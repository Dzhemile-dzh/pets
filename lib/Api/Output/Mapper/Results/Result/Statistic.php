<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\Results\Result;

use Api\Output\Mapper\Methods\LegacyDecorators;

class Statistic extends \Api\Output\Mapper\HorsesMapper
{
    use LegacyDecorators;
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            '(stringToFloat)total_sp' => 'total_sp',
            'no_of_runners_calculated' => 'number_of_runners',
            'winners_time_secs' => 'winner_time',
            '(sumDiffToStandardTime)winners_time_secs,average_time_sec' => 'diff_to_standard_time_sec',
            'average_time_sec' => 'average_time_sec'
        ];
    }
}
