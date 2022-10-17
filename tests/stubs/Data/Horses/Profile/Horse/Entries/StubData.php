<?php

namespace Tests\Stubs\Data\Horses\Profile\Horse\Entries;

use UnitTestsComponents\Stubs\StubDataInterface;

/**
 * Class StubData
 * @package Tests\Stubs\Data\Horses\Profile\Horse\AllEntries
 */
class StubData implements StubDataInterface
{
    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Models\Bo\HorseProfile\RaceInstance:104 ->getEntries()
            'b9e97d97e71655fb14559556dcc46754' => [
                [
                    'race_instance_uid' => 693226,
                    'race_datetime' => '2018-02-22 13:50:00',
                    'course_name' => 'HUNTINGDON',
                    'course_type_code' => 'J',
                    'course_uid' => 26,
                    'course_style_name' => 'Huntingdon',
                    'race_instance_title' => 'Smarkets Handicap Hurdle',
                    'race_status_code' => 'O',
                    'distance_yard' => 4545,
                    'country_code' => 'GB ',
                    'race_class' => '5',
                    'surface' => 'Turf',
                    'race_type_code' => 'F',
                    'race_group_uid' => null,
                    'rp_ages_allowed_desc' => '2yo',
                    'saddle_cloth_no' => 11,
                    'rp_postmark' => 89,
                    'jockey_uid' => 89471,
                    'jockey_style_name' => 'Michael Heard',
                    'jockey_ptp_type_code' => 'N',
                    'running_conditions' => null,
                    'rp_owner_choice' => 'a',
                    'owner_uid' => 48394,
                    'num_overnight_races' => 58,
                ],
            ],
            //Models\Bo\RaceCards\Runners:660 ->getDaysSinceLastRun()
            'd57de0d286f940b45623977c1cc0c667' => [
                [
                    'horse_uid' => 807486,
                    'race_type_code' => 'flat',
                    'days_since_run' => 18,
                ]
            ],
            //Models\Bo\HorseProfile\HorseRace:156 ->getJockeyStats14Days()
            '9dc182346035aad9f4bd3066760d2ab0' => [
                [
                    'jockey_uid' => 89471,
                    'runs' => 3,
                    'wins' => 0,
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function getExpected(): string
    {
        return file_get_contents(dirname(__FILE__) . '/expected.json');
    }

    /**
     * @return array
     */
    public function getReplacement(): array
    {
        return [];
    }
}
