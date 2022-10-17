<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper;

class Runner extends \Api\Output\Mapper\HorsesMapper
{

    protected function getMap()
    {
        return [
            'horseId' => 'id',
            'horseName' => 'name',
            'points' => 'score'
        ];
    }
}
