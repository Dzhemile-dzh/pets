<?php
/**
 * Created by PhpStorm.
 * User: oleg_symonchuk
 * Date: 29/12/14
 * Time: 12:41 PM
 */

namespace Api\Input\Request\Horses\RaceCards;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;

class StableToursDatabase extends \Api\Input\Request\HorsesRequest
{
    protected function setupParameters()
    {
        $this->addOrderedParameter(
            'searchBy',
            new StandardValidator\Collection(
                [
                    new StandardValidator\ExistsInArray(
                        ['horse', 'trainer']
                    ),
                    new StandardValidator\Callback(
                        function ($value, array $rawParameters) {
                            return isset($rawParameters[1]);
                        },
                        [$this->rawOrderedParameters]
                    )
                ]
            ),
            false
        );

        $this->addOrderedParameter(
            'searchTerm',
            new StandardValidator\Collection(
                [
                    new StandardValidator\StringLength(
                        3
                    ),
                    new StandardValidator\RegEx(
                        "/^[a-zA-Z]+$/"
                    )
                ]
            ),
            false
        );
    }
}
