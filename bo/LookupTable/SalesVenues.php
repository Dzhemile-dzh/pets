<?php

namespace Bo\LookupTable;

use Api\DataProvider\Bo\LookupTable\SalesVenues as DataProvider;

/**
 * @package Bo\LookupTable
 */
class SalesVenues extends \Bo\LookupTable
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
