<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Results;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\XmlSupport\XmlSuppotTrait;
use Api\Output\Mapper\Methods\LegacyDecorators;

/**
 * @package Api\Output\Mapper\Native\Results
 */
class Meeting extends HorsesMapper
{
    use XmlSuppotTrait;
    use LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            '(strval)"meeting"' => '(xmlHandler->asElementName)elName',
            '(prepareMeetingName)course_name,course_country' => '(xmlHandler->asAttribute)name',
            'rp_meeting_order' => 'rp_meeting_order',
            'races' => 'races'
        ];
    }
}
