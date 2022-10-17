<?php

namespace Api\Result\Signposts;

class Sweetspots extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'sweet_spots' => '\Api\Output\Mapper\Signposts\Sweetspots'
        ];
    }
}
