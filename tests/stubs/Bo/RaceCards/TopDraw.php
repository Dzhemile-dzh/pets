<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 01/11/2017
 * Time: 2:20 PM
 */
namespace Tests\Stubs\Bo\RaceCards;

class TopDraw extends \Bo\RaceCards\TopDraw
{
    protected function getDataProvider()
    {
        $dataProvider = new \Tests\Stubs\DataProvider\Bo\RaceCards\TopDraw();
        $dataProvider->setKey($this->getRaceId());

        return $dataProvider;
    }
}
