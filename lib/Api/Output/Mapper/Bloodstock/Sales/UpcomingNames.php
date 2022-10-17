<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 10/20/2016
 * Time: 4:21 PM
 */

namespace Api\Output\Mapper\Bloodstock\Sales;

class UpcomingNames extends \Api\Output\Mapper\HorsesMapper
{

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_names' => 'horse_names',
            'sire_names' => 'sire_names',
            'dam_names' => 'dam_names',
            'damsire_names' => 'damsire_names',
            'vendor_names' => 'vendor_names',
        ];
    }
}
