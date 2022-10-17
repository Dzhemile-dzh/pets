<?php

declare(strict_types=1);

namespace Api\Result\Native\Cards;

use Api\Result\Xml as Result;
use \Api\Output\Mapper\Native\Cards\DateMenu as Mapper;

/**
 * @package Api\Result\Native\Cards
 */
class DateMenu extends Result
{

    /**
     * @return array
     */
    protected function getMappers(): array
    {
        return [
            'dates' => Mapper\Date::class,
        ];
    }
}
