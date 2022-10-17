<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 11/4/2016
 * Time: 4:00 PM
 */

namespace Api\Output\Mapper\Signposts;

class ListForMobile extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_uid',
            'horse_uid' => 'horse_uid',
        ];
    }
}
