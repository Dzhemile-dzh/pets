<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 4/7/2017
 * Time: 2:38 PM
 */

namespace Api\Input\Request\Horses\SeasonalStatistics;

use Phalcon\Input\Request\Parameter\Cast;
use Phalcon\Input\Request\Parameter\Validator;

class SeasonsAvailable extends \Api\Input\Request\HorsesRequest
{
    /**
     * This method initialises all necessary validators and other restrictions for the certain request object
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'activeSeasons',
            new Validator\Boolean(),
            false
        );
        $this->addCast('activeSeasons', new Cast\Boolean());
    }
}
