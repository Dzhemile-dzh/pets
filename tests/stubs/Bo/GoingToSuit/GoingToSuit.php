<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 8/31/2016
 * Time: 2:27 PM
 */

namespace Tests\Stubs\Bo\GoingToSuit;

class GoingToSuit extends \Bo\GoingToSuit\GoingToSuit
{
    protected function getGoingToSuitDataSet()
    {
        return new \Tests\Stubs\DataProvider\Bo\GoingToSuit\GoingToSuit();
    }

    /**
     * @return \Tests\Stubs\DataProvider\Bo\HorseProfile\GoingForm
     */
    protected function getGoingFormDataSet()
    {
        return new \Tests\Stubs\DataProvider\Bo\HorseProfile\GoingForm();
    }
}
