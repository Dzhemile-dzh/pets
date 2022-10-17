<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 8/22/2016
 * Time: 5:17 PM
 */

namespace Api\Input\Request\Horses\Profile\Horse;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

/**
 * Class GoingForm
 *
 * @method integer getHorseId
 * @package Api\Input\Request\Horses\Profile\Horse
 */

class GoingForm extends \Api\Input\Request\HorsesRequest
{
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'horseId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('horseId', new Cast\DecimalInteger());
    }
}
