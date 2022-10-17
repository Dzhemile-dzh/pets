<?php

namespace Api\Result\HorseProfile;

class Notes extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'notes' => '\Api\Output\Mapper\HorseProfile\Quotes',
            'eyecatcher' => '\Api\Output\Mapper\HorseProfile\Quotes',
            'star_performer' => '\Api\Output\Mapper\HorseProfile\Quotes',
        ];
    }
}
