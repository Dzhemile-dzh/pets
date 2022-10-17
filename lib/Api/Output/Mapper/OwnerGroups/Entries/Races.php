<?php

namespace Api\Output\Mapper\OwnerGroups\Entries;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class HorseList
 *
 * @package Api\Output\Mapper\OwnerGroups
 */
class Races extends HorsesMapper
{
    use \Api\Row\Methods\GetDistanceInFurlong;
    use \Api\Output\Mapper\Methods\LegacyDecorators;

    /**
     * Helps to produce optional JSON fields depending on the data existence
     *
     * @var
     */
    private $dataToMap;

    /**
     * We override the constructor of the mapper just because it is the method that has access to the data we map.
     * We should produce dynamic mapper content depending on a field existence in the data.
     * Which by default is impossible.
     * So we use the constructor to expose the data so we can access it from the mapper.
     *
     * @param $objMapFrom
     *
     * @throws \Exception
     */
    public function __construct($objMapFrom)
    {
        // Exposing the data to be used by getMap() method.
        $this->dataToMap = $objMapFrom;

        // continue the normal behaviour.
        parent::__construct($objMapFrom);
    }

    /**
     * @return array
     */
    protected function getMap(): array
    {
        $mapper = [
            'race_instance_uid' => 'race_instance_uid',
            'race_instance_title' => 'race_instance_title',
            '(dateISO8601)race_datetime' => 'race_datetime',
            '(localDateISO8601)race_datetime,hours_difference' => 'local_meeting_race_datetime',
            'race_group_code' => 'race_group_code',
            'race_group_desc' => 'race_group_desc',
            'race_type_code' => 'race_type_code',
            'race_surface' => 'race_surface',
            'race_class' => 'race_class',
            'race_status_code' => 'race_status_code',
            'course_uid' => 'course_uid',
            'course_name' => 'course_name',
            '(getCourseContinent)country_code' => 'course_region',
            '(prepareToDiffusion)diffusion_course_name' => 'diffusion_course_name',
            '(trim)country_code' => 'country_code'
        ];

        // we should show "god_live_stream_URL" Only for owner groups = 5.
        // Otherwise no.
        if (key_exists('owner_group_id', $this->dataToMap) &&
            $this->dataToMap['owner_group_id'] === 5
        ) {
            $mapper['CMS_element_contents'] = 'god_live_stream_URL';
        }

        // the rest of the mapper's mandatory fields:
        $mapper = array_merge($mapper, [
            'distance_yard' => 'distance_yard',
            '(GetDistanceInFurlong)' => 'distance_furlong_rounded',
            'runners' => 'runners'
        ]);

        // we don't need it anymore, let's not leave it and cause unpredicted results.
        unset($this->dataToMap);

        return $mapper;
    }
}
