<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\JockeyProfile;

class Index extends \Api\Output\Mapper\HorsesMapper
{

    protected function getMap()
    {
        return [
            'jockey_uid' => 'jockey_uid',
            'jockey_name' => 'jockey_name',
            'ptp_type_code' => 'ptp_type_code',
            'flat_jockey_type_code' => 'flat_jockey_type_code',
            'jump_jockey_type_code' => 'jump_jockey_type_code',
            'jockey_sex' => 'jockey_sex',
            'style_name' => 'style_name',
            'aka_style_name' => 'aka_style_name',
            'christian_name' => 'christian_name',
            'longest_flat_losing_seq' => 'longest_flat_losing_seq',
            'longest_flat_winning_seq' => 'longest_flat_winning_seq',
            'present_flat_losing_seq' => 'present_flat_losing_seq',
            'present_flat_winning_seq' => 'present_flat_winning_seq',
            'longest_jump_losing_seq' => 'longest_jump_losing_seq',
            'longest_jump_winning_seq' => 'longest_jump_winning_seq',
            'present_jump_losing_seq' => 'present_jump_losing_seq',
            'present_jump_winning_seq' => 'present_jump_winning_seq',
            'lowest_riding_weight' => 'lowest_riding_weight',
            'country_code' => 'country_code',
            'jockey_last_14_days' => 'jockey_last_14_days',
            'since_a_win' => 'since_a_win'
        ];
    }
}
