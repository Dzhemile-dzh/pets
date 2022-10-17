<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Profiles\Horses;

use Api\Output\Mapper\HorsesMapper;
use \Api\Output\Mapper\Methods\LegacyDecorators;

/**
 * @package Api\Output\Mapper\Native\Profiles\Horses
 */
class HorseSir extends HorsesMapper
{
    use LegacyDecorators;
    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            'h_sire_name' => 'name',
            'h_sire_country' => 'country',
            '(formatAvg)h_sire_avg' => 'avg'
        ];
    }
}
