<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\HorseProfile;

class MyNotes extends \Api\Output\Mapper\HorsesMapper
{

    protected function getMap()
    {
        return [
            'reg_id' => 'reg_id',
            'horse_uid' => 'horse_uid',
            'race_type' => 'race_type',
            'comment' => 'comment',
            'rating' => 'rating',
            'rating_flag' => 'rating_flag'
        ];
    }
}
