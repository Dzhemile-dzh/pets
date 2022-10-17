<?php

namespace Api\Result\RaceCards\Trainerspot;

/**
 * Class Trainerspot
 *
 * @package Api\Result\RaceCards\Trainerspot
 */
class Form extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'trainerspot' => '\Api\Output\Mapper\RaceCards\Trainerspot\Form'
        ];
    }
}
