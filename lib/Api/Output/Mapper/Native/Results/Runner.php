<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Results;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\XmlSupport\XmlSuppotTrait;
use Api\Output\Mapper\Methods\LegacyDecorators;

/**
 * @package Api\Output\Mapper\Native\Results
 */
class Runner extends HorsesMapper
{
    use XmlSuppotTrait;
    use LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            '(strval)"runner"' => '(xmlHandler->asElementName)elName',
            // This method is used to format according to legacy
            '(getPos)race_outcome_code' => 'position',
            'horse_name' => 'name',
            'rate' => 'rate'
        ];
    }
}
