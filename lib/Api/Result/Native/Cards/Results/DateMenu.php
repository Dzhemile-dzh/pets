<?php

declare(strict_types=1);

namespace Api\Result\Native\Cards\Results;

use Api\Result\Xml as Result;
use Api\Output\Mapper\Native\Results as Mapper;

class DateMenu extends Result
{
    /**
     * @return array
     */
    protected function getMappers(): array
    {
        return [
            'dates'=> Mapper\Date::class,
        ];
    }
}
