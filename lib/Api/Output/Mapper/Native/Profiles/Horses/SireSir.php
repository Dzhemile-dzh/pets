<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Profiles\Horses;

use Api\Output\Mapper\HorsesMapper;
use \Api\Output\Mapper\Methods\LegacyDecorators;

/**
 * @package Api\Output\Mapper\Native\Profiles\Horses
 */
class SireSir extends HorsesMapper
{
    use LegacyDecorators;
    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            's_sire_name' => 'name',
            's_sire_country' => 'country',
            '(formatAvg)s_sire_avg' => 'avg'
        ];
    }
}
