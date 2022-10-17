<?php

namespace Api\Output\Mapper\Signposts;

class Entry extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            '(dateISO8601)race_datetime' => 'race_datetime',
            'race_instance_uid' => 'race_uid',
            'race_instance_title' => 'race_instance_title',
            'declared_runners' => 'declared_runners',
            'race_group_desc' => 'race_group_desc',
            'perform_race_uid_atr' => 'perform_race_uid_atr',
            'perform_race_uid_ruk' => 'perform_race_uid_ruk',
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)horse_name,horse_country_origin_code' => 'horse_name',
            '(dbYNFlagToBoolean)non_runner' => 'non_runner',
            'rp_owner_choice' => 'rp_owner_choice',
            '(getSilkImagePath)' => 'silk_image_path',
        ];
    }
}
