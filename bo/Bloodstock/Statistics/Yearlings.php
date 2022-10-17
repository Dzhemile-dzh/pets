<?php

namespace Bo\Bloodstock\Statistics;

use Bo\Bloodstock\Stallion\SaleStatistics;
use Models\Bo\Bloodstock\StallionStatistics\Horses as ModelStatistics;
use \Api\Constants\Horses as Constants;

/**
 * Class Yearlings
 *
 * @package Bo\Bloodstock\Statistics
 */
class Yearlings extends \Bo\Bloodstock\Statistics
{
    const ROW_CLASS_CHILDREN = '\Phalcon\Mvc\Model\Row\General';

    /**
     * @var array
     */
    private static $sireStructure = [
        'sire_uid' => null,
        'sire_name' => null,
        'style_name' => null,
        'country_origin_code' => null,
        'colts' => null,
        'fillies' => null,
    ];

    /**
     * @var array
     */
    private static $childrenStructure = [
        'median' => 0,
        'price_average' => 0,
        'price_total' => 0,
        'price_top' => 0,
        'prices' => [],
        'sales_count' => 0,
        'offered_count' => 0,
        'percent_clearance_rate' => 0,
    ];

    /**
     * @return array
     */
    public function getRows()
    {
        return $this->getModel()->getYearlings($this->request);
    }

    /**
     * @param array $rows
     *
     * @return array|null
     */
    public function prepareRows(array $rows)
    {
        if (empty(count($rows))) {
            return null;
        }

        $rtn = [];

        foreach ($this->generatorElement($rows) as $element) {
            $this->setGeneralProperties($element->colts);
            $this->setGeneralProperties($element->fillies);

            $rtn[] = $element;
        }
        usort($rtn, [$this, 'orderRowsBySireName']);

        return $rtn;
    }

    /**
     * @param $element
     * @param $row
     * @param $nextRow
     * @param $cnt
     */
    protected function fillElement($element, $row, $nextRow, $cnt)
    {
        $element->sire_uid = $row->horse_uid;
        $element->sire_name = $row->sire_name;
        $element->style_name = $row->style_name;
        $element->country_origin_code = $row->country_origin_code;
        $price = self::getPrice($row, $this->request);

        if ($row->horse_sex === Constants::HORSE_SEX_CODE_COLT) {
            $entityName = 'colts';
        } elseif ($row->horse_sex === Constants::HORSE_SEX_CODE_FILLY) {
            $entityName = 'fillies';
        } else {
            return;
        }

        $element->{$entityName}->offered_count++;
        if (self::isSold($row)) {
            $element->{$entityName}->sales_count++;
            $element->{$entityName}->price_total += $price;
            $element->{$entityName}->prices[] = $price;
        }
    }

    /**
     * @param $element
     */
    private function setGeneralProperties($element)
    {
        $element->median = SaleStatistics::getMedian($element->prices);
        if ($element->sales_count > 0) {
            $element->price_average = round($element->price_total / $element->sales_count);
            $element->price_top = max($element->prices);
            $element->percent_clearance_rate = round(($element->sales_count / $element->offered_count) * 100);
        }
    }

    /**
     * @param $row
     *
     * @return bool
     */
    private static function isSold($row)
    {
        $buyer = strtoupper(str_replace(' ', '', (string)$row->buyer_detail));

        return $buyer != "NOTSOLD" && $buyer != "WITHDRAWN" && (float)$row->price > 0;
    }

    /**
     * @param $row
     * @param $request
     *
     * @return float
     */
    private static function getPrice($row, $request)
    {
        $price = $row->price;

        switch ($request->getCountryFlag()) {
            case 'GB':
            case 'IRE':
            case 'GB-IRE':
            case 'All':
                if ($row->cur_code != 'GNS') {
                    $price = $row->price / ($row->exchange_rate * SaleStatistics::PRICE_RATIO);
                } else {
                    $price = $row->price * $row->exchange_rate_db;
                }
                break;
            case 'Europe':
                if ($row->cur_code != 'EUR') {
                    $price = $row->price * $row->exchange_rate_db;
                }
                break;
            case 'USA':
                if ($row->cur_code != 'USD') {
                    $price = $row->price * $row->exchange_rate_db;
                }
                break;
            default:
        }

        return round($price);
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
        return $cnt === 1 || !isset($nextRow) || $row->horse_uid !== $nextRow->horse_uid;
    }

    /**
     * @return array
     */
    protected static function getElementStructure()
    {
        $rowChildrenClass = static::ROW_CLASS_CHILDREN;
        Yearlings::$sireStructure['colts'] = $rowChildrenClass::createFromArray(static::$childrenStructure);
        Yearlings::$sireStructure['fillies'] = $rowChildrenClass::createFromArray(static::$childrenStructure);

        return Yearlings::$sireStructure;
    }

    /**
     * @param $rowA
     * @param $rowB
     *
     * @return int
     */
    private function orderRowsBySireName($rowA, $rowB)
    {
        if ($rowA->sire_name == $rowB->sire_name) {
            return 0;
        }

        return ($rowA->sire_name < $rowB->sire_name) ? -1 : 1;
    }

    /**
     * @return ModelStatistics
     * @codeCoverageIgnore
     */
    protected function getModel()
    {
        return new ModelStatistics();
    }
}
