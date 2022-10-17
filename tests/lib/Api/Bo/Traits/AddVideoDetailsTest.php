<?php

namespace Tests\Lib\Bo\Traits;

use Phalcon\Mvc\Model\Row\General as GeneralRow;

class AddVideoDetailsTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param $expectedResult
     * @param $races
     *
     * @dataProvider dataProviderAddVideoDetails
     */
    public function testAddVideoDetails($expectedResult, $races)
    {
        $data = new \Tests\Stubs\Lib\Api\Bo\Traits\AddVideoDetail();

        $data->addVideoDetails($races);
        $this->assertEquals($expectedResult, $races);
    }

    public function dataProviderAddVideoDetails()
    {
        return [
            [
                [
                    123 => \Api\Row\HorseRace::createFromArray([
                        'race_instance_uid' => 123,
                        'video_detail' => array(
                            0 =>
                                GeneralRow::createFromArray(array(
                                    'race_instance_uid' => 123,
                                    'ptv_video_id' => 42532,
                                    'video_provider' => 'ATR',
                                    'complete_race_uid' => 42532,
                                    'complete_race_start' => 0,
                                    'complete_race_end' => 1,
                                    'finish_race_uid' => 42532,
                                    'finish_race_start' => 0,
                                    'finish_race_end' => 1,
                                )),
                        ),
                    ])
                ],
                [
                    123 => \Api\Row\HorseRace::createFromArray(['race_instance_uid' => 123])
                ],
            ],
            [
                [
                    123 => \Api\Row\HorseRace::createFromArray([
                        'race_instance_uid' => 123,
                        'video_detail' => array(
                            0 =>
                                GeneralRow::createFromArray(array(
                                    'race_instance_uid' => 123,
                                    'ptv_video_id' => 177336,
                                    'video_provider' => 'ATR',
                                    'complete_race_uid' => 248,
                                    'complete_race_start' => 0,
                                    'complete_race_end' => 1,
                                    'finish_race_uid' => 248,
                                    'finish_race_start' => 0,
                                    'finish_race_end' => 1,
                                )),
                            1 =>
                                GeneralRow::createFromArray(array(
                                    'race_instance_uid' => 123,
                                    'ptv_video_id' => 42532,
                                    'video_provider' => 'RUK',
                                    'complete_race_uid' => 42532,
                                    'complete_race_start' => 1253,
                                    'complete_race_end' => 356,
                                    'finish_race_uid' => 42532,
                                    'finish_race_start' => 4565,
                                    'finish_race_end' => 36,
                                )),
                        ),
                    ]),
                    456 => \Api\Row\HorseRace::createFromArray([
                        'race_instance_uid' => 456,
                        'video_detail' => array(
                            0 =>
                                GeneralRow::createFromArray(array(
                                    'race_instance_uid' => 456,
                                    'ptv_video_id' => 184110,
                                    'video_provider' => 'ATR',
                                    'complete_race_uid' => 248,
                                    'complete_race_start' => 0,
                                    'complete_race_end' => 1,
                                    'finish_race_uid' => 248,
                                    'finish_race_start' => 0,
                                    'finish_race_end' => 1,
                                )),
                        ),
                    ])
                ],
                [
                    123 => \Api\Row\HorseRace::createFromArray(['race_instance_uid' => 123]),
                    456 => \Api\Row\HorseRace::createFromArray(['race_instance_uid' => 456])
                ],
            ],
            [
                [
                    789 => \Api\Row\HorseRace::createFromArray([
                        'race_instance_uid' => 789,
                        'video_detail' => null
                    ])
                ],
                [
                    789 => \Api\Row\HorseRace::createFromArray(['race_instance_uid' => 789])
                ],
            ],
        ];
    }
}
