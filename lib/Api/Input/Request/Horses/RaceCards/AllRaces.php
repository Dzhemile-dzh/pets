<?php

namespace Api\Input\Request\Horses\RaceCards;

use Models\Selectors;
use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Validator\Date as DateValidator;

/**
 * Class AllRaces
 *
 * @method string getRaceDate()
 *
 * @package Api\Input\Request\Horses\RaceCards
 */
class AllRaces extends HorsesRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'raceDate',
            new DateValidator(Selectors::MIN_DATE_RESULTS_SEARCH, Selectors::MAX_DATE_SYBASE_SMALLDATETIME)
        );
    }
}
