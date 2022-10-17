<?php

namespace Api\Output\Mapper;

/**
 * Class VideoDetail
 *
 * @package Api\Output\Mapper
 */
class VideoDetail extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @inheritdoc
     */
    protected function getMap()
    {
        return [
            'ptv_video_id' => 'ptv_video_id',
            'video_provider' => 'video_provider',

            'complete_race_uid' => 'complete_race_uid',
            'complete_race_start' => 'complete_race_start',
            'complete_race_end' => 'complete_race_end',
            'finish_race_uid' => 'finish_race_uid',
            'finish_race_start' => 'finish_race_start',
            'finish_race_end' => 'finish_race_end'
        ];
    }
}
