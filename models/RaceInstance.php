<?php

namespace Models;

use Api\Constants\Horses as Constants;
use Phalcon\Db\Sql\Builder;
use Phalcon\Db\Column;
use Phalcon\Mvc\Model\MetaData;
use Phalcon\Mvc\Model\Resultset;
use Phalcon\Mvc\Model\Row;

/**
 * Class RaceInstance
 *
 * @package Models
 */
class RaceInstance extends \Phalcon\Mvc\Model
{
    const HORSES_ID_TABLE = '#horsesIdTMP';
    const HORSES_PTP_GB_ID_TABLE = '#horsesPtpGbIdTMP';

    /**
     *
     * @var integer
     */
    protected $race_instance_uid;

    /**
     *
     * @var string
     */
    protected $race_instance_title;

    /**
     *
     * @var string
     */
    protected $race_datetime;

    /**
     *
     * @var string
     */
    protected $race_start_datetime;

    /**
     *
     * @var integer
     */
    protected $distance_yard;

    /**
     *
     * @var integer
     */
    protected $course_uid;

    /**
     *
     * @var string
     */
    protected $straight_round_jubilee_code;

    /**
     *
     * @var string
     */
    protected $going_type_code;

    /**
     *
     * @var integer
     */
    protected $ages_allowed_uid;

    /**
     *
     * @var string
     */
    protected $start_flag_yn;

    /**
     *
     * @var double
     */
    protected $going_correction;

    /**
     *
     * @var integer
     */
    protected $race_group_uid;

    /**
     *
     * @var integer
     */
    protected $official_rating_band_uid;

    /**
     *
     * @var double
     */
    protected $winners_time_secs;

    /**
     *
     * @var double
     */
    protected $diff_to_standard_time_sec;

    /**
     *
     * @var integer
     */
    protected $photo_finish_uid;

    /**
     *
     * @var string
     */
    protected $race_comments;

    /**
     *
     * @var integer
     */
    protected $source_uid;

    /**
     *
     * @var string
     */
    protected $race_type_code;

    /**
     *
     * @var string
     */
    protected $race_status_code;

    /**
     *
     * @var double
     */
    protected $pool_prize_sterling;

    /**
     *
     * @var string
     */
    protected $timestamp;

    /**
     *
     * @var string
     */
    protected $wknum_yn;

    /**
     *
     * @var integer
     */
    protected $no_of_runners;

    /**
     *
     * @var string
     */
    protected $rp_stalls_position;

    /**
     *
     * @var integer
     */
    protected $rp_omitted_fences;

    /**
     *
     * @var double
     */
    protected $rp_going_correction;

    /**
     *
     * @var string
     */
    protected $rp_analysis;

    /**
     *
     * @var integer
     */
    protected $three_yo_min_weight_lbs;

    /**
     *
     * @var integer
     */
    protected $weights_raised_lbs;

    /**
     *
     * @var integer
     */
    protected $minimum_weight_lbs;

    /**
     *
     * @var integer
     */
    protected $race_number;

    /**
     *
     * @var string
     */
    protected $formbook_yn;

    /**
     *
     * @var double
     */
    protected $wk_diff_to_standard_time_sec;

    /**
     *
     * @var double
     */
    protected $scratching_fee;

    /**
     *
     * @var double
     */
    protected $supplementary_fee_1;

    /**
     *
     * @var double
     */
    protected $supplementary_fee_2;

    /**
     *
     * @var integer
     */
    protected $winner_late_disq;

    /**
     *
     * @var integer
     */
    protected $lst_yr_race_instance_uid;

    /**
     *
     * @var string
     */
    protected $race_class;

    /**
     *
     * @var integer
     */
    protected $safety_factor_number;

    /**
     *
     * @var string
     */
    protected $reopened_yn;

    /**
     *
     * @var string
     */
    protected $early_closing_race_yn;

    /**
     *
     * @var string
     */
    protected $alt_race_title;

    /**
     *
     * @var string
     */
    protected $subscription_list;

    /**
     *
     * @var string
     */
    protected $track_code;

    /**
     *
     * @var string
     */
    protected $stats_flag;

    /**
     * @return array
     */
    public function metaData()
    {
        return [

            //Every column in the mapped table
            MetaData::MODELS_ATTRIBUTES => [
                'race_instance_uid',
                'race_instance_title',
                'race_datetime',
                'race_start_datetime',
                'distance_yard',
                'course_uid',
                'straight_round_jubilee_code',
                'going_type_code',
                'ages_allowed_uid',
                'start_flag_yn',
                'going_correction',
                'race_group_uid',
                'official_rating_band_uid',
                'winners_time_secs',
                'diff_to_standard_time_sec',
                'photo_finish_uid',
                'race_comments',
                'source_uid',
                'race_type_code',
                'race_status_code',
                'pool_prize_sterling',
                'timestamp',
                'wknum_yn',
                'no_of_runners',
                'rp_stalls_position',
                'rp_omitted_fences',
                'rp_going_correction',
                'rp_analysis',
                'three_yo_min_weight_lbs',
                'weights_raised_lbs',
                'minimum_weight_lbs',
                'race_number',
                'formbook_yn',
                'wk_diff_to_standard_time_sec',
                'scratching_fee',
                'supplementary_fee_1',
                'supplementary_fee_2',
                'winner_late_disq',
                'lst_yr_race_instance_uid',
                'race_class',
                'safety_factor_number',
                'reopened_yn',
                'early_closing_race_yn',
                'alt_race_title',
                'subscription_list',
                'track_code',
                'stats_flag'
            ],
            //Every column part of the primary key
            MetaData::MODELS_PRIMARY_KEY => [
                'race_instance_uid'
            ],
            //Every column that isn't part of the primary key
            MetaData::MODELS_NON_PRIMARY_KEY => [
                'race_instance_title',
                'race_datetime',
                'race_start_datetime',
                'distance_yard',
                'course_uid',
                'straight_round_jubilee_code',
                'going_type_code',
                'ages_allowed_uid',
                'start_flag_yn',
                'going_correction',
                'race_group_uid',
                'official_rating_band_uid',
                'winners_time_secs',
                'diff_to_standard_time_sec',
                'photo_finish_uid',
                'race_comments',
                'source_uid',
                'race_type_code',
                'race_status_code',
                'pool_prize_sterling',
                'timestamp',
                'wknum_yn',
                'no_of_runners',
                'rp_stalls_position',
                'rp_omitted_fences',
                'rp_going_correction',
                'rp_analysis',
                'three_yo_min_weight_lbs',
                'weights_raised_lbs',
                'minimum_weight_lbs',
                'race_number',
                'formbook_yn',
                'wk_diff_to_standard_time_sec',
                'scratching_fee',
                'supplementary_fee_1',
                'supplementary_fee_2',
                'winner_late_disq',
                'lst_yr_race_instance_uid',
                'race_class',
                'safety_factor_number',
                'reopened_yn',
                'early_closing_race_yn',
                'alt_race_title',
                'subscription_list',
                'track_code',
                'stats_flag'
            ],
            //Every column that doesn't allows null values
            MetaData::MODELS_NOT_NULL => [
                'race_instance_uid',
                'race_datetime',
                'distance_yard',
                'course_uid',
                'race_status_code',
                'timestamp'
            ],
            //Every column and their data types
            MetaData::MODELS_DATA_TYPES => [
                'race_instance_uid' => Column::TYPE_INTEGER,
                'race_instance_title' => Column::TYPE_VARCHAR,
                'race_datetime' => Column::TYPE_DATETIME,
                'race_start_datetime' => Column::TYPE_DATETIME,
                'distance_yard' => Column::TYPE_INTEGER,
                'course_uid' => Column::TYPE_INTEGER,
                'straight_round_jubilee_code' => Column::TYPE_CHAR,
                'going_type_code' => Column::TYPE_VARCHAR,
                'ages_allowed_uid' => Column::TYPE_INTEGER,
                'start_flag_yn' => Column::TYPE_CHAR,
                'going_correction' => Column::TYPE_DECIMAL,
                'race_group_uid' => Column::TYPE_INTEGER,
                'official_rating_band_uid' => Column::TYPE_INTEGER,
                'winners_time_secs' => Column::TYPE_DECIMAL,
                'diff_to_standard_time_sec' => Column::TYPE_DECIMAL,
                'photo_finish_uid' => Column::TYPE_INTEGER,
                'race_comments' => Column::TYPE_VARCHAR,
                'source_uid' => Column::TYPE_INTEGER,
                'race_type_code' => Column::TYPE_CHAR,
                'race_status_code' => Column::TYPE_CHAR,
                'pool_prize_sterling' => Column::TYPE_DECIMAL,
                'timestamp' => Column::TYPE_DATETIME,
                'wknum_yn' => Column::TYPE_CHAR,
                'no_of_runners' => Column::TYPE_INTEGER,
                'rp_stalls_position' => Column::TYPE_CHAR,
                'rp_omitted_fences' => Column::TYPE_INTEGER,
                'rp_going_correction' => Column::TYPE_DECIMAL,
                'rp_analysis' => Column::TYPE_TEXT,
                'three_yo_min_weight_lbs' => Column::TYPE_INTEGER,
                'weights_raised_lbs' => Column::TYPE_INTEGER,
                'minimum_weight_lbs' => Column::TYPE_INTEGER,
                'race_number' => Column::TYPE_INTEGER,
                'formbook_yn' => Column::TYPE_CHAR,
                'wk_diff_to_standard_time_sec' => Column::TYPE_DECIMAL,
                'scratching_fee' => Column::TYPE_DECIMAL,
                'supplementary_fee_1' => Column::TYPE_DECIMAL,
                'supplementary_fee_2' => Column::TYPE_DECIMAL,
                'winner_late_disq' => Column::TYPE_INTEGER,
                'lst_yr_race_instance_uid' => Column::TYPE_INTEGER,
                'race_class' => Column::TYPE_CHAR,
                'safety_factor_number' => Column::TYPE_INTEGER,
                'reopened_yn' => Column::TYPE_CHAR,
                'early_closing_race_yn' => Column::TYPE_VARCHAR,
                'alt_race_title' => Column::TYPE_VARCHAR,
                'subscription_list' => Column::TYPE_VARCHAR,
                'track_code' => Column::TYPE_CHAR,
                'stats_flag' => Column::TYPE_VARCHAR
            ],
            //The columns that have numeric data types
            MetaData::MODELS_DATA_TYPES_NUMERIC => [
                'race_instance_uid' => true,
                'distance_yard' => true,
                'course_uid' => true,
                'ages_allowed_uid' => true,
                'going_correction' => true,
                'race_group_uid' => true,
                'official_rating_band_uid' => true,
                'winners_time_secs' => true,
                'diff_to_standard_time_sec' => true,
                'photo_finish_uid' => true,
                'source_uid' => true,
                'pool_prize_sterling' => true,
                'no_of_runners' => true,
                'rp_omitted_fences' => true,
                'rp_going_correction' => true,
                'three_yo_min_weight_lbs' => true,
                'weights_raised_lbs' => true,
                'minimum_weight_lbs' => true,
                'race_number' => true,
                'wk_diff_to_standard_time_sec' => true,
                'scratching_fee' => true,
                'supplementary_fee_1' => true,
                'supplementary_fee_2' => true,
                'winner_late_disq' => true,
                'lst_yr_race_instance_uid' => true,
                'safety_factor_number' => true,
            ],
            //The identity column, use boolean false if the model doesn't have
            //an identity column
            MetaData::MODELS_IDENTITY_COLUMN => false,
            //How every column must be bound/casted
            MetaData::MODELS_DATA_TYPES_BIND => [
                'race_instance_uid' => Column::BIND_PARAM_INT,
                'race_instance_title' => Column::BIND_PARAM_STR,
                'race_datetime' => Column::BIND_PARAM_STR,
                'race_start_datetime' => Column::BIND_PARAM_STR,
                'distance_yard' => Column::BIND_PARAM_INT,
                'course_uid' => Column::BIND_PARAM_INT,
                'straight_round_jubilee_code' => Column::BIND_PARAM_STR,
                'going_type_code' => Column::BIND_PARAM_STR,
                'ages_allowed_uid' => Column::BIND_PARAM_INT,
                'start_flag_yn' => Column::BIND_PARAM_STR,
                'going_correction' => Column::BIND_PARAM_DECIMAL,
                'race_group_uid' => Column::BIND_PARAM_INT,
                'official_rating_band_uid' => Column::BIND_PARAM_INT,
                'winners_time_secs' => Column::BIND_PARAM_DECIMAL,
                'diff_to_standard_time_sec' => Column::BIND_PARAM_DECIMAL,
                'photo_finish_uid' => Column::BIND_PARAM_INT,
                'race_comments' => Column::BIND_PARAM_STR,
                'source_uid' => Column::BIND_PARAM_INT,
                'race_type_code' => Column::BIND_PARAM_STR,
                'race_status_code' => Column::BIND_PARAM_STR,
                'pool_prize_sterling' => Column::BIND_PARAM_DECIMAL,
                'timestamp' => Column::BIND_PARAM_STR,
                'wknum_yn' => Column::BIND_PARAM_STR,
                'no_of_runners' => Column::BIND_PARAM_INT,
                'rp_stalls_position' => Column::BIND_PARAM_STR,
                'rp_omitted_fences' => Column::BIND_PARAM_INT,
                'rp_going_correction' => Column::BIND_PARAM_DECIMAL,
                'rp_analysis' => Column::BIND_PARAM_STR,
                'three_yo_min_weight_lbs' => Column::BIND_PARAM_INT,
                'weights_raised_lbs' => Column::BIND_PARAM_INT,
                'minimum_weight_lbs' => Column::BIND_PARAM_INT,
                'race_number' => Column::BIND_PARAM_INT,
                'formbook_yn' => Column::BIND_PARAM_STR,
                'wk_diff_to_standard_time_sec' => Column::BIND_PARAM_DECIMAL,
                'scratching_fee' => Column::BIND_PARAM_DECIMAL,
                'supplementary_fee_1' => Column::BIND_PARAM_DECIMAL,
                'supplementary_fee_2' => Column::BIND_PARAM_DECIMAL,
                'winner_late_disq' => Column::BIND_PARAM_INT,
                'lst_yr_race_instance_uid' => Column::BIND_PARAM_INT,
                'race_class' => Column::BIND_PARAM_STR,
                'safety_factor_number' => Column::BIND_PARAM_INT,
                'reopened_yn' => Column::BIND_PARAM_STR,
                'early_closing_race_yn' => Column::BIND_PARAM_STR,
                'alt_race_title' => Column::BIND_PARAM_STR,
                'subscription_list' => Column::BIND_PARAM_STR,
                'track_code' => Column::BIND_PARAM_STR,
                'stats_flag' => Column::BIND_PARAM_STR
            ],
            //Fields that must be ignored from INSERT SQL statements
            MetaData::MODELS_AUTOMATIC_DEFAULT_INSERT => [],
            //Fields that must be ignored from UPDATE SQL statements
            MetaData::MODELS_AUTOMATIC_DEFAULT_UPDATE => []

        ];
    }

    /**
     *  Defines relationships between models
     */
    public function initialize()
    {
        $this->hasMany(
            'race_instance_uid',
            'Models\PreRaceInstance',
            'race_instance_uid'
        );
        $this->hasMany(
            'race_instance_uid',
            'Models\PreHorseRace',
            'race_instance_uid'
        );
        $this->hasMany(
            'race_instance_uid',
            'Models\PostdataResultsNew',
            'race_instance_uid'
        );
        $this->hasMany(
            'race_instance_uid',
            'Models\DaOvernightData',
            'race_instance_uid'
        );

        $this->belongsTo('course_uid', 'Models\Course', 'course_uid');
        $this->belongsTo('going_type_code', 'Models\GoingType', 'going_type_code');
        $this->belongsTo('ages_allowed_uid', 'Models\AgesAllowed', 'ages_allowed_uid');
    }

    /*
     * @return boolean true if race is Jumps, false otherwise.
     */
    public function isJumps($raceType = null)
    {
        $raceType = (is_null($raceType)) ? $this->getRaceTypeCode() : $raceType;
        return (strpos(Constants::RACE_TYPE_JUMPS, $raceType) !== false);
    }

    /**
     * Method to set the value of field race_instance_uid
     *
     * @param integer $race_instance_uid
     *
     * @return $this
     */
    public function setRaceInstanceUid($race_instance_uid)
    {
        $this->race_instance_uid = $race_instance_uid;

        return $this;
    }

    /**
     * Method to set the value of field race_instance_title
     *
     * @param string $race_instance_title
     *
     * @return $this
     */
    public function setRaceInstanceTitle($race_instance_title)
    {
        $this->race_instance_title = $race_instance_title;

        return $this;
    }

    /**
     * Method to set the value of field race_datetime
     *
     * @param string $race_datetime
     *
     * @return $this
     */
    public function setRaceDatetime($race_datetime)
    {
        $this->race_datetime = $race_datetime;

        return $this;
    }

    /**
     * Method to set the value of field race_start_datetime
     *
     * @param string $race_start_datetime
     *
     * @return $this
     */
    public function setRaceStartDatetime($race_start_datetime)
    {
        $this->race_start_datetime = $race_start_datetime;

        return $this;
    }

    /**
     * Method to set the value of field distance_yard
     *
     * @param integer $distance_yard
     *
     * @return $this
     */
    public function setDistanceYard($distance_yard)
    {
        $this->distance_yard = $distance_yard;

        return $this;
    }

    /**
     * Method to set the value of field course_uid
     *
     * @param integer $course_uid
     *
     * @return $this
     */
    public function setCourseUid($course_uid)
    {
        $this->course_uid = $course_uid;

        return $this;
    }

    /**
     * Method to set the value of field straight_round_jubilee_code
     *
     * @param string $straight_round_jubilee_code
     *
     * @return $this
     */
    public function setStraightRoundJubileeCode($straight_round_jubilee_code)
    {
        $this->straight_round_jubilee_code = $straight_round_jubilee_code;

        return $this;
    }

    /**
     * Method to set the value of field going_type_code
     *
     * @param string $going_type_code
     *
     * @return $this
     */
    public function setGoingTypeCode($going_type_code)
    {
        $this->going_type_code = $going_type_code;

        return $this;
    }

    /**
     * Method to set the value of field ages_allowed_uid
     *
     * @param integer $ages_allowed_uid
     *
     * @return $this
     */
    public function setAgesAllowedUid($ages_allowed_uid)
    {
        $this->ages_allowed_uid = $ages_allowed_uid;

        return $this;
    }

    /**
     * Method to set the value of field start_flag_yn
     *
     * @param string $start_flag_yn
     *
     * @return $this
     */
    public function setStartFlagYn($start_flag_yn)
    {
        $this->start_flag_yn = $start_flag_yn;

        return $this;
    }

    /**
     * Method to set the value of field going_correction
     *
     * @param double $going_correction
     *
     * @return $this
     */
    public function setGoingCorrection($going_correction)
    {
        $this->going_correction = $going_correction;

        return $this;
    }

    /**
     * Method to set the value of field race_group_uid
     *
     * @param integer $race_group_uid
     *
     * @return $this
     */
    public function setRaceGroupUid($race_group_uid)
    {
        $this->race_group_uid = $race_group_uid;

        return $this;
    }

    /**
     * Method to set the value of field official_rating_band_uid
     *
     * @param integer $official_rating_band_uid
     *
     * @return $this
     */
    public function setOfficialRatingBandUid($official_rating_band_uid)
    {
        $this->official_rating_band_uid = $official_rating_band_uid;

        return $this;
    }

    /**
     * Method to set the value of field winners_time_secs
     *
     * @param double $winners_time_secs
     *
     * @return $this
     */
    public function setWinnersTimeSecs($winners_time_secs)
    {
        $this->winners_time_secs = $winners_time_secs;

        return $this;
    }

    /**
     * Method to set the value of field diff_to_standard_time_sec
     *
     * @param double $diff_to_standard_time_sec
     *
     * @return $this
     */
    public function setDiffToStandardTimeSec($diff_to_standard_time_sec)
    {
        $this->diff_to_standard_time_sec = $diff_to_standard_time_sec;

        return $this;
    }

    /**
     * Method to set the value of field photo_finish_uid
     *
     * @param integer $photo_finish_uid
     *
     * @return $this
     */
    public function setPhotoFinishUid($photo_finish_uid)
    {
        $this->photo_finish_uid = $photo_finish_uid;

        return $this;
    }

    /**
     * Method to set the value of field race_comments
     *
     * @param string $race_comments
     *
     * @return $this
     */
    public function setRaceComments($race_comments)
    {
        $this->race_comments = $race_comments;

        return $this;
    }

    /**
     * Method to set the value of field source_uid
     *
     * @param integer $source_uid
     *
     * @return $this
     */
    public function setSourceUid($source_uid)
    {
        $this->source_uid = $source_uid;

        return $this;
    }

    /**
     * Method to set the value of field race_type_code
     *
     * @param string $race_type_code
     *
     * @return $this
     */
    public function setRaceTypeCode($race_type_code)
    {
        $this->race_type_code = $race_type_code;

        return $this;
    }

    /**
     * Method to set the value of field race_status_code
     *
     * @param string $race_status_code
     *
     * @return $this
     */
    public function setRaceStatusCode($race_status_code)
    {
        $this->race_status_code = $race_status_code;

        return $this;
    }

    /**
     * Method to set the value of field pool_prize_sterling
     *
     * @param double $pool_prize_sterling
     *
     * @return $this
     */
    public function setPoolPrizeSterling($pool_prize_sterling)
    {
        $this->pool_prize_sterling = $pool_prize_sterling;

        return $this;
    }

    /**
     * Method to set the value of field timestamp
     *
     * @param string $timestamp
     *
     * @return $this
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Method to set the value of field wknum_yn
     *
     * @param string $wknum_yn
     *
     * @return $this
     */
    public function setWknumYn($wknum_yn)
    {
        $this->wknum_yn = $wknum_yn;

        return $this;
    }

    /**
     * Method to set the value of field no_of_runners
     *
     * @param integer $no_of_runners
     *
     * @return $this
     */
    public function setNoOfRunners($no_of_runners)
    {
        $this->no_of_runners = $no_of_runners;

        return $this;
    }

    /**
     * Method to set the value of field rp_stalls_position
     *
     * @param string $rp_stalls_position
     *
     * @return $this
     */
    public function setRpStallsPosition($rp_stalls_position)
    {
        $this->rp_stalls_position = $rp_stalls_position;

        return $this;
    }

    /**
     * Method to set the value of field rp_omitted_fences
     *
     * @param integer $rp_omitted_fences
     *
     * @return $this
     */
    public function setRpOmittedFences($rp_omitted_fences)
    {
        $this->rp_omitted_fences = $rp_omitted_fences;

        return $this;
    }

    /**
     * Method to set the value of field rp_going_correction
     *
     * @param double $rp_going_correction
     *
     * @return $this
     */
    public function setRpGoingCorrection($rp_going_correction)
    {
        $this->rp_going_correction = $rp_going_correction;

        return $this;
    }

    /**
     * Method to set the value of field rp_analysis
     *
     * @param string $rp_analysis
     *
     * @return $this
     */
    public function setRpAnalysis($rp_analysis)
    {
        $this->rp_analysis = $rp_analysis;

        return $this;
    }

    /**
     * Method to set the value of field three_yo_min_weight_lbs
     *
     * @param integer $three_yo_min_weight_lbs
     *
     * @return $this
     */
    public function setThreeYoMinWeightLbs($three_yo_min_weight_lbs)
    {
        $this->three_yo_min_weight_lbs = $three_yo_min_weight_lbs;

        return $this;
    }

    /**
     * Method to set the value of field weights_raised_lbs
     *
     * @param integer $weights_raised_lbs
     *
     * @return $this
     */
    public function setWeightsRaisedLbs($weights_raised_lbs)
    {
        $this->weights_raised_lbs = $weights_raised_lbs;

        return $this;
    }

    /**
     * Method to set the value of field minimum_weight_lbs
     *
     * @param integer $minimum_weight_lbs
     *
     * @return $this
     */
    public function setMinimumWeightLbs($minimum_weight_lbs)
    {
        $this->minimum_weight_lbs = $minimum_weight_lbs;

        return $this;
    }

    /**
     * Method to set the value of field race_number
     *
     * @param integer $race_number
     *
     * @return $this
     */
    public function setRaceNumber($race_number)
    {
        $this->race_number = $race_number;

        return $this;
    }

    /**
     * Method to set the value of field formbook_yn
     *
     * @param string $formbook_yn
     *
     * @return $this
     */
    public function setFormbookYn($formbook_yn)
    {
        $this->formbook_yn = $formbook_yn;

        return $this;
    }

    /**
     * Method to set the value of field wk_diff_to_standard_time_sec
     *
     * @param double $wk_diff_to_standard_time_sec
     *
     * @return $this
     */
    public function setWkDiffToStandardTimeSec($wk_diff_to_standard_time_sec)
    {
        $this->wk_diff_to_standard_time_sec = $wk_diff_to_standard_time_sec;

        return $this;
    }

    /**
     * Method to set the value of field scratching_fee
     *
     * @param double $scratching_fee
     *
     * @return $this
     */
    public function setScratchingFee($scratching_fee)
    {
        $this->scratching_fee = $scratching_fee;

        return $this;
    }

    /**
     * Method to set the value of field supplementary_fee_1
     *
     * @param double $supplementary_fee_1
     *
     * @return $this
     */
    public function setSupplementaryFee1($supplementary_fee_1)
    {
        $this->supplementary_fee_1 = $supplementary_fee_1;

        return $this;
    }

    /**
     * Method to set the value of field supplementary_fee_2
     *
     * @param double $supplementary_fee_2
     *
     * @return $this
     */
    public function setSupplementaryFee2($supplementary_fee_2)
    {
        $this->supplementary_fee_2 = $supplementary_fee_2;

        return $this;
    }

    /**
     * Method to set the value of field winner_late_disq
     *
     * @param integer $winner_late_disq
     *
     * @return $this
     */
    public function setWinnerLateDisq($winner_late_disq)
    {
        $this->winner_late_disq = $winner_late_disq;

        return $this;
    }

    /**
     * Method to set the value of field lst_yr_race_instance_uid
     *
     * @param integer $lst_yr_race_instance_uid
     *
     * @return $this
     */
    public function setLstYrRaceInstanceUid($lst_yr_race_instance_uid)
    {
        $this->lst_yr_race_instance_uid = $lst_yr_race_instance_uid;

        return $this;
    }

    /**
     * Method to set the value of field race_class
     *
     * @param string $race_class
     *
     * @return $this
     */
    public function setRaceClass($race_class)
    {
        $this->race_class = $race_class;

        return $this;
    }

    /**
     * Method to set the value of field safety_factor_number
     *
     * @param integer $safety_factor_number
     *
     * @return $this
     */
    public function setSafetyFactorNumber($safety_factor_number)
    {
        $this->safety_factor_number = $safety_factor_number;

        return $this;
    }

    /**
     * Method to set the value of field reopened_yn
     *
     * @param string $reopened_yn
     *
     * @return $this
     */
    public function setReopenedYn($reopened_yn)
    {
        $this->reopened_yn = $reopened_yn;

        return $this;
    }

    /**
     * Method to set the value of field early_closing_race_yn
     *
     * @param string $early_closing_race_yn
     *
     * @return $this
     */
    public function setEarlyClosingRaceYn($early_closing_race_yn)
    {
        $this->early_closing_race_yn = $early_closing_race_yn;

        return $this;
    }

    /**
     * Method to set the value of field alt_race_title
     *
     * @param string $alt_race_title
     *
     * @return $this
     */
    public function setAltRaceTitle($alt_race_title)
    {
        $this->alt_race_title = $alt_race_title;

        return $this;
    }

    /**
     * Method to set the value of field subscription_list
     *
     * @param string $subscription_list
     *
     * @return $this
     */
    public function setSubscriptionList($subscription_list)
    {
        $this->subscription_list = $subscription_list;

        return $this;
    }

    /**
     * Method to set the value of field track_code
     *
     * @param string $track_code
     *
     * @return $this
     */
    public function setTrackCode($track_code)
    {
        $this->track_code = $track_code;

        return $this;
    }

    /**
     * Method to set the value of field stats_flag
     *
     * @param string $stats_flag
     *
     * @return $this
     */
    public function setStatsFlag($stats_flag)
    {
        $this->stats_flag = $stats_flag;

        return $this;
    }

    /**
     * Returns the value of field race_instance_uid
     *
     * @return integer
     */
    public function getRaceInstanceUid()
    {
        return $this->race_instance_uid;
    }

    /**
     * Returns the value of field race_instance_title
     *
     * @return string
     */
    public function getRaceInstanceTitle()
    {
        return $this->race_instance_title;
    }

    /**
     * Returns the value of field race_datetime
     *
     * @return string
     */
    public function getRaceDatetime()
    {
        return $this->race_datetime;
    }

    /**
     * Returns the value of field race_start_datetime
     *
     * @return string
     */
    public function getRaceStartDatetime()
    {
        return $this->race_start_datetime;
    }

    /**
     * Returns the value of field distance_yard
     *
     * @return integer
     */
    public function getDistanceYard()
    {
        return $this->distance_yard;
    }

    /**
     * Returns the value of field course_uid
     *
     * @return integer
     */
    public function getCourseUid()
    {
        return $this->course_uid;
    }

    /**
     * Returns the value of field straight_round_jubilee_code
     *
     * @return string
     */
    public function getStraightRoundJubileeCode()
    {
        return $this->straight_round_jubilee_code;
    }

    /**
     * Returns the value of field going_type_code
     *
     * @return string
     */
    public function getGoingTypeCode()
    {
        return $this->going_type_code;
    }

    /**
     * Returns the value of field ages_allowed_uid
     *
     * @return integer
     */
    public function getAgesAllowedUid()
    {
        return $this->ages_allowed_uid;
    }

    /**
     * Returns the value of field start_flag_yn
     *
     * @return string
     */
    public function getStartFlagYn()
    {
        return $this->start_flag_yn;
    }

    /**
     * Returns the value of field going_correction
     *
     * @return double
     */
    public function getGoingCorrection()
    {
        return $this->going_correction;
    }

    /**
     * Returns the value of field race_group_uid
     *
     * @return integer
     */
    public function getRaceGroupUid()
    {
        return $this->race_group_uid;
    }

    /**
     * Returns the value of field official_rating_band_uid
     *
     * @return integer
     */
    public function getOfficialRatingBandUid()
    {
        return $this->official_rating_band_uid;
    }

    /**
     * Returns the value of field winners_time_secs
     *
     * @return double
     */
    public function getWinnersTimeSecs()
    {
        return $this->winners_time_secs;
    }

    /**
     * Returns the value of field diff_to_standard_time_sec
     *
     * @return double
     */
    public function getDiffToStandardTimeSec()
    {
        return $this->diff_to_standard_time_sec;
    }

    /**
     * Returns the value of field photo_finish_uid
     *
     * @return integer
     */
    public function getPhotoFinishUid()
    {
        return $this->photo_finish_uid;
    }

    /**
     * Returns the value of field race_comments
     *
     * @return string
     */
    public function getRaceComments()
    {
        return $this->race_comments;
    }

    /**
     * Returns the value of field source_uid
     *
     * @return integer
     */
    public function getSourceUid()
    {
        return $this->source_uid;
    }

    /**
     * Returns the value of field race_type_code
     *
     * @return string
     */
    public function getRaceTypeCode()
    {
        return $this->race_type_code;
    }

    /**
     * Returns the value of field race_status_code
     *
     * @return string
     */
    public function getRaceStatusCode()
    {
        return $this->race_status_code;
    }

    /**
     * Returns the value of field pool_prize_sterling
     *
     * @return double
     */
    public function getPoolPrizeSterling()
    {
        return $this->pool_prize_sterling;
    }

    /**
     * Returns the value of field timestamp
     *
     * @return string
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Returns the value of field wknum_yn
     *
     * @return string
     */
    public function getWknumYn()
    {
        return $this->wknum_yn;
    }

    /**
     * Returns the value of field no_of_runners
     *
     * @return integer
     */
    public function getNoOfRunners()
    {
        return $this->no_of_runners;
    }

    /**
     * Returns the value of field rp_stalls_position
     *
     * @return string
     */
    public function getRpStallsPosition()
    {
        return $this->rp_stalls_position;
    }

    /**
     * Returns the value of field rp_omitted_fences
     *
     * @return integer
     */
    public function getRpOmittedFences()
    {
        return $this->rp_omitted_fences;
    }

    /**
     * Returns the value of field rp_going_correction
     *
     * @return double
     */
    public function getRpGoingCorrection()
    {
        return $this->rp_going_correction;
    }

    /**
     * Returns the value of field rp_analysis
     *
     * @return string
     */
    public function getRpAnalysis()
    {
        return $this->rp_analysis;
    }

    /**
     * Returns the value of field three_yo_min_weight_lbs
     *
     * @return integer
     */
    public function getThreeYoMinWeightLbs()
    {
        return $this->three_yo_min_weight_lbs;
    }

    /**
     * Returns the value of field weights_raised_lbs
     *
     * @return integer
     */
    public function getWeightsRaisedLbs()
    {
        return $this->weights_raised_lbs;
    }

    /**
     * Returns the value of field minimum_weight_lbs
     *
     * @return integer
     */
    public function getMinimumWeightLbs()
    {
        return $this->minimum_weight_lbs;
    }

    /**
     * Returns the value of field race_number
     *
     * @return integer
     */
    public function getRaceNumber()
    {
        return $this->race_number;
    }

    /**
     * Returns the value of field formbook_yn
     *
     * @return string
     */
    public function getFormbookYn()
    {
        return $this->formbook_yn;
    }

    /**
     * Returns the value of field wk_diff_to_standard_time_sec
     *
     * @return double
     */
    public function getWkDiffToStandardTimeSec()
    {
        return $this->wk_diff_to_standard_time_sec;
    }

    /**
     * Returns the value of field scratching_fee
     *
     * @return double
     */
    public function getScratchingFee()
    {
        return $this->scratching_fee;
    }

    /**
     * Returns the value of field supplementary_fee_1
     *
     * @return double
     */
    public function getSupplementaryFee1()
    {
        return $this->supplementary_fee_1;
    }

    /**
     * Returns the value of field supplementary_fee_2
     *
     * @return double
     */
    public function getSupplementaryFee2()
    {
        return $this->supplementary_fee_2;
    }

    /**
     * Returns the value of field winner_late_disq
     *
     * @return integer
     */
    public function getWinnerLateDisq()
    {
        return $this->winner_late_disq;
    }

    /**
     * Returns the value of field lst_yr_race_instance_uid
     *
     * @return integer
     */
    public function getLstYrRaceInstanceUid()
    {
        return $this->lst_yr_race_instance_uid;
    }

    /**
     * Returns the value of field race_class
     *
     * @return string
     */
    public function getRaceClass()
    {
        return $this->race_class;
    }

    /**
     * Returns the value of field safety_factor_number
     *
     * @return integer
     */
    public function getSafetyFactorNumber()
    {
        return $this->safety_factor_number;
    }

    /**
     * Returns the value of field reopened_yn
     *
     * @return string
     */
    public function getReopenedYn()
    {
        return $this->reopened_yn;
    }

    /**
     * Returns the value of field early_closing_race_yn
     *
     * @return string
     */
    public function getEarlyClosingRaceYn()
    {
        return $this->early_closing_race_yn;
    }

    /**
     * Returns the value of field alt_race_title
     *
     * @return string
     */
    public function getAltRaceTitle()
    {
        return $this->alt_race_title;
    }

    /**
     * Returns the value of field subscription_list
     *
     * @return string
     */
    public function getSubscriptionList()
    {
        return $this->subscription_list;
    }

    /**
     * Returns the value of field track_code
     *
     * @return string
     */
    public function getTrackCode()
    {
        return $this->track_code;
    }

    /**
     * Returns the value of field stats_flag
     *
     * @return string
     */
    public function getStatsFlag()
    {
        return $this->stats_flag;
    }

    /**
     * @param $raceId
     * @param $resultType
     * @param $ptpGbFlag
     * @param $limit
     * @param $isResults
     * @param $raceDatetime
     * @param $returnP2P
     *
     * @return Builder
     */
    private function getBuilderForFormOrWinsOrMyRatings(
        $raceId,
        $resultType,
        $ptpGbFlag,
        $limit,
        $isResults,
        $raceDatetime,
        $returnP2P
    ) {
        $builder = new Builder();

        $builder->setSqlTemplate(
            "
            SELECT
                ri.race_instance_uid
                , ri.race_group_uid
                , ri.race_datetime
                , clt.hours_difference
                , ri.course_uid
                , c.course_name
                , course_style_name = c.style_name
                , c.country_code
                , c.course_type_code
                , ri.race_instance_title
                , ri.race_type_code
                , c.course_code
                , course_rp_abbrev_3 = c.rp_abbrev_3
                , course_rp_abbrev_4 = c.rp_abbrev_4
                , hr.weight_allowance_lbs
                , cm.rp_jump_course_comment
                , cm.rp_flat_course_comment
                , going_type_services_desc = gt.services_desc
                , rip.prize_euro_gross
                , rip.prize_sterling
                , cc.exchange_rate
                , rip.prize_euro_gross
                , ri.distance_yard
                , actual_race_class = attr.race_attrib_desc
                , aa.rp_ages_allowed_desc
                , rg.race_group_code
                , rg.race_group_desc
                , hr.weight_carried_lbs
                , hr.saddle_cloth_no
                , hr.race_outcome_uid
                , hr.final_race_outcome_uid
                , ro.race_outcome_desc
                , ro.race_outcome_form_char
                , ro.race_output_order
                , ro.race_outcome_position
                -- We have different alias for same field
                -- because addHorsePositioning trait requires final/original race outcome position (depends on the join of race_outcome table)
                , final_race_outcome_position  = ro.race_outcome_position
                , orig_race_outcome_position   = orig_ro.race_outcome_position
                , race_outcome_code = rtrim(ro.race_outcome_code)
                , orig_race_output_order  = orig_ro.race_output_order
                , ri.no_of_runners
                , ri.going_type_code
                , gt.going_type_desc
                , no_of_runners_calculated = (
                    SELECT count(1)
                    FROM horse_race hr1
                    INNER JOIN race_outcome ro1 ON 
                      (ro1.race_outcome_uid = hr1.final_race_outcome_uid /*{EXPRESSION(ro1)}*/)
                    WHERE hr1.race_instance_uid = ri.race_instance_uid
                        AND hr1.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                )
                , hrc.rp_close_up_comment
                , hrn.notes
                , hhg.rp_horse_head_gear_code
                , hhg.first_time_yn
                , o.odds_desc
                , o.odds_value
                , o.favourite_flag
                , hr.horse_uid
                , jockey_style_name = j.style_name
                , j.aka_style_name
                , jockey_jockey_uid = j.jockey_uid
                , jockey_ptp_type_code = j.ptp_type_code
                , hr.official_rating_ran_off
                , hr.rp_topspeed
                , hr.rp_postmark
                , hr.rp_betting_movements
                , hr.disqualification_uid
                , d.disqualification_desc
                , srjc.rp_straight_round_jubilee_desc
                , other_horse = NULL
                , race_tactics = NULL
                , next_run = NULL
                , hr.draw
                , dtw_rp_distance_desc = NULL
                , dtw_sum_distance_value = NULL
                , dtw_count_horse_race = NULL
                , dtw_total_distance_value = NULL
                /*{COLUMNS}*/
            FROM race_instance ri
                JOIN horse_race hr ON hr.race_instance_uid = ri.race_instance_uid
                JOIN course c ON ri.course_uid = c.course_uid
                JOIN race_outcome ro ON ro.race_outcome_uid = hr.final_race_outcome_uid
                    /*{EXPRESSION(ro)}*/
                JOIN race_outcome orig_ro ON orig_ro.race_outcome_uid = hr.race_outcome_uid
                    /*{EXPRESSION(orig_ro)}*/
                LEFT JOIN going_type gt ON gt.going_type_code = ri.going_type_code
                LEFT JOIN race_instance_prize rip ON rip.race_instance_uid = hr.race_instance_uid
                    AND rip.position_no = 1
                LEFT JOIN ages_allowed aa ON aa.ages_allowed_uid = ri.ages_allowed_uid
                LEFT JOIN race_group rg ON rg.race_group_uid = ri.race_group_uid
                LEFT JOIN horse_race_comments hrc ON hrc.race_instance_uid = hr.race_instance_uid
                    AND hrc.horse_uid = hr.horse_uid
                LEFT JOIN horse_race_notes hrn ON hrn.race_instance_uid = ri.race_instance_uid
                    AND hrn.horse_uid = hr.horse_uid AND hrn.notes_type_code = ". Constants::NOTES_TYPE_CODE_HORSE_BANS ."
                LEFT JOIN horse_head_gear hhg ON hhg.horse_head_gear_uid = hr.horse_head_gear_uid
                LEFT JOIN odds o ON o.odds_uid = hr.starting_price_odds_uid
                LEFT JOIN jockey j ON j.jockey_uid = hr.jockey_uid
                LEFT JOIN disqualification d ON hr.disqualification_uid = d.disqualification_uid
                LEFT JOIN straight_round_jubilee srjc ON
                    ri.straight_round_jubilee_code = srjc.straight_round_jubilee_code
                LEFT JOIN country_currencies cc ON cc.country_code = 'EUR'
                    AND year(ri.race_datetime) = cc.year
                LEFT JOIN course_local_time clt ON clt.course_uid = ri.course_uid
                    AND ri.race_datetime BETWEEN clt.date_from AND clt.date_to
                LEFT JOIN (
                    SELECT ral.race_attrib_code, raj.race_instance_uid, ral.race_attrib_desc
                    FROM race_attrib_join raj
                       LEFT JOIN race_attrib_lookup ral ON raj.race_attrib_uid = ral.race_attrib_uid
                    WHERE ral.race_attrib_desc IS NOT NULL 
                    AND ral.race_attrib_code IN (" . Constants::RACE_CLASS_SUB . ", " . Constants::RACE_CLASS . ")
                    ) attr ON attr.race_instance_uid = ri.race_instance_uid
                    AND (c.country_code = 'GB' AND attr.race_attrib_code = " . Constants::RACE_CLASS_SUB . "
                        OR c.country_code != 'GB' AND  attr.race_attrib_code = " . Constants::RACE_CLASS . ")
                LEFT JOIN course_comments cm ON cm.course_uid = ri.course_uid
            WHERE
                ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                /*{WHERE}*/
            ORDER BY
              hr.horse_uid
              , ri.race_datetime DESC
            PLAN '(use optgoal allrows_dss)(nl_join (i_scan hr)(i_scan ri))'
        "
        );

        $builder->columns(
            "
            non_runner =
                CASE WHEN hr.race_outcome_uid IN (" . Constants::NON_RUNNER_IDS . ") THEN 'Y' ELSE 'N' END
        "
        );

        $builder->where(
            "
             AND EXISTS (SELECT 1 FROM " . (($ptpGbFlag === false)
                ? static::HORSES_ID_TABLE
                : static::HORSES_PTP_GB_ID_TABLE) . " hids WHERE hr.horse_uid = hids.horse_uid)
        "
        );
        // by default we want to exclude non runners and void race runners
        $notIncludedOutcomeIds = Constants::NON_RUNNER_AND_VOID_IDS;

        // WINS ENDPOINT USES THIS
        if ($resultType == 'wins') {
            $builder->where('AND ro.race_outcome_position = 1');
        } elseif ($resultType == 'my_ratings') {
            $builder->where(
                "AND (ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                OR (ri.race_type_code = " . Constants::RACE_TYPE_P2P . " AND c.country_code != 'GB'))"
            );
        } elseif ($resultType == 'form') {
            if (!$returnP2P) {
                $builder->where("AND (ri.race_type_code != " . Constants::RACE_TYPE_P2P . ")");
            } elseif (!$ptpGbFlag) {
                $builder->where(
                    "AND (ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                    OR (ri.race_type_code = " . Constants::RACE_TYPE_P2P . " AND c.country_code != 'GB'))"
                );
            }
        }

        // NOT ALL form endpoints pass $raceId so this check is needed to avoid not showing non runners and void races
        if ($resultType == 'form' && $raceId > 0) {
            // For janus endpoints we should included void races and $raceDatetime is only passed for janus endpoints
            if (!empty($raceDatetime)) {
                $notIncludedOutcomeIds = Constants::NON_RUNNER_IDS;
            }
            $builder->where(
                'AND hr.final_race_outcome_uid NOT IN (' . $notIncludedOutcomeIds . ')'
            );
        }

        // race_status_code is missing in horse_race table so we only need this at pre-race status. Janus endpoints
        if ($raceId > 0 && $isResults == false) {
            $builder->where(
                "
                AND EXISTS (
                    SELECT 1
                    FROM race_instance ri2
                        INNER JOIN pre_horse_race phr2 ON phr2.race_instance_uid = ri2.race_instance_uid
                    WHERE phr2.race_status_code =
                         (CASE WHEN ri2.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                            THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                            ELSE ri2.race_status_code
                        END)
                        AND ri2.race_instance_uid = :raceId:
                        AND phr2.horse_uid = hr.horse_uid
                )
            "
            );
            $builder->setParam('raceId', $raceId);
        }
        // IF we have the $limit var set it means we have a query param of limit on races to include in result for form
        if ($limit > 0) {
            $builder->where(
                " AND (SELECT COUNT(*)
                    FROM horse_race hr1
                    JOIN race_instance ri1 ON ri1.race_instance_uid = hr1.race_instance_uid
                    WHERE hr1.horse_uid = hr.horse_uid
                        /*{EXPRESSION(preOrPostRaces)}*/
                        /*{EXPRESSION(whereLimit)}*/
                        AND ri1.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                        /*{EXPRESSION(forLimit)}*/
                ) <= (:limit:)
            "
            );
            // The Janus endpoints consuming this method require us to return void races aswell
            $builder->expression(
                'whereLimit',
                'AND hr1.final_race_outcome_uid NOT IN (' . $notIncludedOutcomeIds . ')'
            );

            if ($resultType == 'form' && $raceId > 0) {
                if ($isResults && !empty($raceDatetime)) {
                    $builder->where(
                        "
                    AND ri.race_datetime > '" . $raceDatetime . "'
                    "
                    );
                    // if we are at results status we only want to include form races AFTER the race_datetime of the given date
                    // hence the usage of this expression which will be empty unless it meets the race_status condition
                    $builder->expression(
                        'preOrPostRaces',
                        "
                            AND '" . $raceDatetime . "' < ri1.race_datetime
                            AND ri.race_datetime >= ri1.race_datetime
                        "
                    );
                } else {
                    $builder->expression(
                        'preOrPostRaces',
                        'AND ri.race_datetime <= ri1.race_datetime'
                    );
                }
            }

            $builder->setParam('limit', $limit);
            if ($resultType == 'wins') {
                $builder->expression('forLimit', 'AND hr1.final_race_outcome_uid IN (1, 71)');
            } elseif ($resultType == 'my_ratings') {
                $builder->expression(
                    'forLimit',
                    "AND (ri1.race_type_code != " . Constants::RACE_TYPE_P2P . "
                            OR (ri1.race_type_code = " . Constants::RACE_TYPE_P2P . " AND c.country_code != 'GB'))"
                );
            } elseif ($resultType == 'form') {
                if (!$returnP2P) {
                    $builder->expression(
                        'forLimit',
                        "AND (ri1.race_type_code != " . Constants::RACE_TYPE_P2P . ")"
                    );
                } elseif (!$ptpGbFlag) {
                    $builder->expression(
                        'forLimit',
                        "AND (ri1.race_type_code != " . Constants::RACE_TYPE_P2P . "
                            OR (ri1.race_type_code = " . Constants::RACE_TYPE_P2P . " AND c.country_code != 'GB'))"
                    );
                }
            } else {
                $builder->expression(
                    'forLimit',
                    ''
                );
            }
        }

        if ($resultType !== 'form') {
            $expressions = ['ro', 'orig_ro', 'ro1'];
            foreach ($expressions as $expression) {
                $builder->expression(
                    $expression,
                    "AND {$expression}.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")"
                );
            }
        }
        $builder->build();

        return $builder;
    }

    /**
     * @param int|null $raceId
     * @param string   $resultType
     * @param boolean  $ptpGbFlag
     * @param int|null $limit
     * @param boolean  $isResults
     * @param string   $raceDatetime
     * @param boolean   $returnP2P
     *
     * @return array
     */
    protected function getFormOrWinsOrMyRatings(
        ?int $raceId,
        string $resultType,
        $ptpGbFlag = false,
        $limit = null,
        $isResults = false,
        string $raceDatetime = '',
        $returnP2P = false
    ) {
        $builder = $this->getBuilderForFormOrWinsOrMyRatings($raceId, $resultType, $ptpGbFlag, $limit, $isResults, $raceDatetime, $returnP2P);
        $result = $this->getReadConnection()->query($builder->getSql(), $builder->getParams());
        $result = new Resultset\General(
            null,
            new \Api\Row\RaceInstance(),
            $result
        );

        $resultForm = $result->toArrayWithRows('horse_uid', null, true);
        $resultForm = $this->joinDistanceWinnersDataToForm($resultForm, $resultType);

        $racesId = array_keys($result->toArrayWithRows('race_instance_uid'));
        $resultForm = $this->joinOtherHorseDataToForm($resultForm, $racesId);
        if ($resultType == 'form') {
            $resultForm = $this->joinNextRunToForm($resultForm, $racesId);
        }

        return $this->restructureForm($resultForm, $limit);
    }

    /**
     * @param array $form
     * @param array $racesId
     *
     * @return array
     */
    protected function joinOtherHorseDataToForm(array $form, array $racesId)
    {
        if (!empty($form)) {
            $sql = "
                SELECT
                    h.style_name
                    , h.country_origin_code
                    , hr.horse_uid
                    , hr.weight_carried_lbs
                    , hr.race_instance_uid
                    , race_outcome_position = CASE
                        WHEN hr.final_race_outcome_uid IN (1, 71) THEN 1
                        WHEN hr.final_race_outcome_uid IN (2, 72) THEN 2
                    END
                FROM
                    horse_race hr
                JOIN
                    horse h ON h.horse_uid = hr.horse_uid
                WHERE
                    hr.race_instance_uid IN (:raceIdArray:)
                    AND hr.final_race_outcome_uid IN (1, 2, 71, 72)
                ORDER BY
                    CASE
                        WHEN hr.final_race_outcome_uid IN (1, 71) THEN 1
                        WHEN hr.final_race_outcome_uid IN (2, 72) THEN 2
                    END
                    , hr.horse_uid
                ";

            $result = $this->getReadConnection()->query(
                $sql,
                [
                    'raceIdArray' => $racesId
                ]
            );

            $result = new Resultset\General(
                null,
                new \Api\Row\RaceInstance(),
                $result
            );

            $otherHorses = $result->toArrayWithRows('race_instance_uid', null, true);

            foreach ($form as $horseId => $races) {
                foreach ($races as $id => $race) {
                    $otherHorse = null;

                    if (array_key_exists($race->race_instance_uid, $otherHorses)) {
                        if (isset($otherHorses[$race->race_instance_uid][0])
                            && $horseId != $otherHorses[$race->race_instance_uid][0]->horse_uid
                        ) {
                            // Winner
                            $otherHorse = $otherHorses[$race->race_instance_uid][0];
                        } elseif (isset($otherHorses[$race->race_instance_uid][1])
                            && $horseId != $otherHorses[$race->race_instance_uid][1]->horse_uid
                        ) {
                            // Second place
                            $otherHorse = $otherHorses[$race->race_instance_uid][1];
                        }
                    }
                    $form[$horseId][$id]->other_horse = $otherHorse;
                }
            }
        }

        return $form;
    }

    /**
     * @param array  $form
     * @param string $resultType
     *
     * @return array
     */
    protected function joinDistanceWinnersDataToForm(array $form, $resultType)
    {
        if (!empty($form)) {
            $horseIds = array_keys($form);

            $builder = new Builder();

            $builder->setSqlTemplate(
                "
                SELECT
                    hr.race_instance_uid
                    , hr.horse_uid
                    , dtw_rp_distance_desc = (
                        SELECT dth2.rp_distance_desc
                        FROM horse_race hr2
                            JOIN race_outcome ro2 ON
                              ro2.race_outcome_uid = hr2.race_outcome_uid AND ro2.race_output_order = 2
                            JOIN dist_to_horse dth2 ON
                              dth2.dist_to_horse_uid = hr2.dist_to_horse_in_front_uid
                                AND dth2.rp_distance_desc != " . Constants::DIST_TO_HORSE_DHT . "
                        WHERE
                            hr2.race_instance_uid = hr.race_instance_uid
                            AND hr2.horse_uid = hr.horse_uid
                    )
                    , dtw_sum_distance_value = (
                        SELECT SUM(dth3.distance_value)
                        FROM horse_race hr3
                            , race_outcome ro3
                            , dist_to_horse dth3
                        WHERE
                            dth3.dist_to_horse_uid = hr3.dist_to_horse_in_front_uid
                            AND ro3.race_outcome_uid = hr3.race_outcome_uid
                            /*{EXPRESSION(ro3)}*/
                            AND hr3.race_instance_uid = hr.race_instance_uid
                            AND ro3.race_output_order <= 
                                CASE WHEN orig_ro.race_output_order = 1 THEN 2 ELSE orig_ro.race_output_order END
                        GROUP BY hr.horse_uid
                        )
                    , dtw_count_horse_race = (
                        SELECT COUNT(1)
                        FROM horse_race hr4
                            , race_outcome ro4
                            , dist_to_horse dth4
                        WHERE
                            dth4.dist_to_horse_uid = hr4.dist_to_horse_in_front_uid
                            AND ro4.race_outcome_uid = hr4.race_outcome_uid
                            /*{EXPRESSION(ro4)}*/
                            AND hr4.race_instance_uid = hr.race_instance_uid
                            AND ro4.race_output_order <= ro.race_output_order
                            AND dth4.plus_flag = 'Y'
                        GROUP BY hr.horse_uid
                        )
                    , dtw_total_distance_value = (
                        SELECT SUM(dth5.distance_value)
                        FROM horse_race hr5
                            , race_outcome ro5
                            , dist_to_horse dth5
                        WHERE
                            dth5.dist_to_horse_uid = hr5.dist_to_horse_in_front_uid
                            AND ro5.race_outcome_uid = hr5.race_outcome_uid
                            /*{EXPRESSION(ro5)}*/
                            AND hr5.race_instance_uid = hr.race_instance_uid
                        GROUP BY hr.horse_uid
                        )
                    , dth_distance_value = (
                        SELECT dth.distance_value
                        FROM  dist_to_horse dth
                        WHERE
                            dth.dist_to_horse_uid = hr.dist_to_horse_in_front_uid
                        )
                FROM
                    horse_race hr
                    JOIN race_outcome ro ON ro.race_outcome_uid = hr.final_race_outcome_uid
                    JOIN race_outcome orig_ro ON orig_ro.race_outcome_uid = hr.race_outcome_uid
                WHERE
                    hr.horse_uid IN (:horseIds)
            "
            );

            $builder->setParam('horseIds', $horseIds);

            if ($resultType !== 'form') {
                $expressions = ['ro3', 'ro4', 'ro5'];
                foreach ($expressions as $expression) {
                    $builder->expression(
                        $expression,
                        "AND {$expression}.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")"
                    );
                }
            }

            $builder->build();

            $result = $this->getReadConnection()->query(
                $builder->getSql(),
                $builder->getParams()
            );

            $result = new Resultset\General(
                null,
                new \Phalcon\Mvc\Model\Row\General(),
                $result
            );

            $runners = $result->getGroupedResult(
                [
                'horse_uid',
                'races(\Phalcon\Mvc\Model\Row\General)' => [
                    'race_instance_uid',
                    'dtw_rp_distance_desc',
                    'dtw_sum_distance_value',
                    'dtw_count_horse_race',
                    'dtw_total_distance_value',
                    'dth_distance_value',
                ]
                ],
                ['horse_uid', 'race_instance_uid']
            );

            foreach ($form as $horseId => $races) {
                foreach ($races as $raceId => $race) {
                    $runnerRace = null;

                    if (isset($runners[$horseId]->races[$race->race_instance_uid])) {
                        $runnerRace = $runners[$horseId]->races[$race->race_instance_uid];

                        $form[$horseId][$raceId]->dtw_rp_distance_desc = $runnerRace->dtw_rp_distance_desc;
                        $form[$horseId][$raceId]->dtw_sum_distance_value = $runnerRace->dtw_sum_distance_value;
                        $form[$horseId][$raceId]->dtw_count_horse_race = $runnerRace->dtw_count_horse_race;
                        $form[$horseId][$raceId]->dtw_total_distance_value = $runnerRace->dtw_total_distance_value;
                        $form[$horseId][$raceId]->dth_distance_value = $runnerRace->dth_distance_value;
                    }
                }
            }
        }

        return $form;
    }

    /**
     * @param string $tableName
     */
    protected function deleteTable($tableName)
    {
        $sql = "
            IF OBJECT_ID('{$tableName}') IS NOT NULL
            DROP TABLE {$tableName}
        ";
        $this->getReadConnection()->execute($sql, null, null, false);
    }

    /**
     * @param array $form
     * @param array $racesId
     *
     * @return boolean
     */
    private function prepareNextRunTmpTables(array $form, array $racesId)
    {
        if (empty($form)) {
            return false;
        } else {
            $this->deleteTable('#forms_races');

            $sql = "
                SELECT
                    ri.race_instance_uid
                    , ri.race_datetime
                    , ri.race_type_code
                    , race_type_in =
                    CASE
                        WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ") THEN '[FX]'
                        WHEN ri.race_type_code = " . Constants::RACE_TYPE_HURDLE_TURF . " THEN '[H]'
                        WHEN ri.race_type_code = " . Constants::RACE_TYPE_CHASE_TURF . " THEN '[C]'
                        ELSE '[HCZBYUPW]'
                    END
                    , form_total_runners = (
                        SELECT COUNT(*)
                        FROM horse_race hr
                        WHERE hr.race_instance_uid = ri.race_instance_uid
                            AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                        )
                INTO #forms_races
                FROM race_instance ri
                    JOIN course c ON c.course_uid = ri.course_uid
                WHERE ri.race_instance_uid IN (:raceIdArray:)
                    AND c.country_code IN ('GB', 'IRE')
                ";

            $result = $this->getReadConnection()->execute(
                $sql,
                [
                    'raceIdArray' => $racesId
                ],
                null,
                false
            );
            if ($result === false) {
                return false;
            }

            $this->deleteTable('#forms_horses');

            $sql = "
                SELECT
                    ri.race_instance_uid
                    , hr.horse_uid
                    , form_race_position = ro.race_outcome_position
                INTO #forms_horses
                FROM horse_race hr
                    JOIN #forms_races ri ON ri.race_instance_uid = hr.race_instance_uid
                        AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                    JOIN race_outcome ro ON ro.race_outcome_uid = hr.final_race_outcome_uid
                ";

            $result = $this->getReadConnection()->execute($sql, null, null, false);
            if ($result === false) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param array $form
     * @param array $racesId
     * @return array|bool|Resultset\General
     * @throws Resultset\ResultsetException
     */
    public function getNextRun(array $form, array $racesId)
    {
        $result = $this->prepareNextRunTmpTables($form, $racesId);

        if ($result === false) {
            return [];
        } else {
            $sql = "
                SELECT
                    w.form_race_instance_uid
                    , first_3_wins
                    , first_3_placed
                    , first_3_total
                    , other_wins
                    , other_placed
                    , other_total
                    , other_placed
                    , form_total_runners
                FROM (
                    SELECT
                        r.form_race_instance_uid
                        , r.form_total_runners
                        , first_3_wins = SUM(CASE WHEN r.race_outcome_position = 1 AND (r.form_race_position BETWEEN 1 AND 3) THEN 1 ELSE 0 END)
                        , first_3_placed = SUM(CASE
                            WHEN ((r.race_outcome_position = 2 AND r.total_runners > 4)
                                    OR (r.race_outcome_position = 3 AND r.total_runners > 7)
                                    OR (r.race_outcome_position = 4 AND r.total_runners > 15
                                        AND r.race_group_code = " . Constants::RACE_TYPE_HURDLE_TURF . "))
                                AND r.form_race_position BETWEEN 1 AND 3
                            THEN 1 ELSE 0 END)
                        , first_3_total = SUM(CASE WHEN r.form_race_position BETWEEN 1 AND 3 THEN 1 ELSE 0 END)
                        , other_wins = SUM(CASE WHEN r.race_outcome_position = 1 AND (r.form_race_position = 0 OR r.form_race_position > 3) THEN 1 ELSE 0 END)
                        , other_placed = SUM(CASE
                            WHEN ((r.race_outcome_position = 2 AND r.total_runners > 4)
                                    OR (r.race_outcome_position = 3 AND r.total_runners > 7)
                                    OR (r.race_outcome_position = 4 AND r.total_runners > 15
                                        AND r.race_group_code = " . Constants::RACE_TYPE_HURDLE_TURF . "))
                                AND (r.form_race_position = 0 OR r.form_race_position > 3)
                            THEN 1 ELSE 0 END)
                        , other_total = SUM(CASE WHEN r.form_race_position = 0 OR r.form_race_position > 3 THEN 1 ELSE 0 END)
                    FROM (
                        SELECT
                            form_race_instance_uid = fri.race_instance_uid
                            , fri.form_total_runners
                            , fhr.form_race_position
                            , hr.horse_uid
                            , ri.race_instance_uid
                            , ro.race_outcome_position
                            , rg.race_group_code
                            , total_runners = (
                                SELECT COUNT(*)
                                FROM horse_race hr3
                                WHERE hr3.race_instance_uid = ri.race_instance_uid
                                    AND hr3.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                                )
                        FROM race_instance ri
                            JOIN horse_race hr ON hr.race_instance_uid = ri.race_instance_uid
                            JOIN #forms_horses fhr ON fhr.horse_uid = hr.horse_uid
                            JOIN #forms_races fri ON fri.race_instance_uid = fhr.race_instance_uid
                            JOIN race_outcome ro ON ro.race_outcome_uid = hr.final_race_outcome_uid
                            JOIN course co ON co.course_uid = ri.course_uid
                            LEFT JOIN race_group rg ON rg.race_group_uid = isnull(ri.race_group_uid, 0)
                        WHERE
                            ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                            AND ri.race_datetime > fri.race_datetime
                            AND ri.race_datetime <= getdate()
                            AND ri.race_type_code LIKE fri.race_type_in
                            AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                            AND ri.race_datetime = (
                                SELECT MIN(ri2.race_datetime)
                                FROM race_instance ri2
                                    JOIN horse_race hr2 ON hr2.race_instance_uid = ri2.race_instance_uid
                                        AND ri2.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                                        AND hr2.horse_uid = hr.horse_uid
                                        AND ri2.race_datetime > fri.race_datetime
                                        AND ri2.race_datetime <= getdate()
                                        AND ri2.race_type_code LIKE fri.race_type_in
                                        AND hr2.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                                )
                        GROUP BY
                            fri.race_instance_uid
                            , fri.form_total_runners
                            , fhr.form_race_position
                            , hr.horse_uid
                            , ri.race_instance_uid
                            , ro.race_outcome_position
                            , ro.race_outcome_code
                            , rg.race_group_code
                        ) r
                    GROUP BY
                        r.form_race_instance_uid
                        , r.form_total_runners
                    ) w

                ";

            $result = $this->getReadConnection()->query($sql);

            $result = new Resultset\General(
                null,
                new \Api\Row\RaceInstance(),
                $result
            );


            $result = $result->toArrayWithRows('form_race_instance_uid', null, true);

            foreach ($result as $race => $horses) {
                foreach ($horses as $horse) {
                    // We calculate all the below fields to save doing this in the SQL.
                    $horse->first_3_unplaced = $horse->first_3_total - $horse->first_3_wins - $horse->first_3_placed;

                    $horse->other_unplaced = $horse->other_total - $horse->other_wins - $horse->other_placed;

                    $horse->hot_race = 0;
                    $horse->cold_race = 0;

                    $allWins = $horse->first_3_wins
                        + $horse->other_wins
                        + $horse->first_3_placed
                        + $horse->other_placed;

                    $firstWins = $horse->first_3_wins + $horse->other_wins;
                    $firstThree = $horse->first_3_total - $horse->first_3_wins - $horse->first_3_placed;
                    $otherWins = $horse->other_total - $horse->other_wins - $horse->other_placed;

                    // We calculate hot_race and cold_race to save doing these checks and calculations in the SQL.
                    if (($firstWins >= 4
                        || $allWins >= ($horse->form_total_runners / 2))
                        && $firstWins >= 2
                    ) {
                        $horse->hot_race = 1;
                    }


                    if (($allWins + $firstThree + $otherWins) >= 6
                        && $firstWins == 0
                        && ($horse->first_3_placed + $horse->other_placed)                        < (floor($horse->form_total_runners / 3))
                    ) {
                        $horse->cold_race = 1;
                    };
                }
            }

            $this->deleteTable('#forms_horses');
            $this->deleteTable('#forms_races');

            return $result;
        }
    }

    /**
     * @param array $form
     * @param array $racesId
     *
     * @return array
     */
    protected function joinNextRunToForm(array $form, array $racesId)
    {
        $nextRunRaces = $this->getNextRun($form, $racesId);

        if (!empty($nextRunRaces)) {
            foreach ($form as $horseId => $races) {
                foreach ($races as $id => $race) {
                    $nextRunRace = null;
                    $firstThree = null;
                    $other = null;

                    if (array_key_exists($race->race_instance_uid, $nextRunRaces)
                        && isset($nextRunRaces[$race->race_instance_uid][0])
                    ) {
                        $nextRunRace = $nextRunRaces[$race->race_instance_uid][0];

                        $firstThree = (object)[
                            'wins' => $nextRunRace->first_3_wins,
                            'placed' => $nextRunRace->first_3_placed,
                            'unplaced' => $nextRunRace->first_3_unplaced,
                        ];
                        $other = (object)[
                            'wins' => $nextRunRace->other_wins,
                            'placed' => $nextRunRace->other_placed,
                            'unplaced' => $nextRunRace->other_unplaced,
                        ];
                    }
                    $form[$horseId][$id]->next_run = $nextRunRace;

                    if (!is_null($form[$horseId][$id]->next_run)) {
                        $form[$horseId][$id]->next_run->first_three = $firstThree;
                        $form[$horseId][$id]->next_run->other = $other;
                        $form[$horseId][$id]->next_run->average_race = ($nextRunRace['hot_race'] == 0
                            && $nextRunRace['cold_race'] == 0) ? 1 : 0;
                    }
                }
            }
        }

        return $form;
    }

    /**
     * @param array    $forms
     * @param int|null $limit
     *
     * @return array
     */
    protected function restructureForm(array $forms, $limit = null)
    {
        $result = [];

        foreach ($forms as $horseId => $races) {
            $raceObjects = [];
            foreach ($races as $race) {
                $raceObjects[$race->race_instance_uid] = $race;
            }

            $result[$horseId] = (Object)[
                'horse_uid' => $horseId,
                'races' => $raceObjects
            ];
        }

        return $result;
    }

    /**
     * Returns an array of horses for which PTP races are allowed to display
     *
     * @return array
     */
    public function getPtpGbHorses()
    {
        $sql = "
            SELECT horse_uid
            FROM " . static::HORSES_PTP_GB_ID_TABLE;

        $result = $this->getReadConnection()->query($sql);

        $result = (new Resultset\Simple(null, new \Phalcon\Mvc\Model\Row(), $result))->toArray();

        $ret = [];
        foreach ($result as $row) {
            $ret[] = reset($row);
        }

        return $ret;
    }

    /**
     * @param int    $attr_id
     * @param string $exclude
     *
     * @return string
     */
    public static function getSpecialFlagExclusionCondition($attr_id = 432, $exclude = '')
    {
        $innerCondition = "WHERE
                raj.race_instance_uid = ri.race_instance_uid
                AND raj.race_attrib_uid = $attr_id";

        if (!empty($exclude)) {
            $innerCondition .= " AND c.crs_id NOT IN ($exclude)";
        }

        $excludeCardRaces = "
            NOT EXISTS (
                SELECT *
                FROM race_attrib_join raj
                $innerCondition
            )";

        return $excludeCardRaces;
    }

    /**
     * Create horsesId tmp table by $raceId
     *
     * @param int  $raceId
     * @param bool $isResults
     *
     * @return mixed
     *
     * @codeCoverageIgnore
     */
    private function createHorsesIdTmpTableByRace($raceId, $isResults)
    {

        // In case we are at results status we need to join a horse_race instead of pre_horse_race table.
        if ($isResults == false) {
            $horseOrPreHorseTable = 'pre_horse_race';
            $where =  'AND phr.race_status_code = (
                    CASE
                        WHEN ri.race_status_code = ' . Constants::RACE_STATUS_RESULTS . '
                        THEN ' . Constants::RACE_STATUS_OVERNIGHT . '
                        ELSE ri.race_status_code
                    END)';
        } else {
            $horseOrPreHorseTable = 'horse_race';
            // at results stage the race_status_code is always "R" so we don't need to check for that
            $where = '';
        }

        $sql = '
            SELECT
                phr.horse_uid
            INTO ' . static::HORSES_ID_TABLE . '
            FROM race_instance ri
                INNER JOIN ' . $horseOrPreHorseTable . ' phr ON phr.race_instance_uid = ri.race_instance_uid
            WHERE
                ri.race_instance_uid = :raceId
                ' . $where . '
            CREATE INDEX ' . static::HORSES_ID_TABLE . 'Idx ON ' . static::HORSES_ID_TABLE . ' (horse_uid)
        ';


        sprintf($sql, $horseOrPreHorseTable, $where);

        return $this->getReadConnection()->execute(
            $sql,
            [
                'raceId' => $raceId
            ],
            null,
            false
        );
    }

    /**
     * Create horsesId tmp table by $horseId
     *
     * @param int $horseId
     *
     * @return mixed
     *
     * @codeCoverageIgnore
     */
    private function createHorsesIdTmpTableByHorse($horseId)
    {
        $sql = "
            SELECT
                horse_uid = :horseId:
            INTO " . static::HORSES_ID_TABLE . "
        ";

        return $this->getReadConnection()->execute(
            $sql,
            [
                'horseId' => $horseId
            ],
            null,
            false
        );
    }

    /**
     * Create PTP GB horsesId tmp table
     *
     * @return mixed
     *
     * @codeCoverageIgnore
     */
    private function createHorsePtpGbIdTmpTable()
    {
        $sql = "
            SELECT DISTINCT
                hr.horse_uid
            INTO " . static::HORSES_PTP_GB_ID_TABLE . "
            FROM
                race_instance ri
                , horse_race hr
                , course c
            WHERE ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                AND ri.race_instance_uid = hr.race_instance_uid
                AND ri.course_uid = c.course_uid
                AND c.country_code = 'GB'
                AND ri.race_type_code = " . Constants::RACE_TYPE_P2P . "
                AND EXISTS (SELECT 1 FROM " . static::HORSES_ID_TABLE . " hids WHERE hr.horse_uid = hids.horse_uid)
                AND (
                    EXISTS (
                    SELECT 1
                    FROM pre_horse_race phr1
                        , race_instance ri1
                    WHERE
                        phr1.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                        AND ri1.race_instance_uid = phr1.race_instance_uid
                        AND ri1.race_status_code = phr1.race_status_code
                        AND ri1.race_type_code != " . Constants::RACE_TYPE_P2P . "
                        AND phr1.horse_uid = hr.horse_uid
                    )
                    OR EXISTS (
                    SELECT 1
                    FROM
                        race_instance ri2
                        , horse_race hr2
                    WHERE ri2.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                        AND ri2.race_instance_uid = hr2.race_instance_uid
                        AND hr2.horse_uid = hr.horse_uid
                        AND ri2.race_type_code != " . Constants::RACE_TYPE_P2P . "
                    )
                )

            CREATE INDEX " . static::HORSES_PTP_GB_ID_TABLE . "Idx
                ON " . static::HORSES_PTP_GB_ID_TABLE . " (horse_uid)
        ";

        return $this->getReadConnection()->execute($sql, null, null, false);
    }

    /**
     * @param int  $raceId
     * @param int  $horseId
     * @param bool $isResults - used to identify which tables we want to join in the tmp table we want to create
     *
     * @codeCoverageIgnore
     */
    public function createHorsesIdTables($raceId, $horseId = 0, $isResults = false)
    {
        if ($raceId > 0) {
            $this->createHorsesIdTmpTableByRace($raceId, $isResults);
        } elseif ($horseId > 0) {
            $this->createHorsesIdTmpTableByHorse($horseId);
        }
        $this->createHorsePtpGbIdTmpTable();
    }


    /**
     * Drop horsesUids tmp table
     *
     * @codeCoverageIgnore
     */
    public function dropHorsesUidsTmpTables()
    {
        static::deleteTable(static::HORSES_ID_TABLE);
        static::deleteTable(static::HORSES_PTP_GB_ID_TABLE);
    }
}
