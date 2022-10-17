<?php

namespace Tests\Stubs\Bo\Profile\Jockey;

/**
 * Class SeasonsAvailable
 * @package Tests\Stubs\Bo\Profile\Jockey
 */
class SeasonsAvailable extends \Bo\Profile\Jockey\SeasonsAvailable
{
    /**
     * @return \Tests\Stubs\DataProvider\Bo\Profile\Jockey\SeasonsAvailable
     */
    protected function getDataProviderSeasonsAvailable()
    {
        return new \Tests\Stubs\DataProvider\Bo\Profile\Jockey\SeasonsAvailable();
    }
}
