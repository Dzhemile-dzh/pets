<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\TrainerProfile;

class Index extends \Api\Result\Json
{
    /**
     * @return null
     */
    protected function getPreparedData()
    {
        $data = parent::getPreparedData();
        if (isset($data->record_by_race_type)) {
            foreach ($data->record_by_race_type as $category => $value) {
                $data->record_by_race_type[$category] = new \Api\Output\Mapper\TrainerProfile\RecordByRaceType(
                    $value
                );
            }
        }
        return $data;
    }

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'profile' => '\Api\Output\Mapper\TrainerProfile\Profile',
            'profile.trainer_last_14_days' => '\Api\Output\Mapper\TrainerProfile\WinsRuns',
            'profile.since_a_win.flat' => '\Api\Output\Mapper\TrainerProfile\SinceAWin',
            'profile.since_a_win.jumps' => '\Api\Output\Mapper\TrainerProfile\SinceAWin',
            'big_race_wins' => '\Api\Output\Mapper\TrainerProfile\BigRaceWins',
            'big_race_wins.video_detail' => '\Api\Output\Mapper\TrainerProfile\VideoDetail',
            'entries' => '\Api\Output\Mapper\TrainerProfile\Entry',
            'last_14_days' => '\Api\Output\Mapper\TrainerProfile\Last14Days',
            'last_14_days.video_detail' => '\Api\Output\Mapper\TrainerProfile\VideoDetail',
            'statistical_summary' => '\Api\Output\Mapper\TrainerProfile\StatisticalSummary',
        ];
    }
}
