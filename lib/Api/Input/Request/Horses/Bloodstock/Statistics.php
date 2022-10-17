<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 5/13/2016
 * Time: 11:46 AM
 */

namespace Api\Input\Request\Horses\Bloodstock;

abstract class Statistics extends \Api\Input\Request\HorsesRequest
{
    /**
     * @var array
     */
    protected static $availableCountryCodes = ['FR', 'GER', 'ITY', 'GB', 'IRE', 'USA', 'SWE', 'NOR', 'DEN', 'TUR', 'SPA'];

    /**
     * @return array
     */
    public static function getAvailableCountryCodes()
    {
        return static::$availableCountryCodes;
    }
}
