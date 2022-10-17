<?php

namespace Api\Output\Mapper\Native\Meetings;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class MeetingList
 *
 * @package Api\Output\Mapper\Native\Meetings
 */
class MeetingList extends HorsesMapper
{
    use \Api\Output\XmlSupport\XmlSuppotTrait;
    use \Api\Output\Mapper\Methods\LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            '(trim)"meeting"' => '(xmlHandler->asElementName)meeting',
            '(prepareMeetingName)course_name,course_country' => '(xmlHandler->asAttribute)name',
            'course_uid' => '(xmlHandler->asAttribute)id',
        ];
    }
}
