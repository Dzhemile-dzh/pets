<?php

namespace Tests\Stubs\Bo;

/**
 * Class VideoProviders
 *
 * @package Tests\Stubs\Bo
 */
class VideoProviders extends \Bo\VideoProviders
{
    /**
     * @return \Api\DataProvider\Bo\VideoProviders|null
     */
    protected function getDataProvider()
    {
        return new \Tests\Stubs\DataProvider\Bo\VideoProviders;
    }
}
