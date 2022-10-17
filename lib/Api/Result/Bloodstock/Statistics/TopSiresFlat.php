<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 5/13/2016
 * Time: 2:28 PM
 */

namespace Api\Result\Bloodstock\Statistics;

class TopSiresFlat extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'top_sires' => '\Api\Output\Mapper\Bloodstock\Statistics\TopSires',
        ];
    }
}
