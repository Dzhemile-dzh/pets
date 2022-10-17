<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\Bloodstock\Dam;

class ProgenySales extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'progeny-sales' => '\Api\Output\Mapper\Bloodstock\Dam\ProgenySales'
        ];
    }
}
