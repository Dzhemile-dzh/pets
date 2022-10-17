<?php

namespace Models;

class AgesAllowed extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $ages_allowed_uid;

    /**
     *
     * @var string
     */
    protected $ages_allowed_desc;

    /**
     *
     * @var string
     */
    protected $sporting_life_code;

    /**
     *
     * @var string
     */
    protected $rp_ages_allowed_desc;


    public function initialize()
    {
        $this->hasMany(
            'ages_allowed_uid',
            'Models\RaceInstance',
            'ages_allowed_uid'
        );
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
     * Method to set the value of field ages_allowed_desc
     *
     * @param string $ages_allowed_desc
     *
     * @return $this
     */
    public function setAgesAllowedDesc($ages_allowed_desc)
    {
        $this->ages_allowed_desc = $ages_allowed_desc;

        return $this;
    }

    /**
     * Method to set the value of field sporting_life_code
     *
     * @param string $sporting_life_code
     *
     * @return $this
     */
    public function setSportingLifeCode($sporting_life_code)
    {
        $this->sporting_life_code = $sporting_life_code;

        return $this;
    }

    /**
     * Method to set the value of field rp_ages_allowed_desc
     *
     * @param string $rp_ages_allowed_desc
     *
     * @return $this
     */
    public function setRpAgesAllowedDesc($rp_ages_allowed_desc)
    {
        $this->rp_ages_allowed_desc = $rp_ages_allowed_desc;

        return $this;
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
     * Returns the value of field ages_allowed_desc
     *
     * @return string
     */
    public function getAgesAllowedDesc()
    {
        return $this->ages_allowed_desc;
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
     * Returns the value of field rp_ages_allowed_desc
     *
     * @return string
     */
    public function getRpAgesAllowedDesc()
    {
        return $this->rp_ages_allowed_desc;
    }
}
