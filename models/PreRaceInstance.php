<?php

namespace Models;

use Phalcon\Mvc\Model;
use Phalcon\Db\Column;
use Phalcon\Mvc\Model\MetaData;

class PreRaceInstance extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $race_instance_uid;
     
    /**
     *
     * @var string
     */
    protected $race_status_code;
     
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
    protected $safety_factor_number;
     
    /**
     *
     * @var string
     */
    protected $weatherbys_race_no;
     
    /**
     *
     * @var string
     */
    protected $weatherbys_division_no;
     
    /**
     *
     * @var string
     */
    protected $weatherbys_part_no;
     
    /**
     *
     * @var string
     */
    protected $early_closing_race_yn;
     
    /**
     *
     * @var string
     */
    protected $race_datetime;
     
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
    protected $reopened_yn;
     
    /**
     *
     * @var integer
     */
    protected $no_of_runners;
     
    /**
     *
     * @var string
     */
    protected $t_timestamp;
     
    /**
     *
     * @var integer
     */
    protected $min_weight;
     
    /**
     *
     * @var integer
     */
    protected $entry_fee;
     
    /**
     *
     * @var string
     */
    protected $extra_fee;
     
    /**
     *
     * @var integer
     */
    protected $three_yo_min_weight_lbs;
     
    /**
     *
     * @var integer
     */
    protected $division_preference;
     
    /**
     *
     * @var string
     */
    protected $subscription_list;

    /**
     * @return array
     */
    public function metaData()
    {
        return array(

            //Every column in the mapped table
            MetaData::MODELS_ATTRIBUTES => array(
                'race_instance_uid',
                'race_status_code',
                'weights_raised_lbs',
                'minimum_weight_lbs',
                'safety_factor_number',
                'weatherbys_race_no',
                'weatherbys_division_no',
                'weatherbys_part_no',
                'early_closing_race_yn',
                'race_datetime',
                'distance_yard',
                'course_uid',
                'reopened_yn',
                'no_of_runners',
                't_timestamp',
                'min_weight',
                'entry_fee',
                'extra_fee',
                'three_yo_min_weight_lbs',
                'division_preference',
                'subscription_list'
            ),

            //Every column part of the primary key
            MetaData::MODELS_PRIMARY_KEY => array(
                'race_instance_uid', 'race_status_code'
            ),

            //Every column that isn't part of the primary key
            MetaData::MODELS_NON_PRIMARY_KEY => array(
                'weights_raised_lbs',
                'minimum_weight_lbs',
                'safety_factor_number',
                'weatherbys_race_no',
                'weatherbys_division_no',
                'weatherbys_part_no',
                'early_closing_race_yn',
                'race_datetime',
                'distance_yard',
                'course_uid',
                'reopened_yn',
                'no_of_runners',
                't_timestamp',
                'min_weight',
                'entry_fee',
                'extra_fee',
                'three_yo_min_weight_lbs',
                'division_preference',
                'subscription_list'
            ),

            //Every column that doesn't allows null values
            MetaData::MODELS_NOT_NULL => array(
                'race_instance_uid',
                'race_status_code',
                't_timestamp'
            ),

            //Every column and their data types
            MetaData::MODELS_DATA_TYPES => array(
                'race_instance_uid' => Column::TYPE_INTEGER,
                'race_status_code' => Column::TYPE_CHAR,
                'weights_raised_lbs' => Column::TYPE_INTEGER,
                'minimum_weight_lbs' => Column::TYPE_INTEGER,
                'safety_factor_number' => Column::TYPE_INTEGER,
                'weatherbys_race_no' => Column::TYPE_VARCHAR,
                'weatherbys_division_no' => Column::TYPE_CHAR,
                'weatherbys_part_no' => Column::TYPE_CHAR,
                'early_closing_race_yn' => Column::TYPE_CHAR,
                'race_datetime' => Column::TYPE_DATETIME,
                'distance_yard' => Column::TYPE_INTEGER,
                'course_uid' => Column::TYPE_INTEGER,
                'reopened_yn' => Column::TYPE_CHAR,
                'no_of_runners' => Column::TYPE_INTEGER,
                't_timestamp' => Column::TYPE_DATETIME,
                'min_weight' => Column::TYPE_INTEGER,
                'entry_fee' => Column::TYPE_INTEGER,
                'extra_fee' => Column::TYPE_VARCHAR,
                'three_yo_min_weight_lbs' => Column::TYPE_INTEGER,
                'division_preference' => Column::TYPE_INTEGER,
                'subscription_list' => Column::TYPE_VARCHAR
            ),

            //The columns that have numeric data types
            MetaData::MODELS_DATA_TYPES_NUMERIC => array(
                'race_instance_uid' => true,
                'weights_raised_lbs' => true,
                'minimum_weight_lbs' => true,
                'safety_factor_number' => true,
                'distance_yard' => true,
                'course_uid' => true,
                'no_of_runners' => true,
                'min_weight' => true,
                'entry_fee' => true,
                'three_yo_min_weight_lbs' => true,
                'division_preference' => true,
            ),

            //The identity column, use boolean false if the model doesn't have
            //an identity column
            MetaData::MODELS_IDENTITY_COLUMN => false,

            //How every column must be bound/casted
            MetaData::MODELS_DATA_TYPES_BIND => array(
                'race_instance_uid' => Column::BIND_PARAM_INT,
                'race_status_code' => Column::BIND_PARAM_STR,
                'weights_raised_lbs' => Column::BIND_PARAM_INT,
                'minimum_weight_lbs' => Column::BIND_PARAM_INT,
                'safety_factor_number' => Column::BIND_PARAM_INT,
                'weatherbys_race_no' => Column::BIND_PARAM_STR,
                'weatherbys_division_no' => Column::BIND_PARAM_STR,
                'weatherbys_part_no' => Column::BIND_PARAM_STR,
                'early_closing_race_yn' => Column::BIND_PARAM_STR,
                'race_datetime' => Column::BIND_PARAM_STR,
                'distance_yard' => Column::BIND_PARAM_INT,
                'course_uid' => Column::BIND_PARAM_INT,
                'reopened_yn' => Column::BIND_PARAM_STR,
                'no_of_runners' => Column::BIND_PARAM_INT,
                't_timestamp' => Column::BIND_PARAM_STR,
                'min_weight' => Column::BIND_PARAM_INT,
                'entry_fee' => Column::BIND_PARAM_INT,
                'extra_fee' => Column::BIND_PARAM_STR,
                'three_yo_min_weight_lbs' => Column::BIND_PARAM_INT,
                'division_preference' => Column::BIND_PARAM_INT,
                'subscription_list' => Column::BIND_PARAM_STR
            ),

            //Fields that must be ignored from INSERT SQL statements
            MetaData::MODELS_AUTOMATIC_DEFAULT_INSERT => array(),

            //Fields that must be ignored from UPDATE SQL statements
            MetaData::MODELS_AUTOMATIC_DEFAULT_UPDATE => array()

        );
    }

    public function initialize()
    {
        $this->belongsTo('race_instance_uid', 'Models\RaceInstance', 'race_instance_uid');
    }
     
    /**
     * Method to set the value of field race_instance_uid
     *
     * @param integer $race_instance_uid
     * @return $this
     */
    public function setRaceInstanceUid($race_instance_uid)
    {
        $this->race_instance_uid = $race_instance_uid;

        return $this;
    }

    /**
     * Method to set the value of field race_status_code
     *
     * @param string $race_status_code
     * @return $this
     */
    public function setRaceStatusCode($race_status_code)
    {
        $this->race_status_code = $race_status_code;

        return $this;
    }

    /**
     * Method to set the value of field weights_raised_lbs
     *
     * @param integer $weights_raised_lbs
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
     * @return $this
     */
    public function setMinimumWeightLbs($minimum_weight_lbs)
    {
        $this->minimum_weight_lbs = $minimum_weight_lbs;

        return $this;
    }

    /**
     * Method to set the value of field safety_factor_number
     *
     * @param integer $safety_factor_number
     * @return $this
     */
    public function setSafetyFactorNumber($safety_factor_number)
    {
        $this->safety_factor_number = $safety_factor_number;

        return $this;
    }

    /**
     * Method to set the value of field weatherbys_race_no
     *
     * @param string $weatherbys_race_no
     * @return $this
     */
    public function setWeatherbysRaceNo($weatherbys_race_no)
    {
        $this->weatherbys_race_no = $weatherbys_race_no;

        return $this;
    }

    /**
     * Method to set the value of field weatherbys_division_no
     *
     * @param string $weatherbys_division_no
     * @return $this
     */
    public function setWeatherbysDivisionNo($weatherbys_division_no)
    {
        $this->weatherbys_division_no = $weatherbys_division_no;

        return $this;
    }

    /**
     * Method to set the value of field weatherbys_part_no
     *
     * @param string $weatherbys_part_no
     * @return $this
     */
    public function setWeatherbysPartNo($weatherbys_part_no)
    {
        $this->weatherbys_part_no = $weatherbys_part_no;

        return $this;
    }

    /**
     * Method to set the value of field early_closing_race_yn
     *
     * @param string $early_closing_race_yn
     * @return $this
     */
    public function setEarlyClosingRaceYn($early_closing_race_yn)
    {
        $this->early_closing_race_yn = $early_closing_race_yn;

        return $this;
    }

    /**
     * Method to set the value of field race_datetime
     *
     * @param string $race_datetime
     * @return $this
     */
    public function setRaceDatetime($race_datetime)
    {
        $this->race_datetime = $race_datetime;

        return $this;
    }

    /**
     * Method to set the value of field distance_yard
     *
     * @param integer $distance_yard
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
     * @return $this
     */
    public function setCourseUid($course_uid)
    {
        $this->course_uid = $course_uid;

        return $this;
    }

    /**
     * Method to set the value of field reopened_yn
     *
     * @param string $reopened_yn
     * @return $this
     */
    public function setReopenedYn($reopened_yn)
    {
        $this->reopened_yn = $reopened_yn;

        return $this;
    }

    /**
     * Method to set the value of field no_of_runners
     *
     * @param integer $no_of_runners
     * @return $this
     */
    public function setNoOfRunners($no_of_runners)
    {
        $this->no_of_runners = $no_of_runners;

        return $this;
    }

    /**
     * Method to set the value of field t_timestamp
     *
     * @param string $t_timestamp
     * @return $this
     */
    public function setTTimestamp($t_timestamp)
    {
        $this->t_timestamp = $t_timestamp;

        return $this;
    }

    /**
     * Method to set the value of field min_weight
     *
     * @param integer $min_weight
     * @return $this
     */
    public function setMinWeight($min_weight)
    {
        $this->min_weight = $min_weight;

        return $this;
    }

    /**
     * Method to set the value of field entry_fee
     *
     * @param integer $entry_fee
     * @return $this
     */
    public function setEntryFee($entry_fee)
    {
        $this->entry_fee = $entry_fee;

        return $this;
    }

    /**
     * Method to set the value of field extra_fee
     *
     * @param string $extra_fee
     * @return $this
     */
    public function setExtraFee($extra_fee)
    {
        $this->extra_fee = $extra_fee;

        return $this;
    }

    /**
     * Method to set the value of field three_yo_min_weight_lbs
     *
     * @param integer $three_yo_min_weight_lbs
     * @return $this
     */
    public function setThreeYoMinWeightLbs($three_yo_min_weight_lbs)
    {
        $this->three_yo_min_weight_lbs = $three_yo_min_weight_lbs;

        return $this;
    }

    /**
     * Method to set the value of field division_preference
     *
     * @param integer $division_preference
     * @return $this
     */
    public function setDivisionPreference($division_preference)
    {
        $this->division_preference = $division_preference;

        return $this;
    }

    /**
     * Method to set the value of field subscription_list
     *
     * @param string $subscription_list
     * @return $this
     */
    public function setSubscriptionList($subscription_list)
    {
        $this->subscription_list = $subscription_list;

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
     * Returns the value of field race_status_code
     *
     * @return string
     */
    public function getRaceStatusCode()
    {
        return $this->race_status_code;
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
     * Returns the value of field safety_factor_number
     *
     * @return integer
     */
    public function getSafetyFactorNumber()
    {
        return $this->safety_factor_number;
    }

    /**
     * Returns the value of field weatherbys_race_no
     *
     * @return string
     */
    public function getWeatherbysRaceNo()
    {
        return $this->weatherbys_race_no;
    }

    /**
     * Returns the value of field weatherbys_division_no
     *
     * @return string
     */
    public function getWeatherbysDivisionNo()
    {
        return $this->weatherbys_division_no;
    }

    /**
     * Returns the value of field weatherbys_part_no
     *
     * @return string
     */
    public function getWeatherbysPartNo()
    {
        return $this->weatherbys_part_no;
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
     * Returns the value of field race_datetime
     *
     * @return string
     */
    public function getRaceDatetime()
    {
        return $this->race_datetime;
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
     * Returns the value of field reopened_yn
     *
     * @return string
     */
    public function getReopenedYn()
    {
        return $this->reopened_yn;
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
     * Returns the value of field t_timestamp
     *
     * @return string
     */
    public function getTTimestamp()
    {
        return $this->t_timestamp;
    }

    /**
     * Returns the value of field min_weight
     *
     * @return integer
     */
    public function getMinWeight()
    {
        return $this->min_weight;
    }

    /**
     * Returns the value of field entry_fee
     *
     * @return integer
     */
    public function getEntryFee()
    {
        return $this->entry_fee;
    }

    /**
     * Returns the value of field extra_fee
     *
     * @return string
     */
    public function getExtraFee()
    {
        return $this->extra_fee;
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
     * Returns the value of field division_preference
     *
     * @return integer
     */
    public function getDivisionPreference()
    {
        return $this->division_preference;
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
}
