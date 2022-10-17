<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 12/29/2016
 * Time: 11:00 AM
 */

namespace Api\Input\Request\Parameter\Calculate;

use Phalcon\Input\Request\Parameter\Calculate\ByDefault;
use Api\Exception\NotFound as NotFoundException;
use Bo\Profile;

/**
 * Class RaceType calculates default race type for Trainer & Owner & Jockey
 *
 * @package Api\Input\Request\Parameter\Calculate
 */
class RaceType extends ByDefault
{
    const EXCEPTION_CODE_DEFAULT_NOT_FOUND = 5;
    const DEFAULT_RACE_TYPE_CODE = 'F';

    /**
     * @var string
     */
    private $raceType;

    /**
     * @return string|null
     * @throws NotFoundException
     */
    public function getValue()
    {
        if ($this->getModel()) {
            if (!$this->raceType) {
                $profile = $this->getModel()->get(
                    $this->getRequest()->getId(),
                    $this->getSafeCountryCode(),
                    []
                );
                if (empty($profile)) {
                    throw new NotFoundException(static::EXCEPTION_CODE_DEFAULT_NOT_FOUND);
                }
                $raceTypeCode = empty($profile->race_type_code)
                    ? static::DEFAULT_RACE_TYPE_CODE
                    : $profile->race_type_code;
                $this->raceType = $this
                    ->getRequest()
                    ->getSelectors()
                    ->getRaceTypeByRaceTypeCode($raceTypeCode);
            }
            return $this->raceType;
        }
    }

    /**
     * @return \Api\DataProvider\Bo\Profile\DefaultInfo
     */
    protected function getModel()
    {
        return $this->getRequest()->get(Profile::MODEL_DEFAULT_INFO);
    }

    /**
     * @return null
     */
    private function getSafeCountryCode()
    {
        return $this->getRequest()->isParameterProvided('countryCode')
            ? $this->getRequest()->getCountryCode()
            : null;
    }
}
