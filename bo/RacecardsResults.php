<?php

declare(strict_types=1);

namespace Bo;

use Api\Bo\Traits\AddVideoDetails;
use Api\DataProvider\Bo\RacecardsResults as Dataprovider;
use Api\Constants\Horses as Constants;
use Api\Methods;
use Api\Output\Mapper\Methods\LegacyDecorators;
use Api\Row\Methods\GetEachWayTerms;
use Api\Row\Methods\MapRaceStatusCode;
use Bo\RaceCards\Runners;
use Models\Bo\RaceCards\RaceInstance;
use Api\Exception\ValidationError;

/**
 * This class is used to get data for racecards-results endpoint.
 *
 * The implementation works in a way where we depend on the race_status_code of the race to determine,
 * if we want post or pre race data.
 *
 * This endpoint is created with A/C from
 *  - https://racingpost.atlassian.net/browse/AD-1523
 *  - https://racingpost.atlassian.net/browse/AD-1522
 *
 *
 * Class RacecardsResults
 * @package Bo
 */
class RacecardsResults extends Standart
{
    use GetEachWayTerms;
    use LegacyDecorators;
    use Methods\AddHorsePositioning;
    use MapRaceStatusCode;
    use AddVideoDetails;
    /**
     * @return array
     * @throws \Exception
     */
    public function getData()
    {
        $raceData = [];
        $raceId = $this->request->getRaceId();
        $raceStatusCodeData = (new Dataprovider())->getRaceStatusCodeAndRaceDatetime($raceId);
        if (empty($raceStatusCodeData)) {
            return [];
        }
        // We access the array by the first index because we will only have 1 element with 1 status code
        $raceStatusCode = $raceStatusCodeData[0]['race_status_code'];

        if ($raceStatusCode == Constants::RACE_STATUS_ABANDONED_STR) {
            throw new ValidationError(7115);
        }

        // THIS PART COVERS POST RACE DATA //
        if ($raceStatusCode == Constants::RACE_STATUS_RESULTS_STR) {
            $resultsBo = new Results($this->request);
            $raceData = $resultsBo->getRaceInfo(true);

            if (empty($raceData)) {
                return [];
            }

            // The below values are null by default for post data (requirement)
            $raceData->description          = null;
            $raceData->course_name          = null;
            $raceData->max_runners          = null;
            $raceData->veridct              = null;
            $raceData->each_way             = null;
            $raceData->tv_details           = [];
            $raceData->surface              = null;
            $raceData->perform_race_uid_atr = null;
            $raceData->perform_race_uid_ruk = null;
            $raceData->verdict              = null;
            $raceData->weather_details      = null;

            $raceAttributes = (new RaceInstance())->getRaceAttributes([$raceId]);
            $this->populateAdditionalFieldsForRace($raceData, $raceAttributes, true);

            // Set the winning times //
            $raceStats = $resultsBo->getStatistic();
            $raceData->winners_time_secs    = $raceStats->winners_time_secs;
            $raceData->average_time_sec     = $raceStats->average_time_sec;
            $furlongs                       = $raceData->distance->yards / 220;

            $raceData->diff_to_standard_time = $this->sumDiffToStandardTime(
                $raceStats->winners_time_secs,
                $raceStats->average_time_sec
            );

            $raceData->winners_time_secs_furlongs = !is_null($raceData->winners_time_secs) ? $raceStats->winners_time_secs / $furlongs : null;
            $raceData->diff_to_standard_time_furlongs = !is_null($raceData->diff_to_standard_time) ? $raceData->diff_to_standard_time / $furlongs : null;

            $raceData->total_sp = round($raceStats->total_sp, 2);

            // We need only to apply euro prizes to races that are "IRE"
            $this->addEuroPrize($raceData);

            // Runners data manipulation //
            $raceData->runners = $resultsBo->getResultsByRaceId(true);
            $geldingFirstTimeRunners = $resultsBo->getModelHorseRace()->getGeldingFirstTimeRunnersForResults($raceId);

            $numberOfrunners = 0;
            foreach ($raceData->runners as $horse) {
                // We set the below values as default for post data (requirement)
                $horse->figures_calculated          = null;
                $horse->figures                     = null;
                $horse->premium_tips                = [];
                $horse->tips                        = [];
                $horse->selection_cnt               = null;
                $horse->longSpotlight               = null;
                $horse->shortSpotlight              = null;
                $horse->trainer_rtf                 = null;
                $horse->over_weight_kg              = null;
                $horse->extra_weight_kg             = null;
                $horse->rp_topspeed_pre             = null;
                $horse->rp_postmark_pre             = null;
                $horse->weight_carried_kg           = null;
                $horse->weight_allowance_kg         = null;
                $horse->days_since_last_run         = null;
                $horse->days_since_last_run_flat    = null;
                $horse->days_since_last_run_jumps   = null;
                $horse->days_since_last_run_ptp     = null;
                $horse->expected_weight_carried_kg  = null;
                $horse->expected_weight_carried_lbs = null;
                $horse->irish_reserve_yn            = null;
                $horse->course_winner               = null;
                $horse->distance_winner             = null;
                $horse->course_distance_winner      = null;
                $horse->beaten_favourite            = null;

                $horse->horse_name          = $horse->horse_style_name;
                $horse->horse_sex_desc      = !empty($horse->horse_sex_desc) ? ucfirst($horse->horse_sex_desc) : null;
                $horse->rp_postmark_post    = $horse->rp_postmark;
                $horse->rp_topspeed_post    = $horse->rp_topspeed = $horse->rp_topspeed > 0 ? $horse->rp_topspeed : null;
                $horse->uid                 = $horse->horse_uid;

                $horse->favourite_bool  = is_string($horse->favourite_flag);
                $horse->non_runner      = in_array($horse->race_outcome_uid, Constants::NON_RUNNER_IDS_ARRAY);

                $horse->saddle_cloth_no = $this->addSaddleClothNo($horse->saddle_cloth_no);

                $numberOfrunners  = $this->addNoOfRunners($numberOfrunners, $horse->non_runner, $horse->irish_reserve_yn);
                $this->addHorsePositioning($horse);

                $horse->gelding_first_time = ($horse->date_gelded !== null
                    && array_key_exists($horse->horse_uid, $geldingFirstTimeRunners));
            }
            $raceData->race_status_code = Constants::RACE_STATUS_MAPPING[$raceData->race_status_code];
            $raceData->no_of_runners = $numberOfrunners;

            // Use the race status, no. of runners and race group code to determine the Eacy-Way terms
            $raceData->each_way = $this->getEachWayTerms($raceStatusCode, $numberOfrunners, $raceData->race_group_code);
        }

        // THIS PART COVERS PRE RACE DATA //
        if (in_array($raceStatusCode, Constants::RACE_STATUS_CODES_PRE_RACE_DATA)) {
            $raceBo = new RaceInstance();
            $raceData = $raceBo->getRaceCard($raceId);

            if (empty($raceData)) {
                return [];
            }

            // The below values are null by default for pre race data (requirement)
            $raceData->total_sp                         = null;
            $raceData->rp_analysis                      = null;
            $raceData->winners_time_secs                = null;
            $raceData->race_start_datetime              = null;
            $raceData->diff_to_standard_time            = null;
            $raceData->winners_time_secs_furlongs       = null;
            $raceData->diff_to_standard_time_furlongs   = null;

            $raceData->description          = $raceData->race_condition_desc;
            $raceData->max_runners          = $raceData->safety_factor_number;

            $raceData->tv_details           = [];
            if (!empty($raceData->rp_tv_text)) {
                $raceData->tv_details[] = $raceData->rp_tv_text;
            }

            $raceAttributes = (new RaceInstance())->getRaceAttributes([$raceId]);
            $this->populateAdditionalFieldsForRace($raceData, $raceAttributes);

            $raceData->prizes = $this->getModelRaceInstancePrize()->getForRaceInstanceId($raceId, $raceData->race_datetime);
            // We need only to apply euro prizes to races that are "IRE"
            $this->addEuroPrize($raceData);

            $verdict = (new RaceCards($this->request))->retrieveVerdict($raceId);
            // we need to remove the byline (the name) which is at the end of the verdict, and display is separately
            if (!empty($verdict)) {
                // we access the array by the first index since we won't have more records than one.
                $raceData->verdict = $verdict[0]->rp_verdict;
            }

            // Runners data manipulation //
            $runnersBo = new Runners($this->request);
            $runners = $runnersBo->getRunners($this->request, true, $raceStatusCode);
            // Don't include the keys of the array (horse_uid) - because the mapper will evaluate and display them
            $raceData->runners =  array_values($runners);
            $numberOfrunners = 0;
            foreach ($raceData->runners as $horse) {
                // We set the below values as default for pre race data (requirement)
                $horse->favourite_bool              = null;
                $horse->favourite_flag              = null;
                $raceData->odds_desc                = null;
                $horse->over_weight_kg              = null;
                $horse->over_weight_lbs             = null;
                $horse->extra_weight_kg             = null;
                $horse->rp_topspeed_post            = null;
                $horse->rp_postmark_post            = null;
                $horse->weight_carried_kg           = null;
                $horse->dth_distance_value          = null;
                $horse->rp_close_up_comment         = null;
                $horse->dtw_sum_distance_value      = null;
                $horse->weight_allowance_kg         = null;
                $horse->expected_weight_carried_kg  = null;

                $horse->tips                        = $horse->tips ?? [];
                $horse->premium_tips                = $horse->premium_tips ?? [];

                // In pre-race status we need to set official_rating_ran_off to the calculated official_rating_today
                $horse->official_rating_ran_off     = $horse->official_rating_today;

                $horse->uid                         = $horse->horse_uid;
                $horse->dam_uid                     = $horse->dam_id;
                $horse->sire_uid                    = $horse->sire_id;
                $horse->odds_desc                   = $horse->forecast_odds_desc;
                $horse->rp_postmark_pre             = $horse->rp_postmark;
                $horse->rp_topspeed_pre             = $horse->rp_topspeed = $horse->rp_topspeed > 0 ? $horse->rp_topspeed : null;
                $horse->owner_style_name            = $horse->owner_name;
                $horse->jockey_style_name           = $horse->jockey_name;
                $horse->horse_sire_country          = $horse->sire_country;
                $horse->horse_dam_country           = $horse->dam_country;
                $horse->horse_sire_style_name       = $horse->sire_name;
                $horse->horse_dam_style_name        = $horse->dam_name;
                $horse->horse_country_origin_code   = $horse->country_origin_code;
                $horse->expected_weight_carried_lbs = $horse->weight_carried_lbs;
                // first we need to set the weight_carried to the expected since the mapper will expect that field
                // and then we set it to null since thats the business requirements for pre-race data
                $horse->weight_carried_lbs          = null;
                $horse->trainer_rtf                 = $this->roundToTwoDecimalPoints($horse->trainer_rtf);
                $horse->saddle_cloth_no             = $this->addSaddleClothNo($horse->saddle_cloth_no);
                $horse->non_runner                  = $this->dbYNtoBool($horse->non_runner);
                $horse->horse_sex_desc              = !empty($horse->horse_sex_desc) ? ucfirst($horse->horse_sex_desc) : null;
                // For races outside UK, IRE, HK & UAE course_wins, distance_wins & course_and_distance_wins will be
                // null and we should keep that value here, while still using false for other empty cases.
                $horse->course_winner               = !empty($horse->course_wins) ? true : (!is_null($horse->course_wins) ? false : null);
                $horse->distance_winner             = !empty($horse->distance_wins) ? true : (!is_null($horse->distance_wins) ? false : null);
                $horse->course_distance_winner      = !empty($horse->course_and_distance_wins) ? true : (!is_null($horse->course_and_distance_wins) ? false : null);
                $horse->beaten_favourite            = $horse->beaten_favourite == 'Y' ? true : false;

                // We only need the last 6 form figures per A/C requirements
                if (!empty($horse->figures_calculated)) {
                    $horse->figures_calculated = array_slice($horse->figures_calculated, 0, 6);
                }

                if (!empty($horse->figures)) {
                    $horse->figures = substr($horse->figures, -6);
                }
                $numberOfrunners = $this->addNoOfRunners($numberOfrunners, $horse->non_runner, $horse->irish_reserve_yn);
                $horse->irish_reserve_yn = strtolower($horse->irish_reserve_yn) == 'y' ? true : false;

                $this->addHorsePositioning($horse, true);
            }
            $raceData->race_status_code = $this->mapRaceStatusCode($raceStatusCode, $numberOfrunners, $raceData->early_closing_race_yn);
            $raceData->no_of_runners = $numberOfrunners;

            // Use the race status, no. of runners and race group code to determine the Each-Way terms
            $raceData->each_way = $this->getEachWayTerms($raceStatusCode, $numberOfrunners, $raceData->race_group_code);
        }
        return $raceData;
    }

    /**
     * This method is used to populate additional fields which are common between pre/post race data.
     *
     * We assume we will always have the main properties (race_type_code, race_status_code) available in $raceData.
     *
     * @param $raceData
     * @param $raceAttributes
     * @param bool $resultsStatus
     */
    private function populateAdditionalFieldsForRace(&$raceData, $raceAttributes, $resultsStatus = false)
    {
        $bettingReturns = new \StdClass();
        $bettingReturns->tote_currency_code             = null;
        $bettingReturns->tote_win_money                 = null;
        $bettingReturns->tote_place_1_money             = null;
        $bettingReturns->tote_place_2_money             = null;
        $bettingReturns->tote_place_3_money             = null;
        $bettingReturns->tote_place_4_money             = null;
        $bettingReturns->tricast_money                  = null;
        $bettingReturns->tote_trio_money                = null;
        $bettingReturns->jackpot_text                   = null;
        $bettingReturns->placepot_text                  = null;
        $bettingReturns->quadpot_text                   = null;
        $bettingReturns->rule4_value                    = null;
        $bettingReturns->rule4_text                     = null;
        $bettingReturns->tote_dual_forecast_money       = null;
        $bettingReturns->computer_strght_frcst_money    = null;

        $replayDetails = $this->returnDefaultReplayObj();
        if ($resultsStatus) {
            // Lets add the betting returns and replay details to our $raceData (only when race is at results status)
            $bettingReturns->tote_currency_code             = $raceData->tote_currency_code;
            $bettingReturns->tote_win_money                 = $raceData->tote_win_money;
            $bettingReturns->tote_place_1_money             = $raceData->tote_place_1_money;
            $bettingReturns->tote_place_2_money             = $raceData->tote_place_2_money;
            $bettingReturns->tote_place_3_money             = $raceData->tote_place_3_money;
            $bettingReturns->tote_place_4_money             = $raceData->tote_place_4_money;
            $bettingReturns->tricast_money                  = $raceData->tricast_money;
            $bettingReturns->tote_trio_money                = $raceData->tote_trio_money;
            $bettingReturns->jackpot_text                   = $this->trimAndNullifyString($raceData->jackpot_text);
            $bettingReturns->placepot_text                  = $this->trimAndNullifyString($raceData->placepot_text);
            $bettingReturns->quadpot_text                   = $this->trimAndNullifyString($raceData->quadpot_text);
            $bettingReturns->rule4_value                    = $raceData->rule4_value;
            $bettingReturns->rule4_text                     = $raceData->rule4_text;
            $bettingReturns->computer_strght_frcst_money    = $raceData->computer_strght_frcst_money;
            $bettingReturns->tote_dual_forecast_money       = $raceData->tote_dual_forecast_money;

            if (!empty($raceData->video_detail)) {
                $replayDetails = $raceData->video_detail[0];
            }
        }

        $raceData->bettingReturns = $bettingReturns;
        $raceData->replay_details = $replayDetails;

        // Lets add distance data
        $raceData->distance             = new \StdClass();
        $raceData->distance->miles      = null;
        $raceData->distance->yards      = $raceData->distance_yard;
        $raceData->distance->meters     = null;
        $raceData->distance->furlongs   = null;

        $raceData->race_type_desc   = Constants::JANUS_RACE_TYPE_DESCRIPTIONS[$raceData->race_type_code];
        $raceData->category = [];
        $raceData->race_class = null;
        $raceData->surface = null;


        // Category Logic: when race_group_uid = 0 we ignore the description otherwise we should display it (requirement)
        if (!empty($raceData->race_group_uid) && $raceData->race_group_uid !== 0 && !empty($raceData->race_group_desc)) {
            $raceData->category[] = $raceData->race_group_desc;
        }

        if (!empty($raceAttributes)) {
            // Pre race data requires us to set race_class but for post race data we already have the property set
            if (empty($raceData->race_class)) {
                $classConstant = $raceData->country_code == 'GB' ? CONSTANTS::RACE_CLASS : Constants::RACE_CLASS_SUB;
                $classConstant = trim($classConstant, "'");

                if (isset($raceAttributes[$classConstant]) &&
                    !empty($raceAttributes[$classConstant])) {
                    $raceClassObject = current($raceAttributes[$classConstant]['attrib_uids']);
                    $raceData->race_class = $raceClassObject['race_attrib_desc'];
                }
            }
            // We only want to include surface race attrib descriptions (requirement)
            if (!empty($raceAttributes) &&
                !empty($raceAttributes['Surface']) &&
                !empty($raceAttributes['Surface']->attrib_uids)
            ) {
                // Surface will only ever contain value so we are safe to either take it directly using index 0
                $raceData->surface = array_values($raceAttributes['Surface']->attrib_uids)[0]->race_attrib_desc ?? null;
            }

            // We need to check race_attrib_lookup table to see if "Category" exists and show the race_attrib_desc (requirement)
            if (!empty($raceAttributes['Category'])) {
                foreach ($raceAttributes['Category']['attrib_uids'] as $attributes) {
                    // some of the values we get from race_attrib_desc need to be mapped hence the ternary below
                    $raceData->category[] = Constants::RACE_ATTRIB_DESC_CATEGORY_MAPPING[$attributes->race_attrib_desc] ?? $attributes->race_attrib_desc;
                }
            }
        }
    }

    /**
     * This method is used to set null values for euro prize.
     * @param $raceData
     */
    private function addEuroPrize(&$raceData)
    {
        // We need only to apply euro prizes to races that are "IRE"
        if ($raceData->country_code !== Constants::COUNTRY_IRE) {
            foreach ($raceData->prizes as $prizeObj) {
                $prizeObj->prize_euro = null;
            }
        }
    }

    /**
     * @param int $numberOfrunners
     * @param bool $nonRunner
     * @param string|null $irishReserve
     * @return integer
     */
    private function addNoOfRunners(int $numberOfrunners, bool $nonRunner, ?string $irishReserve)
    {
        if ($nonRunner == false && $irishReserve != 'Y') {
            $numberOfrunners++;
        }
        return $numberOfrunners;
    }
}
