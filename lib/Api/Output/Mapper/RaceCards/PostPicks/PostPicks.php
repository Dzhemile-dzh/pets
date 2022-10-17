<?php

declare(strict_types=1);

namespace Api\Output\Mapper\RaceCards\PostPicks;

use Api\Output\Mapper\HorsesMapper;

/**
 * @package Api\Output\Mapper\RaceCards\PostPicks
 */
class PostPicks extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            'post_pick_1' => 'post_pick_1',
            'post_pick_2' => 'post_pick_2',
            'post_pick_3' => 'post_pick_3',
            'post_pick_4' => 'post_pick_4'
        ];
    }
}
