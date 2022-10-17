<?php

declare(strict_types=1);

namespace Bo\Native\Results;

use Bo\Standart;
use \stdClass as Row;
use Api\DataProvider\Bo\Native\Results\DateMenu as DataProvider;
use Api\Input\Request\Horses\Native\Results\DateMenu as Request;

/**
 * @method Request getRequest()
 *
 * @package Bo\Native\Cards
 */
class DateMenu extends Standart
{
    const ACTION_TYPE = "result";
    const LAST_X_DAYS = 6;

    /**
     * @return Object
     */
    public function getData(): Row
    {
        $dataProvider = new DataProvider();

        // We should always start our results from today's date
        // If it is in the morning, there won't be any finished races (status = R), so we will make the race_count 0 by default
        // This function will just help us to get the today's date (so we can build proper unit tests).
        $date = $dataProvider->getData();
        // The date will be returned as SQL object so we will convert to the format we need.
        $date = strtotime($date->date);

        // This will get the race_count for 6 days from today (including)
        // BUT!!! If there are no any finished races on any one of the dates, the date will be completely missing from
        // the result. This is why we get the today's date "manually" with the previous function execution ^^^
        $availableDate = $dataProvider->getAvailable();

        // ... our job is to build missing rows from the database (because we should always display 6 rows from today)
        // and put race_count = 0 in case this date is missing.

        // To make it easier to check how many race_counts we have per date, we will build simpler array of races per date
        // eg: '2018-12-05' => 3 (there are 3 races on this date)
        $racesPerDate = array_reduce($availableDate, function ($lastResult, $item) {
            $lastResult[$item->unique_race_date] = $item->race_count;
            return $lastResult;
        }, array());

        $dates = array();
        for ($i = 0; $i <= self::LAST_X_DAYS - 1; $i++) {
            $tempDate = new Row();
            $tempDate->dateValue = date('Y-m-d', strtotime('-'.$i.' days', $date));

            // Here we  build our final result.
            // Our for loop will always iterate 6 times and will look for race_count in the built date.
            // The date may be missing because of missing finished races on this date.
            $tempDate->available = isset($racesPerDate[$tempDate->dateValue]) ? 1 : '';
            $dates[]=$tempDate;
        }

        $results = new Row();
        $results->actionType = self::ACTION_TYPE;
        $results->dates = $dates;

        return $results;
    }
}
