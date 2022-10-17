<?php

namespace Api\Result\HorseProfile;

/**
 * Class Relatives
 *
 * @package Api\Result\HorseProfile
 */
class Relatives extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'relatives' => '\Api\Output\Mapper\HorseProfile\Relatives'
        ];
    }
}
