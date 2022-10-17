<?php

namespace Api\Output\Mapper\OwnerGroups;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class HorseList
 *
 * @package Api\Output\Mapper\OwnerGroups
 */
class DailyStats extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            '(formatDate)date' => 'date',
            'course' => 'course',
            'cntry' => 'cntry',
            'm' => 'm',
            'f' => 'f',
            'yd' => 'y',
            'going' => 'going',
            'horse_name' => 'horse_name',
            'age' => 'age',
            'sex' => 'sex',
            'wght_lbs' => 'wght_lbs',
            'headgear' => 'headgear',
            'title' => 'title',
            'Code' => 'Code',
            'Type' => 'Type',
            'fin_pos' => 'fin_pos',
            '(formatValue)EUROS' => 'EUROS',
            '(formatValue)STERLING' => 'STERLING',
            'time' => 'time',
            'diff' => 'diff',
            'jockey' => 'jockey',
            'trainer' => 'trainer',
            'RPR' => 'RPR',
            'rp_close_up_comment' => 'rp_close_up_comment',
        ];
    }
    /**
     *
     * @param $date
     * @return false|string
     */
    private function formatDate($date)
    {
        $date = date("M d Y", strtotime($date));
        return $date;
    }

    /**
     * @param $value
     * @return float
     */
    private function formatValue($value)
    {
        if (!is_null($value)) {
            $value = round($value, 2);
        }
        return $value;
    }
}
