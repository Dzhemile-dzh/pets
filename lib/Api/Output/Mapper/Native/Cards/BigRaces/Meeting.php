<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Cards\BigRaces;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\XmlSupport\XmlSuppotTrait;
use Api\Output\Mapper\Methods\LegacyDecorators;

/**
 * @package Api\Output\Mapper\Native\Cards
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
            'course_id' => '(xmlHandler->asAttribute)id',
            '(prepareMeetingName)course_name,course_country' => '(xmlHandler->asAttribute)name',
            '(formatToDiffusion)course_name' => '(xmlHandler->asAttribute)diffusion_course_name',
            '(strval)""' => '(xmlHandler->asElementValue)elName',
        ];
    }
}
