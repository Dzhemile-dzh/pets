<?php

namespace Models;

use Phalcon\Mvc\Model;
use Phalcon\Db\Column;
use Phalcon\Mvc\Model\MetaData;

class MeetingDetails extends \Phalcon\Mvc\Model
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
    protected $close_up_man;

    /**
     *
     * @var string
     */
    protected $going_desc;

    /**
     *
     * @var string
     */
    protected $stalls_position;

    /**
     *
     * @var string
     */
    protected $misc_text;

    /**
     *
     * @var string
     */
    protected $jackpot_text;

    /**
     *
     * @var string
     */
    protected $placepot_text;

    /**
     *
     * @var string
     */
    protected $quadpot_text;

    /**
     *
     * @var string
     */
    protected $irish_text;

    /**
     *
     * @var integer
     */
    protected $hunt_uid;

    /**
     *
     * @var string
     */
    protected $principal_yn;

    /**
     *
     * @var integer
     */
    protected $punters_club_no;

    /**
     *
     * @var string
     */
    protected $analysis_man;

    /**
     *
     * @var string
     */
    protected $betting_man;

    /**
     *
     * @var string
     */
    protected $wind;

    /**
     *
     * @var string
     */
    protected $weather_cond;

    /**
     *
     * @var string
     */
    protected $meeting_name;

    /**
     *
     * @var string
     */
    protected $meeting_abandoned;

    /**
     *
     * @var string
     */
    protected $abandoned_reason;

    /**
     *
     * @var string
     */
    protected $rf_meeting_comment;

    /**
     *
     * @var string
     */
    protected $subscription_list;

    /**
     *
     * @var string
     */
    protected $rf_meeting_infocus;

    /**
     *
     * @var string
     */
    protected $rp_going_assessment;

    /**
     *
     * @var string
     */
    protected $rails;

    /**
     *
     * @var string
     */
    protected $other_details;

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
     * Method to set the value of field close_up_man
     *
     * @param string $close_up_man
     *
     * @return $this
     */
    public function setCloseUpMan($close_up_man)
    {
        $this->close_up_man = $close_up_man;

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
     * Method to set the value of field stalls_position
     *
     * @param string $stalls_position
     *
     * @return $this
     */
    public function setStallsPosition($stalls_position)
    {
        $this->stalls_position = $stalls_position;

        return $this;
    }

    /**
     * Method to set the value of field misc_text
     *
     * @param string $misc_text
     *
     * @return $this
     */
    public function setMiscText($misc_text)
    {
        $this->misc_text = $misc_text;

        return $this;
    }

    /**
     * Method to set the value of field jackpot_text
     *
     * @param string $jackpot_text
     *
     * @return $this
     */
    public function setJackpotText($jackpot_text)
    {
        $this->jackpot_text = $jackpot_text;

        return $this;
    }

    /**
     * Method to set the value of field placepot_text
     *
     * @param string $placepot_text
     *
     * @return $this
     */
    public function setPlacepotText($placepot_text)
    {
        $this->placepot_text = $placepot_text;

        return $this;
    }

    /**
     * Method to set the value of field quadpot_text
     *
     * @param string $quadpot_text
     *
     * @return $this
     */
    public function setQuadpotText($quadpot_text)
    {
        $this->quadpot_text = $quadpot_text;

        return $this;
    }

    /**
     * Method to set the value of field irish_text
     *
     * @param string $irish_text
     *
     * @return $this
     */
    public function setIrishText($irish_text)
    {
        $this->irish_text = $irish_text;

        return $this;
    }

    /**
     * Method to set the value of field hunt_uid
     *
     * @param integer $hunt_uid
     *
     * @return $this
     */
    public function setHuntUid($hunt_uid)
    {
        $this->hunt_uid = $hunt_uid;

        return $this;
    }

    /**
     * Method to set the value of field principal_yn
     *
     * @param string $principal_yn
     *
     * @return $this
     */
    public function setPrincipalYn($principal_yn)
    {
        $this->principal_yn = $principal_yn;

        return $this;
    }

    /**
     * Method to set the value of field punters_club_no
     *
     * @param integer $punters_club_no
     *
     * @return $this
     */
    public function setPuntersClubNo($punters_club_no)
    {
        $this->punters_club_no = $punters_club_no;

        return $this;
    }

    /**
     * Method to set the value of field analysis_man
     *
     * @param string $analysis_man
     *
     * @return $this
     */
    public function setAnalysisMan($analysis_man)
    {
        $this->analysis_man = $analysis_man;

        return $this;
    }

    /**
     * Method to set the value of field betting_man
     *
     * @param string $betting_man
     *
     * @return $this
     */
    public function setBettingMan($betting_man)
    {
        $this->betting_man = $betting_man;

        return $this;
    }

    /**
     * Method to set the value of field wind
     *
     * @param string $wind
     *
     * @return $this
     */
    public function setWind($wind)
    {
        $this->wind = $wind;

        return $this;
    }

    /**
     * Method to set the value of field weather_cond
     *
     * @param string $weather_cond
     *
     * @return $this
     */
    public function setWeatherCond($weather_cond)
    {
        $this->weather_cond = $weather_cond;

        return $this;
    }

    /**
     * Method to set the value of field meeting_name
     *
     * @param string $meeting_name
     *
     * @return $this
     */
    public function setMeetingName($meeting_name)
    {
        $this->meeting_name = $meeting_name;

        return $this;
    }

    /**
     * Method to set the value of field meeting_abandoned
     *
     * @param string $meeting_abandoned
     *
     * @return $this
     */
    public function setMeetingAbandoned($meeting_abandoned)
    {
        $this->meeting_abandoned = $meeting_abandoned;

        return $this;
    }

    /**
     * Method to set the value of field abandoned_reason
     *
     * @param string $abandoned_reason
     *
     * @return $this
     */
    public function setAbandonedReason($abandoned_reason)
    {
        $this->abandoned_reason = $abandoned_reason;

        return $this;
    }

    /**
     * Method to set the value of field rf_meeting_comment
     *
     * @param string $rf_meeting_comment
     *
     * @return $this
     */
    public function setRfMeetingComment($rf_meeting_comment)
    {
        $this->rf_meeting_comment = $rf_meeting_comment;

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
     * Method to set the value of field rf_meeting_infocus
     *
     * @param string $rf_meeting_infocus
     *
     * @return $this
     */
    public function setRfMeetingInfocus($rf_meeting_infocus)
    {
        $this->rf_meeting_infocus = $rf_meeting_infocus;

        return $this;
    }

    /**
     * Method to set the value of field rp_going_assessment
     *
     * @param string $rp_going_assessment
     *
     * @return $this
     */
    public function setRpGoingAssessment($rp_going_assessment)
    {
        $this->rp_going_assessment = $rp_going_assessment;

        return $this;
    }

    /**
     * Method to set the value of field rails
     *
     * @param string $rails
     *
     * @return $this
     */
    public function setRails($rails)
    {
        $this->rails = $rails;

        return $this;
    }

    /**
     * Method to set the value of field other_details
     *
     * @param string $other_details
     *
     * @return $this
     */
    public function setOtherDetails($other_details)
    {
        $this->other_details = $other_details;

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
     * Returns the value of field close_up_man
     *
     * @return string
     */
    public function getCloseUpMan()
    {
        return $this->close_up_man;
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
     * Returns the value of field stalls_position
     *
     * @return string
     */
    public function getStallsPosition()
    {
        return $this->stalls_position;
    }

    /**
     * Returns the value of field misc_text
     *
     * @return string
     */
    public function getMiscText()
    {
        return $this->misc_text;
    }

    /**
     * Returns the value of field jackpot_text
     *
     * @return string
     */
    public function getJackpotText()
    {
        return $this->jackpot_text;
    }

    /**
     * Returns the value of field placepot_text
     *
     * @return string
     */
    public function getPlacepotText()
    {
        return $this->placepot_text;
    }

    /**
     * Returns the value of field quadpot_text
     *
     * @return string
     */
    public function getQuadpotText()
    {
        return $this->quadpot_text;
    }

    /**
     * Returns the value of field irish_text
     *
     * @return string
     */
    public function getIrishText()
    {
        return $this->irish_text;
    }

    /**
     * Returns the value of field hunt_uid
     *
     * @return integer
     */
    public function getHuntUid()
    {
        return $this->hunt_uid;
    }

    /**
     * Returns the value of field principal_yn
     *
     * @return string
     */
    public function getPrincipalYn()
    {
        return $this->principal_yn;
    }

    /**
     * Returns the value of field punters_club_no
     *
     * @return integer
     */
    public function getPuntersClubNo()
    {
        return $this->punters_club_no;
    }

    /**
     * Returns the value of field analysis_man
     *
     * @return string
     */
    public function getAnalysisMan()
    {
        return $this->analysis_man;
    }

    /**
     * Returns the value of field betting_man
     *
     * @return string
     */
    public function getBettingMan()
    {
        return $this->betting_man;
    }

    /**
     * Returns the value of field wind
     *
     * @return string
     */
    public function getWind()
    {
        return $this->wind;
    }

    /**
     * Returns the value of field weather_cond
     *
     * @return string
     */
    public function getWeatherCond()
    {
        return $this->weather_cond;
    }

    /**
     * Returns the value of field meeting_name
     *
     * @return string
     */
    public function getMeetingName()
    {
        return $this->meeting_name;
    }

    /**
     * Returns the value of field meeting_abandoned
     *
     * @return string
     */
    public function getMeetingAbandoned()
    {
        return $this->meeting_abandoned;
    }

    /**
     * Returns the value of field abandoned_reason
     *
     * @return string
     */
    public function getAbandonedReason()
    {
        return $this->abandoned_reason;
    }

    /**
     * Returns the value of field rf_meeting_comment
     *
     * @return string
     */
    public function getRfMeetingComment()
    {
        return $this->rf_meeting_comment;
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
     * Returns the value of field rf_meeting_infocus
     *
     * @return string
     */
    public function getRfMeetingInfocus()
    {
        return $this->rf_meeting_infocus;
    }

    /**
     * Returns the value of field rp_going_assessment
     *
     * @return string
     */
    public function getRpGoingAssessment()
    {
        return $this->rp_going_assessment;
    }

    /**
     * Returns the value of field rails
     *
     * @return string
     */
    public function getRails()
    {
        return $this->rails;
    }

    /**
     * Returns the value of field other_details
     *
     * @return string
     */
    public function getOtherDetails()
    {
        return $this->other_details;
    }

    public function getSource()
    {
        return 'meeting_details';
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
                'close_up_man',
                'going_desc',
                'stalls_position',
                'misc_text',
                'jackpot_text',
                'placepot_text',
                'quadpot_text',
                'irish_text',
                'hunt_uid',
                'principal_yn',
                'punters_club_no',
                'analysis_man',
                'betting_man',
                'wind',
                'weather_cond',
                'meeting_name',
                'meeting_abandoned',
                'abandoned_reason',
                'rf_meeting_comment',
                'subscription_list',
                'rf_meeting_infocus',
                'rp_going_assessment',
                'rails',
                'other_details',
            ),
            //Every column part of the primary key
            MetaData::MODELS_PRIMARY_KEY => array(
                'course_uid',
                'meeting_date',
            ),
            //Every column that isn't part of the primary key
            MetaData::MODELS_NON_PRIMARY_KEY => array(
                'close_up_man',
                'going_desc',
                'stalls_position',
                'misc_text',
                'jackpot_text',
                'placepot_text',
                'quadpot_text',
                'irish_text',
                'hunt_uid',
                'principal_yn',
                'punters_club_no',
                'analysis_man',
                'betting_man',
                'wind',
                'weather_cond',
                'meeting_name',
                'meeting_abandoned',
                'abandoned_reason',
                'rf_meeting_comment',
                'subscription_list',
                'rf_meeting_infocus',
                'rp_going_assessment',
                'rails',
                'other_details',
            ),
            //Every column that doesn't allows null values
            MetaData::MODELS_NOT_NULL => array(
                'close_up_man',
                'going_desc',
                'stalls_position',
                'misc_text',
                'jackpot_text',
                'placepot_text',
                'quadpot_text',
                'irish_text',
                'hunt_uid',
                'punters_club_no',
                'analysis_man',
                'betting_man',
                'wind',
                'weather_cond',
                'meeting_name',
                'meeting_abandoned',
                'abandoned_reason',
                'rf_meeting_comment',
                'subscription_list',
                'rf_meeting_infocus',
                'rp_going_assessment',
                'rails',
                'other_details',
            ),
            //Every column and their data types
            MetaData::MODELS_DATA_TYPES => array(
                'course_uid' => Column::TYPE_INTEGER,
                'meeting_date' => Column::TYPE_DATETIME,
                'close_up_man' => Column::TYPE_VARCHAR,
                'going_desc' => Column::TYPE_VARCHAR,
                'stalls_position' => Column::TYPE_VARCHAR,
                'misc_text' => Column::TYPE_VARCHAR,
                'jackpot_text' => Column::TYPE_VARCHAR,
                'placepot_text' => Column::TYPE_VARCHAR,
                'quadpot_text' => Column::TYPE_VARCHAR,
                'irish_text' => Column::TYPE_VARCHAR,
                'hunt_uid' => Column::TYPE_INTEGER,
                'principal_yn' => Column::TYPE_CHAR,
                'punters_club_no' => Column::TYPE_INTEGER,
                'analysis_man' => Column::TYPE_VARCHAR,
                'betting_man' => Column::TYPE_VARCHAR,
                'wind' => Column::TYPE_VARCHAR,
                'weather_cond' => Column::TYPE_VARCHAR,
                'meeting_name' => Column::TYPE_VARCHAR,
                'meeting_abandoned' => Column::TYPE_CHAR,
                'abandoned_reason' => Column::TYPE_VARCHAR,
                'rf_meeting_comment' => Column::TYPE_VARCHAR,
                'subscription_list' => Column::TYPE_VARCHAR,
                'rf_meeting_infocus' => Column::TYPE_VARCHAR,
                'rp_going_assessment' => Column::TYPE_VARCHAR,
                'rails' => Column::TYPE_VARCHAR,
                'other_details' => Column::TYPE_VARCHAR,
            ),
            //The columns that have numeric data types
            MetaData::MODELS_DATA_TYPES_NUMERIC => array(
                'course_uid' => true,
                'meeting_date' => false,
                'close_up_man' => false,
                'going_desc' => false,
                'stalls_position' => false,
                'misc_text' => false,
                'jackpot_text' => false,
                'placepot_text' => false,
                'quadpot_text' => false,
                'irish_text' => false,
                'hunt_uid' => true,
                'principal_yn' => false,
                'punters_club_no' => true,
                'analysis_man' => false,
                'betting_man' => false,
                'wind' => false,
                'weather_cond' => false,
                'meeting_name' => false,
                'meeting_abandoned' => false,
                'abandoned_reason' => false,
                'rf_meeting_comment' => false,
                'subscription_list' => false,
                'rf_meeting_infocus' => false,
                'rp_going_assessment' => false,
                'rails' => false,
                'other_details' => false,
            ),
            //How every column must be bound/casted
            MetaData::MODELS_DATA_TYPES_BIND => array(
                'course_uid' => Column::BIND_PARAM_INT,
                'meeting_date' => Column::BIND_PARAM_STR,
                'close_up_man' => Column::BIND_PARAM_STR,
                'going_desc' => Column::BIND_PARAM_STR,
                'stalls_position' => Column::BIND_PARAM_STR,
                'misc_text' => Column::BIND_PARAM_STR,
                'jackpot_text' => Column::BIND_PARAM_STR,
                'placepot_text' => Column::BIND_PARAM_STR,
                'quadpot_text' => Column::BIND_PARAM_STR,
                'irish_text' => Column::BIND_PARAM_STR,
                'hunt_uid' => Column::BIND_PARAM_INT,
                'principal_yn' => Column::BIND_PARAM_STR,
                'punters_club_no' => Column::BIND_PARAM_INT,
                'analysis_man' => Column::BIND_PARAM_STR,
                'betting_man' => Column::BIND_PARAM_STR,
                'wind' => Column::BIND_PARAM_STR,
                'weather_cond' => Column::BIND_PARAM_STR,
                'meeting_name' => Column::BIND_PARAM_STR,
                'meeting_abandoned' => Column::BIND_PARAM_STR,
                'abandoned_reason' => Column::BIND_PARAM_STR,
                'rf_meeting_comment' => Column::BIND_PARAM_STR,
                'subscription_list' => Column::BIND_PARAM_STR,
                'rf_meeting_infocus' => Column::BIND_PARAM_STR,
                'rp_going_assessment' => Column::BIND_PARAM_STR,
                'rails' => Column::BIND_PARAM_STR,
                'other_details' => Column::BIND_PARAM_STR,
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
