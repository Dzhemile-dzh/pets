<?php

namespace Api\Output\Mapper\Form;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class ReplayDetails
 * @package Api\Output\Mapper\Form
 */
class ReplayDetails extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'ptv_video_id' => 'videoId',
            'video_provider' => 'videoProvider',
            'complete_race_uid' => 'completeRaceUid',
            'complete_race_start' => 'completeRaceStart',
            'complete_race_end' => 'completeRaceEnd',
            'finish_race_uid' => 'finishRaceUid',
            'finish_race_start' => 'finishRaceStart',
            'finish_race_end' => 'finishRaceEnd',
        ];
    }
}
