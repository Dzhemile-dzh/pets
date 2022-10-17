<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 3/16/2016
 * Time: 9:20 AM
 */

namespace Tests\Stubs\Bo\Bloodstock\Stallion;

use Tests\Stubs\Models\Bo\Bloodstock\Stallion as Bo;

class ProgenyStatistics extends \Bo\Bloodstock\Stallion\ProgenyStatistics
{
    /**
     * @return \Tests\Stubs\DataProvider\Bo\Bloodstock\Stallion\ProgenyStatistics
     */
    protected function getProgenyStatisticsDataProvider()
    {
        return new \Tests\Stubs\DataProvider\Bo\Bloodstock\Stallion\ProgenyStatistics($this->request->getStallionId());
    }
}
