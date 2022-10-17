<?php

namespace Tests\Stubs\Bo\Bloodstock;

use Api\Input\Request\Horses\Bloodstock\Sales as Request;
use Tests\Stubs\DataProvider\Bo\Bloodstock\Sales\Catalogue\Index;
use Tests\Stubs\DataProvider\Bo\Bloodstock\Sales\Catalogue\PreviouslySold;
use Tests\Stubs\DataProvider\Bo\Bloodstock\Sales\Catalogue\Vendors;
use Tests\Stubs\DataProvider\Bo\Bloodstock\Sales\SalesCompaniesList;
use Tests\Stubs\Models\Bo\Bloodstock\Sales\Catalogue;
use Tests\Stubs\DataProvider\Bo\Bloodstock\Sales as DPSales;

class Sales extends \Bo\Bloodstock\Sales
{
    /**
     * @return \Tests\Stubs\Models\Bo\Bloodstock\Sales\BloodstockSale
     */
    public function getModelBloodstockSale()
    {
        return new \Tests\Stubs\Models\Bo\Bloodstock\Sales\BloodstockSale();
    }

    /**
     * @return Index
     */
    protected function getDataProviderCatalogueIndex()
    {
        return new Index();
    }

    /**
     * @return Vendors
     */
    protected function getDataProviderCatalogueVendors()
    {
        return new Vendors();
    }

    /**
     * @return PreviouslySold
     */
    protected function getDataProviderCataloguePreviouslySold()
    {
        return new PreviouslySold();
    }

    protected function getDataProviderSale()
    {
        return new DPSales();
    }
}
