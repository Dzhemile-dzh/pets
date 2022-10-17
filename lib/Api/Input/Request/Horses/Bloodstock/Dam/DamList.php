<?php
namespace Api\Input\Request\Horses\Bloodstock\Dam;

use Api\Constants\Horses as Constants;
use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Cast;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;

/**
 * Class DamList
 *
 * @method int getAge()
 * @method string getCountry()
 * @method string getName()
 * @method bool getDeceased()
 *
 * @package Api\Input\Request\Horses\Bloodstock\Dam
 */
class DamList extends HorsesRequest
{
    /**
     * Setup parameters
     */
    protected function setupParameters()
    {
        // Dam age should be in range from 5 to 30
        $this->addNamedParameter(
            'age',
            new StandardValidator\RegEx('/^(([5-9]|1[0-9]|2[0-9]|30)\,{0,1})+$/'),
            false
        );

        $this->addNamedParameter(
            'country',
            new StandardValidator\ExistsInArray(Constants::COUNTRY_CODES_FOR_PARAMS),
            false
        );

        $this->addNamedParameter(
            'name',
            new StandardValidator\StringLength(4),
            false
        );

        $this->addNamedParameter(
            'deceased',
            new StandardValidator\Boolean(),
            false
        );
        $this->addCast('deceased', new Cast\Boolean());
    }
}
