<?php
namespace Api\Output\Mapper\BetFinder;

class Bet extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;
    
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'uid' => 'uid',
            'race_uid' => 'race_uid',
            '(intval)race_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'race_jump' => 'race_jump',
            'race_8runners' => 'race_8runners',
            'race_run_nos' => 'race_run_nos',
            'race_type' => 'race_type',
            'race_going' => 'race_going',
            'owner_uid' => 'owner_uid',
            'owner_choice' => 'owner_choice',
            'rp_owner_choice' => 'rp_owner_choice',
            'ctry_code' => 'ctry_code',
            'course_uid' => 'course_uid',
            'course_name' => 'course_name',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            '(stringToURLkey)course_name' => 'course_key',
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)horse_name,horse_country_origin_code' => 'horse_name',
            'horse_name_lc' => 'horse_name_lc',
            'trainer_uid' => 'trainer_uid',
            'trainer_name' => 'trainer_name',
            'trainer_name_lc' => 'trainer_name_lc',
            'jockey_uid' => 'jockey_uid',
            'jockey_name' => 'jockey_name',
            'jockey_name_lc' => 'jockey_name_lc',
            'weight_allowance_lbs' => 'weight_allowance_lbs',
            '(fixAroHorseName)sire_horse_name,sire_country_origin_code' => 'sire_horse_name',
            'winner' => 'winner',
            'placed' => 'placed',
            'bfv' => 'bfv',
            'postmark' => 'postmark',
            'topspeed' => 'topspeed',
            'silk_red' => 'silk_red',
            'silk_orange' => 'silk_orange',
            'silk_yellow' => 'silk_yellow',
            'silk_green' => 'silk_green',
            'silk_blue' => 'silk_blue',
            'silk_purple' => 'silk_purple',
            'silk_pink' => 'silk_pink',
            'silk_black' => 'silk_black',
            'silk_white' => 'silk_white',
            'silk_brown' => 'silk_brown',
            '(getSilkImagePath)' => 'silk_image_path',
            'improver' => 'improver',
            'drop_in_class' => 'drop_in_class',
            'blinkers' => 'blinkers',
            'big_trainer' => 'big_trainer',
            'trainer_inform' => 'trainer_inform',
            'course_trainer' => 'course_trainer',
            'trainer_fur_trv' => 'trainer_fur_trv',
            'big_jockey' => 'big_jockey',
            'jockey_inform' => 'jockey_inform',
            'course_jockey' => 'course_jockey',
            'one_tr_jockey' => 'one_tr_jockey',
            'suit_going' => 'suit_going',
            'suit_course' => 'suit_course',
            'suit_dist' => 'suit_dist',
            'spotlight' => 'spotlight',
            'postdata' => 'postdata',
            'lambourn' => 'lambourn',
            'north' => 'north',
            'daily_tel' => 'daily_tel',
            'times' => 'times',
            'telegraph' => 'telegraph',
            'guardian' => 'guardian',
            'daily_mail' => 'daily_mail',
            'daily_exp' => 'daily_exp',
            'daily_mir' => 'daily_mir',
            'sun' => 'sun',
            'star' => 'star',
            'daily_rec' => 'daily_rec',
            'nap' => 'nap',
            'fc_odds_uid' => 'fc_odds_uid',
            'fc_odds_value' => 'fc_odds_value',
            'fc_odds' => 'fc_odds',
            'fc_fav' => 'fc_fav',
            'fc_long_shot' => 'fc_long_shot',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            'saddle_no' => 'saddle_no',
            'weight_allow' => 'weight_allow',
            'sire_name' => 'sire_name',
            'sire_uid' => 'sire_uid',
            'tricast' => 'tricast',
            'ruk' => 'ruk',
            'atr' => 'atr',
            'deleted' => 'deleted'
        ];
    }
}
