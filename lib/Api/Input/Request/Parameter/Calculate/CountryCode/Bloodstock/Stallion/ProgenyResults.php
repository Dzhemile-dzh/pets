<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 1/12/2017
 * Time: 1:42 PM
 */

namespace Api\Input\Request\Parameter\Calculate\CountryCode\Bloodstock\Stallion;

use Phalcon\Input\Request\Parameter\Calculate\ByDefault;

class ProgenyResults extends ByDefault
{
    public function getValue()
    {
        if ($this->getRequest()->getSeason()) {
            return $this->getRequest()->getSeason()->countryCode;
        }
    }
}
