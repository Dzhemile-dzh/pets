<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\Results;

class Prize extends \Api\Output\Mapper\HorsesMapper
{

    protected function getMap()
    {
        return [
            '(roundNullable)prize_sterling,2' => 'prize_sterling',
            'prize_euro' => 'prize_euro',
            'prize_euro_gross' => 'prize_euro_gross',
            'prize_usd' => 'prize_usd',
            'position_no' => 'position_no',
        ];
    }
}
