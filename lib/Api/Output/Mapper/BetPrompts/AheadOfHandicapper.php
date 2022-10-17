<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 2/1/2016
 * Time: 3:08 PM
 */

namespace Api\Output\Mapper\BetPrompts;

class AheadOfHandicapper extends \Api\Output\Mapper\HorsesMapper
{
    protected function getMap()
    {
        return [
            '(fixAroHorseName)horse_style_name,horse_country_origin_code' => 'horse',
            'horse_uid' => 'horse_uid',
            'saddle_cloth_no' => 'start_number',
            'entries' => 'entries',
            'bet_prompt_rating' => 'bet_prompt_rating',
            'bet_prompt_weighting' => 'bet_prompt_weighting',
            '(round)bet_prompt_score,2' => 'bet_prompt_score',
        ];
    }
}
