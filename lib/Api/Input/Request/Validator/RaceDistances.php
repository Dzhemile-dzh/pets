<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 1/21/2016
 * Time: 12:22 PM
 */

namespace Api\Input\Request\Validator;

use Api\Exception\ValidationError;
use Phalcon\Input\Request\Validator;

class RaceDistances extends Validator
{
    const ERROR_WRONG_DISTANCE_PARAMETER_RANGE = 19;

    private $distance;
    private $raceType;
    private $errorCode;

    /**
     * RaceDistances constructor.
     *
     * @param \Models\Selectors $selectors
     * @param                           $raceType
     * @param integer $errorCode
     */
    public function __construct(\Models\Selectors $selectors, $raceType, $errorCode = null)
    {
        $this->distance = $selectors->getDistance();
        $this->raceType = $raceType;
        $this->errorCode = $errorCode ?: self::ERROR_WRONG_DISTANCE_PARAMETER_RANGE;
    }

    /**
     * @throws ValidationError
     */
    public function validate()
    {
        try {
            $this->distance->setRaceType($this->raceType);
            $this->distance->getDistanceGroup($this->request->getDistance());
        } catch (\Exception $e) {
            throw new ValidationError($this->errorCode);
        }
    }
}
