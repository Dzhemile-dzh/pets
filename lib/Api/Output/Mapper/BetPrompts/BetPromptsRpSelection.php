<?php
namespace Api\Output\Mapper\BetPrompts;

class BetPromptsRpSelection extends \Api\Output\Mapper\HorsesMapper
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
            'rp_postmark' => 'rp_postmark',
            '(boolval)rpr_nap' => 'rpr_nap',
            'bet_prompt_weighting' => 'bet_prompt_weighting',
            'bet_prompt_rating' => 'bet_prompt_rating',
            '(round)bet_prompt_score,2' => 'bet_prompt_score',
            '(getSilkImagePath)' => 'silk_image_path',
            '(dbYNFlagToBoolean)non_runner' => 'non_runner'
        ];
    }
}
