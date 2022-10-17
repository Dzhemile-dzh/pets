<?php

namespace Api\Output\Mapper\OwnerProfile;

/**
 * Class Standard
 *
 * @package Api\Output\Mapper\OwnerProfile
 */
class Standard extends \Api\Output\Mapper\HorsesMapper
{

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'style_name' => 'owner_name',
            '(getSilkImagePath)' => 'silk_image_path',
            'owner_last_14_days' => 'owner_last_14_days',
            'since_a_win' => 'since_a_win'
        ];
    }
}
