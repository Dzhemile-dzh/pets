<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 11/4/14
 * Time: 11:44 AM
 */

namespace Api\Input\Request\Method;

trait GetSeasonTypeCode
{
    /**
     * @throws \Exception
     * @return string
     */
    public function getSeasonTypeCode()
    {
        return $this->getSelectors()->getSeasonTypeCode(
            $this->internalCountryCode(),
            $this->isParameterProvided('raceType') ? $this->getRaceType() : $this->retrieveDefaultValue('raceType'),
            $this->isParameterExists('surface') ? $this->getSurface() : null,
            $this->isParameterExists('championship') ? $this->getChampionship() : null
        );
    }

    /**
     * @return null|string
     */
    private function internalCountryCode()
    {
        $countryCode = null;
        if ($this->get('countryCode')) {
            $countryCode = $this->get('countryCode');
        } elseif ($this->isParameterExists('countryCode')) {
            $countryCode = $this->getCountryCode();
        }
        return $countryCode;
    }
}
