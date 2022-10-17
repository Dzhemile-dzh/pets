<?php
namespace Api\Output\Mapper\Results;

class Dividend extends \Api\Output\Mapper\HorsesMapper
{
    protected function getMap()
    {
        return [
            'aggregate_sp' => 'aggregate_sp',
            'favorites_index' => 'favorites_index',
            '(roundNullable)winning_distances,2' => 'winning_distances',
            'double_cards' => 'double_cards',
            'betting_man' => 'betting_man',
            'analysis_man' => 'analysis_man',
            'close_up_man' => 'close_up_man'
        ];
    }
}
