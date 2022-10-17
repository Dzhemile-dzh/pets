<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 4/19/2017
 * Time: 2:22 PM
 */

namespace Api\Input\Request\Horses\GoingToSuit;

use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

/**
 * Class RaceFlags
 *
 * @method int getRaceId()
 *
 * @package Api\Input\Request\Horses\GoingToSuit
 */
class RaceFlags extends HorsesRequest
{
    /**
     * This method initialises all necessary validators and other restrictions for the certain request object
     */
    protected function setupParameters()
    {
        $this->addOrderedParameter(
            'raceId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('raceId', new Cast\DecimalInteger());
    }
}
