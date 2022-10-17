<?php

namespace Api\Input\Request\Horses\RaceCards\Trainerspot;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;

/**
 * Class RaceTrace
 *
 * @package Api\Input\Request\Horses\RaceCards\Trainerspot
 */
class RaceTrace extends \Api\Input\Request\HorsesRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
        $this->addOrderedParameter(
            'countryCode',
            new StandardValidator\ExistsInArray(['GB', 'IRE']),
            false,
            array('GB','IRE')
        );
    }
}
