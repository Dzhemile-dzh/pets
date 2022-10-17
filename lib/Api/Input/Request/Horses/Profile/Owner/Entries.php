<?php
/**
 * Created by PhpStorm.
 * User: Kateryna_Vozniuk
 * Date: 2/10/2015
 * Time: 3:45 PM
 */

namespace Api\Input\Request\Horses\Profile\Owner;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class Entries extends \Api\Input\Request\HorsesRequest
{
    /**
     * Setup parameters
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'ownerId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('ownerId', new Cast\DecimalInteger());
    }
}
