<?php
namespace Api\Output\Mapper\BetPrompts;

class BetPromptsPostDataSelection extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)horse_name,country_origin_code' => 'horse_name',
            'saddle_cloth_no' => 'start_number',
            'post_data_total' => 'post_data_total',
            'bet_prompt_weighting' => 'bet_prompt_weighting',
            'bet_prompt_rating' => 'bet_prompt_rating',
            '(round)bet_prompt_score,2' => 'bet_prompt_score',
            '(getSilkImagePath)' => 'silk_image_path',
            '(dbYNFlagToBoolean)non_runner' => 'non_runner',
            'trainer_form_output' => 'trainer_form_output',
            'going_output' => 'going_output',
            'distance_output' => 'distance_output',
            'course_output' => 'course_output',
            'draw_output' => 'draw_output',
            'ability_output' => 'ability_output',
            'recent_form_output' => 'recent_form_output'
        ];
    }
}
