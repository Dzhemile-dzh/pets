<?php

declare(strict_types=1);

namespace Api\Input\Request\Horses\Native\Profiles\Horses;

use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Validator\StringLength;

/**
 * @method string getResultsDate()
 * @package Api\Input\Request\Horses\Native\Results
 */
class Search extends HorsesRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters(): void
    {
        $this->addNamedParameter(
            'name',
            new StringLength(4)
        );
    }
}
