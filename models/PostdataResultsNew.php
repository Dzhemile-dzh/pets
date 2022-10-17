<?php

namespace Models;

use Phalcon\Mvc\Model;
use \Api\Constants\Horses as Constants;

/**
 * Class PostdataResultsNew
 *
 * @package Models
 */
class PostdataResultsNew extends Model
{

    /**
     *
     * @var integer
     */
    protected $race_instance_uid;

    /**
     *
     * @var integer
     */
    protected $horse_uid;

    /**
     *
     * @var integer
     */
    protected $trainer_uid;

    /**
     *
     * @var integer
     */
    protected $saddle_cloth_no;

    /**
     *
     * @var integer
     */
    protected $postmark;

    /**
     *
     * @var integer
     */
    protected $debut;

    /**
     *
     * @var string
     */
    protected $select_yn;

    /**
     *
     * @var double
     */
    protected $ability_points;

    /**
     *
     * @var double
     */
    protected $recent_form_points;

    /**
     *
     * @var double
     */
    protected $trainer_form_points;

    /**
     *
     * @var double
     */
    protected $trainer_record_points;

    /**
     *
     * @var double
     */
    protected $going_points;

    /**
     *
     * @var double
     */
    protected $distance_points;

    /**
     *
     * @var double
     */
    protected $course_points;

    /**
     *
     * @var double
     */
    protected $draw_points;

    /**
     *
     * @var string
     */
    protected $group_race;

    /**
     *
     * @var double
     */
    protected $extra_points;

    /**
     *
     * @var integer
     */
    protected $jockey_wins;

    /**
     *
     * @var integer
     */
    protected $jockey_stable_wins;

    /**
     *
     * @var string
     */
    protected $jockey_no_wins_flag;

    /**
     *
     * @var string
     */
    protected $first_time_blinkers;

    /**
     *
     * @var string
     */
    protected $ability_output;

    /**
     *
     * @var string
     */
    protected $recent_form_output;

    /**
     *
     * @var string
     */
    protected $trainer_form_output;

    /**
     *
     * @var string
     */
    protected $trainer_record_output;

    /**
     *
     * @var string
     */
    protected $going_output;

    /**
     *
     * @var string
     */
    protected $distance_output;

    /**
     *
     * @var string
     */
    protected $course_output;

    /**
     *
     * @var string
     */
    protected $draw_output;

    /**
     *
     * @var integer
     */
    protected $topspeed_race_instance_uid;

    /**
     *
     * @var string
     */
    protected $topspeed_course;

    /**
     *
     * @var string
     */
    protected $topspeed_date;

    /**
     *
     * @var string
     */
    protected $topspeed_dist_going;

    /**
     *
     * @var string
     */
    protected $top_master_bold;

    /**
     *
     * @var integer
     */
    protected $topspeed_master_rating;

    /**
     *
     * @var integer
     */
    protected $bare_topspeed_master_rating;

    /**
     *
     * @var string
     */
    protected $top_last_bold;

    /**
     *
     * @var integer
     */
    protected $num_topspeed_last_rating;

    /**
     *
     * @var string
     */
    protected $topspeed_last_rating;

    /**
     *
     * @var integer
     */
    protected $num_topspeed_best_rating;

    /**
     *
     * @var string
     */
    protected $topspeed_last_best;


    public function initialize()
    {
        $this->belongsTo('horse_uid', 'Models\Horse', 'horse_uid');
        $this->belongsTo(
            'race_instance_uid',
            'Models\RaceInstance',
            'race_instance_uid'
        );

        $this->hasManyToMany(
            'race_instance_uid',
            'Models\RaceInstance',
            'race_instance_uid',
            'race_instance_uid',
            'Models\PreHorseRace',
            'race_instance_uid'
        );
        $this->hasManyToMany(
            'race_instance_uid',
            'Models\RaceInstance',
            'race_instance_uid',
            'course_uid',
            'Models\Course',
            'course_uid'
        );
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
     * Method to set the value of field horse_uid
     *
     * @param integer $horse_uid
     *
     * @return $this
     */
    public function setHorseUid($horse_uid)
    {
        $this->horse_uid = $horse_uid;

        return $this;
    }

    /**
     * Method to set the value of field trainer_uid
     *
     * @param integer $trainer_uid
     *
     * @return $this
     */
    public function setTrainerUid($trainer_uid)
    {
        $this->trainer_uid = $trainer_uid;

        return $this;
    }

    /**
     * Method to set the value of field saddle_cloth_no
     *
     * @param integer $saddle_cloth_no
     *
     * @return $this
     */
    public function setSaddleClothNo($saddle_cloth_no)
    {
        $this->saddle_cloth_no = $saddle_cloth_no;

        return $this;
    }

    /**
     * Method to set the value of field postmark
     *
     * @param integer $postmark
     *
     * @return $this
     */
    public function setPostmark($postmark)
    {
        $this->postmark = $postmark;

        return $this;
    }

    /**
     * Method to set the value of field debut
     *
     * @param integer $debut
     *
     * @return $this
     */
    public function setDebut($debut)
    {
        $this->debut = $debut;

        return $this;
    }

    /**
     * Method to set the value of field select_yn
     *
     * @param string $select_yn
     *
     * @return $this
     */
    public function setSelectYn($select_yn)
    {
        $this->select_yn = $select_yn;

        return $this;
    }

    /**
     * Method to set the value of field ability_points
     *
     * @param double $ability_points
     *
     * @return $this
     */
    public function setAbilityPoints($ability_points)
    {
        $this->ability_points = $ability_points;

        return $this;
    }

    /**
     * Method to set the value of field recent_form_points
     *
     * @param double $recent_form_points
     *
     * @return $this
     */
    public function setRecentFormPoints($recent_form_points)
    {
        $this->recent_form_points = $recent_form_points;

        return $this;
    }

    /**
     * Method to set the value of field trainer_form_points
     *
     * @param double $trainer_form_points
     *
     * @return $this
     */
    public function setTrainerFormPoints($trainer_form_points)
    {
        $this->trainer_form_points = $trainer_form_points;

        return $this;
    }

    /**
     * Method to set the value of field trainer_record_points
     *
     * @param double $trainer_record_points
     *
     * @return $this
     */
    public function setTrainerRecordPoints($trainer_record_points)
    {
        $this->trainer_record_points = $trainer_record_points;

        return $this;
    }

    /**
     * Method to set the value of field going_points
     *
     * @param double $going_points
     *
     * @return $this
     */
    public function setGoingPoints($going_points)
    {
        $this->going_points = $going_points;

        return $this;
    }

    /**
     * Method to set the value of field distance_points
     *
     * @param double $distance_points
     *
     * @return $this
     */
    public function setDistancePoints($distance_points)
    {
        $this->distance_points = $distance_points;

        return $this;
    }

    /**
     * Method to set the value of field course_points
     *
     * @param double $course_points
     *
     * @return $this
     */
    public function setCoursePoints($course_points)
    {
        $this->course_points = $course_points;

        return $this;
    }

    /**
     * Method to set the value of field draw_points
     *
     * @param double $draw_points
     *
     * @return $this
     */
    public function setDrawPoints($draw_points)
    {
        $this->draw_points = $draw_points;

        return $this;
    }

    /**
     * Method to set the value of field group_race
     *
     * @param string $group_race
     *
     * @return $this
     */
    public function setGroupRace($group_race)
    {
        $this->group_race = $group_race;

        return $this;
    }

    /**
     * Method to set the value of field extra_points
     *
     * @param double $extra_points
     *
     * @return $this
     */
    public function setExtraPoints($extra_points)
    {
        $this->extra_points = $extra_points;

        return $this;
    }

    /**
     * Method to set the value of field jockey_wins
     *
     * @param integer $jockey_wins
     *
     * @return $this
     */
    public function setJockeyWins($jockey_wins)
    {
        $this->jockey_wins = $jockey_wins;

        return $this;
    }

    /**
     * Method to set the value of field jockey_stable_wins
     *
     * @param integer $jockey_stable_wins
     *
     * @return $this
     */
    public function setJockeyStableWins($jockey_stable_wins)
    {
        $this->jockey_stable_wins = $jockey_stable_wins;

        return $this;
    }

    /**
     * Method to set the value of field jockey_no_wins_flag
     *
     * @param string $jockey_no_wins_flag
     *
     * @return $this
     */
    public function setJockeyNoWinsFlag($jockey_no_wins_flag)
    {
        $this->jockey_no_wins_flag = $jockey_no_wins_flag;

        return $this;
    }

    /**
     * Method to set the value of field first_time_blinkers
     *
     * @param string $first_time_blinkers
     *
     * @return $this
     */
    public function setFirstTimeBlinkers($first_time_blinkers)
    {
        $this->first_time_blinkers = $first_time_blinkers;

        return $this;
    }

    /**
     * Method to set the value of field ability_output
     *
     * @param string $ability_output
     *
     * @return $this
     */
    public function setAbilityOutput($ability_output)
    {
        $this->ability_output = $ability_output;

        return $this;
    }

    /**
     * Method to set the value of field recent_form_output
     *
     * @param string $recent_form_output
     *
     * @return $this
     */
    public function setRecentFormOutput($recent_form_output)
    {
        $this->recent_form_output = $recent_form_output;

        return $this;
    }

    /**
     * Method to set the value of field trainer_form_output
     *
     * @param string $trainer_form_output
     *
     * @return $this
     */
    public function setTrainerFormOutput($trainer_form_output)
    {
        $this->trainer_form_output = $trainer_form_output;

        return $this;
    }

    /**
     * Method to set the value of field trainer_record_output
     *
     * @param string $trainer_record_output
     *
     * @return $this
     */
    public function setTrainerRecordOutput($trainer_record_output)
    {
        $this->trainer_record_output = $trainer_record_output;

        return $this;
    }

    /**
     * Method to set the value of field going_output
     *
     * @param string $going_output
     *
     * @return $this
     */
    public function setGoingOutput($going_output)
    {
        $this->going_output = $going_output;

        return $this;
    }

    /**
     * Method to set the value of field distance_output
     *
     * @param string $distance_output
     *
     * @return $this
     */
    public function setDistanceOutput($distance_output)
    {
        $this->distance_output = $distance_output;

        return $this;
    }

    /**
     * Method to set the value of field course_output
     *
     * @param string $course_output
     *
     * @return $this
     */
    public function setCourseOutput($course_output)
    {
        $this->course_output = $course_output;

        return $this;
    }

    /**
     * Method to set the value of field draw_output
     *
     * @param string $draw_output
     *
     * @return $this
     */
    public function setDrawOutput($draw_output)
    {
        $this->draw_output = $draw_output;

        return $this;
    }

    /**
     * Method to set the value of field topspeed_race_instance_uid
     *
     * @param integer $topspeed_race_instance_uid
     *
     * @return $this
     */
    public function setTopspeedRaceInstanceUid($topspeed_race_instance_uid)
    {
        $this->topspeed_race_instance_uid = $topspeed_race_instance_uid;

        return $this;
    }

    /**
     * Method to set the value of field topspeed_course
     *
     * @param string $topspeed_course
     *
     * @return $this
     */
    public function setTopspeedCourse($topspeed_course)
    {
        $this->topspeed_course = $topspeed_course;

        return $this;
    }

    /**
     * Method to set the value of field topspeed_date
     *
     * @param string $topspeed_date
     *
     * @return $this
     */
    public function setTopspeedDate($topspeed_date)
    {
        $this->topspeed_date = $topspeed_date;

        return $this;
    }

    /**
     * Method to set the value of field topspeed_dist_going
     *
     * @param string $topspeed_dist_going
     *
     * @return $this
     */
    public function setTopspeedDistGoing($topspeed_dist_going)
    {
        $this->topspeed_dist_going = $topspeed_dist_going;

        return $this;
    }

    /**
     * Method to set the value of field top_master_bold
     *
     * @param string $top_master_bold
     *
     * @return $this
     */
    public function setTopMasterBold($top_master_bold)
    {
        $this->top_master_bold = $top_master_bold;

        return $this;
    }

    /**
     * Method to set the value of field topspeed_master_rating
     *
     * @param integer $topspeed_master_rating
     *
     * @return $this
     */
    public function setTopspeedMasterRating($topspeed_master_rating)
    {
        $this->topspeed_master_rating = $topspeed_master_rating;

        return $this;
    }

    /**
     * Method to set the value of field bare_topspeed_master_rating
     *
     * @param integer $bare_topspeed_master_rating
     *
     * @return $this
     */
    public function setBareTopspeedMasterRating($bare_topspeed_master_rating)
    {
        $this->bare_topspeed_master_rating = $bare_topspeed_master_rating;

        return $this;
    }

    /**
     * Method to set the value of field top_last_bold
     *
     * @param string $top_last_bold
     *
     * @return $this
     */
    public function setTopLastBold($top_last_bold)
    {
        $this->top_last_bold = $top_last_bold;

        return $this;
    }

    /**
     * Method to set the value of field num_topspeed_last_rating
     *
     * @param integer $num_topspeed_last_rating
     *
     * @return $this
     */
    public function setNumTopspeedLastRating($num_topspeed_last_rating)
    {
        $this->num_topspeed_last_rating = $num_topspeed_last_rating;

        return $this;
    }

    /**
     * Method to set the value of field topspeed_last_rating
     *
     * @param string $topspeed_last_rating
     *
     * @return $this
     */
    public function setTopspeedLastRating($topspeed_last_rating)
    {
        $this->topspeed_last_rating = $topspeed_last_rating;

        return $this;
    }

    /**
     * Method to set the value of field num_topspeed_best_rating
     *
     * @param integer $num_topspeed_best_rating
     *
     * @return $this
     */
    public function setNumTopspeedBestRating($num_topspeed_best_rating)
    {
        $this->num_topspeed_best_rating = $num_topspeed_best_rating;

        return $this;
    }

    /**
     * Method to set the value of field topspeed_last_best
     *
     * @param string $topspeed_last_best
     *
     * @return $this
     */
    public function setTopspeedLastBest($topspeed_last_best)
    {
        $this->topspeed_last_best = $topspeed_last_best;

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
     * Returns the value of field horse_uid
     *
     * @return integer
     */
    public function getHorseUid()
    {
        return $this->horse_uid;
    }

    /**
     * Returns the value of field trainer_uid
     *
     * @return integer
     */
    public function getTrainerUid()
    {
        return $this->trainer_uid;
    }

    /**
     * Returns the value of field saddle_cloth_no
     *
     * @return integer
     */
    public function getSaddleClothNo()
    {
        return $this->saddle_cloth_no;
    }

    /**
     * Returns the value of field postmark
     *
     * @return integer
     */
    public function getPostmark()
    {
        return $this->postmark;
    }

    /**
     * Returns the value of field debut
     *
     * @return integer
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * Returns the value of field select_yn
     *
     * @return string
     */
    public function getSelectYn()
    {
        return $this->select_yn;
    }

    /**
     * Returns the value of field ability_points
     *
     * @return double
     */
    public function getAbilityPoints()
    {
        return $this->ability_points;
    }

    /**
     * Returns the value of field recent_form_points
     *
     * @return double
     */
    public function getRecentFormPoints()
    {
        return $this->recent_form_points;
    }

    /**
     * Returns the value of field trainer_form_points
     *
     * @return double
     */
    public function getTrainerFormPoints()
    {
        return $this->trainer_form_points;
    }

    /**
     * Returns the value of field trainer_record_points
     *
     * @return double
     */
    public function getTrainerRecordPoints()
    {
        return $this->trainer_record_points;
    }

    /**
     * Returns the value of field going_points
     *
     * @return double
     */
    public function getGoingPoints()
    {
        return $this->going_points;
    }

    /**
     * Returns the value of field distance_points
     *
     * @return double
     */
    public function getDistancePoints()
    {
        return $this->distance_points;
    }

    /**
     * Returns the value of field course_points
     *
     * @return double
     */
    public function getCoursePoints()
    {
        return $this->course_points;
    }

    /**
     * Returns the value of field draw_points
     *
     * @return double
     */
    public function getDrawPoints()
    {
        return $this->draw_points;
    }

    /**
     * Returns the value of field group_race
     *
     * @return string
     */
    public function getGroupRace()
    {
        return $this->group_race;
    }

    /**
     * Returns the value of field extra_points
     *
     * @return double
     */
    public function getExtraPoints()
    {
        return $this->extra_points;
    }

    /**
     * Returns the value of field jockey_wins
     *
     * @return integer
     */
    public function getJockeyWins()
    {
        return $this->jockey_wins;
    }

    /**
     * Returns the value of field jockey_stable_wins
     *
     * @return integer
     */
    public function getJockeyStableWins()
    {
        return $this->jockey_stable_wins;
    }

    /**
     * Returns the value of field jockey_no_wins_flag
     *
     * @return string
     */
    public function getJockeyNoWinsFlag()
    {
        return $this->jockey_no_wins_flag;
    }

    /**
     * Returns the value of field first_time_blinkers
     *
     * @return string
     */
    public function getFirstTimeBlinkers()
    {
        return $this->first_time_blinkers;
    }

    /**
     * Returns the value of field ability_output
     *
     * @return string
     */
    public function getAbilityOutput()
    {
        return $this->ability_output;
    }

    /**
     * Returns the value of field recent_form_output
     *
     * @return string
     */
    public function getRecentFormOutput()
    {
        return $this->recent_form_output;
    }

    /**
     * Returns the value of field trainer_form_output
     *
     * @return string
     */
    public function getTrainerFormOutput()
    {
        return $this->trainer_form_output;
    }

    /**
     * Returns the value of field trainer_record_output
     *
     * @return string
     */
    public function getTrainerRecordOutput()
    {
        return $this->trainer_record_output;
    }

    /**
     * Returns the value of field going_output
     *
     * @return string
     */
    public function getGoingOutput()
    {
        return $this->going_output;
    }

    /**
     * Returns the value of field distance_output
     *
     * @return string
     */
    public function getDistanceOutput()
    {
        return $this->distance_output;
    }

    /**
     * Returns the value of field course_output
     *
     * @return string
     */
    public function getCourseOutput()
    {
        return $this->course_output;
    }

    /**
     * Returns the value of field draw_output
     *
     * @return string
     */
    public function getDrawOutput()
    {
        return $this->draw_output;
    }

    /**
     * Returns the value of field topspeed_race_instance_uid
     *
     * @return integer
     */
    public function getTopspeedRaceInstanceUid()
    {
        return $this->topspeed_race_instance_uid;
    }

    /**
     * Returns the value of field topspeed_course
     *
     * @return string
     */
    public function getTopspeedCourse()
    {
        return $this->topspeed_course;
    }

    /**
     * Returns the value of field topspeed_date
     *
     * @return string
     */
    public function getTopspeedDate()
    {
        return $this->topspeed_date;
    }

    /**
     * Returns the value of field topspeed_dist_going
     *
     * @return string
     */
    public function getTopspeedDistGoing()
    {
        return $this->topspeed_dist_going;
    }

    /**
     * Returns the value of field top_master_bold
     *
     * @return string
     */
    public function getTopMasterBold()
    {
        return $this->top_master_bold;
    }

    /**
     * Returns the value of field topspeed_master_rating
     *
     * @return integer
     */
    public function getTopspeedMasterRating()
    {
        return $this->topspeed_master_rating;
    }

    /**
     * Returns the value of field bare_topspeed_master_rating
     *
     * @return integer
     */
    public function getBareTopspeedMasterRating()
    {
        return $this->bare_topspeed_master_rating;
    }

    /**
     * Returns the value of field top_last_bold
     *
     * @return string
     */
    public function getTopLastBold()
    {
        return $this->top_last_bold;
    }

    /**
     * Returns the value of field num_topspeed_last_rating
     *
     * @return integer
     */
    public function getNumTopspeedLastRating()
    {
        return $this->num_topspeed_last_rating;
    }

    /**
     * Returns the value of field topspeed_last_rating
     *
     * @return string
     */
    public function getTopspeedLastRating()
    {
        return $this->topspeed_last_rating;
    }

    /**
     * Returns the value of field num_topspeed_best_rating
     *
     * @return integer
     */
    public function getNumTopspeedBestRating()
    {
        return $this->num_topspeed_best_rating;
    }

    /**
     * Returns the value of field topspeed_last_best
     *
     * @return string
     */
    public function getTopspeedLastBest()
    {
        return $this->topspeed_last_best;
    }
}
