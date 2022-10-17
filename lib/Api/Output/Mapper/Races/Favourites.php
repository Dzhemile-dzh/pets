<?php

namespace Api\Output\Mapper\Races;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class Favourites
 * @package Api\Output\Mapper\Races
 */
class Favourites extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid'         => 'raceId',
            'uid'                       => 'favourite.uid',
            'saddle_cloth_no'           => 'favourite.saddleClothNumber',
            'draw'                      => 'favourite.draw',
            '(getSilkImagePath)'        => 'favourite.silkURL',
            'trainer_uid'               => 'favourite.trainer.uid',
            'trainer_style_name'        => 'favourite.trainer.name',
            'owner_uid'                 => 'favourite.owner.uid',
            'owner_name'                => 'favourite.owner.name',
            'jockey_uid'                => 'favourite.jockey.uid',
            'jockey_name'               => 'favourite.jockey.name',
            'allowance'                 => 'favourite.jockey.weightAllowance.lbs',
            'weight_allowance_kg'       => 'favourite.jockey.weightAllowance.kg',
            'horse_uid'                 => 'favourite.horse.uid',
            '(strtoupper)horse_name'    => 'favourite.horse.name.full',
            'horse_name'                => 'favourite.horse.name.style',
            'country_origin_code'       => 'favourite.horse.originCountryCode',
        ];
    }
}
