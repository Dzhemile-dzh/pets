<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 11/27/2015
 * Time: 2:35 PM
 */
namespace Api\Output\Mapper\RaceCards\RaceCard;

class HighestOfficialRating extends RaceCardMapper
{
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            'start_number' => 'start_number',
            '(fixAroHorseName)horse_name,country_origin_code' => 'horse_name',
            'official_rating' => 'official_rating',
        ];
    }
}
