<?php

namespace Api\Result\Signposts;

class HotJockeys extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'hot_jockeys' => '\Api\Output\Mapper\Signposts\HotJockeys',
            'hot_jockeys.entries' => '\Api\Output\Mapper\Signposts\Entries'
        ];
    }
}
