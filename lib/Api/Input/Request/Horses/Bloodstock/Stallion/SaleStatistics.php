<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 3/29/2016
 * Time: 2:32 PM
 */

namespace Api\Input\Request\Horses\Bloodstock\Stallion;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;
use Api\Input\Request\Parameter\Validator as CustomValidator;

class SaleStatistics extends \Api\Input\Request\HorsesRequest
{
    const DEFAULT_COUNTRY_FLAG = 'GB-IRE';
    const DEFAULT_RESTRICTION = 'yearlings';

    /**
     * @var array
     */
    private static $availableCountryFlags = ['GB-IRE', 'Europe', 'USA', 'All', 'GB', 'IRE'];

    /**
     * @var array
     */
    private static $availableRestrictions = ['foals', 'yearlings', '2yo', '3yo', '4yo', 'older', 'mares'];

    /**
     * @return array
     */
    public static function getAvailableCountryFlags()
    {
        return self::$availableCountryFlags;
    }

    /**
     * @return array
     */
    public static function getAvailableRestrictions()
    {
        return self::$availableRestrictions;
    }

    protected function setupParameters()
    {
        $this->addNamedParameter(
            'stallionId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('stallionId', new Cast\DecimalInteger());

        $this->addOrderedParameter(
            'countryFlag',
            new StandardValidator\ExistsInArray(
                self::getAvailableCountryFlags()
            ),
            false,
            self::DEFAULT_COUNTRY_FLAG
        );

        $this->addOrderedParameter(
            'horseRestriction',
            new StandardValidator\ExistsInArray(
                self::getAvailableRestrictions()
            ),
            false,
            self::DEFAULT_RESTRICTION
        );
    }
}
