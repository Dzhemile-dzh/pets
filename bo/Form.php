<?php

declare(strict_types=1);

namespace Bo;

use Api\Bo\Traits\AddVideoDetails;
use Api\Constants\Horses as Constants;
use Models\Bo\RaceCards\RaceInstance;
use Api\Output\Mapper\Methods\LegacyDecorators;
use Api\Methods;

/**
 * This class is used to get data for horses form given a raceID and it should serve pre/post race status.
 * This endpoint is created with A/C from
 * - https://racingpost.atlassian.net/browse/AD-1526
 * - https://racingpost.atlassian.net/browse/AD-1561
 *
 * Class Form
 *
 * @package Bo
 */
class Form extends Standart
{
    use LegacyDecorators;
    use Methods\AddHorsePositioning;
    use AddVideoDetails;

    /**
     * @param $limit
     * @return array
     * @throws \Exception
     */
    public function getForm($limit)
    {
        if ($limit > Constants::PARAMETER_LIMIT_MAX_UPPER) {
            throw new \Api\Exception\ValidationError(30, array('numberOfRaces', (Constants::PARAMETER_LIMIT_MAX_UPPER + 1)));
        }

        $raceId = $this->request->getRaceId();

        $raceStatusAndDatetime = (new \Api\DataProvider\Bo\RacecardsResults())->getRaceStatusCodeAndRaceDatetime($this->request->getRaceId());

        if (empty($raceStatusAndDatetime)) {
            throw new \Api\Exception\NotFound(7101);
        }

        // We access the array by the first index because we will only have 1 item returned
        $queryRaceStatusCode = $raceStatusAndDatetime[0]['race_status_code'];
        $queryRaceDatetime   = $raceStatusAndDatetime[0]['race_datetime'];

        // If the race is abandoned we want to throw an error
        if ($queryRaceStatusCode == Constants::RACE_STATUS_ABANDONED_STR) {
            throw new \Api\Exception\NotFound(7115);
        }

        if ($queryRaceStatusCode == Constants::RACE_STATUS_RESULTS_STR) {
            $isResults = true;
        } else {
            $isResults = false;
        }

        $model = new RaceInstance();
        $model->dropHorsesUidsTmpTables();
        $model->createHorsesIdTables($raceId, 0, $isResults);

        $runnersIds = $model->getRunnersIds();

        $formData = $model->getForm($runnersIds, $raceId, $isResults, $queryRaceDatetime, true, $limit);

        //As a pre-caution we want to throw error in case we have no form and no runners (most likely this won't happen)
        if (empty($formData) && empty($runnersIds)) {
            throw new \Api\Exception\NotFound(7101);
        }

        // Add video details to the form data we retrieved above
        (new RaceCards($this->request))->addVideoDetails($formData);

        // We need only the race IDS to get the race attributes for all the races of the given horse
        $raceIds = [];
        foreach ($formData as $horse) {
            foreach ($horse->races as $race) {
                $raceIds[] = $race->race_instance_uid;
            }
        }

        if (!empty($raceIds)) {
            $allRacesAttributes = $model->getRaceAttributes($raceIds, 'form');
        } else {
            $allRacesAttributes = [];
        }

        // Lets check which horses don't have form data because we need to still return the horse_uid
        $horsesWithNoFormData = array_diff_key(array_flip($runnersIds), $formData);
        if (!empty($horsesWithNoFormData)) {
            // lets loop them and add each horse as an object with horse_uid inside to our $formData
            foreach ($horsesWithNoFormData as $key => $horse) {
                $formData[$key]->horse_uid = $key;
            }
        }
        // Now we need to do the data manipulation for the race and the horses
        foreach ($formData as $horse) {
            // Check straight away if we have records for any races the horse has participated in, otherwise skip horse
            if (empty($horse->races)) {
                $horse->races = [];
                continue;
            }
            foreach ($horse->races as $race) {
                // When at post race status we should only include records for races after the race_datetime of the race in the url.
                if ($isResults && ($race->race_datetime < $queryRaceDatetime || $race->race_instance_uid == $raceId)) {
                    unset($horse->races[$race->race_instance_uid]);
                    continue;
                }

                if (empty($race->video_detail)) {
                    $replayDetails = $this->returnDefaultReplayObj();
                    $race->video_detail = [$replayDetails];
                }

                $this->addHorsePositioning($race);
                // Lets add distance data and the default fields
                $race->distance             = new \StdClass();
                $race->distance->miles      = null;
                $race->distance->yards      = $race->distance_yard;
                $race->distance->meters     = null;
                $race->distance->furlongs   = null;
                $race->weight_carried_kg    = null;
                $race->weight_allowance_kg  = null;
                $race->official_rating      = null;
                $race->meeting_uid          = null;
                $race->favourite_bool   = is_string($race->favourite_flag);
                $race->saddle_cloth_no  = $this->addSaddleClothNo($race->saddle_cloth_no);
                $race->race_status_code = Constants::RACE_STATUS_WORD_RESULT;
                $race->race_type_desc   = Constants::JANUS_RACE_TYPE_DESCRIPTIONS[$race->race_type_code];

                if (!empty($allRacesAttributes[$race->race_instance_uid])) {
                    $raceAttributes = $allRacesAttributes[$race->race_instance_uid];
                } else {
                    $raceAttributes = [];
                }
                $this->addSurfaceAndCategory($race, $raceAttributes);

                if (!empty($race->other_horse)) {
                    $race->other_horse->weight_carried_kg = null;
                    // In case we have a winning horse we should set the winning_distance in other horse object
                    if ($race->final_race_outcome_uid == 1) {
                        $race->other_horse->winning_distance = $race->dtw_sum_distance_value;
                    } else {
                        $race->other_horse->winning_distance = null;
                    }
                } else {
                    $race->other_horse = new \StdClass();
                    $race->other_horse->style_name = null;
                    $race->other_horse->horse_uid = null;
                    $race->other_horse->weight_carried_lbs = null;
                    $race->other_horse->weight_carried_kg = null;
                    $race->other_horse->winning_distance = null;
                }

                $race->rp_topspeed = $race->rp_topspeed > 0 ? $race->rp_topspeed : null;
            }
            $horse->races = array_values($horse->races);
        }
        $model->dropHorsesUidsTmpTables();

        return array_values($formData);
    }
    /**
     * Method to add Surface, Category and Distance fields to the race data
     *
     * @param $raceData
     * @param $raceAttributes
     */
    private function addSurfaceAndCategory(&$raceData, $raceAttributes)
    {
        $raceData->category = [];
        $raceData->surface = null;

        // Category Logic: when race_group_uid = 0 we ignore the description otherwise we should display it (requirement)
        if (!empty($raceData->race_group_uid) && $raceData->race_group_uid !== 0 && !empty($raceData->race_group_desc)) {
            $raceData->category[] = $raceData->race_group_desc;
        }

        if (!empty($raceAttributes) && !empty($raceAttributes->attrib_codes)) {
            // We only want to include surface race attrib descriptions (requirement)
            if (!empty($raceAttributes)
                && !empty($raceAttributes->attrib_codes['Surface'])
                && !empty($raceAttributes->attrib_codes['Surface']->attrib_uids)
            ) {
                // Surface will only ever contain value so we are safe to either take it directly using index 0
                $raceData->surface = $raceAttributes->attrib_codes['Surface']->attrib_uids[0]->race_attrib_desc ?? null;
            }

            // We need to check race_attrib_lookup table to see if "Category" exists and show the race_attrib_desc (requirement)
            if (!empty($raceAttributes->attrib_codes['Category'])
                && !empty($raceAttributes->attrib_codes['Category']->attrib_uids)
            ) {
                foreach ($raceAttributes->attrib_codes['Category']['attrib_uids'] as $attributes) {
                    // some of the values we get from race_attrib_desc need to be mapped hence the ternary below
                    $raceData->category[] = Constants::RACE_ATTRIB_DESC_CATEGORY_MAPPING[$attributes->race_attrib_desc] ?? $attributes->race_attrib_desc;
                }
            }
        }
    }
}
