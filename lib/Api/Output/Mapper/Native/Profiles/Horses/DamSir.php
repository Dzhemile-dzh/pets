<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Profiles\Horses;

use Api\Output\Mapper\HorsesMapper;
use \Api\Output\Mapper\Methods\LegacyDecorators;

/**
 * @package Api\Output\Mapper\Native\Profiles\Horses
 */
class DamSir extends HorsesMapper
{
    use LegacyDecorators;
    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            'd_sire_name' => 'name',
            'd_sire_country' => 'country',
            '(formatAvg)d_sire_avg' => 'avg'
        ];
    }
}
