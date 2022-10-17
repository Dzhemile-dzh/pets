<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 1/12/2017
 * Time: 11:45 AM
 */

namespace Api\Input\Request\Parameter\Calculate\RaceType\Bloodstock\Stallion;

use Phalcon\Input\Request\Parameter\Calculate\ByDefault;

class ProgenyResults extends ByDefault
{
    /**
     * @return string|null
     */
    public function getValue()
    {
        if ($this->getRequest()->getSeason()) {
            return $this->getRequest()->getSeason()->raceType;
        }
    }
}
