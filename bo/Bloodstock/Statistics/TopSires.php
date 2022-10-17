<?php

namespace Bo\Bloodstock\Statistics;

use Models\Bo\Bloodstock\StallionStatistics\Horses as ModelStatistics;

/**
 * Class TopSires
 * @package Bo\Bloodstock\Statistics
 */
class TopSires extends \Bo\Bloodstock\Statistics
{
    const ROW_CLASS = '\Phalcon\Mvc\Model\Row\General';

    /**
     * @var array
     */
    private static $elementStructure = [
        'sire_uid' => null,
        'sire_name' => null,
        'sire_country_origin_code' => null,
        'best_horse_uid' => null,
        'best_horse_name' => null,
        'best_horse_country_origin_code' => null,
        'runners' => 0,
        'rated_80_plus' => [],
        'rated_100_plus' => [],
        'rated_115_plus' => [],
        'rated_125_plus' => [],
        'rated_150_plus' => [],
        'best_rp_postmark' => 0
    ];

    /**
     * @return array
     * @throws \Exception
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getRows()
    {
        return $this->getModel()->getTopSires($this->request);
    }

    /**
     * @param array $rows
     * @return array|null
     */
    public function prepareRows(array $rows)
    {
        if (empty(count($rows))) {
            return null;
        }

        $rtn = [];

        foreach ($this->generatorElement($rows) as $element) {
            if ($element->runners < 15) {
                continue;
            }

            $element->rated_80_plus = count($element->rated_80_plus);
            $element->rated_100_plus = count($element->rated_100_plus);
            $element->rated_115_plus = count($element->rated_115_plus);
            $element->rated_125_plus = count($element->rated_125_plus);
            $element->rated_150_plus = count($element->rated_150_plus);

            $element->percent_rated_80_plus = round($element->rated_80_plus / $element->runners * 100);
            $element->percent_rated_100_plus = round($element->rated_100_plus / $element->runners * 100);
            $element->percent_rated_115_plus = round($element->rated_115_plus / $element->runners * 100);
            $element->percent_rated_125_plus = round($element->rated_125_plus / $element->runners * 100);
            $element->percent_rated_150_plus = round($element->rated_150_plus / $element->runners * 100);

            $rtn[] = $element;
        }
        usort($rtn, [$this, 'orderRowsByPercent115']);
        return $rtn;
    }

    /**
     * @return array
     */
    protected static function getElementStructure()
    {
        return static::$elementStructure;
    }

    /**
     * @param $element
     * @param $row
     * @param $nextRow
     * @param $cnt
     */
    protected function fillElement($element, $row, $nextRow, $cnt)
    {
        $element->sire_uid = $row->sire_uid;
        $element->sire_name = $row->sire_name;
        $element->country_origin_code = $row->sire_country_origin_code;

        if ($row->rp_postmark > $element->best_rp_postmark) {
            $element->best_rp_postmark = $row->rp_postmark;
            $element->best_horse_name = $row->style_name;
            $element->best_horse_uid = $row->horse_uid;
            $element->best_horse_country_origin_code = $row->sire_country_origin_code;
        }

        if ($row->rp_postmark >= 80 && !in_array($row->horse_uid, $element->rated_80_plus)) {
            $element->rated_80_plus[$row->horse_uid] = $row->horse_uid;
        }
        if ($row->rp_postmark >= 100 && !in_array($row->horse_uid, $element->rated_100_plus)) {
            $element->rated_100_plus[$row->horse_uid] = $row->horse_uid;
        }
        if ($row->rp_postmark >= 115 && !in_array($row->horse_uid, $element->rated_115_plus)) {
            $element->rated_115_plus[$row->horse_uid] = $row->horse_uid;
        }
        if ($row->rp_postmark >= 125 && !in_array($row->horse_uid, $element->rated_125_plus)) {
            $element->rated_125_plus[$row->horse_uid] = $row->horse_uid;
        }
        if ($row->rp_postmark >= 150 && !in_array($row->horse_uid, $element->rated_150_plus)) {
            $element->rated_150_plus[$row->horse_uid] = $row->horse_uid;
        }

        if ($cnt === 1 || !isset($nextRow) || $row->horse_uid !== $nextRow->horse_uid) {
            $element->runners++;
        }
    }

    /**
     * @param $row
     * @param $nextRow
     * @param $cnt
     * @return bool
     */
    protected function isNeedSwitchToNextElement($row, $nextRow, $cnt)
    {
        return $cnt === 1 || !isset($nextRow) || $row->sire_uid !== $nextRow->sire_uid;
    }

    /**
     * @param $rowA
     * @param $rowB
     *
     * @return int
     */
    private function orderRowsByPercent115($rowA, $rowB)
    {
        if ($rowA->percent_rated_115_plus == $rowB->percent_rated_115_plus) {
            return $this->orderRowsByPercent100($rowA, $rowB);
        } else {
            return $rowA->percent_rated_115_plus > $rowB->percent_rated_115_plus ? -1 : 1;
        }
    }

    /**
     * @param $rowA
     * @param $rowB
     *
     * @return int
     */
    private function orderRowsByPercent100($rowA, $rowB)
    {
        if ($rowA->percent_rated_100_plus == $rowB->percent_rated_100_plus) {
            return $this->orderRowsByPercent80($rowA, $rowB);
        } else {
            return $rowA->percent_rated_100_plus > $rowB->percent_rated_100_plus ? -1 : 1;
        }
    }

    /**
     * @param $rowA
     * @param $rowB
     *
     * @return int
     */
    private function orderRowsByPercent80($rowA, $rowB)
    {
        if ($rowA->percent_rated_80_plus == $rowB->percent_rated_80_plus) {
            return $this->orderRowsBySireName($rowA, $rowB);
        } else {
            return $rowA->percent_rated_80_plus > $rowB->percent_rated_80_plus ? -1 : 1;
        }
    }

    /**
     * @param $rowA
     * @param $rowB
     *
     * @return int
     */
    private function orderRowsBySireName($rowA, $rowB)
    {
        return $rowA->sire_name < $rowB->sire_name ? -1 : 1;
    }

    /**
     * @return ModelStatistics
     */
    protected function getModel()
    {
        return new ModelStatistics();
    }
}
