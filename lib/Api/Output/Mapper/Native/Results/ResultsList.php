<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Results;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\XmlSupport\XmlSuppotTrait;

/**
 * @package Api\Output\Mapper\Native\Results
 */
class ResultsList extends HorsesMapper
{
    use XmlSuppotTrait;

    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            'adsChangeDelay' => 'adsChangeDelay',
            'meetings' => 'meetings'
        ];
    }
}
