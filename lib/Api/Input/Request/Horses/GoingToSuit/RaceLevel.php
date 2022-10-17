<?php

/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 8/30/2016
 * Time: 12:34 PM
 */

namespace Api\Input\Request\Horses\GoingToSuit;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Models\Selectors;

/**
 * Class RaceLevel
 *
 * @method integer getRaceId
 * @package Api\Input\Request\Horses\GoingToSuit
 *
 */
class RaceLevel extends \Api\Input\Request\HorsesRequest
{
    protected function setupParameters()
    {
        $this->addOrderedParameter(
            'raceDate',
            new StandardValidator\Date(),
            false,
            (new \DateTime())->format('Y-m-d')
        );
    }
}
