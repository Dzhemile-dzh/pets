<?php

namespace Tests\Stubs\Bo\LookupTable;

use Tests\Stubs\DataProvider\Bo\LookupTable\SalesVenues as DataProvider;

/**
 * @package Tests\Stubs\Bo\LookupTable
 */
class SalesVenues extends \Bo\LookupTable\SalesVenues
{
    /**
     * @inheritdoc
     */
    protected function getDataProvider()
    {
        return new DataProvider();
    }
}
