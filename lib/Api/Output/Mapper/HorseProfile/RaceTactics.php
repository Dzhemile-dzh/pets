<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 10/11/2016
 * Time: 12:14 PM
 */

namespace Api\Output\Mapper\HorseProfile;

class RaceTactics extends \Api\Output\Mapper\HorsesMapper
{

    protected function getMap()
    {
        return [
            'actual' => 'actual',
            'predicted' => 'predicted'
        ];
    }
}
