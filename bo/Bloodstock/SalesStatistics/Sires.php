<?php

namespace Bo\Bloodstock\SalesStatistics;

use Bo\Bloodstock\Stallion\SaleStatistics;
use Api\DataProvider\Bo\Bloodstock\SalesStatistics\Sires as SireDataSet;

/**
 * Class Sires
 * @package Bo\Bloodstock\SalesStatistics
 */
class Sires extends SaleStatistics
{
    const ROW_CLASS = '\Phalcon\Mvc\Model\Row\General';
    const ROW_CLASS_CHILDREN = '\Phalcon\Mvc\Model\Row\General';
    /**
     * @var array
     */
    protected static $sireStructure = [
        'sire_uid' => null,
        'sire_name' => null,
        'sire_style_name' => null,

        'median' => 0,
        'price_average' => 0,
        'price_max' => 0,
        'price_min' => SaleStatistics::MAX_PRICE,
        'price_total' => 0,
        'price_count' => 0,
        'price_top' => 0,
        'prices' => [],
        'sales_count' => 0,
        'sold' => false,
        'offered_count' => 0,
        'buyers_count' => 0,
        'withdraws_count' => 0,
        'total_count' => 0,
        'cur_code' => null,

        'colts' => null,
        'fillies' => null,
    ];

    /**
     * @var array
     */
    protected static $childrenStructure = [
        'median' => 0,
        'price_average' => 0,
        'price_max' => 0,
        'price_min' => SaleStatistics::MAX_PRICE,
        'price_total' => 0,
        'price_count' => 0,
        'price_top' => 0,
        'prices' => [],
        'sales_count' => 0,
        'sold' => false,
        'offered_count' => 0,
        'buyers_count' => 0,
        'withdraws_count' => 0,
        'total_count' => 0,
    ];
    /**
     * @return array
     */
    public function getRows()
    {
        return $this->getSireDataSet()->getSires($this->request);
    }

    /**
     * @param $row
     * @param $nextRow
     * @param $cnt
     *
     * @return bool
     */
    protected function isNeedSwitchToNextElement($row, $nextRow, $cnt)
    {
        return $cnt === 1 || !isset($nextRow) || $row->sire_uid !== $nextRow->sire_uid;
    }

    /**
     * @param  $row
     *
     * @return float
     */
    protected static function getPrice($row)
    {
        return round((float)$row->price, static::FLOAT_PRECISION);
    }

    /**
     * @param $element
     * @param $row
     */
    protected static function cloneProperties($element, $row)
    {
        $element->sire_uid = $row->sire_uid;
        $element->sire_name = $row->sire_name;
        $element->sire_style_name = $row->sire_style_name;
        $element->sale_year = $row->sale_year;
        $element->horse_sex_flag = $row->horse_sex_flag;
        $element->buyer_detail = $row->buyer_detail;
        $element->price = $row->price;
        $element->exchange_rate = $row->exchange_rate;
        $element->currency_code = $row->currency_code;
        $element->cur_code = $row->cur_code;
    }

    /**
     * @return SireDataSet
     */
    protected function getSireDataSet()
    {
        return new SireDataSet();
    }

    /**
     * @param array $rows
     *
     * @return mixed
     */
    public function prepareRows(array $rows)
    {
        $result = null;

        if (empty($rows)) {
            return $result;
        }

        $elements = [];
        foreach ($this->generatorElement($rows) as $element) {
            $this->setGeneralProperties($element->colts);
            $this->setGeneralProperties($element->fillies);
            $this->setGeneralProperties($element, true);
            $elements[] = $element;
        }

        if (!empty($elements)) {
            $this->overall->sale_year = 'overall';
            $this->overall->colts->sale_year = 'overall';
            $this->overall->fillies->sale_year = 'overall';

            $this->setGeneralProperties($this->overall->colts, true);
            $this->setGeneralProperties($this->overall->fillies, true);
            $this->setGeneralProperties($this->overall, true);

            $result = [
                'overall' => $this->overall,
                'sires' => $elements
            ];
        }

        return $result;
    }
}
