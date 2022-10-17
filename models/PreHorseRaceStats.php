<?php

namespace Models;

class PreHorseRaceStats extends \Phalcon\Mvc\Model
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
     * @var string
     */
    protected $form_figures;

    /**
     *
     * @var string
     */
    protected $days_since_run;

    /**
     *
     * @var string
     */
    protected $course_distance;

    /**
     *
     * @var integer
     */
    protected $trainer_id;

    /**
     *
     * @var string
     */
    protected $trainer_stylename;

    /**
     *
     * @var integer
     */
    protected $owner_id;

    /**
     *
     * @var string
     */
    protected $owner_stylename;

    /**
     *
     * @var string
     */
    protected $long_handicap;

    /**
     *
     * @var integer
     */
    protected $sire_uid;

    /**
     *
     * @var integer
     */
    protected $dam_uid;


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
     * Method to set the value of field form_figures
     *
     * @param string $form_figures
     *
     * @return $this
     */
    public function setFormFigures($form_figures)
    {
        $this->form_figures = $form_figures;

        return $this;
    }

    /**
     * Method to set the value of field days_since_run
     *
     * @param string $days_since_run
     *
     * @return $this
     */
    public function setDaysSinceRun($days_since_run)
    {
        $this->days_since_run = $days_since_run;

        return $this;
    }

    /**
     * Method to set the value of field course_distance
     *
     * @param string $course_distance
     *
     * @return $this
     */
    public function setCourseDistance($course_distance)
    {
        $this->course_distance = $course_distance;

        return $this;
    }

    /**
     * Method to set the value of field trainer_id
     *
     * @param integer $trainer_id
     *
     * @return $this
     */
    public function setTrainerId($trainer_id)
    {
        $this->trainer_id = $trainer_id;

        return $this;
    }

    /**
     * Method to set the value of field trainer_stylename
     *
     * @param string $trainer_stylename
     *
     * @return $this
     */
    public function setTrainerStylename($trainer_stylename)
    {
        $this->trainer_stylename = $trainer_stylename;

        return $this;
    }

    /**
     * Method to set the value of field owner_id
     *
     * @param integer $owner_id
     *
     * @return $this
     */
    public function setOwnerId($owner_id)
    {
        $this->owner_id = $owner_id;

        return $this;
    }

    /**
     * Method to set the value of field owner_stylename
     *
     * @param string $owner_stylename
     *
     * @return $this
     */
    public function setOwnerStylename($owner_stylename)
    {
        $this->owner_stylename = $owner_stylename;

        return $this;
    }

    /**
     * Method to set the value of field long_handicap
     *
     * @param string $long_handicap
     *
     * @return $this
     */
    public function setLongHandicap($long_handicap)
    {
        $this->long_handicap = $long_handicap;

        return $this;
    }

    /**
     * Method to set the value of field sire_uid
     *
     * @param integer $sire_uid
     *
     * @return $this
     */
    public function setSireUid($sire_uid)
    {
        $this->sire_uid = $sire_uid;

        return $this;
    }

    /**
     * Method to set the value of field dam_uid
     *
     * @param integer $dam_uid
     *
     * @return $this
     */
    public function setDamUid($dam_uid)
    {
        $this->dam_uid = $dam_uid;

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
     * Returns the value of field form_figures
     *
     * @return string
     */
    public function getFormFigures()
    {
        return $this->form_figures;
    }

    /**
     * Returns the value of field days_since_run
     *
     * @return string
     */
    public function getDaysSinceRun()
    {
        return $this->days_since_run;
    }

    /**
     * Returns the value of field course_distance
     *
     * @return string
     */
    public function getCourseDistance()
    {
        return $this->course_distance;
    }

    /**
     * Returns the value of field trainer_id
     *
     * @return integer
     */
    public function getTrainerId()
    {
        return $this->trainer_id;
    }

    /**
     * Returns the value of field trainer_stylename
     *
     * @return string
     */
    public function getTrainerStylename()
    {
        return $this->trainer_stylename;
    }

    /**
     * Returns the value of field owner_id
     *
     * @return integer
     */
    public function getOwnerId()
    {
        return $this->owner_id;
    }

    /**
     * Returns the value of field owner_stylename
     *
     * @return string
     */
    public function getOwnerStylename()
    {
        return $this->owner_stylename;
    }

    /**
     * Returns the value of field long_handicap
     *
     * @return string
     */
    public function getLongHandicap()
    {
        return $this->long_handicap;
    }

    /**
     * Returns the value of field sire_uid
     *
     * @return integer
     */
    public function getSireUid()
    {
        return $this->sire_uid;
    }

    /**
     * Returns the value of field dam_uid
     *
     * @return integer
     */
    public function getDamUid()
    {
        return $this->dam_uid;
    }
}
