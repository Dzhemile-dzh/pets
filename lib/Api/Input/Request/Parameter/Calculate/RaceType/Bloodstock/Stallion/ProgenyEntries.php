<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 1/12/2017
 * Time: 4:31 PM
 */

namespace Api\Input\Request\Parameter\Calculate\RaceType\Bloodstock\Stallion;

use Phalcon\Input\Request\Parameter\Calculate\ByDefault;
use Bo\Bloodstock\Stallion\ProgenyHorses as BoProgeny;

class ProgenyEntries extends ByDefault
{
    /**
     * @return string|null
     */
    public function getValue()
    {
        if ($this->getModel()) {
            return $this->getModel()->getDefaultRaceType($this->getRequest()->getId());
        }
    }

    /**
     * @return \Api\DataProvider\Bo\Bloodstock\Stallion\RaceInstance
     */
    private function getModel()
    {
        return $this->getRequest()->get(BoProgeny::MODEL_DEFAULT_INFO);
    }
}
