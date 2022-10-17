<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 5/27/2016
 * Time: 3:27 PM
 */

namespace Tests\Stubs\Bo\Bloodstock\Statistics;

class TopSires extends \Bo\Bloodstock\Statistics\TopSires
{
    /**
     * @return \Models\Bo\Bloodstock\StallionStatistics\Horses
     *
     * @codeCoverageIgnore
     */
    protected function getModel()
    {
        return new \Tests\Stubs\Models\Bo\Bloodstock\StallionStatistics\Horses();
    }
}
