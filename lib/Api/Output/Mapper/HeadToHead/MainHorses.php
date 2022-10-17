<?php
namespace Api\Output\Mapper\HeadToHead;

/**
 * Class MainHorses
 * @package Api\Output\Mapper\HeadToHead
 */
class MainHorses extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_style_name' => 'horse_style_name',
            'horse_uid' => 'horse_uid',
            'horse_country_origin_code' => 'horse_country_origin_code',
            'horse_sex_code' => 'horse_sex_code',
            '(trim)race_outcome_code' => 'race_outcome_code',
            'odds_desc' => 'odds_desc',
            'odds_value' => 'odds_value',
            'saddle_cloth_no' => 'saddle_cloth_no',
            '(setNullIfZero)official_rating_ran_off' => 'official_rating_ran_off',
            '(setNullIfZero)rp_postmark' => 'rp_postmark',
            'jockey_style_name' => 'jockey_style_name',
            '(setNullIfZero)weight_allowance_lbs' => 'weight_allowance_lbs',
            'trainer_style_name' => 'trainer_style_name'
        ];
    }
}
