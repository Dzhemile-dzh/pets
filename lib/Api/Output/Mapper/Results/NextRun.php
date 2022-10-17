<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 6/29/2017
 * Time: 5:42 PM
 */

namespace Api\Output\Mapper\Results;

class NextRun extends \Api\Output\Mapper\HorsesMapper
{

    protected function getMap()
    {
        return [
            'wins' => 'wins',
            'placed' => 'placed',
            'unplaced' => 'unplaced',
        ];
    }
}
