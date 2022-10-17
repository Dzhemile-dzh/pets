<?php

namespace Api\Row\Methods;

/**
 * Trait GetTimeOfDayLetter
 *
 * @package Api\Row\Methods
 */
trait GetTimeOfDayLetter
{
    /**
     *  offical = 90 degrees 50' (gk: this is the "official" number to determine sunrise & sunset)
     */
    private $zenithOfficial = 90.83333333;

    private $dayCode = 'D';
    private $nightCode = 'N';

    /**
     * @return string
     * @throws \Api\Exception\InternalServerError
     */
    public function getTimeOfDayLetter()
    {
        if (!is_numeric($this->race_timestamp)) {
            throw new \Api\Exception\InternalServerError(1112, $this->race_timestamp);
        }

        if (!is_numeric($this->latitude) || !is_numeric($this->longitude)) {
            throw new \Api\Exception\InternalServerError(1111);
        }

        $sunrise = date_sunrise($this->race_timestamp, SUNFUNCS_RET_TIMESTAMP, $this->latitude, $this->longitude, $this->zenithOfficial, 0);
        $sunset = date_sunset($this->race_timestamp, SUNFUNCS_RET_TIMESTAMP, $this->latitude, $this->longitude, $this->zenithOfficial, 0);

        if ($sunrise < $sunset) {
            if (($this->race_timestamp >= $sunrise) && ($this->race_timestamp < $sunset)) {
                return $this->dayCode;
            } else {
                return $this->nightCode;
            }
        } else {
            if (($this->race_timestamp >= $sunrise) || ($this->race_timestamp < $sunset)) {
                return $this->dayCode;
            } else {
                return $this->nightCode;
            }
        }
    }
}
