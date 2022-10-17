<?php

namespace Api\Output\Mapper\Tipping;

use Api\Output\Mapper\HorsesMapper;
use \Api\Row\Methods\GetPngSilkImage;
use \Api\Output\Mapper\Methods\LegacyDecorators;

/**
 * Class Singles
 *
 * @package Api\Output\Mapper\Tipping\Singles
 */
class Singles extends HorsesMapper
{
    use GetPngSilkImage;
    use LegacyDecorators;
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'course_name' => 'course_name',
            'diffusion_course_name' => 'diffusion_course_name',
            'horse_name' => 'horse_name',
            'horse_uid' => 'horse_uid',
            'saddle_cloth_no' => 'start_number',
            '(getPngSilkImage)owner_uid' => 'silk_image_path',
            'jockey_name' => 'jockey_name',
            'trainer_name' => 'trainer_name',
            'verdict' => 'verdict',
            '(getOpeningPrice)newspaper_uid,selection_desc' => 'opening_price',
            'tipster_uid' => 'tipster_uid',
            'tipster_name' => 'tipster_name',
            'tipster_type' => 'tipster_type',
            '(buildTipType)newspaper_uid' => 'tip_type',
            '(dbYNFlagToBoolean)non_runner' => 'non_runner'
         ];
    }
}
