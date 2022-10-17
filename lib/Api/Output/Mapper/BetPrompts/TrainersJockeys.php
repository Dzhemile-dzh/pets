<?php

namespace Api\Output\Mapper\BetPrompts;

class TrainersJockeys extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'trainer_uid' => 'trainer_uid',
            'trainer_name' => 'trainer_name',
            'jockey_uid' => 'jockey_uid',
            'jockey_name' => 'jockey_name',
            't_percent' => 'trainer_percentage',
            'j_percent' => 'jockey_percentage',
            'percent' => 'percentage',
            'bet_prompt_rating' => 'bet_prompt_rating',
            'bet_prompt_weighting' => 'bet_prompt_weighting',
            '(round)bet_prompt_score,2' => 'bet_prompt_score',
            'entries' => 'entries'
        ];
    }
}
