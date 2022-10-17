<?php
namespace Controllers\Horses\RaceMeetings;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

class GoingChangesTest extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/race-meetings/going-changes/2019-10-25';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //models\Bo\RaceMeetings\RaceInstance:934 ->getGoingChanges()
            'f03a8b66c8e4d196ffeab50ab3330f39' => [
                [
                    'course_uid' => 11,
                    'course_name' => "Cheltenham",
                    'course_region' => 'GB & IRE',
                    'country_code' => "GB",
                    'meeting_going_desc' => "SOFT (Heavy in places) changing to HEAVY after Race 1 (2.00)",
                    'weather_conditions' => "Rain",
                    'races' => null,
                    'race_instance_uid' => 740997,
                    'race_datetime' => "2019-10-25T15:45:00+01:00",
                    'previous_goings' => null,
                    'race_instance_title' => "Matchbook Most Trusted Betting Exchange Novices' Chase",
                    'distance_yard' => 5360,
                    'race_going_history_uid' => 68566,
                    'race_status_code' => null,
                    'md_going_desc' => null,
                    'pmd_going_desc' => null,
                    'ri_going_type_code' => "G",
                    'ri_going_type_desc' => "Good",
                    'h_going_type_code' => "G",
                    'h_going_type_desc' => "Good",
                    'going_change_date_time' => "2019-10-18T09:08:26+01:00"
                ]
            ]
        ];
    }
}
