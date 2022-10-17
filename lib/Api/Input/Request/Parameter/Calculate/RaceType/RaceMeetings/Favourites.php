<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 1/13/2017
 * Time: 2:44 PM
 */

namespace Api\Input\Request\Parameter\Calculate\RaceType\RaceMeetings;

use Phalcon\Input\Request\Parameter\Calculate\ByDefault;
use Bo\RaceMeetings as Profile;

/**
 * Class Favourites
 * @package Api\Input\Request\Parameter\Calculate\RaceType\RaceMeetings
 */
class Favourites extends ByDefault
{

    /**
     * @return string|null
     */
    public function getValue()
    {
        if ($this->getModel()) {
            return $this->getModel()->getDefaultRaceTypeCode($this->getRequest()->getId());
        }
    }

    /**
     * @return \Models\Bo\RaceMeetings\Course
     */
    protected function getModel()
    {
        return $this->getRequest()->get(Profile::MODEL_DEFAULT_INFO);
    }
}
