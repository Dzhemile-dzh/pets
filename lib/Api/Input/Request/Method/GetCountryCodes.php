<?php
namespace Api\Input\Request\Method;

/**
 * Trait GetCountryCodes
 * @package Api\Input\Request\Method
 */
trait GetCountryCodes
{
    public function getCountryCodes()
    {
        return explode('-', $this->isParameterExists('countryCode') ? $this->getCountryCode() : '');
    }
}
