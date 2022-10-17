<?php

namespace Tests\Stubs\Models;

class Trainer extends \Models\Trainer
{
    use StubDataGetter;

    protected static $_stubData = [
        'trainers' => [
            25628 => [
                'trainer_uid' => 25628,
                'search_name' => 'HILLS',
                'trainer_name' => 'CHARLES HILLS',
                'source_uid' => null,
                'address_uid' => null,
                'trainer_location' => 'Lambourn, Berks',
                'timestamp' => null,
                'mirror_name' => 'C HILLS',
                'trainer_type_code' => null,
                'rp_x_coord' => 433,
                'rp_y_coord' => 181,
                'country_code' => 'GB',
                'searchname' => 'CHARLESHILLS',
                'style_name' => 'Charles Hills',
                'surname' => null,
                'christian_name' => null,
                'initials' => null,
                'title' => null,
                'aka_style_name' => null,
                'date_of_birth' => null,
                'telephone_number_1' => null,
                'telephone_number_2' => null,
                'mobile_number' => null,
                'fax_number' => null,
                'email_address' => null,
                'retired_date' => null,
                'ptp_type_code' => null,
                'latitude' => null,
                'longitude' => null,
                'zoom' => null
            ]
        ]
    ];

    /**
     * @param int $ownerUid
     * @return array
     */
    public function getByTrainerUid($trainerUid)
    {
        return \Phalcon\Mvc\Model\Row\General::createFromArray(self::getStubData('trainers')[$trainerUid]);
    }

    /**
     * @param int $horseUid
     * @return array
     */
    public function getByHorseUid($horseUid)
    {
        $horseOwnerStub = new \Tests\Stubs\Models\HorseTrainer();
        $horseOwner = $horseOwnerStub->getByHorseUid($horseUid);

        return $this->getByTrainerUid($horseOwner->trainer_uid);
    }
}
