<?php

namespace Tests\Stubs\Bo\Profile\Owner;

/**
 * Class SeasonsAvailable
 * @package Tests\Stubs\Bo\Profile\Owner
 */
class SeasonsAvailable extends \Bo\Profile\Owner\SeasonsAvailable
{
    /**
     * @return \Tests\Stubs\DataProvider\Bo\Profile\Owner\SeasonsAvailable
     */
    protected function getDataProviderSeasonsAvailable()
    {
        return new \Tests\Stubs\DataProvider\Bo\Profile\Owner\SeasonsAvailable();
    }
}
