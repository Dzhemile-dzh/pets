<?php

namespace Api\Output\Mapper\Meetings;

use Api\Output\Mapper\HorsesMapper;
use Api\Methods\RemoveBrackets;
use Api\Output\Mapper\Methods\LegacyDecorators;

/**
 * Class Meetings
 * @package Api\Output\Mapper\Meetings
 */
class Meetings extends HorsesMapper
{
    use RemoveBrackets;
    use LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'meetingId' => 'meetingId',
            'rp_meeting_order' => 'rpMeetingOrder',
            'style_name' => 'venueName',
            '(prepareToDiffusion)course_name' => 'diffusionVenueName',
            '(stringToURLkey)course_name' => 'courseKey',
            'country_code' => 'venueCountryCode',
            'course_uid' => 'venueUid',
            'mixed_course_uid' => 'mixedVenueUid',
            '(dateISO8601)meeting_time' => 'meetingStartDateTime.utc',
            '(localDateISO8601)meeting_time,hours_difference' => 'meetingStartDateTime.local',
            'numberOfRaces' => 'numberOfRaces',
            'meeting_type' => 'meetingType',
            '(removeBrackets)weather_details' => 'weather',
            '(trimAndNullifyString)going_desc' => 'going',
            'sumNonRunners' => 'numberNonRunners',
            'races' => 'races'
        ];
    }
}
