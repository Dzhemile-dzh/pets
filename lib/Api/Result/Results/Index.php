<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\Results;

class Index extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'race_info' => '\Api\Output\Mapper\Results\RaceInfo',
            'race_info.prizes' => '\Api\Output\Mapper\Results\Prize',
            'race_info.dividends' => '\Api\Output\Mapper\Results\Dividend',
            'race_info.video_detail' => '\Api\Output\Mapper\Results\Index\VideoDetail',
            'non_runners' => '\Api\Output\Mapper\Results\NonRunner',
            'result' => '\Api\Output\Mapper\Results\Result',
            'result.next_race' => '\Api\Output\Mapper\Results\HorseRace',
            'result.prev_race' => '\Api\Output\Mapper\Results\HorseRace',
            'statistic' => '\Api\Output\Mapper\Results\Result\Statistic',
            'draw_bias_index' => '\Api\Output\Mapper\Results\Dbi',
            'next_run' => '\Api\Output\Mapper\Results\NextRunHeader',
            'next_run.first_three' => '\Api\Output\Mapper\Results\NextRun',
            'next_run.also_rans' => '\Api\Output\Mapper\Results\NextRun',
        ];
    }
}
