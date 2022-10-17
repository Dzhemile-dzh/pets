<?php

namespace Models;

use Phalcon\Mvc\Model;
use Phalcon\Db\Column;
use Phalcon\Mvc\Model\MetaData;

class PreMeetingDetails extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $course_uid;

    /**
     *
     * @var string
     */
    protected $meeting_date;

    /**
     *
     * @var string
     */
    protected $going_desc;

    /**
     *
     * @var double
     */
    protected $trio_carry_over_sterling;

    /**
     *
     * @var integer
     */
    protected $trio_pre_course_uid;

    /**
     *
     * @var string
     */
    protected $trio_pre_date;

    /**
     *
     * @var double
     */
    protected $jackpot_carry_over_sterling;

    /**
     *
     * @var integer
     */
    protected $jackpot_pre_course_uid;

    /**
     *
     * @var string
     */
    protected $jackpot_pre_date;

    /**
     *
     * @var double
     */
    protected $guaratd_jackpot_today_sterling;

    /**
     *
     * @var string
     */
    protected $trio_jackpot_text;

    /**
     *
     * @var string
     */
    protected $tv_text;

    /**
     *
     * @var string
     */
    protected $weather_details;

    /**
     *
     * @var string
     */
    protected $diomed;

    /**
     *
     * @var double
     */
    protected $placepot_cost;

    /**
     *
     * @var string
     */
    protected $tote_jackpot_yn;

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
     * Method to set the value of field meeting_date
     *
     * @param string $meeting_date
     *
     * @return $this
     */
    public function setMeetingDate($meeting_date)
    {
        $this->meeting_date = $meeting_date;

        return $this;
    }

    /**
     * Method to set the value of field going_desc
     *
     * @param string $going_desc
     *
     * @return $this
     */
    public function setGoingDesc($going_desc)
    {
        $this->going_desc = $going_desc;

        return $this;
    }

    /**
     * Method to set the value of field trio_carry_over_sterling
     *
     * @param double $trio_carry_over_sterling
     *
     * @return $this
     */
    public function setTrioCarryOverSterling($trio_carry_over_sterling)
    {
        $this->trio_carry_over_sterling = $trio_carry_over_sterling;

        return $this;
    }

    /**
     * Method to set the value of field trio_pre_course_uid
     *
     * @param integer $trio_pre_course_uid
     *
     * @return $this
     */
    public function setTrioPreCourseUid($trio_pre_course_uid)
    {
        $this->trio_pre_course_uid = $trio_pre_course_uid;

        return $this;
    }

    /**
     * Method to set the value of field trio_pre_date
     *
     * @param string $trio_pre_date
     *
     * @return $this
     */
    public function setTrioPreDate($trio_pre_date)
    {
        $this->trio_pre_date = $trio_pre_date;

        return $this;
    }

    /**
     * Method to set the value of field jackpot_carry_over_sterling
     *
     * @param double $jackpot_carry_over_sterling
     *
     * @return $this
     */
    public function setJackpotCarryOverSterling($jackpot_carry_over_sterling)
    {
        $this->jackpot_carry_over_sterling = $jackpot_carry_over_sterling;

        return $this;
    }

    /**
     * Method to set the value of field jackpot_pre_course_uid
     *
     * @param integer $jackpot_pre_course_uid
     *
     * @return $this
     */
    public function setJackpotPreCourseUid($jackpot_pre_course_uid)
    {
        $this->jackpot_pre_course_uid = $jackpot_pre_course_uid;

        return $this;
    }

    /**
     * Method to set the value of field jackpot_pre_date
     *
     * @param string $jackpot_pre_date
     *
     * @return $this
     */
    public function setJackpotPreDate($jackpot_pre_date)
    {
        $this->jackpot_pre_date = $jackpot_pre_date;

        return $this;
    }

    /**
     * Method to set the value of field guaratd_jackpot_today_sterling
     *
     * @param double $guaratd_jackpot_today_sterling
     *
     * @return $this
     */
    public function setGuaratdJackpotTodaySterling(
        $guaratd_jackpot_today_sterling
    ) {
        $this->guaratd_jackpot_today_sterling = $guaratd_jackpot_today_sterling;

        return $this;
    }

    /**
     * Method to set the value of field trio_jackpot_text
     *
     * @param string $trio_jackpot_text
     *
     * @return $this
     */
    public function setTrioJackpotText($trio_jackpot_text)
    {
        $this->trio_jackpot_text = $trio_jackpot_text;

        return $this;
    }

    /**
     * Method to set the value of field tv_text
     *
     * @param string $tv_text
     *
     * @return $this
     */
    public function setTvText($tv_text)
    {
        $this->tv_text = $tv_text;

        return $this;
    }

    /**
     * Method to set the value of field weather_details
     *
     * @param string $weather_details
     *
     * @return $this
     */
    public function setWeatherDetails($weather_details)
    {
        $this->weather_details = $weather_details;

        return $this;
    }

    /**
     * Method to set the value of field diomed
     *
     * @param string $diomed
     *
     * @return $this
     */
    public function setDiomed($diomed)
    {
        $this->diomed = $diomed;

        return $this;
    }

    /**
     * Method to set the value of field placepot_cost
     *
     * @param double $placepot_cost
     *
     * @return $this
     */
    public function setPlacepotCost($placepot_cost)
    {
        $this->placepot_cost = $placepot_cost;

        return $this;
    }

    /**
     * Method to set the value of field tote_jackpot_yn
     *
     * @param string $tote_jackpot_yn
     *
     * @return $this
     */
    public function setToteJackpotYn($tote_jackpot_yn)
    {
        $this->tote_jackpot_yn = $tote_jackpot_yn;

        return $this;
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
     * Returns the value of field meeting_date
     *
     * @return string
     */
    public function getMeetingDate()
    {
        return $this->meeting_date;
    }

    /**
     * Returns the value of field going_desc
     *
     * @return string
     */
    public function getGoingDesc()
    {
        return $this->going_desc;
    }

    /**
     * Returns the value of field trio_carry_over_sterling
     *
     * @return double
     */
    public function getTrioCarryOverSterling()
    {
        return $this->trio_carry_over_sterling;
    }

    /**
     * Returns the value of field trio_pre_course_uid
     *
     * @return integer
     */
    public function getTrioPreCourseUid()
    {
        return $this->trio_pre_course_uid;
    }

    /**
     * Returns the value of field trio_pre_date
     *
     * @return string
     */
    public function getTrioPreDate()
    {
        return $this->trio_pre_date;
    }

    /**
     * Returns the value of field jackpot_carry_over_sterling
     *
     * @return double
     */
    public function getJackpotCarryOverSterling()
    {
        return $this->jackpot_carry_over_sterling;
    }

    /**
     * Returns the value of field jackpot_pre_course_uid
     *
     * @return integer
     */
    public function getJackpotPreCourseUid()
    {
        return $this->jackpot_pre_course_uid;
    }

    /**
     * Returns the value of field jackpot_pre_date
     *
     * @return string
     */
    public function getJackpotPreDate()
    {
        return $this->jackpot_pre_date;
    }

    /**
     * Returns the value of field guaratd_jackpot_today_sterling
     *
     * @return double
     */
    public function getGuaratdJackpotTodaySterling()
    {
        return $this->guaratd_jackpot_today_sterling;
    }

    /**
     * Returns the value of field trio_jackpot_text
     *
     * @return string
     */
    public function getTrioJackpotText()
    {
        return $this->trio_jackpot_text;
    }

    /**
     * Returns the value of field tv_text
     *
     * @return string
     */
    public function getTvText()
    {
        return $this->tv_text;
    }

    /**
     * Returns the value of field weather_details
     *
     * @return string
     */
    public function getWeatherDetails()
    {
        return $this->weather_details;
    }

    /**
     * Returns the value of field diomed
     *
     * @return string
     */
    public function getDiomed()
    {
        return $this->diomed;
    }

    /**
     * Returns the value of field placepot_cost
     *
     * @return double
     */
    public function getPlacepotCost()
    {
        return $this->placepot_cost;
    }

    /**
     * Returns the value of field tote_jackpot_yn
     *
     * @return string
     */
    public function getToteJackpotYn()
    {
        return $this->tote_jackpot_yn;
    }

    public function getSource()
    {
        return 'pre_meeting_details';
    }

    /**
     * @return array
     */
    public function metaData()
    {
        return array(

            //Every column in the mapped table
            MetaData::MODELS_ATTRIBUTES => array(
                'course_uid',
                'meeting_date',
                'going_desc',
                'trio_carry_over_sterling',
                'trio_pre_course_uid',
                'trio_pre_date',
                'jackpot_carry_over_sterling',
                'jackpot_pre_course_uid',
                'jackpot_pre_date',
                'guaratd_jackpot_today_sterling',
                'trio_jackpot_text',
                'tv_text',
                'weather_details',
                'diomed',
                'placepot_cost',
                'tote_jackpot_yn',
            ),
            //Every column part of the primary key
            MetaData::MODELS_PRIMARY_KEY => array(
                'course_uid',
                'meeting_date',
            ),
            //Every column that isn't part of the primary key
            MetaData::MODELS_NON_PRIMARY_KEY => array(
                'going_desc',
                'trio_carry_over_sterling',
                'trio_pre_course_uid',
                'trio_pre_date',
                'jackpot_carry_over_sterling',
                'jackpot_pre_course_uid',
                'jackpot_pre_date',
                'guaratd_jackpot_today_sterling',
                'trio_jackpot_text',
                'tv_text',
                'weather_details',
                'diomed',
                'placepot_cost',
                'tote_jackpot_yn',
            ),
            //Every column that doesn't allows null values
            MetaData::MODELS_NOT_NULL => array(
                'going_desc',
                'trio_carry_over_sterling',
                'trio_pre_course_uid',
                'trio_pre_date',
                'jackpot_carry_over_sterling',
                'jackpot_pre_course_uid',
                'jackpot_pre_date',
                'guaratd_jackpot_today_sterling',
                'trio_jackpot_text',
                'tv_text',
                'weather_details',
                'diomed',
                'placepot_cost',
                'tote_jackpot_yn',
            ),
            //Every column and their data types
            MetaData::MODELS_DATA_TYPES => array(
                'course_uid' => Column::TYPE_INTEGER,
                'meeting_date' => Column::TYPE_DATETIME,
                'going_desc' => Column::TYPE_VARCHAR,
                'trio_carry_over_sterling' => Column::TYPE_DECIMAL,
                'trio_pre_course_uid' => Column::TYPE_INTEGER,
                'trio_pre_date' => Column::TYPE_DATETIME,
                'jackpot_carry_over_sterling' => Column::TYPE_DECIMAL,
                'jackpot_pre_course_uid' => Column::TYPE_INTEGER,
                'jackpot_pre_date' => Column::TYPE_DATETIME,
                'guaratd_jackpot_today_sterling' => Column::TYPE_DECIMAL,
                'trio_jackpot_text' => Column::TYPE_VARCHAR,
                'tv_text' => Column::TYPE_VARCHAR,
                'weather_details' => Column::TYPE_VARCHAR,
                'diomed' => Column::TYPE_VARCHAR,
                'placepot_cost' => Column::TYPE_DECIMAL,
                'tote_jackpot_yn' => Column::TYPE_CHAR,
            ),
            //The columns that have numeric data types
            MetaData::MODELS_DATA_TYPES_NUMERIC => array(
                'course_uid' => true,
                'meeting_date' => false,
                'going_desc' => false,
                'trio_carry_over_sterling' => true,
                'trio_pre_course_uid' => true,
                'trio_pre_date' => false,
                'jackpot_carry_over_sterling' => true,
                'jackpot_pre_course_uid' => true,
                'jackpot_pre_date' => false,
                'guaratd_jackpot_today_sterling' => true,
                'trio_jackpot_text' => false,
                'tv_text' => false,
                'weather_details' => false,
                'diomed' => false,
                'placepot_cost' => true,
                'tote_jackpot_yn' => false,
            ),
            //How every column must be bound/casted
            MetaData::MODELS_DATA_TYPES_BIND => array(
                'course_uid' => Column::BIND_PARAM_INT,
                'meeting_date' => Column::BIND_PARAM_STR,
                'going_desc' => Column::BIND_PARAM_STR,
                'trio_carry_over_sterling' => Column::BIND_PARAM_DECIMAL,
                'trio_pre_course_uid' => Column::BIND_PARAM_INT,
                'trio_pre_date' => Column::BIND_PARAM_STR,
                'jackpot_carry_over_sterling' => Column::BIND_PARAM_DECIMAL,
                'jackpot_pre_course_uid' => Column::BIND_PARAM_INT,
                'jackpot_pre_date' => Column::BIND_PARAM_STR,
                'guaratd_jackpot_today_sterling' => Column::BIND_PARAM_DECIMAL,
                'trio_jackpot_text' => Column::BIND_PARAM_STR,
                'tv_text' => Column::BIND_PARAM_STR,
                'weather_details' => Column::BIND_PARAM_STR,
                'diomed' => Column::BIND_PARAM_STR,
                'placepot_cost' => Column::BIND_PARAM_DECIMAL,
                'tote_jackpot_yn' => Column::BIND_PARAM_STR,
            ),
            //Fields that must be ignored from INSERT SQL statements
            MetaData::MODELS_AUTOMATIC_DEFAULT_INSERT => false,
            //Fields that must be ignored from UPDATE SQL statements
            MetaData::MODELS_AUTOMATIC_DEFAULT_UPDATE => false,
            //The identity column, use boolean false if the model doesn't have an identity column
            MetaData::MODELS_IDENTITY_COLUMN => false
        );
    }
}
