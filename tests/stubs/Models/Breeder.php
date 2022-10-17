<?php

namespace Tests\Stubs\Models;

class Breeder extends \Models\Breeder
{
    use StubDataGetter;

    protected static $_stubData = [
        'breeders' => [
            1074450 => [
                'breeder_uid' => 1074450,
                'search_name' => 'MAKTOUM',
                'breeder_name' => 'SHEIKH HAMDAN BIN MAKTOUM AL MAKTOUM',
                'source_uid' => null,
                'address_uid' => null,
                'timestamp' => null,
                'searchname' => null,
                'darley' => null,
                'style_name' => 'Sheikh Hamdan Bin Maktoum Al Maktoum',
            ]
        ]
    ];

    /**
     * @param int $horseUid
     * @return array
     */
    public function getByBreederUid($breederUid)
    {
        return \Phalcon\Mvc\Model\Row\General::createFromArray(self::getStubData('breeders')[$breederUid]);
    }
}
