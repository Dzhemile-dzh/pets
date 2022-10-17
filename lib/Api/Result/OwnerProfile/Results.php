<?php

namespace Api\Result\OwnerProfile;

class Results extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'results' => '\Api\Output\Mapper\OwnerProfile\Results',
            'results.video_detail' => '\Api\Output\Mapper\OwnerProfile\VideoDetail',
        ];
    }
}
