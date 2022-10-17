<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Profile\Notes;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 * @package Tests\Controllers\Horses\Profile\Notes
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/profile/horse/595255/notes';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Models\Bo\HorseProfile\RaceInstance:359 ->getNotes()
            '77d1e52b1224ad5f95e8ebda2568dac1' => [
                [
                    'horse_uid' => 595255,
                    'horse_name' => 'AUSTRALIA',
                    'horse_style_name' => 'Australia',
                    'country_origin_code' => 'GB ',
                    'race_id' => '569322',
                    'race_date' => '2014-06-07 16:00:00.000',
                    'course_uid' => '17',
                    'course_name' => 'EPSOM',
                    'course_type_code' => 'F',
                    'course_style_name' => 'Epsom',
                    'distance_yard' => '2646',
                    'race_title' => 'Investec Derby (Group 1) (Entire Colts & Fillies)',
                    'going_type_code' => 'G ',
                    'rp_postmark' => 125,
                    'notes_type_code' => 'R',
                    'notes' => 'did the job well on the day that he was born and bred to shine'
                ]
            ],
            //Models\Bo\HorseProfile\RaceInstance:359 ->getNotes()
            'c87dc64f5e0f230d9d6132bd32be975d' => [
                [
                    'horse_uid' => 595255,
                    'horse_name' => 'AUSTRALIA',
                    'horse_style_name' => 'Australia',
                    'country_origin_code' => 'GB ',
                    'race_id' => '569322',
                    'race_date' => '2014-06-07 16:00:00.000',
                    'course_uid' => '17',
                    'course_name' => 'EPSOM',
                    'course_type_code' => 'F',
                    'course_style_name' => 'Epsom',
                    'distance_yard' => '2646',
                    'race_title' => 'Investec Derby (Group 1) (Entire Colts & Fillies)',
                    'going_type_code' => 'G ',
                    'rp_postmark' => 125,
                    'notes_type_code' => '8',
                    'notes' => '\b(4.00)\p eyecatcher note'
                ]
            ],
            //Models\Bo\HorseProfile\RaceInstance:359 ->getNotes()
            '93ff0ea3809a694dd2c9e2bee3d87e61' => [
                [
                    'horse_uid' => 595255,
                    'horse_name' => 'AUSTRALIA',
                    'horse_style_name' => 'Australia',
                    'country_origin_code' => 'GB ',
                    'race_id' => '569322',
                    'race_date' => '2014-06-07 16:00:00.000',
                    'course_uid' => '17',
                    'course_name' => 'EPSOM',
                    'course_type_code' => 'F',
                    'course_style_name' => 'Epsom',
                    'distance_yard' => '2646',
                    'race_title' => 'Investec Derby (Group 1) (Entire Colts & Fillies)',
                    'going_type_code' => 'G ',
                    'rp_postmark' => 125,
                    'notes_type_code' => '9',
                    'notes' => '\b(4.00)\p did the job well on the day that he was born and bred to shine'
                ]
            ],
        ];
    }
}
