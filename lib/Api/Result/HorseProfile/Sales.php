<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 7/16/2015
 * Time: 3:18 PM
 */

namespace Api\Result\HorseProfile;

class Sales extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'sales' => '\Api\Output\Mapper\HorseProfile\Sales',
        ];
    }
}
