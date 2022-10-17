<?php
namespace Api\Output\Mapper\Bloodstock\Dam;

class ProgenyResults extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'main_type' => 'main_type',
            'horse_uid' => 'horse_uid',
            '(trim)style_name' => 'horse_name',
            '(fixAroHorseName)style_name,country_origin_code' => 'style_name',
            'country_origin_code' => 'country_origin_code',
            'h_yob' => 'horse_yob',
            'horse_sex_code' => 'horse_sex_code',
            'trainer_name' => 'trainer_name',
            'trainer_uid' => 'trainer_uid',
            'runs' => 'runs',
            'wins' => 'wins',
            'places' => 'places',
            '(roundNullable)total_prize_money,2' => 'total_prize_money',
            'stakes_winner' => 'stakes_winner',
            '(intval)stakes_winner' => 'stakes_placed',
            'sire_uid' => 'sire_uid',
            '(fixAroHorseName)sire_style_name,sire_country_origin_code' => 'sire_style_name',
            'sire_country_origin_code' => 'sire_country_origin_code',
            'rp_postmark' => 'best_rp_postmark',
            'avg_flat_win_dist_of_progeny' => 'avg_flat_win_dist_of_progeny',
            'distance_yard' => 'distance_yard',
            '(getDistanceInFurlong)' => 'distance_furlong',
            '(getPercent)place_1st_number,races_number' => 'win_percent',
            '(boolval)stakes_winner' => 'stakes_winner_or_placed'
        ];
    }
}
