<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 3/15/2016
 * Time: 6:14 PM
 */

namespace Api\Input\Request\Horses\Bloodstock\Stallion;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class NickDescendants extends \Api\Input\Request\HorsesRequest
{
    /**
     * @var array
     */
    private static $availableSortOrders = ['a-z', 'wins', 'win-prize', 'total-prize'];

    /**
     * @return array
     */
    public static function getAvailableSortOrders()
    {
        return self::$availableSortOrders;
    }

    protected function setupParameters()
    {
        $this->addNamedParameter(
            'stallionId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('stallionId', new Cast\DecimalInteger());

        $this->addOrderedParameter(
            'stallionAncestorId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('stallionAncestorId', new Cast\DecimalInteger());

        $this->addOrderedParameter(
            'order',
            new StandardValidator\ExistsInArray(self::getAvailableSortOrders()),
            false,
            'a-z'
        );
    }
}
