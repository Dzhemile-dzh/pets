<?php

namespace Tests\Stubs\Models\Bo\Results;

class FastHorseRace extends \Tests\Stubs\Models\HorseRace
{
    /**
     * @param $fastRaceId
     *
     * @return array
     */
    public function getRaceFastResult($fastRaceId)
    {
        $data = [
            178847 => (Object)[
                'fast_race_instance_uid' => 178847,
                'course_name' => "SOUTHWELL",
                'race_datetime' => "Jan 22 2015  2:40PM",
                'favorite' => null,
                'no_of_runners' => 7,
                'non_runners' => "Striking Stone, Misu Pete",
                'tote_win_money' => "4.60",
                'dual_forecast' => "10.30",
                'csf' => "9.26",
                'tricast' => "17.58",
                'placepot' => null,
                'miscellaneous' => "| PL: #1.80, #2.20;Trifecta: #24.40; Weighed In",
                'race_instance_uid' => 181129,
                'formbook_yn' => 'Y',
                'horses' => (Object)[
                    'horse_name' => "Pancake Day",
                    'jockey_name' => "A Elliott",
                    'saddle_cloth_number' => 4,
                    'race_outcome_position' => 1,
                    'starting_price' => "7/2",
                ]
            ],
            178848 => (Object)[
                'fast_race_instance_uid' => 178848,
                'course_name' => "SOUTHWELL",
                'race_datetime' => "Jan 22 2015  2:40PM",
                'favorite' => null,
                'no_of_runners' => 7,
                'non_runners' => "Striking Stone, Misu Pete",
                'tote_win_money' => "4.60",
                'dual_forecast' => "10.30",
                'csf' => "9.26",
                'tricast' => "17.58",
                'placepot' => null,
                'miscellaneous' => "| PL: #1.80, #2.20;Trifecta: #24.40; Weighed In",
                'race_instance_uid' => 181129,
                'formbook_yn' => null,
                'horses' => (Object)[
                    'horse_name' => "Pancake Day",
                    'jockey_name' => "A Elliott",
                    'saddle_cloth_number' => 4,
                    'race_outcome_position' => 1,
                    'starting_price' => "7/2",
                ]
            ],
            207236 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                array(
                    'course_name' => 'NEWMARKET',
                    'race_datetime' => 'Apr 19 2017  3:35PM',
                    'favorite' => 'Roly Poly 7/2F',
                    'no_of_runners' => 11,
                    'non_runners' => null,
                    'tote_win_money' => '13.20',
                    'dual_forecast' => '176.30',
                    'csf' => '160.45',
                    'tricast' => null,
                    'placepot' => null,
                    'miscellaneous' => '| PL: #3.70, #3.60, #2.20;Trifecta: #1257.70; Weighed In',
                    'race_instance_uid' => 671748,
                    'fast_race_instance_uid' => 207236,
                    'formbook_yn' => 'Y',
                    'horses' =>
                        array(
                            0 =>
                                \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    array(
                                        'horse_name' => 'Daban',
                                        'saddle_cloth_number' => 3,
                                        'jockey_name' => 'L Dettori',
                                        'odds_desc' => '12/1',
                                        'race_outcome_position' => 1,
                                    )
                                ),
                            1 =>
                                \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    array(
                                        'horse_name' => 'Unforgetable Filly',
                                        'saddle_cloth_number' => 11,
                                        'jockey_name' => 'James Doyle',
                                        'odds_desc' => '14/1',
                                        'race_outcome_position' => 2,
                                    )
                                ),
                            2 =>
                                \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    array(
                                        'horse_name' => 'Poet\'s Vanity',
                                        'saddle_cloth_number' => 7,
                                        'jockey_name' => 'Oisin Murphy',
                                        'odds_desc' => '6/1',
                                        'race_outcome_position' => 3,
                                    )
                                ),
                        ),
                )
            ),
            207228 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                array(
                    'course_name' => 'CHELTENHAM',
                    'race_datetime' => 'Apr 19 2017  2:05PM',
                    'favorite' => null,
                    'no_of_runners' => 5,
                    'non_runners' => null,
                    'tote_win_money' => '1.30',
                    'dual_forecast' => '20.10',
                    'csf' => '15.80',
                    'tricast' => null,
                    'placepot' => null,
                    'miscellaneous' => '| PL: #1.10, #7.90;Trifecta: #74.40; Weighed In',
                    'race_instance_uid' => 671661,
                    'fast_race_instance_uid' => 207228,
                    'formbook_yn' => 'Y',
                    'horses' =>
                        array(
                            0 =>
                                \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    array(
                                        'horse_name' => 'William Henry',
                                        'saddle_cloth_number' => 4,
                                        'jockey_name' => 'D N Russell',
                                        'odds_desc' => '8/15F',
                                        'race_outcome_position' => 1,
                                    )
                                ),
                            1 =>
                                \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    array(
                                        'horse_name' => 'Blairs Cove',
                                        'saddle_cloth_number' => 5,
                                        'jockey_name' => 'Ian Popham',
                                        'odds_desc' => '40/1',
                                        'race_outcome_position' => 2,
                                    )
                                ),
                        ),
                )
            )
        ];

        return $data[$fastRaceId];
    }

    /**
     * @param int|null $raceId
     *
     * @return array
     */
    public function getFastRaceId($raceId)
    {
        $data = [
            671748 => 207236,
            671661 => 207228,
        ];

        return $data[$raceId];
    }
}
