<?php
namespace Api\Output\Mapper\BetPrompts;

class BetPromptsMostNapped extends \Api\Output\Mapper\HorsesMapper
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
            'nap_count' => 'naps_count',
            'naps' => 'naps',
            'most_napped_today' => 'most_napped_today',
            'bet_prompt_weighting' => 'bet_prompt_weighting',
            'bet_prompt_rating' => 'bet_prompt_rating',
            '(round)bet_prompt_score,2' => 'bet_prompt_score',
            '(getSilkImagePath)' => 'silk_image_path',
            '(dbYNFlagToBoolean)non_runner' => 'non_runner'
        ];
    }
}
