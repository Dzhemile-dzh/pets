<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 25.09.2014
 * Time: 13:46
 */

namespace Api\Result;

class DrawAnalyser extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'race' => '\Api\Output\Mapper\DrawAnalyser\Race',
            'runners' => '\Api\Output\Mapper\DrawAnalyser\Runner'
        ];
    }
}
