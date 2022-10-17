<?php

declare(strict_types=1);

namespace Api\Result\Native\Cards;

use Api\Result\Xml as Result;

/**
 * @package Api\Result\Native\Cards
 */
class BigRaces extends Result
{

    /**
     * @return array
     */
    protected function getMappers(): array
    {
        return [
            'races' => '\Api\Output\Mapper\Native\Cards\BigRaces\Race',
            'races.meeting' => '\Api\Output\Mapper\Native\Cards\BigRaces\Meeting'
        ];
    }
}
