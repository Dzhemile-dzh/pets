<?php

namespace Api\Output\Mapper\Results\ResultsDate;

/**
 * Class NonRunner
 *
 * @package Api\Output\Mapper\Results\ResultsDate
 */
class NonRunner extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)horse_name,horse_country_origin_code' => 'horse_name',
            'horse_country_origin_code' => 'horse_country_origin_code',
            'horse_age' => 'horse_age',
            'weight_carried_lbs' => 'weight_carried_lbs',
            'jockey_style_name' => 'jockey_style_name',
            'trainer_style_name' => 'trainer_style_name',
            'owner_group_uid' => 'owner_group_uid',
            'rp_close_up_comment' => 'rp_close_up_comment'
        ];
    }
}
