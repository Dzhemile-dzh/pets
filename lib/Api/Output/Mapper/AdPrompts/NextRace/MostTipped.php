<?php

declare(strict_types=1);

namespace Api\Output\Mapper\AdPrompts\NextRace;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class MostTipped
 * @package Api\Output\Mapper\AdPrompts\NextRace
 */
class MostTipped extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            'horse_uid' => 'horse_uid',
            'horse_name' => 'horse_name',
            '(getSilkImagePath)"png"' => 'silk_image_url_png',
        ];
    }
}
