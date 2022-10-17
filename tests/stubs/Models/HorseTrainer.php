<?php

namespace Tests\Stubs\Models;

class HorseTrainer extends \Models\HorseTrainer
{
    use StubDataGetter;

    protected static $_stubData = [
        'horseTrainers' => [
            867979 => [
                'trainer_uid' => 25628,
                'horse_uid' => 867979,
                'trainer_change_date' => null,
                'timestamp' => null
            ]
        ]
    ];

    /**
     * @param int $horseUid
     * @return array
     */
    public function getByHorseUid($horseUid)
    {
        return \Phalcon\Mvc\Model\Row\General::createFromArray(self::getStubData('horseTrainers')[$horseUid]);
    }
}
