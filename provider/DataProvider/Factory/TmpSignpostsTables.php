<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 2/15/2017
 * Time: 3:30 PM
 */

namespace Api\DataProvider\Factory;

use Api\DataProvider\Bo\Signposts\TmpTable\WorkSignpostDataToday;
use Api\DataProvider\Bo\Signposts\TmpTable\PreRaceInstanceExtended;
use Api\DataProvider\Bo\Signposts\TmpTable\SevenDaysWinners\Today;
use Api\DataProvider\Bo\Signposts\TmpTable\SevenDaysWinners\Statistics;
use Api\DataProvider\Bo\Signposts\TmpTable\SevenDaysWinners\Trainers;

class TmpSignpostsTables
{
    /**
     * @var \Api\DataProvider\Bo\Signposts\Tmp\WorkSignpostDataToday
     */
    private static $workSignpostsDataToday;

    /**
     * @var \Api\DataProvider\Bo\Signposts\Tmp\PreRaceInstanceExtended
     */
    private static $preRaceInstanceExtended;

    private static $sevenDaysWinners;

    /**
     * @return string
     */
    public static function getWorkSignpostsDataToday()
    {
        if (self::$workSignpostsDataToday === null) {
            self::$workSignpostsDataToday = new WorkSignpostDataToday();
        }
        return self::$workSignpostsDataToday->getTemporaryTable();
    }

    /**
     * @param $request
     * @return string
     */
    public static function getPreRaceInstanceExtended($request)
    {
        if (self::$preRaceInstanceExtended === null) {
            self::$preRaceInstanceExtended = new PreRaceInstanceExtended();
            self::$preRaceInstanceExtended->setRequest($request);
        }
        return self::$preRaceInstanceExtended->getTemporaryTable();
    }

    public static function getSevenDaysWinners($request = null)
    {
        if (self::$sevenDaysWinners === null) {
            if ($request === null) {
                throw new \RuntimeException("The request is needed for SevenDayWinners logic");
            }
            $today = new Today();
            $today->setRequest($request);
            self::$sevenDaysWinners = (Object)[
                'today' => $today,
                'trainers' => new Trainers(),
                'statistics' => new Statistics(),
            ];
        }
        return self::$sevenDaysWinners;
    }
}
