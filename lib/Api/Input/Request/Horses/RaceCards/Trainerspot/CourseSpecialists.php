<?php

namespace Api\Input\Request\Horses\RaceCards\Trainerspot;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast\StringToArray;

/**
 * Class CourseSpecialists
 *
 * @package Api\Input\Request\Horses\RaceCards\Trainerspot
 */
class CourseSpecialists extends \Api\Input\Request\HorsesRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
        $this->addOrderedParameter(
            'raceType',
            new StandardValidator\ExistsInArray(
                $this->getSelectors()->getRaceTypeKeys()
            ),
            true
        );

        $this->addOrderedParameter(
            'countryCode',
            new StandardValidator\ExistsInArray(['GB', 'IRE']),
            false
        );
    }
}
