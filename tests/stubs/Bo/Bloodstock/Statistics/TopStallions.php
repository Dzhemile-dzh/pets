<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 5/27/2016
 * Time: 3:28 PM
 */

namespace Tests\Stubs\Bo\Bloodstock\Statistics;

class TopStallions extends \Bo\Bloodstock\Statistics\TopStallions
{
    /**
     * @return \Models\Bo\Bloodstock\StallionStatistics\Horses
     *
     * @codeCoverageIgnore
     */
    protected function getModelTopStatistics()
    {
        return new \Tests\Stubs\Models\Bo\Bloodstock\StallionStatistics\Horses();
    }
}
