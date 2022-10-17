<?php
/**
 * Created by PhpStorm.
 * User: oleg_symonchuk
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\RaceCards\Selections;

class Selections extends \Api\Output\Mapper\HorsesMapper
{

    protected function getMap()
    {
        return [
            'newspaper_name' => 'newspaper_name',
            'newspaper_uid' => 'newspaper_uid',
            'sort_order' => 'sort_order',
            '(fixAroHorseName)horse_name,country_origin_code' => 'horse_name',
            'horse_uid' => 'horse_uid',
            '(getSelectionType)' => 'selection_type',
            '(setNullIfZero)tipster_uid' => 'tipster_uid',
            '(nullIfStringEmpty)tipster_name' => 'tipster_name',
            '(nullIfLessThanZero)selection_cnt' => 'selection_cnt',
            'rp_owner_choice' => 'rp_owner_choice',
            '(getSilkImagePath)' => 'silk_image_path',
            '(dbYNFlagToBoolean)non_runner' => 'non_runner',
        ];
    }
}
