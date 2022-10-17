<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 3/18/2016
 * Time: 3:33 PM
 */

namespace Tests\Stubs\Bo\Bloodstock\Stallion;

class ProgenyStatisticsTop extends \Bo\Bloodstock\Stallion\ProgenyStatisticsTop
{
    /**
     * @return \Tests\Stubs\DataProvider\Bo\Bloodstock\Stallion\ProgenyStatisticsTop
     */
    protected function getProgenyStatisticsTopDataProvider()
    {
        return new \Tests\Stubs\DataProvider\Bo\Bloodstock\Stallion\ProgenyStatisticsTop($this->request->getStallionId());
    }
}
