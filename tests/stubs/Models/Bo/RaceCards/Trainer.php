<?php

namespace Tests\Stubs\Models\Bo\RaceCards;

class Trainer extends \Tests\Stubs\Models\Trainer
{
    /**
     * @param $raceId
     *
     * @return array
     * @throws \Exception
     */
    public function getTrainerIdsForStatistics($raceId)
    {
        $data = [
            614973 => [14931, 236, 14931, 5715, 8543, 9714, 15107, 16467, 703, 667, 29599]
        ];

        return $data[$raceId];
    }

    public function getTrainerspot()
    {
        return [
            [
                \Api\Row\RaceInstance::createFromArray(
                    [
                        'trainer_uid' => 35,
                        'style_name' => 'J R Jenkins',
                        'race_datetime' => 'Oct 30 2016  3:35PM',
                        'days_ago' => 1,
                        'race_outcome_position' => 2,
                        'race_outcome_form_char' => '2',
                        'rp_postmark' => 0,
                        'rp_pre_postmark' => 85,
                        'race_distance' => 3471,
                        'dist_to_winner' => 5,
                        'runners' => 7,
                    ]
                ),
                \Api\Row\RaceInstance::createFromArray(
                    [
                        'trainer_uid' => 35,
                        'style_name' => 'J R Jenkins',
                        'race_datetime' => 'Oct 28 2016  3:35PM',
                        'days_ago' => 3,
                        'race_outcome_position' => 2,
                        'race_outcome_form_char' => '2',
                        'rp_postmark' => 0,
                        'rp_pre_postmark' => 85,
                        'race_distance' => 3471,
                        'dist_to_winner' => 10,
                        'runners' => 10,
                    ]
                ),
                \Api\Row\RaceInstance::createFromArray(
                    [
                        'trainer_uid' => 35,
                        'style_name' => 'J R Jenkins',
                        'race_datetime' => 'Oct 28 2016  3:35PM',
                        'days_ago' => 3,
                        'race_outcome_position' => 2,
                        'race_outcome_form_char' => '2',
                        'rp_postmark' => 0,
                        'rp_pre_postmark' => 85,
                        'race_distance' => 3471,
                        'dist_to_winner' => 10,
                        'runners' => 10,
                    ]
                ),
                \Api\Row\RaceInstance::createFromArray(
                    [
                        'trainer_uid' => 35,
                        'style_name' => 'J R Jenkins',
                        'race_datetime' => 'Oct 28 2016  3:35PM',
                        'days_ago' => 3,
                        'race_outcome_position' => 2,
                        'race_outcome_form_char' => '2',
                        'rp_postmark' => 0,
                        'rp_pre_postmark' => 85,
                        'race_distance' => 3471,
                        'dist_to_winner' => 10,
                        'runners' => 10,
                    ]
                ),
                \Api\Row\RaceInstance::createFromArray(
                    [
                        'trainer_uid' => 35,
                        'style_name' => 'J R Jenkins',
                        'race_datetime' => 'Oct 28 2016  3:35PM',
                        'days_ago' => 3,
                        'race_outcome_position' => 2,
                        'race_outcome_form_char' => '2',
                        'rp_postmark' => 0,
                        'rp_pre_postmark' => 85,
                        'race_distance' => 3471,
                        'dist_to_winner' => 10,
                        'runners' => 10,
                    ]
                ),
                \Api\Row\RaceInstance::createFromArray(
                    [
                        'trainer_uid' => 35,
                        'style_name' => 'J R Jenkins',
                        'race_datetime' => 'Oct 28 2016  3:35PM',
                        'days_ago' => 3,
                        'race_outcome_position' => 2,
                        'race_outcome_form_char' => '2',
                        'rp_postmark' => 0,
                        'rp_pre_postmark' => 85,
                        'race_distance' => 3471,
                        'dist_to_winner' => 10,
                        'runners' => 10,
                    ]
                )
            ]
        ];
    }
}
