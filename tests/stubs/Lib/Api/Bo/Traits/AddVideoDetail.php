<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 10/25/2017
 * Time: 5:56 PM
 */

namespace Tests\Stubs\Lib\Api\Bo\Traits;

use Api\Bo\Traits\AddVideoDetails;

/**
 * Class AddVideoDetail
 *
 * @package Tests\Stubs\Lib\Api\Bo\Traits
 */
class AddVideoDetail
{
    use AddVideoDetails;

    /**
     * @param array $raceIDs
     *
     * @return \Tests\Stubs\Bo\VideoProviders
     */
    protected function getVideoProviders($raceIDs)
    {
        return new \Tests\Stubs\Bo\VideoProviders($raceIDs);
    }
}
