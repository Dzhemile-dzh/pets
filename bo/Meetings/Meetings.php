<?php

declare(strict_types=1);

namespace Bo\Meetings;

use Api\Bo\Traits as Traits;
use Api\Constants\Horses as Constants;
use Api\DataProvider\Bo\Meetings\Meetings as Dataprovider;
use Api\Exception;
use Api\Input\Request\Horses\Meetings as Request;
use Api\Row\Methods\MapRaceStatusCode;
use Bo\Standart;
use Bo\VideoProviders;
use InvalidArgumentException;
use Models\Bo\Results\RaceAttribLookup;
use Models\Bo\Results\RaceInstance as RaceInstance;
use Models\Course as Course;

/**
 * Class Meetings
 *
 * @property Request $request;
 *
 * @package Bo\Meetings
 */
class Meetings extends Standart
{
    use MapRaceStatusCode;
    use Traits\EveningMeetingCheck;

    /**
     * @return array
     * @throws \Exception
     */
    public function getData()
    {
        $raceDate = $this->getRequest()->getDate() ?? date('Y-m-d');

        $data = (new Dataprovider())->getMeetingsData($raceDate);
        if (empty($data['meetings'])) {
            return [];
        }

        // we should only try to retrieve data for tote and video if the race is at result status
        if (isset($data['racesByRaceStatus'][Constants::RACE_STATUS_RESULTS_STR]['races'])) {
            $resultStatusRaceIds = array_keys($data['racesByRaceStatus'][Constants::RACE_STATUS_RESULTS_STR]['races']);

            if (!empty($resultStatusRaceIds)) {
                $toteData  = $this->getTote($resultStatusRaceIds);
                $videoData = $this->getVideoProviders($resultStatusRaceIds);
            }
        }

        $excludedMeetings = [];
        $includedMeetings = [];

        // declare one instance of RaceAttribLookup here for later use within foreach loops.
        $raceAttribs = new RaceAttribLookup();
        foreach ($data['meetings'] as $key => $meeting) {
            $meeting->country_code = trim($meeting->country_code);

            // meetingStartDatetime is the first race in the races array because its ordered from the SQL based on race_datetime
            $firstRace = $meeting->races[0];

            // if hours_difference is null we set to zero because in the mapper we use a method that cannot evaluate null
            $meeting->hours_difference         = $firstRace->hours_difference ?? 0;
            $meeting->meeting_time             = $firstRace->race_datetime;
            $meeting->numberOfRaces            = count($meeting->races);
            $meeting->containsNotFinishedRaces = 0;
            $meeting->rp_meeting_order         = 100;
            $meeting->race_date                = $raceDate;
            $meeting->racesItv                 = 0;
            $meeting->totalPrizeMoney          = 0;
            $meeting->hasRaces                 = false;
            $meeting->sumNonRunners            = 0;
            $meeting->going_desc               = $firstRace->going_desc;
            // Only do the evening meeting check for present and future dates
            if ($raceDate >= date('Y-m-d')) {
                // A meeting with its first race starting after 4pm UK time is considered to be an evening meeting
                $meeting->eveningMeeting = $this->getEveningMeetingFlag($firstRace->race_datetime);
            } else {
                $meeting->eveningMeeting = 0;
            }

            // We want to prioritise GB & IRE meetings ahead of others
            $meeting->rp_position = in_array($meeting->country_code, [Constants::COUNTRY_GB, Constants::COUNTRY_IRE]) ? 1 : 2;

            $raceTypeCodes = [];
            foreach ($meeting['races'] as $race) {
                $race->bettingReturns   = null;
                $race->replayDetails    = null;
                $race->tvDetails        = [];
                $race->category         = [];
                $race->race_class       = $race->race_class > 0 ? (int)$race->race_class : null;
                $race->hours_difference = $race->hours_difference ?? 0;

                if (isset($race->rp_tv_text) && trim($race->rp_tv_text) != '') {
                    $race->tvDetails[] = trim($race->rp_tv_text);

                    if (in_array(trim($race->rp_tv_text), Constants::ITV_CODES)) {
                        $meeting->racesItv = -1;
                    }
                }

                // Only set category to race_group_desc when a valid race_group_uid & race_group_desc is found
                if (!empty($race->race_group_uid) && !empty($race->race_group_desc)) {
                    $race->category[] = $race->race_group_desc;
                }

                $raceAttribCategories = $raceAttribs->getRaceCategory($race->race_instance_uid);

                // If any race attrib categories exist, add these to the category array.
                if (!empty($raceAttribCategories)) {
                    foreach ($raceAttribCategories as $raceGroupDesc) {
                        // some of the values we get from race_attrib_desc need to be mapped to a different value
                        $race->category[] = Constants::RACE_ATTRIB_DESC_CATEGORY_MAPPING[$raceGroupDesc->race_attrib_desc] ?? $raceGroupDesc->race_attrib_desc;
                    }
                }

                if (isset($race->official_rating_band_desc)) {
                    $race->official_rating_band_desc = trim($race->official_rating_band_desc);
                }

                $race->is_handicap = in_array($race->race_group_uid, Constants::HANDICAP_RACE_GROUP_ARR);

                $race->distance = new \StdClass();

                $race->distance->miles    = null;
                $race->distance->yards    = $race->distance_yard;
                $race->distance->meters   = null;
                $race->distance->furlongs = null;

                if ($race->race_status_code != Constants::RACE_STATUS_ABANDONED_STR) {
                    $meeting->hasRaces = true;

                    if (!empty($race->pool_prize_sterling)) {
                        $meeting->totalPrizeMoney -= $race->pool_prize_sterling;
                    }
                    $meeting->sumNonRunners += $race->sumNonRunners;

                    // set tote info only if race is at results status
                    if ($race->race_status_code == Constants::RACE_STATUS_RESULTS_STR) {
                        $race->bettingReturns = $toteData[$race->race_instance_uid]  ?? null;
                        $race->replayDetails  = $videoData[$race->race_instance_uid] ?? null;
                    } else {
                        // Any race that's not a result or abandoned means the meeting still has unfinished races
                        $meeting->containsNotFinishedRaces = -1;
                    }
                }

                // we need to map the race_status_code according to what janus requires
                $race->race_status_code = $this->mapRaceStatusCode(
                    $race->race_status_code,
                    $race->no_of_runners,
                    $race->early_closing_race_yn
                );

                $race->race_type_desc = Constants::JANUS_RACE_TYPE_DESCRIPTIONS[$race->race_type_code];

                $raceTypeCodes[] = $race->race_type_code;
            }

            $meeting->meeting_type = null;
            try {
                $meeting->meeting_type = $this->getModelSelectors()->getMeetingTypeByRacesTypes($raceTypeCodes);
            } catch (InvalidArgumentException $e) {
            } catch (Exception\ValidationError $e) {
            }

            // Exclude abandoned meetings from rp_meeting_order calculation, but keep their original key.
            if ($meeting->hasRaces === false) {
                $meeting->rp_meeting_order = null;

                $excludedMeetings[$key] = $meeting;
            } else {
                $includedMeetings[$key] = $meeting;
            }
        }

        (new Course)->calculateRpMeetingOrder($includedMeetings);

        // Bring all the meetings back together again.
        // We use a union (+) rather than array_merge to preserve the original keys, allowing us to resort
        // $data['meetings'] and preserve the original order of any abandoned meetings in the array.
        $data['meetings'] = $includedMeetings + $excludedMeetings;
        ksort($data['meetings']);

        return [
            'meetings' => $data['meetings']
        ];
    }

    /**
     * @param $raceIds
     * @return array
     */
    protected function getTote($raceIds)
    {
        return (new RaceInstance())->getTote($raceIds);
    }

    /**
     * @param $raceIDs
     * @return array
     * @throws \Api\Exception\InternalServerError
     */
    protected function getVideoProviders($raceIDs)
    {
        return (new VideoProviders($raceIDs))->getDetails();
    }
}
