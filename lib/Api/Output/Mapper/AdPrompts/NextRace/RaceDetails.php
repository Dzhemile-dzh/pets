<?php

declare(strict_types=1);

namespace Api\Output\Mapper\AdPrompts\NextRace;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class RaceDetails
 * @package Api\Output\Mapper\AdPrompts\NextRace
 */
class RaceDetails extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'course_uid' => 'course_uid',
            'course_style_name' => 'course_style_name'
        ];
    }
}
