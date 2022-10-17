<?php

namespace Tests\Stubs\Data\Horses\Profile\Horse\AllEntries;

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
            //Models\Bo\HorseProfile\RaceInstance:99 ->getEntries()
            '477047eb85307e018c4f5bf26514c88c' => [
                [
                    'race_instance_uid' => 698598,
                    'race_datetime' => '2018-05-02 15:55:00',
                    'course_name' => 'PONTEFRACT',
                    'course_type_code' => 'F',
                    'course_uid' => 46,
                    'course_style_name' => 'Pontefract',
                    'race_instance_title' => 'Coral Supporting The Northern Racing College Handicap',
                    'race_status_code' => '5',
                    'distance_yard' => 1766,
                    'saddle_cloth_no' => 13,
                    'rp_postmark' => null,
                    'jockey_uid' => null,
                    'jockey_style_name' => null,
                    'jockey_ptp_type_code' => null,
                    'running_conditions' => null,
                    'rp_owner_choice' => 'a',
                    'owner_uid' => 189171,
                    'num_overnight_races' => 41,
                    'rp_abbrev_3' => 'PON',
                    'local_meeting_race_datetime' => '2018-05-02 15:55:00',
                    'hours_difference' => 0,
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
