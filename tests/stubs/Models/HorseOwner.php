<?php

namespace Tests\Stubs\Models;

class HorseOwner extends \Models\HorseOwner
{
    use StubDataGetter;

    protected static $_stubData = [
        'horseOwners' => [
            867979 => [
            'horse_uid' => 867979,
            'owner_uid' => 1859,
            'owner_change_date' => null,
            'timestamp' => null,
            ]
        ]
    ];

    /**
     * @param int $horseUid
     * @return array
     */
    public function getByHorseUid($horseUid)
    {
        return \Phalcon\Mvc\Model\Row\General::createFromArray(self::getStubData('horseOwners')[$horseUid]);
    }
}
