<?php

namespace Models;

class HorseOwner extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $horse_uid;
     
    /**
     *
     * @var integer
     */
    protected $owner_uid;
     
    /**
     *
     * @var string
     */
    protected $owner_change_date;
     
    /**
     *
     * @var string
     */
    protected $timestamp;

    /**
     *  Defines relationships between models
     */
    public function initialize()
    {
        $this->belongsTo('horse_uid', 'Models\Horse', 'horse_uid');
        $this->belongsTo('owner_uid', 'Models\Owner', 'owner_uid');

        $this->hasManyToMany(
            'horse_uid', //this table field
            'Models\Horse', //related n-1 table
            'horse_uid', //related field in that table
            'horse_uid', // field in that table, related to the 3-rd table as 1-m
            'Models\PreHorseRace', //3-rd related table
            'horse_uid' //field in that table
        );
    }
     
    /**
     * Method to set the value of field horse_uid
     *
     * @param integer $horse_uid
     * @return $this
     */
    public function setHorseUid($horse_uid)
    {
        $this->horse_uid = $horse_uid;

        return $this;
    }

    /**
     * Method to set the value of field owner_uid
     *
     * @param integer $owner_uid
     * @return $this
     */
    public function setOwnerUid($owner_uid)
    {
        $this->owner_uid = $owner_uid;

        return $this;
    }

    /**
     * Method to set the value of field owner_change_date
     *
     * @param string $owner_change_date
     * @return $this
     */
    public function setOwnerChangeDate($owner_change_date)
    {
        $this->owner_change_date = $owner_change_date;

        return $this;
    }

    /**
     * Method to set the value of field timestamp
     *
     * @param string $timestamp
     * @return $this
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
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
     * Returns the value of field owner_uid
     *
     * @return integer
     */
    public function getOwnerUid()
    {
        return $this->owner_uid;
    }

    /**
     * Returns the value of field owner_change_date
     *
     * @return string
     */
    public function getOwnerChangeDate()
    {
        return $this->owner_change_date;
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
}
