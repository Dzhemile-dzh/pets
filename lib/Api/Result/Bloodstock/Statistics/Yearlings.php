<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 5/13/2016
 * Time: 2:28 PM
 */

namespace Api\Result\Bloodstock\Statistics;

class Yearlings extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'yearlings' => '\Api\Output\Mapper\Bloodstock\Statistics\YearlingsCore',
            'yearlings.colts' => '\Api\Output\Mapper\Bloodstock\Statistics\Yearlings',
            'yearlings.fillies' => '\Api\Output\Mapper\Bloodstock\Statistics\Yearlings',
        ];
    }
}
