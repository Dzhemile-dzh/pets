<?php

namespace Models;

class HorseHeadGear extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $horse_head_gear_uid;
     
    /**
     *
     * @var string
     */
    protected $horse_head_gear_code;
     
    /**
     *
     * @var string
     */
    protected $horse_head_gear_desc;
     
    /**
     *
     * @var string
     */
    protected $blinkers_yn;
     
    /**
     *
     * @var string
     */
    protected $visors_yn;
     
    /**
     *
     * @var string
     */
    protected $first_time_yn;
     
    /**
     *
     * @var string
     */
    protected $weatherbys_code;
     
    /**
     *
     * @var string
     */
    protected $rp_horse_head_gear_code;

    public function initialize()
    {
        $this->hasMany('horse_head_gear_uid', 'Models\PreHorseRace', 'horse_head_gear_uid');
    }
     
    /**
     * Method to set the value of field horse_head_gear_uid
     *
     * @param integer $horse_head_gear_uid
     * @return $this
     */
    public function setHorseHeadGearUid($horse_head_gear_uid)
    {
        $this->horse_head_gear_uid = $horse_head_gear_uid;

        return $this;
    }

    /**
     * Method to set the value of field horse_head_gear_code
     *
     * @param string $horse_head_gear_code
     * @return $this
     */
    public function setHorseHeadGearCode($horse_head_gear_code)
    {
        $this->horse_head_gear_code = $horse_head_gear_code;

        return $this;
    }

    /**
     * Method to set the value of field horse_head_gear_desc
     *
     * @param string $horse_head_gear_desc
     * @return $this
     */
    public function setHorseHeadGearDesc($horse_head_gear_desc)
    {
        $this->horse_head_gear_desc = $horse_head_gear_desc;

        return $this;
    }

    /**
     * Method to set the value of field blinkers_yn
     *
     * @param string $blinkers_yn
     * @return $this
     */
    public function setBlinkersYn($blinkers_yn)
    {
        $this->blinkers_yn = $blinkers_yn;

        return $this;
    }

    /**
     * Method to set the value of field visors_yn
     *
     * @param string $visors_yn
     * @return $this
     */
    public function setVisorsYn($visors_yn)
    {
        $this->visors_yn = $visors_yn;

        return $this;
    }

    /**
     * Method to set the value of field first_time_yn
     *
     * @param string $first_time_yn
     * @return $this
     */
    public function setFirstTimeYn($first_time_yn)
    {
        $this->first_time_yn = $first_time_yn;

        return $this;
    }

    /**
     * Method to set the value of field weatherbys_code
     *
     * @param string $weatherbys_code
     * @return $this
     */
    public function setWeatherbysCode($weatherbys_code)
    {
        $this->weatherbys_code = $weatherbys_code;

        return $this;
    }

    /**
     * Method to set the value of field rp_horse_head_gear_code
     *
     * @param string $rp_horse_head_gear_code
     * @return $this
     */
    public function setRpHorseHeadGearCode($rp_horse_head_gear_code)
    {
        $this->rp_horse_head_gear_code = $rp_horse_head_gear_code;

        return $this;
    }

    /**
     * Returns the value of field horse_head_gear_uid
     *
     * @return integer
     */
    public function getHorseHeadGearUid()
    {
        return $this->horse_head_gear_uid;
    }

    /**
     * Returns the value of field horse_head_gear_code
     *
     * @return string
     */
    public function getHorseHeadGearCode()
    {
        return $this->horse_head_gear_code;
    }

    /**
     * Returns the value of field horse_head_gear_desc
     *
     * @return string
     */
    public function getHorseHeadGearDesc()
    {
        return $this->horse_head_gear_desc;
    }

    /**
     * Returns the value of field blinkers_yn
     *
     * @return string
     */
    public function getBlinkersYn()
    {
        return $this->blinkers_yn;
    }

    /**
     * Returns the value of field visors_yn
     *
     * @return string
     */
    public function getVisorsYn()
    {
        return $this->visors_yn;
    }

    /**
     * Returns the value of field first_time_yn
     *
     * @return string
     */
    public function getFirstTimeYn()
    {
        return $this->first_time_yn;
    }

    /**
     * Returns the value of field weatherbys_code
     *
     * @return string
     */
    public function getWeatherbysCode()
    {
        return $this->weatherbys_code;
    }

    /**
     * Returns the value of field rp_horse_head_gear_code
     *
     * @return string
     */
    public function getRpHorseHeadGearCode()
    {
        return $this->rp_horse_head_gear_code;
    }
}
