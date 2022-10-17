<?php

namespace Bo\LookupTable;

use Api\DataProvider\Bo\LookupTable\HorseHeadGear as DataProvider;

/**
 * @package Bo\LookupTable
 */
class HorseHeadGear extends \Bo\LookupTable
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
