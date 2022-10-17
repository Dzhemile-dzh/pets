<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 5/13/2016
 * Time: 9:59 AM
 */

namespace Api\Input\Request\Horses\Bloodstock\Statistics;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class TopStallions extends \Api\Input\Request\Horses\Bloodstock\Statistics
{
    const DEFAULT_CATEGORY = 'Flat';

    /**
     * @var array
     */
    private static $availableCategories = [
        'Worldwide G1',
        'Euro Stakes',
        'Broodmare sires',
        'First Crop',
        'All-weather',
        'Jumps',
        'Flat',
        '2yo',
    ];

    /**
     * @return array
     */
    public static function getAvailableCategories()
    {
        return self::$availableCategories;
    }

    protected function setupParameters()
    {
        $this->addOrderedParameter(
            'season',
            new StandardValidator\IntegerId(),
            false,
            date("Y")
        );
        $this->addCast('season', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'countryOrigCodes',
            new StandardValidator\ArrayParameter(
                new StandardValidator\ExistsInArray(static::getAvailableCountryCodes())
            ),
            false
        );

        $this->addNamedParameter(
            'category',
            new StandardValidator\ExistsInArray(
                self::getAvailableCategories()
            ),
            false,
            self::DEFAULT_CATEGORY
        );

        $this->addNamedParameter(
            'progenyPerformersLimit',
            new StandardValidator\SmallInteger(),
            false,
            10
        );
        $this->addCast('progenyPerformersLimit', new Cast\DecimalInteger());
    }
}
