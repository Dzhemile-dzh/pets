<?php

namespace Api\Output\Mapper\Races;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class Runners
 * @package Api\Output\Mapper\Races
 */
class Runners extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'uid'                       => 'uid',
            'saddle_cloth_no'           => 'saddleClothNumber',
            'draw'                      => 'draw',
            '(getSilkImagePath)'        => 'silkURL',
            'trainer_uid'               => 'trainer.uid',
            'trainer_style_name'        => 'trainer.name',
            'jockey_uid'                => 'jockey.uid',
            'jockey_style_name'         => 'jockey.name',
            'weight_allowance_lbs'      => 'jockey.weightAllowance.lbs',
            'weight_allowance_kg'       => 'jockey.weightAllowance.kg',
            'pos_official'              => 'position.official',
            'pos_original'              => 'position.original',
            'pos_deadheat'              => 'position.deadheat',
            'pos_dnf'                   => 'position.didNotFinish',
            'pos_dnf_status'            => 'position.didNotFinishStatus',
            'pos_disqualified'          => 'position.disqualified',
            'pos_disq_status'           => 'position.disqualifiedStatus',
            'odds_desc'                 => 'startingPrice.fractional',
            'favourite_bool'            => 'startingPrice.favourite',
            'favourite_flag'            => 'startingPrice.favoriteType',
            'dth_distance_value'        => 'distanceFromHorseInFront.lengths',
            'dtw_sum_distance_value'    => 'distanceFromWinner.lengths',
            'horse_uid'                 => 'horse.uid',
            'horse_name'                => 'horse.name.full',
            'horse_style_name'          => 'horse.name.style',
            'country_origin_code'       => 'horse.originCountyCode',
        ];
    }
}