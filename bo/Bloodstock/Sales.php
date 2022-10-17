<?php

namespace Bo\Bloodstock;

use Api\DataProvider\Bo\Bloodstock\Sales\Catalogue\Index;
use Api\DataProvider\Bo\Bloodstock\Sales\Catalogue\PreviouslySold;
use Api\DataProvider\Bo\Bloodstock\Sales\SalesCompaniesList;
use Api\DataProvider\Bo\Bloodstock\Sales\Catalogue\Vendors;
use Api\DataProvider\Bo\Bloodstock\Sales as DPSales;
use Api\Input\Request\Horses\Bloodstock\Sales as Request;
use Models\Bo\Bloodstock\Sales\BloodstockSale;
use Phalcon\Mvc\Model\Resultset\General;

/**
 * Class Sales
 *
 * @package Bo\Bloodstock
 */
class Sales extends \Bo\Standart
{
    /**
     * @param Request\UpcomingSales $request
     *
     * @return mixed
     */
    public function getUpcomingSales(Request\UpcomingSales $request)
    {
        $upcomingSales = $this->getDataProviderSale()->getUpcomingSales($request);
        $racesUids = $this->getDataProviderSale()->getUpcomingSalesEntryRacesUids();

        foreach ($upcomingSales as $upcomingSale) {
            $upcomingSale->entry_race_uid = null;

            if (!array_key_exists($upcomingSale->horse_uid, $racesUids)) {
                continue;
            }

            foreach ($racesUids[$upcomingSale->horse_uid] as $item) {
                $upcomingSale->entry_race_uid[] = $item->entry_race_uid;
            }
        }

        return $upcomingSales;
    }

    /**
     * @return DPSales
     * @codeCoverageIgnore
     */
    protected function getDataProviderSale()
    {
        return new DPSales();
    }

    /**
     * @param Request\SalesResults $request
     *
     * @return mixed
     */
    public function getSalesResults(Request\SalesResults $request)
    {
        $salesDP = $this->getDataProviderSale();
        $sales = $salesDP->getSalesResults($request);

        $salesIds = [];
        $horsesIds = [];

        foreach ($sales as $id => $sale) {
            if ($sale->entered == 'Y' && !is_null($sale->horse_uid)) {
                $salesIds[] = $id;
                $horsesIds[] = $sale->horse_uid;
            }
        }
        if (!empty($horsesIds)) {
            $races = $salesDP->getEnteredRaces($horsesIds);

            foreach ($salesIds as $id) {
                $sale = $sales[$id];
                if (array_key_exists($sale->horse_uid, $races)) {
                    $sales[$id]->entered_races = $races[$sale->horse_uid];
                }
            }
        }

        return $sales;
    }

    /**
     * @param $request
     *
     * @return array
     */
    public function getCatalogueSires($request)
    {
        return $this->getModelBloodstockSale()->getCatalogueSires($request);
    }

    /**
     * @return BloodstockSale
     * @codeCoverageIgnore
     */
    protected function getModelBloodstockSale()
    {
        return new BloodstockSale();
    }

    /**
     * @return \Phalcon\Mvc\Model\Row\General[]
     */
    public function getCatalogue()
    {
        $result = [];
        $catalogueRows = $this->getDataProviderCatalogueIndex()->getCatalogue($this->request);

        $count = count($catalogueRows);
        for ($i = 0; $i < $count; $i++) {
            if (!isset($saleDate)) {
                $saleDate = $catalogueRows[$i]->sale_date;
            }

            $key = $saleDate . '_' . $catalogueRows[$i]->sale_name . '_' . $catalogueRows[$i]->venue_uid;
            if (!isset($result[$key])) {
                $result[$key] = $catalogueRows[$i];
            } else {
                $result[$key]->sale_end_date = $catalogueRows[$i]->sale_end_date;
                $result[$key]->total_lots += $catalogueRows[$i]->total_lots;
            }

            if ($this->isLastSale($catalogueRows, $i)) {
                unset($saleDate);
            }
        }

        usort($result, function ($a, $b) {
            $dateA = new \DateTime($a->sale_end_date);
            $dateB = new \DateTime($b->sale_end_date);
            if ($dateA > $dateB) {
                return -1;
            } elseif ($dateA < $dateB) {
                return 1;
            } else {
                if ($a->venue_uid < $b->venue_uid) {
                    return -1;
                } elseif ($a->venue_uid > $b->venue_uid) {
                    return 1;
                }

                return 0;
            }
        });

        return array_values($result);
    }

    /**
     * @return Index
     * @codeCoverageIgnore
     */
    protected function getDataProviderCatalogueIndex()
    {
        return new Index();
    }

    /**
     * @param $catalogueRows
     * @param $i
     *
     * @return bool
     */
    private function isLastSale($catalogueRows, $i)
    {
        if (isset($catalogueRows[$i + 1])) {
            $date = new \DateTime($catalogueRows[$i]->sale_date);
            $interval = $date->diff(new \DateTime($catalogueRows[$i + 1]->sale_date));
            if ($interval->days > 1 || $catalogueRows[$i]->sale_name != $catalogueRows[$i + 1]->sale_name) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return array
     */
    public function getVendors()
    {
        return $this->getDataProviderCatalogueVendors()->getVendors($this->request);
    }

    /**
     * @return Vendors
     * @codeCoverageIgnore
     */
    protected function getDataProviderCatalogueVendors()
    {
        return new Vendors();
    }

    /**
     * @return \Phalcon\Mvc\Model\Row\General[]
     */
    public function getPreviouslySold()
    {
        return $this->getDataProviderCataloguePreviouslySold()->getPreviouslySold($this->request);
    }

    /**
     * @return PreviouslySold
     * @codeCoverageIgnore
     */
    protected function getDataProviderCataloguePreviouslySold()
    {
        return new PreviouslySold();
    }

    /**
     * @param Request\UpcomingNames $request
     *
     * @return object
     */
    public function getUpcomingNames(Request\UpcomingNames $request)
    {
        $upcomingNames = $this->getDataProviderSale()->getUpcomingNames($request);

        $result = [
            'horse_names' => [],
            'sire_names' => [],
            'dam_names' => [],
            'damsire_names' => [],
            'vendor_names' => [],
        ];

        foreach ($upcomingNames as $row) {
            if (!is_null($row->horse_uid) || !is_null($row->horse_name)) {
                $result['horse_names'][] = (Object)[
                    'horse_uid' => $row->horse_uid,
                    'horse_name' => $row->horse_name,
                ];
            }

            if (!is_null($row->sire_uid) || !is_null($row->sire_name)) {
                $result['sire_names'][] = (Object)[
                    'sire_uid' => $row->sire_uid,
                    'sire_name' => $row->sire_name,
                ];
            }

            if (!is_null($row->dam_uid) || !is_null($row->dam_name)) {
                $result['dam_names'][] = (Object)[
                    'dam_uid' => $row->dam_uid,
                    'dam_name' => $row->dam_name,
                ];
            }

            if (!is_null($row->damsire_uid) || !is_null($row->damsire_name)) {
                $result['damsire_names'][] = (Object)[
                    'damsire_uid' => $row->damsire_uid,
                    'damsire_name' => $row->damsire_name,
                ];
            }

            if (!is_null($row->vendor_name)) {
                $result['vendor_names'][] = (Object)[
                    'vendor_name' => $row->vendor_name,
                ];
            }
        }

        $ret = [
            'horse_names' => empty($result['horse_names']) ? null
                : array_values(array_unique($result['horse_names'], SORT_REGULAR)),
            'sire_names' => empty($result['sire_names']) ? null
                : array_values(array_unique($result['sire_names'], SORT_REGULAR)),
            'dam_names' => empty($result['dam_names']) ? null
                : array_values(array_unique($result['dam_names'], SORT_REGULAR)),
            'damsire_names' => empty($result['damsire_names']) ? null
                : array_values(array_unique($result['damsire_names'], SORT_REGULAR)),
            'vendor_names' => empty($result['vendor_names']) ? null
                : array_values(array_unique($result['vendor_names'], SORT_REGULAR)),
        ];

        return (Object)$ret;
    }

    /**
     * @return \Phalcon\Mvc\Model\Row\General[]
     */
    public function getSalesCompaniesList(Request\CompanyNames $request)
    {
        return $this->getDataProviderSale()->getSalesCompaniesList($request);
    }
}
