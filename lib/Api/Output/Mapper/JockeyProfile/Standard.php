<?php

namespace Api\Output\Mapper\JockeyProfile;

/**
 * Class Standard
 *
 * @package Api\Output\Mapper\JockeyProfile
 */
class Standard extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'style_name' => 'jockey_name',
            'aka_style_name' => 'jockey_short_name',
            'jockey_sex' => 'jockey_sex',
            'flat_jockey_type_code' => 'flat_jockey_type_code',
            'jump_jockey_type_code' => 'jump_jockey_type_code',
            'lowest_riding_weight' => 'lowest_riding_weight_lbs',
            'country_code' => 'jockey_country_code',
            'jockey_last_14_days' => 'jockey_last_14_days',
            'since_a_win' => 'since_a_win'
        ];
    }
}
