<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 12/29/2016
 * Time: 11:17 AM
 */

namespace Api\Input\Request\Parameter\Calculate;

use Phalcon\Input\Request\Parameter\Calculate\ByDefault;
use Api\Exception\NotFound as NotFoundException;
use Bo\Profile;

class CountryCode extends ByDefault
{
    const EXCEPTION_CODE_DEFAULT_NOT_FOUND = 5;
    const DEFAULT_COUNTRY_CODE = 'GB';

    private static $possibleCountryCodes = ['GB', 'IRE'];

    /**
     * @return string|null
     * @throws NotFoundException
     */
    public function getValue()
    {
        if ($this->getModel()) {
            $model = $this->getModel();
            $profile = $model->get(
                $this->getRequest()->getId(),
                null,
                $this->getSafeRaceTypeCode()
            );
            if (empty($profile)) {
                throw new NotFoundException(static::EXCEPTION_CODE_DEFAULT_NOT_FOUND);
            }
            $countryCode = empty($profile->country_code) || !in_array($profile->country_code, self::$possibleCountryCodes, true)
                ? static::DEFAULT_COUNTRY_CODE
                : $profile->country_code;

            return $countryCode;
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
     * @return array
     */
    private function getSafeRaceTypeCode()
    {
        if ($this->getRequest()->isParameterProvided('raceType')) {
            $raceTypeCode = $this
                ->getRequest()
                ->getSelectors()
                ->getRaceTypeCode(
                    $this
                        ->getRequest()
                        ->getRaceType()
                );
        } else {
            $raceTypeCode = [];
        }
        return $raceTypeCode;
    }
}
