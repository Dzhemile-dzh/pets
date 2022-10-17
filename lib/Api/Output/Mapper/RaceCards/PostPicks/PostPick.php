<?php

declare(strict_types=1);

namespace Api\Output\Mapper\RaceCards\PostPicks;

use Api\Output\Mapper\HorsesMapper;

/**
 * @package Api\Output\Mapper\RaceCards\PostPicks
 */
class PostPick extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            'horse_uid' => 'horse_uid',
            'horse_name' => 'horse_name',
            'saddle_cloth_number' => 'saddle_cloth_number'
        ];
    }
}
