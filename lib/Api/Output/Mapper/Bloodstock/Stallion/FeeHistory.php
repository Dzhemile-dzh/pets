<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 3/24/2016
 * Time: 5:33 PM
 */

namespace Api\Output\Mapper\Bloodstock\Stallion;

class FeeHistory extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            '(getStudFee)' => 'stud_fee',
            'stud_name' => 'stud_name',
            'country_code' => 'country_code',
            'country_desc' => 'country_desc',
            'cur_code' => 'currency_code',
            'year' => 'nomination_year',
            'exchange_rate' => 'exchange_rate',
        ];
    }
}
