<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Predictor\Race;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\Predictor\Race
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/predictor/703924';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\Predictor\RaceInstance:37 ->isRaceExists()
            '54142a535db4ac7afa1e5ae630e0d795' => [
                [
                    'computed' => 1,
                ],
            ],
            //Api\DataProvider\Bo\Predictor\RaceInstance:83 ->getRace()
            'd87d292066afff74a5a87304cc7def87' => [
                [
                    'race_instance_uid' => 703924,
                    'race_type_code' => 'F',
                    'race_datetime' => '2018-06-27 14:00:00',
                    'race_status_code' => 'O',
                    'course' => 'CARLISLE',
                    'course_uid' => 8,
                    'country_code' => 'GB ',
                    'distance_yard' => 1100,
                    'going' => 'Good To Firm',
                    'ages_allowed' => '2yo',
                    'latitude' => 54.862382,
                    'longitude' => -2.931161,
                ],
            ],
            //Api\DataProvider\Bo\Predictor\RaceInstance:37 ->isRaceExists()
            '54142a535db4ac7afa1e5ae630e0d795' => [
                [
                    'computed' => 1,
                ],
            ],
            //Api\DataProvider\Bo\Predictor\RaceInstance:169 ->getHorses()
            '13593c8dcb3b6373081caa0a4684d048' => [
                [
                    'race_instance_uid' => 703924,
                    'style_name' => 'Tick Tock Croc',
                    'country_origin_code' => 'IRE',
                    'horse_id' => 1796230,
                    'start_number' => 4,
                    'owner_choice' => 'a',
                    'non_runner' => null,
                    'owner_uid' => 152765,
                    'owner_name' => 'Ceffyl Racing',
                ],
                [
                    'race_instance_uid' => 703924,
                    'style_name' => 'Kalissi',
                    'country_origin_code' => 'GB',
                    'horse_id' => 1796359,
                    'start_number' => 6,
                    'owner_choice' => 'a',
                    'non_runner' => 'Y',
                    'owner_uid' => 89641,
                    'owner_name' => 'Brian Ellison Racing Club',
                ],
                [
                    'race_instance_uid' => 703924,
                    'style_name' => 'Lorton',
                    'country_origin_code' => 'GB',
                    'horse_id' => 1797824,
                    'start_number' => 7,
                    'owner_choice' => 'a',
                    'non_runner' => null,
                    'owner_uid' => 6489,
                    'owner_name' => 'G B Turnbull Ltd',
                ],
                [
                    'race_instance_uid' => 703924,
                    'style_name' => 'Gunnabedun',
                    'country_origin_code' => 'IRE',
                    'horse_id' => 1996395,
                    'start_number' => 2,
                    'owner_choice' => 'a',
                    'non_runner' => 'Y',
                    'owner_uid' => 262958,
                    'owner_name' => 'Davidson & Jardine',
                ],
                [
                    'race_instance_uid' => 703924,
                    'style_name' => 'Princes Des Sables',
                    'country_origin_code' => 'GB',
                    'horse_id' => 2023601,
                    'start_number' => 8,
                    'owner_choice' => 'c',
                    'non_runner' => null,
                    'owner_uid' => 202723,
                    'owner_name' => 'J C G Chua & C K Ong',
                ],
                [
                    'race_instance_uid' => 703924,
                    'style_name' => 'Baby Steps',
                    'country_origin_code' => 'GB',
                    'horse_id' => 2025065,
                    'start_number' => 1,
                    'owner_choice' => 'b',
                    'non_runner' => null,
                    'owner_uid' => 224994,
                    'owner_name' => 'David Lowe',
                ],
                [
                    'race_instance_uid' => 703924,
                    'style_name' => 'Micronize',
                    'country_origin_code' => 'IRE',
                    'horse_id' => 2036943,
                    'start_number' => 3,
                    'owner_choice' => 'a',
                    'non_runner' => null,
                    'owner_uid' => 260060,
                    'owner_name' => 'Nick Bradley Racing 43',
                ],
                [
                    'race_instance_uid' => 703924,
                    'style_name' => 'Forcetoreckon',
                    'country_origin_code' => 'GB',
                    'horse_id' => 2064007,
                    'start_number' => 5,
                    'owner_choice' => 'a',
                    'non_runner' => null,
                    'owner_uid' => 147742,
                    'owner_name' => 'Habton Farms',
                ],
            ],
            //Api\DataProvider\Bo\Predictor\RaceInstance:228 ->getPostdata()
            '642e15e5a9f1084e9f2b78c28eee6e6b' => [
                [
                    'horse_style_name' => 'Tick Tock Croc',
                    'trainer_record_output' => '-',
                    'trainer_form_output' => 'a',
                    'going_output' => '?',
                    'distance_output' => '?',
                    'course_output' => '?',
                    'ability_output' => 'X',
                    'recent_form_output' => 'X',
                    'group_race' => ' ',
                    'saddle_cloth_no' => 4,
                    'horse_uid' => 1796230,
                    'rp_tops' => 44,
                    'rp_pm_chars' => null,
                    'official_rating' => 0,
                    'draw_output' => '-',
                    'race_instance_uid' => 703924,
                    'jockey_no_wins_flag' => ' ',
                    'first_time_blinkers' => ' ',
                    'jockey_wins' => 73,
                    'jockey_stable_wins' => 25,
                    'is_first_time' => null,
                    'race_datetime' => '2018-06-27 14:00:00',
                    'course_name' => 'CARLISLE',
                    'trainer_id' => 373,
                    'top_speed' => 44,
                    'RPR' => 60,
                    'form_points' => 0.0,
                ],
                [
                    'horse_style_name' => 'Kalissi',
                    'trainer_record_output' => '-',
                    'trainer_form_output' => 'a',
                    'going_output' => 'a',
                    'distance_output' => 'a',
                    'course_output' => '?',
                    'ability_output' => 'a',
                    'recent_form_output' => 'a',
                    'group_race' => ' ',
                    'saddle_cloth_no' => 6,
                    'horse_uid' => 1796359,
                    'rp_tops' => 37,
                    'rp_pm_chars' => null,
                    'official_rating' => 0,
                    'draw_output' => '-',
                    'race_instance_uid' => 703924,
                    'jockey_no_wins_flag' => ' ',
                    'first_time_blinkers' => ' ',
                    'jockey_wins' => 31,
                    'jockey_stable_wins' => 25,
                    'is_first_time' => 'Y',
                    'race_datetime' => '2018-06-27 14:00:00',
                    'course_name' => 'CARLISLE',
                    'trainer_id' => 4431,
                    'top_speed' => 37,
                    'RPR' => 72,
                    'form_points' => 0.75,
                ],
                [
                    'horse_style_name' => 'Lorton',
                    'trainer_record_output' => '-',
                    'trainer_form_output' => 'a',
                    'going_output' => 'a',
                    'distance_output' => 'a',
                    'course_output' => 'a',
                    'ability_output' => 'aa',
                    'recent_form_output' => 'aa',
                    'group_race' => ' ',
                    'saddle_cloth_no' => 7,
                    'horse_uid' => 1797824,
                    'rp_tops' => 66,
                    'rp_pm_chars' => 'X',
                    'official_rating' => 0,
                    'draw_output' => '-',
                    'race_instance_uid' => 703924,
                    'jockey_no_wins_flag' => ' ',
                    'first_time_blinkers' => ' ',
                    'jockey_wins' => 83,
                    'jockey_stable_wins' => 25,
                    'is_first_time' => null,
                    'race_datetime' => '2018-06-27 14:00:00',
                    'course_name' => 'CARLISLE',
                    'trainer_id' => 12225,
                    'top_speed' => 66,
                    'RPR' => 91,
                    'form_points' => 1.5,
                ],
                [
                    'horse_style_name' => 'Gunnabedun',
                    'trainer_record_output' => '-',
                    'trainer_form_output' => '-',
                    'going_output' => '-',
                    'distance_output' => '-',
                    'course_output' => '-',
                    'ability_output' => '-',
                    'recent_form_output' => '-',
                    'group_race' => ' ',
                    'saddle_cloth_no' => 2,
                    'horse_uid' => 1996395,
                    'rp_tops' => null,
                    'rp_pm_chars' => null,
                    'official_rating' => 0,
                    'draw_output' => '-',
                    'race_instance_uid' => 703924,
                    'jockey_no_wins_flag' => ' ',
                    'first_time_blinkers' => ' ',
                    'jockey_wins' => 0,
                    'jockey_stable_wins' => 0,
                    'is_first_time' => null,
                    'race_datetime' => '2018-06-27 14:00:00',
                    'course_name' => 'CARLISLE',
                    'trainer_id' => 21516,
                    'top_speed' => null,
                    'RPR' => 0,
                    'form_points' => 0.0,
                ],
                [
                    'horse_style_name' => 'Princes Des Sables',
                    'trainer_record_output' => '-',
                    'trainer_form_output' => 'a',
                    'going_output' => '?',
                    'distance_output' => '?',
                    'course_output' => '?',
                    'ability_output' => 'aa',
                    'recent_form_output' => 'a',
                    'group_race' => ' ',
                    'saddle_cloth_no' => 8,
                    'horse_uid' => 2023601,
                    'rp_tops' => 66,
                    'rp_pm_chars' => null,
                    'official_rating' => 0,
                    'draw_output' => '-',
                    'race_instance_uid' => 703924,
                    'jockey_no_wins_flag' => ' ',
                    'first_time_blinkers' => ' ',
                    'jockey_wins' => 21,
                    'jockey_stable_wins' => 25,
                    'is_first_time' => null,
                    'race_datetime' => '2018-06-27 14:00:00',
                    'course_name' => 'CARLISLE',
                    'trainer_id' => 22525,
                    'top_speed' => 66,
                    'RPR' => 84,
                    'form_points' => 0.75,
                ],
                [
                    'horse_style_name' => 'Baby Steps',
                    'trainer_record_output' => '-',
                    'trainer_form_output' => 'X',
                    'going_output' => 'a',
                    'distance_output' => 'a',
                    'course_output' => '?',
                    'ability_output' => 'aa',
                    'recent_form_output' => 'aa',
                    'group_race' => ' ',
                    'saddle_cloth_no' => 1,
                    'horse_uid' => 2025065,
                    'rp_tops' => 83,
                    'rp_pm_chars' => 'X',
                    'official_rating' => 0,
                    'draw_output' => '-',
                    'race_instance_uid' => 703924,
                    'jockey_no_wins_flag' => ' ',
                    'first_time_blinkers' => ' ',
                    'jockey_wins' => 100,
                    'jockey_stable_wins' => 25,
                    'is_first_time' => null,
                    'race_datetime' => '2018-06-27 14:00:00',
                    'course_name' => 'CARLISLE',
                    'trainer_id' => 31698,
                    'top_speed' => 83,
                    'RPR' => 91,
                    'form_points' => 1.5,
                ],
                [
                    'horse_style_name' => 'Micronize',
                    'trainer_record_output' => '-',
                    'trainer_form_output' => 'a',
                    'going_output' => '?',
                    'distance_output' => '?',
                    'course_output' => '?',
                    'ability_output' => 'X',
                    'recent_form_output' => 'X',
                    'group_race' => ' ',
                    'saddle_cloth_no' => 3,
                    'horse_uid' => 2036943,
                    'rp_tops' => null,
                    'rp_pm_chars' => null,
                    'official_rating' => 0,
                    'draw_output' => '-',
                    'race_instance_uid' => 703924,
                    'jockey_no_wins_flag' => ' ',
                    'first_time_blinkers' => ' ',
                    'jockey_wins' => 64,
                    'jockey_stable_wins' => 25,
                    'is_first_time' => null,
                    'race_datetime' => '2018-06-27 14:00:00',
                    'course_name' => 'CARLISLE',
                    'trainer_id' => 8010,
                    'top_speed' => null,
                    'RPR' => 18,
                    'form_points' => 0.0,
                ],
                [
                    'horse_style_name' => 'Forcetoreckon',
                    'trainer_record_output' => 'aa',
                    'trainer_form_output' => 'a',
                    'going_output' => '-',
                    'distance_output' => '-',
                    'course_output' => '-',
                    'ability_output' => '-',
                    'recent_form_output' => '-',
                    'group_race' => ' ',
                    'saddle_cloth_no' => 5,
                    'horse_uid' => 2064007,
                    'rp_tops' => null,
                    'rp_pm_chars' => null,
                    'official_rating' => 0,
                    'draw_output' => '-',
                    'race_instance_uid' => 703924,
                    'jockey_no_wins_flag' => ' ',
                    'first_time_blinkers' => ' ',
                    'jockey_wins' => 68,
                    'jockey_stable_wins' => 25,
                    'is_first_time' => null,
                    'race_datetime' => '2018-06-27 14:00:00',
                    'course_name' => 'CARLISLE',
                    'trainer_id' => 10152,
                    'top_speed' => null,
                    'RPR' => 0,
                    'form_points' => 0.0,
                ],
            ],
        ];
    }
}
