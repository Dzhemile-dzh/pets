<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 11/19/2015
 * Time: 4:52 PM
 */

namespace Api\Row\Methods;

trait IsPdfAvailable
{
    /**
     * @return bool
     */
    public function isPdfAvailable()
    {
        return (
            isset($this->country_code)
            && ($this->country_code == 'GB' || $this->country_code == 'IRE' || $this->country_code == 'UAE')
        ) ? true
        : false;
    }
}
