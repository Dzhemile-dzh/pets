<?php

namespace Api\Result\HorseProfile;

class Medical extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            '\Api\Output\Mapper\HorseProfile\Medical\Horse',
            'medical_info' => '\Api\Output\Mapper\HorseProfile\Medical\Medical',
        ];
    }
}
