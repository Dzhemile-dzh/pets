<?php

namespace Api\Input\Request\Horses\Signposts;

use Api\Input\Request\Horses\Signposts;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Models\Selectors;

class Sweetspots extends Signposts
{
    protected function setupParameters()
    {
        $this->addOrderedParameter(
            'date',
            new StandardValidator\Date(Selectors::MIN_DATE_RESULTS_SEARCH, Selectors::MAX_DATE_SYBASE_SMALLDATETIME),
            false
        );
    }
}
