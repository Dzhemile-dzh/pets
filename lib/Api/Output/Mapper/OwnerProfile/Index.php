<?php

namespace Api\Output\Mapper\OwnerProfile;

class Index extends \Api\Output\Mapper\HorsesMapper
{

    protected function getMap()
    {
        return [
           'owner_uid' => 'owner_uid',
           'owner_name' => 'owner_name',
           'ptp_type_code' => 'ptp_type_code',
           'silk' => 'silk',
           'style_name' => 'style_name',
           '(getSilkImagePath)' => 'silk_image_path',
           'owner_last_14_days' => 'owner_last_14_days',
           'since_a_win' => 'since_a_win'
        ];
    }
}
