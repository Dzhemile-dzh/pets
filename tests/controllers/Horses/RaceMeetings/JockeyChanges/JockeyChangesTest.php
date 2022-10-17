<?php
namespace Controllers\Horses\RaceMeetings;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

class JockeyChangesTest extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/race-meetings/jockey-changes/2019-09-12';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //models\Bo\RaceMeetings\RaceInstance:274 ->getJockeyChanges()
            '7ddf98ab05a72f82443205db9797a7b5' => [
                [
                    'course_uid' => 17,
                    'course_name' => "Epsom",
                    'race_instance_uid' => 737871,
                    'race_datetime' => "2019-09-12T15:55:00+01:00",
                    'horse_uid' => 1437120,
                    'horse_name' => "CASEMENT",
                    'saddle_cloth_no' => 4,
                    'jockey_uid' => 97753,
                    'old_jockey_uid' => 93211,
                    'old_jockey_name' => "Alistair Rawlinson",
                    'jockey_name' => "Mark Crehan",
                    'weight_allowance_lbs' => 7,
                    'races' => null,
                    'horses' => null,
                    'previous_jockeys' => null,
                    'change_date' => "2019-09-12T11:39:16+01:00"
                ]
            ]
        ];
    }
}
