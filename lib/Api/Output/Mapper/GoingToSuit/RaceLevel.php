<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 8/30/2016
 * Time: 4:46 PM
 */

namespace Api\Output\Mapper\GoingToSuit;

class RaceLevel extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_uid',
            '(dbYNFlagToBoolean)going_to_suit' => 'going_to_suit',
        ];
    }
}
