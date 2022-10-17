<?php

namespace Tests\Stubs\Bo\Profile\Trainer;

/**
 * Class SeasonsAvailable
 * @package Tests\Stubs\Bo\Profile\Trainer
 */
class SeasonsAvailable extends \Bo\Profile\Trainer\SeasonsAvailable
{
    /**
     * @return \Tests\Stubs\DataProvider\Bo\Profile\Trainer\SeasonsAvailable
     */
    protected function getDataProviderSeasonsAvailable()
    {
        return new \Tests\Stubs\DataProvider\Bo\Profile\Trainer\SeasonsAvailable();
    }
}
