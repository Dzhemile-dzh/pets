<?php

namespace Tests\Stubs\Models;

use Phalcon\Mvc\Model\Exception as Exception;
use Phalcon\Mvc\Model as Model;

class RaceInstance extends \Models\RaceInstance
{
    use StubDataGetter;

    private $raceId;
    private $horseId;

    /**
     * @return mixed
     */
    protected function getRaceId()
    {
        return $this->raceId;
    }

    /**
     * @param int $raceId
     */
    protected function setRaceId($raceId)
    {
        $this->raceId = $raceId;
    }

    /**
     * @return mixed
     */
    protected function getHorseId()
    {
        return $this->horseId;
    }

    /**
     * @param int $horseId
     */
    protected function setHorseId($horseId)
    {
        $this->horseId = $horseId;
    }

    protected static $_stubData = [
        'races' => [
            608774 => [
                'race_instance_uid' => 608774,
                'race_instance_title' => 'Irish Stallion Farms EBF Maiden Stakes (Div I)',
                'race_datetime' => '2014-09-05 18:20:00',
                'race_start_datetime' => '2014-09-05 18:21:08',
                'distance_yard' => 1760,
                'course_uid' => 1079,
                'straight_round_jubilee_code' => null,
                'going_type_code' => 'SD',
                'ages_allowed_uid' => 2,
                'start_flag_yn' => 'N',
                'going_correction' => null,
                'race_group_uid' => 0,
                'official_rating_band_uid' => null,
                'winners_time_secs' => 100.09,
                'diff_to_standard_time_sec' => 3.29,
                'photo_finish_uid' => null,
                'race_comments' => null,
                'source_uid' => null,
                'race_type_code' => 'X',
                'race_status_code' => 'R',
                'pool_prize_sterling' => 4500.00,
                'timestamp' => null,
                'wknum_yn' => 'N',
                'no_of_runners' => null,
                'rp_stalls_position' => 'L',
                'rp_omitted_fences' => 'Resource id #55',
                'rp_going_correction' => 0.5500,
                'rp_analysis' => null,
                'three_yo_min_weight_lbs' => null,
                'weights_raised_lbs' => null,
                'minimum_weight_lbs' => null,
                'race_number' => null,
                'formbook_yn' => 'Y',
                'wk_diff_to_standard_time_sec' => null,
                'scratching_fee' => null,
                'supplementary_fee_1' => null,
                'supplementary_fee_2' => null,
                'winner_late_disq' => null,
                'lst_yr_race_instance_uid' => 585336,
                'race_class' => null,
                'safety_factor_number' => 14,
                'reopened_yn' => 'N',
                'early_closing_race_yn' => null,
                'alt_race_title' => null,
                'subscription_list' => null,
                'track_code' => null,
                'stats_flag' => null
            ],
            609758 => [
                'race_instance_uid' => 609758,
                'race_instance_title' => 'toteexacta Pick The 1,2 EBF Maiden Stakes (Tapeta)',
                'race_datetime' => '2014-09-20 19:50:00',
                'race_start_datetime' => '2014-09-20 19:51:40',
                'distance_yard' => 1901,
                'course_uid' => 513,
                'straight_round_jubilee_code' => null,
                'going_type_code' => 'SD',
                'ages_allowed_uid' => 2,
                'start_flag_yn' => 'N',
                'going_correction' => null,
                'race_group_uid' => 0,
                'official_rating_band_uid' => null,
                'winners_time_secs' => 110.66,
                'diff_to_standard_time_sec' => null,
                'photo_finish_uid' => null,
                'race_comments' => null,
                'source_uid' => null,
                'race_type_code' => 'X',
                'race_status_code' => 'R',
                'pool_prize_sterling' => 4500.00,
                'timestamp' => null,
                'wknum_yn' => 'N',
                'no_of_runners' => null,
                'rp_stalls_position' => 'L',
                'rp_omitted_fences' => 'Resource id #55',
                'rp_going_correction' => null,
                'rp_analysis' => null,
                'three_yo_min_weight_lbs' => null,
                'weights_raised_lbs' => null,
                'minimum_weight_lbs' => null,
                'race_number' => null,
                'formbook_yn' => 'Y',
                'wk_diff_to_standard_time_sec' => null,
                'scratching_fee' => null,
                'supplementary_fee_1' => null,
                'supplementary_fee_2' => null,
                'winner_late_disq' => null,
                'lst_yr_race_instance_uid' => 586124,
                'race_class' => null,
                'safety_factor_number' => 13,
                'reopened_yn' => 'N',
                'early_closing_race_yn' => null,
                'alt_race_title' => null,
                'subscription_list' => null,
                'track_code' => null,
                'stats_flag' => null
            ],
            610274 => [
                'race_instance_uid' => 610274,
                'race_instance_title' => 'Pinpoint Recruitment/EBF Maiden Stakes (Bobis Race)',
                'race_datetime' => '2014-10-01 14:00:00',
                'race_start_datetime' => '2014-10-01 14:01:14',
                'distance_yard' => 1763,
                'course_uid' => 37,
                'straight_round_jubilee_code' => 'GF',
                'going_type_code' => 'GF',
                'ages_allowed_uid' => 2,
                'start_flag_yn' => 'N',
                'going_correction' => null,
                'race_group_uid' => 0,
                'official_rating_band_uid' => null,
                'winners_time_secs' => 101.75,
                'diff_to_standard_time_sec' => 3.75,
                'photo_finish_uid' => null,
                'race_comments' => null,
                'source_uid' => null,
                'race_type_code' => 'F',
                'race_status_code' => 'R',
                'pool_prize_sterling' => 6300.00,
                'timestamp' => null,
                'wknum_yn' => 'N',
                'no_of_runners' => null,
                'rp_stalls_position' => 'C',
                'rp_omitted_fences' => 'Resource id #55',
                'rp_going_correction' => 0.9500,
                'rp_analysis' => null,
                'three_yo_min_weight_lbs' => null,
                'weights_raised_lbs' => null,
                'minimum_weight_lbs' => null,
                'race_number' => null,
                'formbook_yn' => 'Y',
                'wk_diff_to_standard_time_sec' => null,
                'scratching_fee' => null,
                'supplementary_fee_1' => null,
                'supplementary_fee_2' => null,
                'winner_late_disq' => null,
                'lst_yr_race_instance_uid' => 586774,
                'race_class' => null,
                'safety_factor_number' => 16,
                'reopened_yn' => 'N',
                'early_closing_race_yn' => null,
                'alt_race_title' => null,
                'subscription_list' => null,
                'track_code' => null,
                'stats_flag' => null
            ],
            597477 => [
                "race_instance_uid" => 597477,
                "race_type_code" => "C",
                "race_datetime" => "Apr 5 2014 3:45PM",
                "race_status_code" => "O",
                "course" => "CHEPSTOW",
                "course_uid" => 12,
                "country_code" => "GB ",
                "distance_yard" => 5280,
                "going" => "Good To Soft",
                "ages_allowed" => "5yo+",
                "latitude" => 51.659193,
                "longitude" => -2.693946,
            ],
            599067 => [
                "race_instance_uid" => 599067,
                "race_type_code" => "H",
                "race_datetime" => "Apr 3 2014 4:45PM",
                "race_status_code" => "O",
                "course" => "CLONMEL",
                "course_uid" => 177,
                "country_code" => "IRE",
                "distance_yard" => 3620,
                "going" => "Heavy",
                "ages_allowed" => "6yo+",
                "latitude" => 51.659193,
                "longitude" => -2.693946,
            ],
            //for results US PR-91
            611487 => [
                "id" => 611487,
                'course' => 'La plata (ARG)',
                'date' => '9/28/2014',
                'time' => '9:55',
                'title' => 'PREMIO CLASICO JOCKEY CLUB DE LA PROVINCIA DE BUENOS AIRES (GROUP 2) (3YO) (DIRT)',
                'class' => '',
                'race_type' => 'All-weather',
                'ages allowed' => '3yo',
                'distance' => '1m2f',
                'distance_rounded' => '',
                'going' => 'Slow',
                'obstacles' => '',
                'obstacle type' => '',
                'currency' => '£',
                'prize 1' => '29657.09',
                'prize 2' => '8897.13',
                'prize 3' => '5338.28',
                'prize 4' => '',
                'prize 5' => '',
                'prize 6' => '',
                'prize 7' => '',
                'prize 8' => '',
                'runners' => '3',
                'Time' => '2m4.03s',
                'Total SP' => '134%',
                '1st owner' => 'La Frontera',
                '1st owner_id' => '',
                '1st Breeder' => 'Francisso Fraguas',
                '1st breeder_id' => '',
                '2nd owner' => 'Castel Gandolfo',
                '2nd owner_id' => '',
                '3rd owner' => 'La Campana',
                '3rd owner_id' => '',
                'Tote Win' => '',
                'Tote Place 1' => '',
                'Tote Place 2' => '',
                'Tote Place 3' => '',
                'Tote Place 4' => '',
                'Exacta' => '',
                'CSF' => '',
                'Tricast' => '',
                'Video stream' => '',
            ],
            609671 => [
                'id' => '609671',
                'course' => 'Newton Abbot',
                'date' => '9/19/2014',
                'time' => '14:40',
                'title' => 'CHANNON AND CO CHARTERED ACCOUNTANTS NOVICES\' CHASE',
                'class' => '4',
                'race_type' => 'Chase',
                'ages allowed' => '4yo+',
                'distance' => '2m5f110y',
                'distance_rounded' => '2m51/2f',
                'going' => 'Good',
                'obstacles' => '16',
                'obstacle type' => 'fences',
                'currency' => '£',
                'prize 1' => '3898',
                'prize 2' => '1144',
                'prize 3' => '572',
                'prize 4' => '',
                'prize 5' => '',
                'prize 6' => '',
                'prize 7' => '',
                'prize 8' => '',
                'runners' => '3',
                'Time' => '5m15.80s',
                'Total SP' => '108%',
                '1st owner' => 'Girls Allowed',
                '1st owner_id' => '',
                '1st Breeder' => 'Noel Fenton',
                '1st breeder_id' => '',
                '2nd owner' => 'Mrs Caren Walsh & Mars Kathleen Quinn',
                '2nd owner_id' => '',
                '3rd owner' => 'D McCain Jnr',
                '3rd owner_id' => '',
                'Tote Win' => '2.5',
                'Tote Place 1' => '',
                'Tote Place 2' => '',
                'Tote Place 3' => '',
                'Tote Place 4' => '',
                'Exacta' => '2.2',
                'CSF' => '2.66',
                'Tricast' => '',
                'Video stream' => '',
            ],
            599203 => array(
                'race_instance_uid' => 599203,
                'race_instance_title' => 'Irish Stallion Farms European Breeders Fund Maiden',
                'race_datetime' => 'Apr  6 2014  1:55PM',
                'race_start_datetime' => 'Apr  6 2014  1:55PM',
                'distance_yard' => 1100,
                'course_uid' => 596,
                'straight_round_jubilee_code' => null,
                'going_type_code' => 'HY',
                'ages_allowed_uid' => 2,
                'start_flag_yn' => null,
                'going_correction' => null,
                'race_group_uid' => 0,
                'official_rating_band_uid' => null,
                'winners_time_secs' => null,
                'diff_to_standard_time_sec' => null,
                'photo_finish_uid' => null,
                'race_comments' => null,
                'source_uid' => 17,
                'race_type_code' => 'F',
                'race_status_code' => 'O',
                'pool_prize_sterling' => 14500,
                'timestamp' => '00000000000003ca',
                'wknum_yn' => null,
                'no_of_runners' => 8,
                'rp_stalls_position' => null,
                'rp_omitted_fences' => null,
                'rp_going_correction' => null,
                'rp_analysis' => null,
                'three_yo_min_weight_lbs' => null,
                'weights_raised_lbs' => null,
                'minimum_weight_lbs' => null,
                'race_number' => null,
                'formbook_yn' => null,
                'wk_diff_to_standard_time_sec' => null,
                'scratching_fee' => null,
                'supplementary_fee_1' => null,
                'supplementary_fee_2' => null,
                'winner_late_disq' => null,
                'lst_yr_race_instance_uid' => null,
                'race_class' => null,
                'safety_factor_number' => null,
                'reopened_yn' => null,
                'early_closing_race_yn' => null,
                'alt_race_title' => null,
                'subscription_list' => 'FL,SP,SS',
                'track_code' => null,
                'stats_flag' => null
            ),
            599206 => array(
                'race_instance_uid' => 599206,
                'race_instance_title' => 'Mallow Handicap',
                'race_datetime' => 'Apr  6 2014  3:30PM',
                'race_start_datetime' => 'Apr  6 2014  3:30PM',
                'distance_yard' => 1540,
                'course_uid' => 596,
                'straight_round_jubilee_code' => null,
                'going_type_code' => 'HY',
                'ages_allowed_uid' => 20,
                'start_flag_yn' => null,
                'going_correction' => null,
                'race_group_uid' => 6,
                'official_rating_band_uid' => null,
                'winners_time_secs' => null,
                'diff_to_standard_time_sec' => null,
                'photo_finish_uid' => null,
                'race_comments' => null,
                'source_uid' => 17,
                'race_type_code' => 'F',
                'race_status_code' => 'O',
                'pool_prize_sterling' => 20000,
                'timestamp' => '00000000000003b1',
                'wknum_yn' => null,
                'no_of_runners' => 9,
                'rp_stalls_position' => null,
                'rp_omitted_fences' => null,
                'rp_going_correction' => null,
                'rp_analysis' => null,
                'three_yo_min_weight_lbs' => null,
                'weights_raised_lbs' => null,
                'minimum_weight_lbs' => 116,
                'race_number' => null,
                'formbook_yn' => null,
                'wk_diff_to_standard_time_sec' => null,
                'scratching_fee' => null,
                'supplementary_fee_1' => null,
                'supplementary_fee_2' => null,
                'winner_late_disq' => null,
                'lst_yr_race_instance_uid' => null,
                'race_class' => null,
                'safety_factor_number' => null,
                'reopened_yn' => null,
                'early_closing_race_yn' => null,
                'alt_race_title' => null,
                'subscription_list' => 'FL,SP,SS',
                'track_code' => null,
                'stats_flag' => null,
            ),
            599210 => array(
                'race_instance_uid' => 599210,
                'race_instance_title' => 'Blackwater Fillies Maiden',
                'race_datetime' => 'Apr  6 2014  5:40PM',
                'race_start_datetime' => 'Apr  6 2014  5:40PM',
                'distance_yard' => 2250,
                'course_uid' => 596,
                'straight_round_jubilee_code' => null,
                'going_type_code' => 'HY',
                'ages_allowed_uid' => 3,
                'start_flag_yn' => null,
                'going_correction' => null,
                'race_group_uid' => 0,
                'official_rating_band_uid' => null,
                'winners_time_secs' => null,
                'diff_to_standard_time_sec' => null,
                'photo_finish_uid' => null,
                'race_comments' => null,
                'source_uid' => 17,
                'race_type_code' => 'F',
                'race_status_code' => 'O',
                'pool_prize_sterling' => 10000,
                'timestamp' => '0000000000000396',
                'wknum_yn' => null,
                'no_of_runners' => 6,
                'rp_stalls_position' => null,
                'rp_omitted_fences' => null,
                'rp_going_correction' => null,
                'rp_analysis' => null,
                'three_yo_min_weight_lbs' => null,
                'weights_raised_lbs' => null,
                'minimum_weight_lbs' => null,
                'race_number' => null,
                'formbook_yn' => null,
                'wk_diff_to_standard_time_sec' => null,
                'scratching_fee' => null,
                'supplementary_fee_1' => null,
                'supplementary_fee_2' => null,
                'winner_late_disq' => null,
                'lst_yr_race_instance_uid' => null,
                'race_class' => null,
                'safety_factor_number' => null,
                'reopened_yn' => null,
                'early_closing_race_yn' => null,
                'alt_race_title' => null,
                'subscription_list' => 'FL,SP,SS',
                'track_code' => null,
                'stats_flag' => null,
            ),
            599701 => [
                'instance_uid' => 599701,
                'race_status_code' => 'O',
                'country_code' => 'USA',
                'race_datetime' => 'Apr  6 2014  5:40PM',
            ],
            599702 => [
                'instance_uid' => 599702,
                'race_status_code' => 'V',
                'country_code' => 'GB',
                'race_datetime' => 'Apr  6 2014  5:40PM',
            ],
            1 => [
                'instance_uid' => 1,
                'race_status_code' => 'O',
                'country_code' => 'GB',
                'race_datetime' => '2014-04-05 12:00:00',
            ],
            2 => [
                'instance_uid' => 2,
                'race_status_code' => 'O',
                'country_code' => 'GB',
                'race_datetime' => '2014-04-05 12:00:00',
            ],
            3 => [
                'instance_uid' => 3,
                'race_status_code' => 'O',
                'country_code' => 'GB',
                'race_datetime' => '2014-04-05 12:00:00',
                'going' => 'Good',
                'distance_yard' => 3630,
                'race_type_code' => 'H',
            ],
        ],
        'validation' => [

        ],
    ];

    public function getRace($raceId)
    {

        if (!is_integer($raceId)) {
            throw new Exception('Set race ID before retrieving it');
        }

        if (!array_key_exists($raceId, static::getStubData('races'))) {
            return null;
        }

        return \Api\Row\RaceInstance::createFromArray(
            static::getStubData('races')[$raceId]
        );
    }

    public function checkFastResults($raceDate)
    {
        return array();
    }

    /**
     * @param int $raceId
     * @param int $horseId
     * @param bool $isResults
     */
    public function createHorsesIdTables($raceId, $horseId = 0, $isResults = false)
    {
        if ($raceId > 0) {
            $this->setRaceId($raceId);
        } elseif ($horseId > 0) {
            $this->setHorseId($horseId);
        }
    }

    /**
     * Drop horsesUids tmp table
     *
     */
    public function dropHorsesUidsTmpTables()
    {
    }
}
