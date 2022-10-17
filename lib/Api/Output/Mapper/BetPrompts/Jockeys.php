<?php

namespace Api\Output\Mapper\BetPrompts;

class Jockeys extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'jockey_uid' => 'jockey_uid',
            'jockey_name' => 'jockey_name',
            'd7_wins' => 'wins',
            'd7_runs' => 'runs',
            'd7_perc' => 'percentage',
            'bet_prompt_rating' => 'bet_prompt_rating',
            'bet_prompt_weighting' => 'bet_prompt_weighting',
            '(round)bet_prompt_score,2' => 'bet_prompt_score',
            'entries' => 'entries'
        ];
    }
}
