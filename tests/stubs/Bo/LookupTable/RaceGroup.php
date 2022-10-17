<?php

namespace Tests\Stubs\Bo\LookupTable;

use Tests\Stubs\DataProvider\Bo\LookupTable\RaceGroup as DataProvider;

/**
 * @package Tests\Stubs\Bo\LookupTable
 */
class RaceGroup extends \Bo\LookupTable\RaceGroup
{
    /**
     * @inheritdoc
     */
    protected function getDataProvider()
    {
        return new DataProvider();
    }
}
