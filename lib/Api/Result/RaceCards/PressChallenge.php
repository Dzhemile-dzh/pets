<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 9/2/2016
 * Time: 10:24 AM
 */

namespace Api\Result\RaceCards;

class PressChallenge extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'press_challenge' => '\Api\Output\Mapper\RaceCards\PressChallenge'
        ];
    }
}
