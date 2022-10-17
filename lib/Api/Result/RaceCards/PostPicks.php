<?php

declare(strict_types=1);

namespace Api\Result\RaceCards;

use Api\Result\Json as Result;

/**
 * @package Api\Result\RaceCards
 */
class PostPicks extends Result
{
    /**
     * @return array
     */
    protected function getMappers(): array
    {
        return [
            'post_picks' => 'Api\Output\Mapper\RaceCards\PostPicks\PostPicks',
            'post_picks.post_pick_1' => 'Api\Output\Mapper\RaceCards\PostPicks\PostPick',
            'post_picks.post_pick_2' => 'Api\Output\Mapper\RaceCards\PostPicks\PostPick',
            'post_picks.post_pick_3' => 'Api\Output\Mapper\RaceCards\PostPicks\PostPick',
            'post_picks.post_pick_4' => 'Api\Output\Mapper\RaceCards\PostPicks\PostPick'
        ];
    }
}
