<?php

namespace Bo\Bloodstock\SalesStatistics;

use Bo\Bloodstock\Stallion\SaleStatistics;
use Api\DataProvider\Bo\Bloodstock\SalesStatistics\Buyers as BuyersDataSet;

/**
 * Class Buyers
 *
 * @package Bo\Bloodstock\SalesStatistics
 */
class Buyers extends SaleStatistics
{
    const ROW_CLASS = '\Phalcon\Mvc\Model\Row\General';
    const ROW_CLASS_CHILDREN = '\Phalcon\Mvc\Model\Row\General';

    protected static $buyerStructure = [
        'buyer_detail' => null,
        'search_buyer_detail' => null,

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

        'entities' => null,
    ];

    protected static $entityStructure = [
        'lot_no' => 0,
        'lot_letter' => null,
        'horse_uid' => null,
        'horse_style_name' => null,
        'horse_first_colour_code' => null,
        'horse_sex' => null,
        'horse_age' => null,
        'sire_uid' => null,
        'sire_style_name' => null,
        'dam_uid' => null,
        'dam_style_name' => null,
        'sire_of_dam_uid' => null,
        'sire_of_dam_style_name' => null,

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
        return $this->getBuyersDataSet()->getBuyers($this->request);
    }

    /**
     * @param array $rows
     *
     * @return null|object
     */
    public function prepareRows(array $rows)
    {
        if (empty(count($rows))) {
            return null;
        }

        $buyers = [];
        foreach ($this->generatorElement($rows) as $element) {
            $this->setGeneralProperties($element, true);
            if ($element->sales_count > 0) {
                usort($element->entities, [$this, 'sortEntities']);
                $buyers[] = $element;
            }
        }
        if (isset($element)) {
            $this->setGeneralProperties($this->overall, true);
            usort($buyers, [$this, 'sortBuyers']);
        }

        return isset($this->overall->sales_count) && $this->overall->sales_count > 0 ? (Object)[
            'overall' => $this->overall,
            'buyers' => $buyers,
        ] : null;
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

        static::cloneProperties($element, $row);
        static::setBuyerProps($buyer, $price, $element);
        static::setPriceProps($price, $element);

        $entity = $this->getChildStructure();
        static::cloneProperties($entity, $row);
        static::setBuyerProps($buyer, $price, $entity);
        static::setPriceProps($price, $entity);

        static::setBuyerProps($buyer, $price, $this->overall);
        static::setPriceProps($price, $this->overall);

        $element->entities[] = $entity;
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
        return $cnt === 1 || !isset($nextRow) || $row->search_buyer_detail !== $nextRow->search_buyer_detail;
    }

    /**
     * @param $element
     * @param $row
     */
    protected static function cloneProperties($element, $row)
    {
        $element->buyer_detail = $row->buyer_detail;
        $element->search_buyer_detail = $row->search_buyer_detail;
        $element->price = $row->price;
        $element->horse_sex = $row->horse_sex;
        $element->horse_age = $row->horse_age;
        $element->horse_first_colour_code = $row->horse_first_colour_code;
        $element->lot_no = $row->lot_no;
        $element->lot_letter = trim($row->lot_letter) ?: null;

        $element->horse_uid = $row->horse_uid;
        $element->horse_name = $row->horse_name;
        $element->horse_style_name = $row->horse_style_name;

        $element->sire_uid = $row->sire_uid;
        $element->sire_name = $row->sire_name;
        $element->sire_style_name = $row->sire_style_name;

        $element->dam_uid = $row->dam_uid;
        $element->dam_name = $row->dam_name;
        $element->dam_style_name = $row->dam_style_name;

        $element->sire_of_dam_uid = $row->sire_of_dam_uid;
        $element->sire_of_dam_name = $row->sire_of_dam_name;
        $element->sire_of_dam_style_name = $row->sire_of_dam_style_name;

        $element->exchange_rate = $row->exchange_rate;
        $element->currency_code = $row->currency_code;
        $element->cur_code = $row->cur_code;
    }

    /**
     * @return array
     */
    protected static function getElementStructure()
    {
        static::$buyerStructure['entities'] = [];

        return static::$buyerStructure;
    }

    /**
     * @return mixed
     */
    protected static function getChildStructure()
    {
        $rowChildrenClass = static::ROW_CLASS_CHILDREN;

        return $rowChildrenClass::createFromArray(static::$entityStructure);
    }

    /**
     * @param \Api\Row\Bloodstock\Stallion\SaleStatistics $row
     *
     * @return float
     */
    protected static function getPrice($row)
    {
        return round((float)$row->price, Buyers::FLOAT_PRECISION);
    }

    /**
     * @return BuyersDataSet
     */
    protected function getBuyersDataSet()
    {
        return new BuyersDataSet();
    }

    /**
     * @param $entityA
     * @param $entityB
     *
     * @return int
     */
    private function sortEntities($entityA, $entityB)
    {
        return $entityA->lot_no > $entityB->lot_no
            ? 1
            : ($entityA->lot_no < $entityB->lot_no
                ? -1
                : 0
            );
    }

    /**
     * @param $buyerA
     * @param $buyerB
     *
     * @return int
     */
    private function sortBuyers($buyerA, $buyerB)
    {
        if ($buyerA->price_total < $buyerB->price_total) {
            return 1;
        } elseif ($buyerA->price_total > $buyerB->price_total) {
            return -1;
        }

        if ($buyerA->search_buyer_detail > $buyerB->search_buyer_detail) {
            return 1;
        } elseif ($buyerA->search_buyer_detail < $buyerB->search_buyer_detail) {
            return -1;
        }

        return 0;
    }
}
