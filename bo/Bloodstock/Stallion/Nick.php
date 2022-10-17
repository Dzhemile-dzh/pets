<?php

namespace Bo\Bloodstock\Stallion;

use Bo\Bloodstock\Statistics;

/**
 * Class Nick
 * @package Bo\Bloodstock\Stallion
 */
class Nick extends Statistics
{
    const ROW_CLASS = '\Api\Row\Bloodstock\Stallion\Nick';

    /**
     * @var array
     */
    private static $elementStructure = [
        'horse_uid' => null,
        'style_name' => null,
        'ancestor_uid' => null,
        'ancestor_name'=> null,
        'ancestor_country_origin_code' => null,
        'runs' => 0,
        'wins' => 0,
        'runners' => 0,
        'winners' => 0,
        'total_money' => 0,
        'win_prize_money' => 0,
        'winners_descendants' => [],
        'descendants' => 0
    ];

    /**
     * @return \Api\DataProvider\Bo\Bloodstock\Stallion\Nick
     * @codeCoverageIgnore
     */
    protected function getNickDataProvider()
    {
        return new \Api\DataProvider\Bo\Bloodstock\Stallion\Nick($this->request);
    }

    /**
     * @return array|\Phalcon\Mvc\Model\Row[]
     * @throws \Exception
     */
    public function getRows()
    {
        return $this->getNickDataProvider()->getNick($this->request);
    }

    /**
     * Method sorts records in the specified order.
     * Attempts of improvement performance by using \SplHeap (insertion entries to the sorted set)
     * does not improve performance, even vise versa,
     * it makes it worse on ~0.01 sec for specified below amount of records.
     *
     * Processing speed 0.035 sec for ~5000 rows
     *
     * @param array|null $rows
     *
     * @return array|null
     */
    public function prepareRows(?array $rows)
    {
        if (empty($rows)) {
            return null;
        }

        $rtn = [];

        foreach ($this->generatorElement($rows) as $element) {
            $element->winners = count($element->winners_descendants);
            $element->descendants = (bool)$element->runners;

            $rtn[] = $element;
        }

        return $rtn;
    }

    /**
     * @return array
     */
    protected static function getElementStructure()
    {
        return self::$elementStructure;
    }

    /**
     * @param $element
     * @param $row
     * @param $nextRow
     * @param $cnt
     */
    protected function fillElement($element, $row, $nextRow, $cnt)
    {
        $element->ancestor_uid = $row->ancestor_uid;
        $element->ancestor_name = $row->ancestor_name;
        $element->ancestor_country_origin_code = $row->ancestor_country_origin_code;
        $element->runs += $row->no_of_runners;
        $element->total_money += $row->win_prize_money;

        if ((int)$row->race_outcome_position === 1) {
            $element->wins += $row->no_of_runners;
            $element->win_prize_money += $row->win_prize_money;
            $element->winners_descendants[$row->horse_uid] = $row->horse_uid;
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
        return $cnt === 1 || !isset($nextRow) || $row->ancestor_uid !== $nextRow->ancestor_uid;
    }
}
