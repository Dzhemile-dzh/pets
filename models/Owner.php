<?php

namespace Models;

class Owner extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $owner_uid;
     
    /**
     *
     * @var string
     */
    protected $search_name;
     
    /**
     *
     * @var string
     */
    protected $owner_name;
     
    /**
     *
     * @var string
     */
    protected $ptp_type_code;
     
    /**
     *
     * @var string
     */
    protected $silk;
     
    /**
     *
     * @var integer
     */
    protected $source_uid;
     
    /**
     *
     * @var integer
     */
    protected $address_uid;
     
    /**
     *
     * @var string
     */
    protected $timestamp;
     
    /**
     *
     * @var string
     */
    protected $searchname;
     
    /**
     *
     * @var string
     */
    protected $darley;
     
    /**
     *
     * @var string
     */
    protected $style_name;
     
    /**
     *
     * @var string
     */
    protected $roa_flag;


    /**
     *  Defines relationships between models
     */
    public function initialize()
    {
        $this->hasMany('owner_uid', 'Models\HorseOwner', 'owner_uid');
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
     * Method to set the value of field search_name
     *
     * @param string $search_name
     * @return $this
     */
    public function setSearchName($search_name)
    {
        $this->search_name = $search_name;

        return $this;
    }

    /**
     * Method to set the value of field owner_name
     *
     * @param string $owner_name
     * @return $this
     */
    public function setOwnerName($owner_name)
    {
        $this->owner_name = $owner_name;

        return $this;
    }

    /**
     * Method to set the value of field ptp_type_code
     *
     * @param string $ptp_type_code
     * @return $this
     */
    public function setPtpTypeCode($ptp_type_code)
    {
        $this->ptp_type_code = $ptp_type_code;

        return $this;
    }

    /**
     * Method to set the value of field silk
     *
     * @param string $silk
     * @return $this
     */
    public function setSilk($silk)
    {
        $this->silk = $silk;

        return $this;
    }

    /**
     * Method to set the value of field source_uid
     *
     * @param integer $source_uid
     * @return $this
     */
    public function setSourceUid($source_uid)
    {
        $this->source_uid = $source_uid;

        return $this;
    }

    /**
     * Method to set the value of field address_uid
     *
     * @param integer $address_uid
     * @return $this
     */
    public function setAddressUid($address_uid)
    {
        $this->address_uid = $address_uid;

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
     * Method to set the value of field searchname
     *
     * @param string $searchname
     * @return $this
     */
    /*
    public function setSearchname($searchname)
    {
        $this->searchname = $searchname;

        return $this;
    }
    */

    /**
     * Method to set the value of field darley
     *
     * @param string $darley
     * @return $this
     */
    public function setDarley($darley)
    {
        $this->darley = $darley;

        return $this;
    }

    /**
     * Method to set the value of field style_name
     *
     * @param string $style_name
     * @return $this
     */
    public function setStyleName($style_name)
    {
        $this->style_name = $style_name;

        return $this;
    }

    /**
     * Method to set the value of field roa_flag
     *
     * @param string $roa_flag
     * @return $this
     */
    public function setRoaFlag($roa_flag)
    {
        $this->roa_flag = $roa_flag;

        return $this;
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
     * Returns the value of field search_name
     *
     * @return string
     */
    public function getSearchName()
    {
        return $this->search_name;
    }

    /**
     * Returns the value of field owner_name
     *
     * @return string
     */
    public function getOwnerName()
    {
        return $this->owner_name;
    }

    /**
     * Returns the value of field ptp_type_code
     *
     * @return string
     */
    public function getPtpTypeCode()
    {
        return $this->ptp_type_code;
    }

    /**
     * Returns the value of field silk
     *
     * @return string
     */
    public function getSilk()
    {
        return $this->silk;
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
     * Returns the value of field address_uid
     *
     * @return integer
     */
    public function getAddressUid()
    {
        return $this->address_uid;
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
     * Returns the value of field searchname
     *
     * @return string
     */
    /*
    public function getSearchname()
    {
        return $this->searchname;
    }
    */

    /**
     * Returns the value of field darley
     *
     * @return string
     */
    public function getDarley()
    {
        return $this->darley;
    }

    /**
     * Returns the value of field style_name
     *
     * @return string
     */
    public function getStyleName()
    {
        return $this->style_name;
    }

    /**
     * Returns the value of field roa_flag
     *
     * @return string
     */
    public function getRoaFlag()
    {
        return $this->roa_flag;
    }
}
