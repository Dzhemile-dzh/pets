<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 7/21/2016
 * Time: 2:26 PM
 */

namespace Api\Output\Mapper\Bloodstock\Sales\Catalogue;

class Vendors extends \Api\Output\Mapper\HorsesMapper
{

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'seller_name' => 'vendor_name',
            'total_lots' => 'total_lots',
            'total_lots_fillies' => 'total_lots_fillies',
            'total_lots_colts' => 'total_lots_colts',
        ];
    }
}
