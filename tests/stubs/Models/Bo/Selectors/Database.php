<?php

/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 5/25/2016
 * Time: 3:15 PM
 */

namespace Tests\Stubs\Models\Bo\Selectors;

use Pseudo\Exception;

class Database extends \Models\Bo\Selectors\Database
{
    /**
     * @param int     $seasonYear
     * @param string  $seasonTypeCode
     *
     * @return string (date)
     */
    public function getSeasonDateBegin($seasonYear, $seasonTypeCode)
    {
        $data = [
            '2011_F' => '2011-01-01 00:00:00.0',
            '2014_J' => '2014-04-27 00:00:00.0',
            '2015_J' => '2015-04-27 00:00:00.0',
            '2010_I' => '2010-04-25 00:00:00.0',
            '2012_T' => '2012-03-31 00:00:00.0',
            '2015_F' => '2015-01-01 00:00:00.0',
            '2016_F' => '2016-01-01 00:00:00.0',
            '2016_A' => '2016-10-29 00:00:00.0',
            '2017_F' => '2017-01-01 00:00:00.0',
            '2018_F' => '2018-01-01 00:00:00.0',
        ];

        return $data[$seasonYear . '_' . $seasonTypeCode];
    }

    /**
     * @param string $seasonTypeCode
     *
     * @return string (date)
     */
    public function getCurrentSeasonDateBegin($seasonTypeCode)
    {
        $data = [
            'F' => '2011-01-01 00:00:00.0',
            'J' => '2014-04-27 00:00:00.0',
            'I' => '2010-04-25 00:00:00.0',
            'A' => '2016-10-29 00:00:00.0',
        ];

        return $data[$seasonTypeCode];
    }

    /**
     * @param int     $seasonYear
     * @param string  $seasonTypeCode
     *
     * @return string (date)
     */
    public function getSeasonDateEnd($seasonYear, $seasonTypeCode)
    {
        $data = [
            '2013_F' => '2013-12-31 23:59:00.0',
            '2014_J' => '2015-04-25 23:59:00.0',
            '2010_I' => '2011-05-07 23:59:00.0',
            '2012_T' => '2012-11-10 23:59:00.0',
            '2015_F' => '2015-12-31 23:59:00.0',
            '2016_F' => '2016-12-31 23:59:00.0',
            '2016_A' => '2017-03-25 23:59:00.0',
            '2016_J' => '2017-04-25 23:59:00.0',
            '2017_F' => '2017-12-31 23:59:00.0',
            '2018_F' => '2018-12-31 23:59:00.0',
        ];

        return $data[$seasonYear . '_' . $seasonTypeCode];
    }

    /**
     * @param string $seasonTypeCode
     *
     * @return string (date)
     */
    public function getCurrentSeasonDateEnd($seasonTypeCode)
    {
        $data = [
            'F' => '2013-12-31 23:59:00.0',
            'J' => '2015-04-25 23:59:00.0',
            'I' => '2011-05-07 23:59:00.0',
            'A' => '2017-03-25 23:59:00.0',
        ];

        return $data[$seasonTypeCode];
    }
}
