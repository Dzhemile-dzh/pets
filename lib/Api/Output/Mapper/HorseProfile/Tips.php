<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 7/16/2015
 * Time: 3:13 PM
 */

namespace Api\Output\Mapper\HorseProfile;

class Tips extends \Api\Output\Mapper\HorsesMapper
{
    protected function getMap()
    {
        return [
            "race_instance_uid" => "race_instance_uid",
            "newspaper_uid" => "newspaper_uid",
            "(nullIfStringEmpty)naps_style" => "naps_style"
        ];
    }
}
