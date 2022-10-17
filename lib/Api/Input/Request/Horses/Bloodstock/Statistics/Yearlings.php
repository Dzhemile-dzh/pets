<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 5/13/2016
 * Time: 12:16 PM
 */

namespace Api\Input\Request\Horses\Bloodstock\Statistics;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class Yearlings extends \Api\Input\Request\Horses\Bloodstock\Statistics
{
    /**
     * @var array
     */
    protected static $availableCountryCodes = ['GB', 'IRE', 'GB-IRE', 'Europe', 'USA', 'All'];

    protected function setupParameters()
    {
        $this->addNamedParameter(
            'countryFlag',
            new StandardValidator\ExistsInArray(
                static::getAvailableCountryCodes()
            ),
            true
        );

        $this->addOrderedParameter(
            'saleYear',
            new StandardValidator\IntegerId(),
            false,
            date("Y")
        );
        $this->addCast('saleYear', new Cast\DecimalInteger());
    }
}
