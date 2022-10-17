<?php

namespace Api\Output\Mapper\OwnerGroups\Results;

use Api\Output\Mapper;

/**
 * Class Races
 *
 * @package Api\Output\Mapper\OwnerGroups\Results
 */
class Races extends Mapper\HorsesMapper
{
    use \Api\Row\Methods\GetDistanceInFurlong;
    use Mapper\Methods\LegacyDecorators;

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
            '(dateISO8601)race_datetime' => 'race_datetime',
            '(localDateISO8601)race_datetime,hours_difference' => 'local_meeting_race_datetime',
            'country_code' => 'country_code',
            '(getCourseContinent)country_code' => 'course_region',
            'course_uid' => 'course_uid',
            'course_name' => 'course_name',
            '(prepareToDiffusion)diffusion_course_name' => 'diffusion_course_name',
            'race_status_code' => 'race_status_code',
            'distance_yard' => 'distance_yard',
            '(GetDistanceInFurlong)' => 'distance_furlong_rounded',
            'race_instance_title' => 'race_instance_title',
            'race_type_code' => 'race_type_code',
            'race_surface' => 'race_surface',
            'race_group_code' => 'race_group_code',
            'race_group_desc' => 'race_group_desc',
            'race_class' => 'race_class',
        ];

        $hasRaceReplayVideo = $this->dataToMap['has_race_replay_video'];
        // we should show "has_race_replay_video" Only for owner groups = 5 Otherwise omit the field.
        // This field is set to null in the SQL and overridden in the BO depending on the owner group id.
        if (!is_null($hasRaceReplayVideo)) {
            $mapper['has_race_replay_video'] = 'has_race_replay_video';
        }

        // the rest of the mapper's mandatory fields:
        $mapper = array_merge($mapper, [
            'stream_url' => 'stream_url',
            'runners' => 'runners'
        ]);

        // we don't need it anymore, let's not leave it and cause unpredicted results.
        unset($this->dataToMap);

        return $mapper;
    }
}
