<?php
namespace Api\Output\Mapper\Bloodstock\Sales;

class CatalogueSires extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'sire_uid' => 'sire_uid',
            'sire_name' => 'sire_name',
            'sire_style_name' => 'sire_style_name',
            'stud_name' => 'stud_name',
            'stud_fee' => 'stud_fee',
            '(roundNullable)stud_fee_gbp,2' => 'stud_fee_gbp',
            'total_lots' => 'total_lots',
            'total_lots_fillies' => 'total_lots_fillies',
            'total_lots_colts' => 'total_lots_colts',
            'cur_code' => 'currency_code',
        ];
    }
}
