<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 3/11/2016
 * Time: 10:57 AM
 */

namespace Api\Input\Request\Horses\Bloodstock\Stallion;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;
use Api\Input\Request\Horses\Profile;
use Api\Input\Request\Parameter\Calculate\RaceType\Bloodstock\Stallion\ProgenyEntries as RaceTypeCalculation;

/**
 * Class ProgenyEntries
 * @method getStallionId
 * @method getRaceType
 *
 * @package Api\Input\Request\Horses\Bloodstock\Stallion
 */
class ProgenyEntries extends Profile
{
    const ENTITY_ID = 'stallionId';

    protected function setupParameters()
    {
        $this->addNamedParameter(
            self::ENTITY_ID,
            new StandardValidator\IntegerId()
        );
        $this->addCast(self::ENTITY_ID, new Cast\DecimalInteger());

        $this->addOrderedParameter(
            'raceType',
            new StandardValidator\ExistsInArray(
                array_merge($this->getSelectors()->getRaceTypeKeys(), ['big-races'])
            ),
            false,
            new RaceTypeCalculation()
        );
    }
}
