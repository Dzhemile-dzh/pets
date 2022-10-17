<?php

namespace Api\Result\Native\Profiles\Horses;

use Api\Result\Xml as Result;

/**
 * Class MeetingList
 *
 * @package Api\Result\Native\Profiles\Horses
 */
class Horse extends Result
{
    /**
     * @return array
     */
    protected function getMappers(): array
    {
        return [
            'Horse' => 'Api\Output\Mapper\Native\Profiles\Horses\Horse',
            'HorseDam' => 'Api\Output\Mapper\Native\Profiles\Horses\HorseDam',
            'DamSir' => 'Api\Output\Mapper\Native\Profiles\Horses\DamSir',
            'HorseSir' => 'Api\Output\Mapper\Native\Profiles\Horses\HorseSir',
            'SireSir' => 'Api\Output\Mapper\Native\Profiles\Horses\SireSir',
            'HorseRecords' => 'Api\Output\Mapper\Native\Profiles\Horses\HorseRecords',
            'HorseForm' => 'Api\Output\Mapper\Native\Profiles\Horses\HorseForm',
        ];
    }
}
