<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 7/6/2016
 * Time: 4:57 PM
 */

namespace Api\Result\RaceCards;

class TopDraw extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'top_draw' => '\Api\Output\Mapper\RaceCards\TopDraw',
        ];
    }
}
