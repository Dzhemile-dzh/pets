<?php

namespace Bo\Bloodstock\SalesStatistics;

use Bo\Bloodstock\Stallion\SaleStatistics;
use Api\DataProvider\Bo\Bloodstock\SalesStatistics\Sales as SalesDataSet;
use \Api\Constants\Horses as Constants;

/**
 * Class Sales
 * @package Bo\Bloodstock\SalesStatistics
 */
class Sales extends SaleStatistics
{
    const ROW_CLASS = '\Phalcon\Mvc\Model\Row\General';
    const ROW_CLASS_CHILDREN = '\Phalcon\Mvc\Model\Row\General';

    private $colts = null;
    private $fillies = null;

    protected static $structure = [
        'sale_date' => null,
        'median' => 0,
        'price_average' => 0,
        'price_max' => 0,
        'price_min' => SaleStatistics::MAX_PRICE,
        'price_total' => 0,
        'price_top' => 0,
        'prices' => [],
        'price_count' => 0,
        'sales_count' => 0,
        'sold' => false,
        'offered_count' => 0,
        'buyers_count' => 0,
        'withdraws_count' => 0,
        'total_count' => 0,
        'cur_code' => null,
    ];

    /**
     * @return array
     */
    public function getRows()
    {
        return $this->getSalesDataSet()->getSales($this->request);
    }

    /**
     * @param array $rows
     *
     * @return null|object
     */
    public function prepareRows(array $rows)
    {
        if (empty($rows)) {
            return null;
        }

        $days = [];

        foreach ($this->generatorElement($rows) as $element) {
            $this->setGeneralProperties($element, true);
            $days[] = $element;
        }

        if (isset($element)) {
            $this->setGeneralProperties($this->overall, true);
            $this->setGeneralProperties($this->colts, true);
            $this->setGeneralProperties($this->fillies, true);
        }

        $result = [
            'days' => $days,
            'overall' => $this->overall,
            'colts' => $this->colts,
            'fillies' => $this->fillies,
        ];

        return (Object)$result;
    }

    /**
     * @return SalesDataSet
     */
    protected function getSalesDataSet()
    {
        return new SalesDataSet();
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
        if (!$this->{$entityName}) {
            $this->{$entityName} = $this->getElementObject();
        }

        $child = $this->{$entityName};

        static::cloneProperties($element, $row);
        static::setBuyerProps($buyer, $price, $element);
        static::setPriceProps($price, $element);

        static::cloneProperties($this->overall, $row);
        static::setBuyerProps($buyer, $price, $this->overall);
        static::setPriceProps($price, $this->overall);

        static::cloneProperties($child, $row);
        static::setBuyerProps($buyer, $price, $child);
        static::setPriceProps($price, $child);
    }

    /**
     * @param \Api\Row\Bloodstock\Stallion\SaleStatistics $row
     *
     * @return float
     */
    protected static function getPrice($row)
    {
        return round((float)$row->price, static::FLOAT_PRECISION);
    }

    /**
     * @param $row
     * @param $nextRow
     * @param $cnt
     * @return bool
     */
    protected function isNeedSwitchToNextElement($row, $nextRow, $cnt)
    {
        return $cnt === 1 || !isset($nextRow) || $row->sale_date !== $nextRow->sale_date;
    }

    /**
     * @return array
     */
    protected static function getElementStructure()
    {
        return static::$structure;
    }

    /**
     * @param $element
     * @param $row
     */
    protected static function cloneProperties($element, $row)
    {
        $element->sale_date = $row->sale_date;
        $element->horse_sex_flag = $row->horse_sex_flag;
        $element->buyer_detail = $row->buyer_detail;
        $element->price = $row->price;
        $element->exchange_rate = $row->exchange_rate;
        $element->currency_code = $row->currency_code;
        $element->cur_code = $row->cur_code;
    }
}
