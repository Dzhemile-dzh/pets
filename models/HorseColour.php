<?php

namespace Models;

class HorseColour extends \Phalcon\Mvc\Model
{
    /**
     *
     * @var string
     */
    protected $horse_colour_code;
     
    /**
     *
     * @var string
     */
    protected $horse_colour_desc;
     
    /**
     *
     * @var string
     */
    protected $weatherbys_code;

    /**
     *
     * @var string
     */
    protected $newspaper_output_desc;

    /**
     *
     * @var string
     */
    protected $rp_newspaper_output_desc;

    public function initialize()
    {
        $this->hasMany('horse_colour_code', 'Models\Horse', 'horse_colour_code');
    }

    /**
     * Returns the value of field horse_colour_code
     *
     * @return string
     */
    public function getHorseColourCode()
    {
        return $this->horse_colour_code;
    }

    /**
     * Method to set the value of field horse_colour_code
     *
     * @param string $horse_colour_code
     */
    public function setHorseColourCode($horse_colour_code)
    {
        $this->horse_colour_code = $horse_colour_code;
    }

    /**
     * Returns the value of field horse_colour_desc
     *
     * @return string
     */
    public function getHorseColourDesc()
    {
        return $this->horse_colour_desc;
    }

    /**
     * Method to set the value of field horse_colour_desc
     *
     * @param string $horse_colour_desc
     */
    public function setHorseColourDesc($horse_colour_desc)
    {
        $this->horse_colour_desc = $horse_colour_desc;
    }

    /**
     * Returns the value of field newspaper_output_desc
     *
     * @return string
     */
    public function getNewspaperOutputDesc()
    {
        return $this->newspaper_output_desc;
    }

    /**
     * Method to set the value of field newspaper_output_desc
     *
     * @param string $newspaper_output_desc
     */
    public function setNewspaperOutputDesc($newspaper_output_desc)
    {
        $this->newspaper_output_desc = $newspaper_output_desc;
    }

    /**
     * Returns the value of field rp_newspaper_output_desc
     *
     * @return string
     */
    public function getRpNewspaperOutputDesc()
    {
        return $this->rp_newspaper_output_desc;
    }

    /**
     * Method to set the value of field rp_newspaper_output_desc
     *
     * @param string $rp_newspaper_output_desc
     */
    public function setRpNewspaperOutputDesc($rp_newspaper_output_desc)
    {
        $this->rp_newspaper_output_desc = $rp_newspaper_output_desc;
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
     * Method to set the value of field weatherbys_code
     *
     * @param string $weatherbys_code
     */
    public function setWeatherbysCode($weatherbys_code)
    {
        $this->weatherbys_code = $weatherbys_code;
    }
}
