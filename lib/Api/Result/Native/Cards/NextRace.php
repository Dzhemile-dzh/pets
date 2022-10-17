<?php

declare(strict_types=1);

namespace Api\Result\Native\Cards;

use Api\Output\Mapper\Native\Cards\NextRace\Id;
use Api\Result\Xml;

/**
 * Class NextRace
 * @package Api\Result\Native\Cards
 */
class NextRace extends Xml
{
    /**
     * @return array
     */
    protected function getMappers(): array
    {
        return [
            'nextRaceId' => '\Api\Output\Mapper\Native\Cards\NextRace\Id',
            'nextRaceDate' => '\Api\Output\Mapper\Native\Cards\NextRace\Date'
        ];
    }
}
