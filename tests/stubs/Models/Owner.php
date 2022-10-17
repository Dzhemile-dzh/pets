<?php

namespace Tests\Stubs\Models;

class Owner extends \Models\Owner
{
    use StubDataGetter;

    protected static $_stubData = [
        'owners' => [
            1859 => [
                'owner_uid' => 1859,
                'search_name' => 'MAKTOUM',
                'owner_name' => 'HAMDAN AL MAKTOUM',
                'ptp_type_code' => 'N',
                'silk' => null,
                'source_uid' => null,
                'address_uid' => null,
                'timestamp' => null,
                'searchname' => 'HAMDANALMAKTOUM',
                'darley' => 'B',
                'style_name' => 'Hamdan Al Maktoum',
                'roa_flag' => null,
            ]
        ]
    ];

    /**
     * @param int $ownerUid
     * @return array
     */
    public function getByOwnerUid($ownerUid)
    {
        return \Phalcon\Mvc\Model\Row\General::createFromArray(self::getStubData('owners')[$ownerUid]);
    }

    /**
     * @param int $horseUid
     * @return array
     */
    public function getByHorseUid($horseUid)
    {
        $horseOwnerStub = new \Tests\Stubs\Models\HorseOwner();
        $horseOwner = $horseOwnerStub->getByHorseUid($horseUid);

        return $this->getByOwnerUid($horseOwner->owner_uid);
    }
}
