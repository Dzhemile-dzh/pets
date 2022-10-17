<?php

namespace Api\Result\TrainerProfile;

/**
 * Class Results
 *
 * @package Api\Result\TrainerProfile
 */
class Results extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'results' => '\Api\Output\Mapper\TrainerProfile\Results',
            'results.video_detail' => '\Api\Output\Mapper\TrainerProfile\VideoDetail',
        ];
    }
}
