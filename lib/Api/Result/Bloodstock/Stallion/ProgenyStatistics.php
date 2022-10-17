<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 3/1/2016
 * Time: 5:33 PM
 */

namespace Api\Result\Bloodstock\Stallion;

class ProgenyStatistics extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'progeny_statistics.current_year' => '\Api\Output\Mapper\Bloodstock\Stallion\ProgenyStatistics',
            'progeny_statistics.2000_to_date' => '\Api\Output\Mapper\Bloodstock\Stallion\ProgenyStatistics',
            'progeny_statistics.1988_to_date' => '\Api\Output\Mapper\Bloodstock\Stallion\ProgenyStatistics',
        ];
    }
}
