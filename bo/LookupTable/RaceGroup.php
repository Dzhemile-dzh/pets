<?php

namespace Bo\LookupTable;

use Api\DataProvider\Bo\LookupTable\RaceGroup as DataProvider;

/**
 * @package Bo\LookupTable
 */
class RaceGroup extends \Bo\LookupTable
{
    /**
     * @return DataProvider
     */
    protected function getDataProvider()
    {
        return new DataProvider();
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->getDataProvider()->getData();
    }
}
