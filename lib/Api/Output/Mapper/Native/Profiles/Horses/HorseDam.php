<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Profiles\Horses;

use Api\Output\Mapper\HorsesMapper;
use \Api\Output\Mapper\Methods\LegacyDecorators;

/**
 * @package Api\Output\Mapper\Native\Profiles\Horses
 */
class HorseDam extends HorsesMapper
{
    use LegacyDecorators;
    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            'dam_name' => 'name',
            'dam_country' => 'country',
            '(formatAvg)d_avg' => 'avg'
        ];
    }
}
