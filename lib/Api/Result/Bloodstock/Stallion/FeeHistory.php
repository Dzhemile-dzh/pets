<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 3/24/2016
 * Time: 5:32 PM
 */

namespace Api\Result\Bloodstock\Stallion;

class FeeHistory extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'fee_history' => '\Api\Output\Mapper\Bloodstock\Stallion\FeeHistory',
        ];
    }
}
