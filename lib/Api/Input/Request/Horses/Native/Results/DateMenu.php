<?php

declare(strict_types=1);

namespace Api\Input\Request\Horses\Native\Results;

use Api\Input\Request\HorsesRequest;

/**
 * @method string getResultsDate()
 * @package Api\Input\Request\Horses\Native\Results
 */
class DateMenu extends HorsesRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters(): void
    {
    }
}
