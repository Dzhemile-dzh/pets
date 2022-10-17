<?php

namespace Bo\Bloodstock\Stallion;

use Bo\Bloodstock\Statistics;
use \Api\Constants\Horses as Constants;

/**
 * Class SaleStatistics
 * @package Bo\Bloodstock\Stallion
 */
class SaleStatistics extends Statistics
{
    const MAX_PRICE = 600000000;
    const PRICE_RATIO = 1.05;
    const FLOAT_PRECISION = 2;

    const ROW_CLASS = '\Api\Row\Bloodstock\Stallion\SaleStatistics';
    const ROW_CLASS_CHILDREN = '\Api\Row\Bloodstock\Stallion\SaleStatistics';

    protected $overall;

    /**
     * @var array
     */
    protected static $sireStructure = [
        'sale_year' => null,
        'horse_sex_flag' => null,
        'buyer_detail' => null,
        'price' => null,
        'exchange_rate' => null,
        'currency_code' => null,
        'cur_code' => null,
        'median' => 0,
        'prices' => [],
        'price_max' => 0,
        'price_min' => self::MAX_PRICE,
        'price_average' => 0,
        'price_total' => 0,
        'price_count' => 0,
        'sales_count' => 0,
        'buyers_count' => 0,
        'withdraws_count' => 0,
        'total_count' => 0,
        'offered_count' => 0,

        'colts' => null,
        'fillies' => null,
    ];

    /**
     * @var array
     */
    protected static $childrenStructure = [
        'sale_year' => null,
        'horse_sex_flag' => null,
        'buyer_detail' => null,
        'price' => null,
        'exchange_rate' => null,
        'currency_code' => null,
        'cur_code' => null,
        'median' => 0,
        'prices' => [],
        'price_max' => 0,
        'price_min' => self::MAX_PRICE,
        'price_average' => 0,
        'price_total' => 0,
        'price_count' => 0,
        'sales_count' => 0,
        'sold' => false,
        'buyers_count' => 0,
        'withdraws_count' => 0,
        'total_count' => 0,
        'offered_count' => 0,
    ];

    /**
     * @return \Api\DataProvider\Bo\Bloodstock\Stallion\SaleStatistics
     */
    protected function getSaleStatisticsDataProvider()
    {
        return new \Api\DataProvider\Bo\Bloodstock\Stallion\SaleStatistics();
    }

    /**
     * @return \Api\Row\Bloodstock\Stallion\SaleStatistics[]
     */
    public function getRows()
    {
        return $this->getSaleStatisticsDataProvider()->getSaleStatistics($this->request);
    }

    /**
     * @param array $rows
     *
     * @return mixed
     */
    public function prepareRows(array $rows)
    {
        $result = [
            'overall' => null,
            'sale_statistics' => null,
        ];

        if (empty($rows)) {
            return $result;
        }

        $elements = [];
        foreach ($this->generatorElement($rows) as $element) {
            $this->setGeneralProperties($element->colts, true);
            $this->setGeneralProperties($element->fillies, true);
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
                'sale_statistics' => $elements,
            ];
        }

        return $result;
    }

    /**
     * @param string    $buyerDetail
     * @param float     $price
     * @param           $element
     */
    public static function setBuyerProps($buyerDetail, $price, $element)
    {
        $element->total_count += 1;
        if ($buyerDetail !== '') {
            $element->buyers_count += 1;
        }
        if (strpos($buyerDetail, 'WITHDRAWN') !== false) {
            $element->withdraws_count += 1;
        }
        $element->sold = false;
        if (strpos($buyerDetail, 'VENDOR') === false
            && (strpos($buyerDetail, 'CASH') !== false
                || ($price > 0
                    && !SaleStatistics::isSubStringExistsInAnyOfArray($buyerDetail, ['NOTSOLD', 'WITHDRAWN', 'NOBID'])))
        ) {
            $element->sales_count += 1;
            $element->sold = true;
        }
    }

    /**
     * @param string $string
     * @param array $array
     * @return bool
     */
    private static function isSubStringExistsInAnyOfArray($string, $array)
    {
        foreach ($array as $item) {
            if (strpos($string, $item) !== false) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param float     $price
     * @param           $element
     */
    public static function setPriceProps($price, $element)
    {
        if (!$element->sold) {
            return;
        }
        if ($price) {
            $element->prices[] = $price;
            $element->price_total += $price;
            $element->price_count++;
            if ($price > $element->price_max) {
                $element->price_max = $price;
            }
            if ($price < $element->price_min) {
                $element->price_min = $price;
            }
        }
    }

    /**
     * @param array      $prices
     * @param bool|false $sort
     *
     * @return float
     */
    public static function getMedian(&$prices, $sort = false)
    {
        if (empty($prices)) {
            return null;
        }
        $cntPrises = count($prices);
        if ($cntPrises === 1) {
            return $prices[0];
        }
        if ($sort) {
            sort($prices);
        }
        if ($cntPrises % 2) {
            $median = $prices[floor($cntPrises / 2)];
        } else {
            $median = ($prices[$cntPrises / 2] + $prices[($cntPrises / 2) - 1]) / 2;
        }

        return $median;
    }

    /**
     * @param $element
     * @param $row
     * @param $nextRow
     * @param $cnt
     */
    protected function fillElement($element, $row, $nextRow, $cnt)
    {

        if (!$this->overall) {
            $this->overall = $this->getElementObject();
        }
        $price = static::getPrice($row);
        $buyer = strtoupper(str_replace(' ', '', (string)$row->buyer_detail));


        if ($row->horse_sex_flag === Constants::HORSE_SEX_FLAG_MALE) {
            $entityName = 'colts';
        } else {
            $entityName = 'fillies';
        }

        $child = $element->{$entityName};
        $childOverall = $this->overall->{$entityName};

        static::cloneProperties($element, $row);
        static::setBuyerProps($buyer, $price, $element);
        static::setPriceProps($price, $element);

        static::cloneProperties($child, $row);
        static::setBuyerProps($buyer, $price, $child);
        static::setPriceProps($price, $child);

        static::setBuyerProps($buyer, $price, $this->overall);
        static::setPriceProps($price, $this->overall);
        static::setBuyerProps($buyer, $price, $childOverall);
        static::setPriceProps($price, $childOverall);
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
        return $cnt === 1 || !isset($nextRow) || $row->sale_year !== $nextRow->sale_year;
    }

    /**]
     * @return array
     */
    protected static function getElementStructure()
    {
        $rowChildrenClass = static::ROW_CLASS_CHILDREN;
        static::$sireStructure['colts'] = $rowChildrenClass::createFromArray(static::$childrenStructure);
        static::$sireStructure['fillies'] = $rowChildrenClass::createFromArray(static::$childrenStructure);

        return static::$sireStructure;
    }

    /**
     * @param $element
     * @param bool $sort
     */
    protected function setGeneralProperties($element, $sort = false)
    {
        if (!isset($element)) {
            return;
        }

        $prices = $element->prices;

        $element->median = empty($prices) ? null : round(static::getMedian($prices, $sort), static::FLOAT_PRECISION);
        $element->price_average = empty($prices)
            ? null
            : round($element->price_total / $element->price_count, static::FLOAT_PRECISION);
        $element->price_max = $element->price_max === 0 ? null : $element->price_max;
        $element->price_min = $element->price_min === static::MAX_PRICE ? null : $element->price_min;
        $element->offered_count =
            $element->total_count - $element->withdraws_count - ($element->total_count
                - $element->buyers_count);

        if (isset($element->colts) && isset($element->fillies)) {
            if ($element->colts->total_count === 0) {
                $element->colts = null;
            }
            if ($element->fillies->total_count === 0) {
                $element->fillies = null;
            }
        }
    }

    /**
     * @param \Api\Row\Bloodstock\Stallion\SaleStatistics $row
     *
     * @return float
     */
    protected static function getPrice($row)
    {
        return round((float)$row->price, self::FLOAT_PRECISION);
    }

    /**
     * @param $element
     * @param $row
     */
    protected static function cloneProperties($element, $row)
    {
        $element->sale_year = $row->sale_year;
        $element->horse_sex_flag = $row->horse_sex_flag;
        $element->buyer_detail = $row->buyer_detail;
        $element->price = $row->price;
        $element->exchange_rate = $row->exchange_rate;
        $element->currency_code = $row->currency_code;
        $element->cur_code = $row->cur_code;
    }
}
