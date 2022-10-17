<?php

namespace Api\Output\Mapper\TotePredictor;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class Runner
 *
 * @package Api\Output\Mapper\TotePredictor
 */
class Runner extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            'horse_name' => 'horse_name',
            'saddle_cloth_no' => 'saddle_cloth_number',
            '(dbYNFlagToBoolean)non_runner' => 'non_runner',
            'conditions_score' => 'conditions_score',
            'rpr_score' => 'rpr_score',
            'form_score' => 'form_score',
            'trainer_jockey_score' => 'trainer_jockey_score',
            'total_score' => 'total_score',
            'predicted_position' => 'predicted_position',
        ];
    }
}
