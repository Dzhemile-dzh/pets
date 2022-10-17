<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 6/24/2016
 * Time: 4:40 PM
 */

namespace Api\Output\Mapper\Bloodstock\StallionBook;

class Names extends \Api\Output\Mapper\HorsesMapper
{

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'stallion_names'    => 'stallion_names',
            'sire_names'        => 'sire_names',
            'stud_farms'        => 'stud_farms',
            'sire_line'         => 'sire_line'
        ];
    }
}
