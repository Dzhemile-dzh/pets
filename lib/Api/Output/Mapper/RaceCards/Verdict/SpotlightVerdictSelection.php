<?php

namespace Api\Output\Mapper\RaceCards\Verdict;

/**
 * Class SpotlightVerdictSelection
 *
 * @package Api\Output\Mapper\RaceCards\Verdict
 */
class SpotlightVerdictSelection extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)style_name,country_origin_code' => 'horse_name',
            'selection_type_uid' => 'selection_type_uid',
            'saddle_cloth_no' => 'start_number',
            '(dbYNFlagToBoolean)non_runner' => 'non_runner',
            '(getSilkImagePath)' => 'silk_image_path',
        ];
    }
}
