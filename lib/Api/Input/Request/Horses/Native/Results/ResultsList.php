<?php

declare(strict_types=1);

namespace Api\Input\Request\Horses\Native\Results;

use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Validator\Date;

/**
 * @method string getResultsDate()
 * @package Api\Input\Request\Horses\Native\Results
 */
class ResultsList extends HorsesRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters(): void
    {
        $this->addNamedParameter('resultsDate', new Date());
    }
}
