<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 7/21/2016
 * Time: 2:12 PM
 */

namespace Api\Result\Bloodstock\Sales\Catalogue;

class Vendors extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'vendors' => '\Api\Output\Mapper\Bloodstock\Sales\Catalogue\Vendors',
        ];
    }
}
