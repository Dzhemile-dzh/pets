<?php

namespace Models;

class GoingType extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    protected $going_type_code;
     
    /**
     *
     * @var string
     */
    protected $going_type_desc;
     
    /**
     *
     * @var integer
     */
    protected $going_band_uid;
     
    /**
     *
     * @var string
     */
    protected $sporting_life_code;
     
    /**
     *
     * @var string
     */
    protected $services_desc;
     
    /**
     *
     * @var string
     */
    protected $rp_going_type_desc;
     
    /**
     *
     * @var integer
     */
    protected $rp_going_type_value;

    public function initialize()
    {
        $this->hasMany('going_type_code', 'Models\RaceInstance', 'going_type_code');
    }
     
    /**
     * Method to set the value of field going_type_code
     *
     * @param string $going_type_code
     * @return $this
     */
    public function setGoingTypeCode($going_type_code)
    {
        $this->going_type_code = $going_type_code;

        return $this;
    }

    /**
     * Method to set the value of field going_type_desc
     *
     * @param string $going_type_desc
     * @return $this
     */
    public function setGoingTypeDesc($going_type_desc)
    {
        $this->going_type_desc = $going_type_desc;

        return $this;
    }

    /**
     * Method to set the value of field going_band_uid
     *
     * @param integer $going_band_uid
     * @return $this
     */
    public function setGoingBandUid($going_band_uid)
    {
        $this->going_band_uid = $going_band_uid;

        return $this;
    }

    /**
     * Method to set the value of field sporting_life_code
     *
     * @param string $sporting_life_code
     * @return $this
     */
    public function setSportingLifeCode($sporting_life_code)
    {
        $this->sporting_life_code = $sporting_life_code;

        return $this;
    }

    /**
     * Method to set the value of field services_desc
     *
     * @param string $services_desc
     * @return $this
     */
    public function setServicesDesc($services_desc)
    {
        $this->services_desc = $services_desc;

        return $this;
    }

    /**
     * Method to set the value of field rp_going_type_desc
     *
     * @param string $rp_going_type_desc
     * @return $this
     */
    public function setRpGoingTypeDesc($rp_going_type_desc)
    {
        $this->rp_going_type_desc = $rp_going_type_desc;

        return $this;
    }

    /**
     * Method to set the value of field rp_going_type_value
     *
     * @param integer $rp_going_type_value
     * @return $this
     */
    public function setRpGoingTypeValue($rp_going_type_value)
    {
        $this->rp_going_type_value = $rp_going_type_value;

        return $this;
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
     * Returns the value of field going_type_desc
     *
     * @return string
     */
    public function getGoingTypeDesc()
    {
        return $this->going_type_desc;
    }

    /**
     * Returns the value of field going_band_uid
     *
     * @return integer
     */
    public function getGoingBandUid()
    {
        return $this->going_band_uid;
    }

    /**
     * Returns the value of field sporting_life_code
     *
     * @return string
     */
    public function getSportingLifeCode()
    {
        return $this->sporting_life_code;
    }

    /**
     * Returns the value of field services_desc
     *
     * @return string
     */
    public function getServicesDesc()
    {
        return $this->services_desc;
    }

    /**
     * Returns the value of field rp_going_type_desc
     *
     * @return string
     */
    public function getRpGoingTypeDesc()
    {
        return $this->rp_going_type_desc;
    }

    /**
     * Returns the value of field rp_going_type_value
     *
     * @return integer
     */
    public function getRpGoingTypeValue()
    {
        return $this->rp_going_type_value;
    }
}
