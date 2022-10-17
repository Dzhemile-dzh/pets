<?php

/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 8/25/2016
 * Time: 6:01 PM
 */

namespace Tests\Stubs\Bo\HorseProfile;

class GoingForm extends \Bo\Profile\Horse\GoingForm
{
    protected function getGoingFormDataSet()
    {
        return new \Tests\Stubs\DataProvider\Bo\HorseProfile\GoingForm();
    }
}
