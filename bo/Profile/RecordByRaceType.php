<?php

namespace Bo\Profile;

use Api\DataProvider\Bo\Profile\RecordByRaceType as DataProvider;

/**
 * Class RecordByRaceType
 *
 * @package Bo\Profile
 */
abstract class RecordByRaceType extends \Bo\Standart
{
    const MODEL_DEFAULT_INFO = 'defaultInfo';
    const MODEL_SEASON = 'season';

    /**
     * @var array
     */
    protected $fieldSet = [
        'group_name' => null,
        'races_number' => 0,
        'percent' => 0,
        'place_1st_number' => 0,
        'place_2nd_number' => 0,
        'place_3rd_number' => 0,
        'place_4th_number' => 0,
        'win_prize' => 0,
        'total_prize' => 0,
        'euro_win_prize' => 0,
        'euro_total_prize' => 0,
        'net_win_prize_money' => 0,
        'net_total_prize_money' => 0,
        'stake' => 0,
        'horses' => 0,
        'winners' => 0,
        'placed' => 0
    ];

    /**
     * @var array
     */
    protected $bestRunnerFields = [
        'best_horse_uid' => null,
        'best_horse_name' => null,
        'best_horse_country_origin_code' => null,
        'best_rp_postmark' => 0
    ];

    /**
     * @var array
     */
    private $flatGroups = [
        '2YO TURF',
        '2YO AW',
        '3YO TURF',
        '3YO AW',
        '4YO+ TURF',
        '4YO+ AW'
    ];

    /**
     * @var array
     */
    private $jumpsGroups = [
        'NHF',
        'HURDLE',
        'CHASE'
    ];

    /**
     * @var array
     */
    private $totalFields = [
        'total_horses' => 'horses',
        'total_winners' => 'winners'
    ];

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\RecordByRaceType
     */
    abstract protected function getDataProvider();

    /**
     * @return array
     */
    public function getRows()
    {
        return $this->getDataProvider()->getRecordByRaceType($this->getRequest());
    }

    /**
     * @param array $rows
     *
     * @return array
     */
    public function prepareRows(array $rows)
    {
        $groups = $this->getGroups();

        $fullSortedResult = [];
        foreach ($groups as $groupName) {
            if (isset($rows[$groupName])) {
                $fullSortedResult[$groupName] = $rows[$groupName];
            } else {
                $fullSortedResult[$groupName] = $this->getEmptyRow();
                $fullSortedResult[$groupName]->{DataProvider::FIELD_GROUP} = $groupName;
            }
        }

        if (!empty($rows)) {
            $fullSortedResult['total'] = $this->getTotalValues($rows);
        }

        return $fullSortedResult;
    }

    /**
     * @param array $rows
     *
     * @return object
     */
    private function getTotalValues(array $rows)
    {
        $total = $this->getEmptyRow();
        $total->group_name = 'total';
        $maxRpr = 0;

        if (!empty($rows)) {
            foreach ($rows as $parameters) {
                if (!empty($parameters)) {
                    foreach ($parameters as $parameter => $value) {
                        if (isset($this->fieldSet[$parameter])
                            && is_numeric($value)
                            && !isset($this->totalFields[$parameter])) {
                            if (isset($total->{$parameter})) {
                                $total->{$parameter} += $value;
                            } else {
                                $total->{$parameter} = $value;
                            }
                        } else {
                            if (isset($this->totalFields[$parameter])) {
                                $total->{$this->totalFields[$parameter]} = $value;
                            }
                        }
                    }

                    if (empty($maxRpr) && !empty($parameters->best_rp_postmark)
                        || !empty($parameters->best_rp_postmark) && $maxRpr < $parameters->best_rp_postmark) {
                        foreach ($this->bestRunnerFields as $field => $value) {
                            $total->{$field} = $parameters->{$field};
                        }

                        $maxRpr = $parameters->best_rp_postmark;
                    }
                }
            }
        }

        return $total;
    }

    /**
     * Method delegates calling to the methods specified below,
     * it depends from 'raceType' parameter in the request
     *
     * @method getFlatGroups
     * @method getJumpsGroups
     *
     * @return array
     */
    public function getGroups()
    {
        $methodName = 'get' . ucfirst($this->getRequest()->getRaceType()) . 'Groups';
        return $this->{$methodName}();
    }

    /**
     * @return null|static
     */
    public function getEmptyRow()
    {
        static $row = null;
        if (!$row) {
            $row = $this->getDataProvider()->getRow()->createFromArray($this->getFieldSet());
        }
        return clone $row;
    }

    /**
     * @return array
     */
    public function getFieldSet()
    {
        return array_merge($this->fieldSet, $this->bestRunnerFields);
    }

    /**
     * @return array
     */
    public function getFlatGroups()
    {
        return $this->flatGroups;
    }

    /**
     * @return array
     */
    public function getJumpsGroups()
    {
        return $this->jumpsGroups;
    }
}
