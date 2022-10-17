<?php

namespace Tests\Stubs\DataProvider\Validator;

use \Phalcon\Mvc\Model\Row\General as Row;

/**
 * Class ResultsRaceIdLimitedDate
 *
 * @package Tests\Stubs\DataProvider
 */
class ResultsRaceIdLimitedDate extends \Api\DataProvider\Validator\ResultsRaceIdLimitedDate
{
    /**
     * @param int $raceId
     *
     * @return \Phalcon\Mvc\Model\Row|null
     */
    public function getRaceInfo($raceId)
    {
        $data = [
            1111 => Row::createFromArray(array(
                'race_datetime' =>  (new \DateTime('-8 Days'))->format('Y-m-d'),
            )),
            2222 => Row::createFromArray(array(
                'race_datetime' =>  (new \DateTime('+1 Days'))->format('Y-m-d'),
            )),
            3333 => null,
            5555 => Row::createFromArray(array(
                'race_datetime' => (new \DateTime('-6 Days'))->format('Y-m-d'),
            )),
            6666 => Row::createFromArray(array(
                'race_datetime' => (new \DateTime('-7 Days'))->format('Y-m-d'),
            )),
            7777 => Row::createFromArray(array(
                'race_datetime' => (new \DateTime())->format('Y-m-d'),
            )),
        ];
        return $data[$raceId];
    }
}
