<?php

namespace Tests\Stubs\Models\Bo\RaceCards;

class HorseRace extends \Tests\Stubs\Models\HorseRace
{
    /**
     * @param array $horseIds
     * @param array $raceTypeCodes
     *
     * @return array
     */
    public function getTopspeedLastYear(array $horseIds, array $raceTypeCodes)
    {
        $data = [
            '1e5ce9bc49701949570994f66b8647bd' => [
                811858 => \Phalcon\Mvc\Model\Row\General::createFromArray([
                    'horse_uid' => 811858,
                    'rp_postmark' => 128,
                    'rp_topspeed' => 40,
                    'course_name' => 'LEOPARDSTOWN',
                    'course_style_name' => 'Leopardstown',
                    'race_instance_uid' => 615460,
                    'race_datetime' => 'Dec 28 2014  1:50PM',
                    'race_type_code' => 'H',
                    'race_instance_title' => 'Squared Financial Christmas Hurdle (Grade 1)',
                    'distance_yard' => 5280,
                    'rp_close_up_comment' => 'held up towards rear, 6th halfway, took closer order behind leaders in 5th when mistake 2 out, soon weakened and dropped to rear before last, eased run-in',
                    'race_outcome_code' => 8,
                    'services_desc' => 'Sft',
                    'race_group_code' => 'H',
                    'no_runners' => 8,
                ]),
                735305 => \Phalcon\Mvc\Model\Row\General::createFromArray([
                    'horse_uid' => 735305,
                    'rp_postmark' => 152,
                    'rp_topspeed' => 140,
                    'course_name' => 'NAVAN',
                    'course_style_name' => 'Navan',
                    'race_instance_uid' => 596058,
                    'race_datetime' => 'Feb 16 2014  2:10PM',
                    'race_type_code' => 'H',
                    'race_instance_title' => 'Ladbrokes Boyne Hurdle (Grade 2)',
                    'distance_yard' => 4620,
                    'rp_close_up_comment' => 'settled behind leaders after 1st, slight mistake 4th and niggled along after, reminder after next, not fluent 6th, ridden from 4 out and went 3rd briefly next, no impression 2 out, kept on under pressure into moderate 2nd run-in',
                    'race_outcome_code' => 2,
                    'services_desc' => 'Hy',
                    'race_group_code' => 'H',
                    'no_runners' => 4,
                ]),
            ],
            'a2072c8a50f1127f73a55a6b5f574da7' => [
                811858 => \Phalcon\Mvc\Model\Row\General::createFromArray([
                    'horse_uid' => 811858,
                    'rp_postmark' => 128,
                    'rp_topspeed' => 40,
                    'course_name' => 'LEOPARDSTOWN',
                    'course_style_name' => 'Leopardstown',
                    'race_instance_uid' => 615460,
                    'race_datetime' => 'Dec 28 2014  1:50PM',
                    'race_type_code' => 'H',
                    'race_instance_title' => 'Squared Financial Christmas Hurdle (Grade 1)',
                    'distance_yard' => 5280,
                    'rp_close_up_comment' => 'held up towards rear, 6th halfway, took closer order behind leaders in 5th when mistake 2 out, soon weakened and dropped to rear before last, eased run-in',
                    'race_outcome_code' => 8,
                    'services_desc' => 'Sft',
                    'race_group_code' => 'H',
                    'no_runners' => 8,
                ]),
                735305 => \Phalcon\Mvc\Model\Row\General::createFromArray([
                    'horse_uid' => 735305,
                    'rp_postmark' => 152,
                    'rp_topspeed' => 140,
                    'course_name' => 'NAVAN',
                    'course_style_name' => 'Navan',
                    'race_instance_uid' => 596058,
                    'race_datetime' => 'Feb 16 2014  2:10PM',
                    'race_type_code' => 'H',
                    'race_instance_title' => 'Ladbrokes Boyne Hurdle (Grade 2)',
                    'distance_yard' => 4620,
                    'rp_close_up_comment' => 'settled behind leaders after 1st, slight mistake 4th and niggled along after, reminder after next, not fluent 6th, ridden from 4 out and went 3rd briefly next, no impression 2 out, kept on under pressure into moderate 2nd run-in',
                    'race_outcome_code' => 2,
                    'services_desc' => 'Hy',
                    'race_group_code' => 'H',
                    'no_runners' => 4,
                ]),
            ]
        ];
        $key = md5(serialize(func_get_args()));//1e5ce9bc49701949570994f66b8647bd 4e9ca40bcad25d41c4d9e472e17f6b4c a2072c8a50f1127f73a55a6b5f574da7
        return $data[$key];
    }

    /**
     * @param array $horseIds
     * @param string $rpGoingTypeDesc
     * @param array $raceTypeCodes
     *
     * @return array
     */
    public function getTopspeedGoing(array $horseIds, $rpGoingTypeDesc, array $raceTypeCodes)
    {
        $data = [
            '8a2f99101f3607c0412e0a568ecee522' => [
                811858 => \Phalcon\Mvc\Model\Row\General::createFromArray([
                    'horse_uid' => 811858,
                    'rp_postmark' => 150,
                    'rp_topspeed' => 126,
                    'course_name' => 'NAAS',
                    'course_style_name' => 'Naas',
                    'race_instance_uid' => 593864,
                    'race_datetime' => 'Jan  5 2014  1:30PM',
                    'race_type_code' => 'H',
                    'race_instance_title' => 'Slaney Novice Hurdle (Grade 2)',
                    'distance_yard' => 4400,
                    'rp_close_up_comment' => 'tracked leader in 2nd, niggled along 3 out and soon closed on outer to get on terms before next, led narrowly between last 2, not fluent last and kept on well under pressure run-in',
                    'race_outcome_code' => 1,
                    'services_desc' => 'Sft',
                    'race_group_code' => 'H',
                    'no_runners' => 3,
                ]),
                735305 => \Phalcon\Mvc\Model\Row\General::createFromArray([
                    'horse_uid' => 735305,
                    'rp_postmark' => 163,
                    'rp_topspeed' => 132,
                    'course_name' => 'GOWRAN PARK',
                    'course_style_name' => 'Gowran park',
                    'race_instance_uid' => 548318,
                    'race_datetime' => 'Feb 18 2012  3:15PM',
                    'race_type_code' => 'H',
                    'race_instance_title' => 'Red Mills Trial Hurdle (Grade 2)',
                    'distance_yard' => 3520,
                    'rp_close_up_comment' => 'tracked leaders in 3rd, 2nd halfway, led after 4 out, travelled strongly and in control from 2 out, kept on well run-in, unextended',
                    'race_outcome_code' => 1,
                    'services_desc' => 'Sft',
                    'race_group_code' => 'H',
                    'no_runners' => 6,
                ]),
            ]
        ];

        return $data[md5(serialize(func_get_args()))];
    }


    /**
     * @param array $horseIds
     * @param array $raceTypeCodes
     * @param string $minDistance
     * @param string $maxDistance
     *
     * @return array
     */
    public function getTopspeedDistance(array $horseIds, array $raceTypeCodes, $minDistance, $maxDistance)
    {
        $data = [
            '81af5bad30137867bb3ff7dad2473a3a' => [//+
                811858 => \Phalcon\Mvc\Model\Row\General::createFromArray([
                    'horse_uid' => 811858,
                    'rp_postmark' => 128,
                    'rp_topspeed' => 40,
                    'course_name' => 'LEOPARDSTOWN',
                    'course_style_name' => 'Leopardstown',
                    'race_instance_uid' => 615460,
                    'race_datetime' => 'Dec 28 2014  1:50PM',
                    'race_type_code' => 'H',
                    'race_instance_title' => 'Squared Financial Christmas Hurdle (Grade 1)',
                    'distance_yard' => 5280,
                    'rp_close_up_comment' => 'held up towards rear, 6th halfway, took closer order behind leaders in 5th when mistake 2 out, soon weakened and dropped to rear before last, eased run-in',
                    'race_outcome_code' => 8,
                    'services_desc' => 'Sft',
                    'race_group_code' => 'H',
                    'no_runners' => 8,
                ]),
                735305=> \Phalcon\Mvc\Model\Row\General::createFromArray([
                    'horse_uid' => 735305,
                    'rp_postmark' => 131,
                    'rp_topspeed' => 121,
                    'course_name' => 'PUNCHESTOWN',
                    'course_style_name' => 'Punchestown',
                    'race_instance_uid' => 574962,
                    'race_datetime' => 'Apr 25 2013  5:30PM',
                    'race_type_code' => 'H',
                    'race_instance_title' => 'Ladbrokes World Series Hurdle (Grade 1)',
                    'distance_yard' => 5280,
                    'rp_close_up_comment' => 'waited with, progress to chase leaders in 4th approaching 2 out, soon no impression in moderate 3rd',
                    'race_outcome_code' => 3,
                    'services_desc' => 'Hy',
                    'race_group_code' => 'H',
                    'no_runners' => 6,
                ]),
            ]
        ];

        return $data[md5(serialize(func_get_args()))];
    }

    /**
     * @param array $horseIds
     * @param array $raceTypeCodes
     * @param int $courseId
     *
     * @return array
     */
    public function getTopspeedCourse(array $horseIds, array $raceTypeCodes, $courseId)
    {
        $data = [
            '7717ca9703dc82ad0adaaed58681c496' => [
                735305 => \Phalcon\Mvc\Model\Row\General::createFromArray([
                    'horse_uid' => 735305,
                    'rp_postmark' => 163,
                    'rp_topspeed' => 132,
                    'course_name' => 'GOWRAN PARK',
                    'course_style_name' => 'Gowran park',
                    'race_instance_uid' => 548318,
                    'race_datetime' => 'Feb 18 2012  3:15PM',
                    'race_type_code' => 'H',
                    'race_instance_title' => 'Red Mills Trial Hurdle (Grade 2)',
                    'distance_yard' => 3520,
                    'rp_close_up_comment' => 'tracked leaders in 3rd, 2nd halfway, led after 4 out, travelled strongly and in control from 2 out, kept on well run-in, unextended',
                    'race_outcome_code' => 1,
                    'services_desc' => 'Sft',
                    'race_group_code' => 'H',
                    'no_runners' => 6,
                ]),
            ]
        ];

        return $data[md5(serialize(func_get_args()))];
    }

    /**
     * @param int $horseId
     * @param array $raceTypeCodes
     * @param string $raceDate
     *
     * @return array
     */
    public function getLast6HorseRacesTopspeeds($horseId, array $raceTypeCodes, $raceDate)
    {
        $data = [
            '8d22544c8ab7c920c81a6ba3cb13038c' => [
                    \Phalcon\Mvc\Model\Row\General::createFromArray([
                        'race_instance_uid' => 615460,
                        'race_datetime' => 'Dec 28 2014  1:50PM',
                        'rp_topspeed' => 40,
                        'race_type_code' => 'H',
                        'course_name' => 'LEOPARDSTOWN',
                        'course_style_name' => 'Leopardstown',
                        'distance_yard' => 5280,
                        'services_desc' => 'Sft',
                        'race_outcome_position' => 8,
                        'race_outcome_code' => '8',
                        'rp_postmark' => 128,
                        'rp_close_up_comment' => 'held up towards rear, 6th halfway, took closer order behind leaders in 5th when mistake 2 out, soon weakened and dropped to rear before last, eased run-in',
                        'race_group_code' => 'H',
                        'no_runners' => 8,
                    ]),
                    \Phalcon\Mvc\Model\Row\General::createFromArray([
                        'race_instance_uid' => 592287,
                        'race_datetime' => 'Mar 14 2014  2:40PM',
                        'rp_topspeed' => 0,
                        'race_type_code' => 'H',
                        'course_name' => 'CHELTENHAM',
                        'course_style_name' => 'Cheltenham',
                        'distance_yard' => 5280,
                        'services_desc' => 'Gd',
                        'race_outcome_position' => 0,
                        'race_outcome_code' => '0',
                        'rp_postmark' => 0,
                        'rp_close_up_comment' => 'in touch, fell 7th',
                        'race_group_code' => 'H',
                        'no_runners' => 18,
                    ]),
                    \Phalcon\Mvc\Model\Row\General::createFromArray([
                        'race_instance_uid' => 593864,
                        'race_datetime' => 'Jan  5 2014  1:30PM',
                        'rp_topspeed' => 126,
                        'race_type_code' => 'H',
                        'course_name' => 'NAAS',
                        'course_style_name' => 'Naas',
                        'distance_yard' => 4400,
                        'services_desc' => 'Sft',
                        'race_outcome_position' => 1,
                        'race_outcome_code' => '1',
                        'rp_postmark' => 150,
                        'rp_close_up_comment' => 'tracked leader in 2nd, niggled along 3 out and soon closed on outer to get on terms before next, led narrowly between last 2, not fluent last and kept on well under pressure run-in',
                        'race_group_code' => 'H',
                        'no_runners' => 3,
                    ]),
                    \Phalcon\Mvc\Model\Row\General::createFromArray([
                        'race_instance_uid' => 590602,
                        'race_datetime' => 'Dec 15 2013  1:05PM',
                        'rp_topspeed' => 71,
                        'race_type_code' => 'H',
                        'course_name' => 'NAVAN',
                        'course_style_name' => 'Navan',
                        'distance_yard' => 4400,
                        'services_desc' => 'Y/Sft',
                        'race_outcome_position' => 1,
                        'race_outcome_code' =>'1',
                        'rp_postmark' => 147,
                        'rp_close_up_comment' => 'made all, not fluent 3 out and soon niggled along, again not fluent next but extended advantage approaching last where jumped much better, stayed on well',
                        'race_group_code' => 'H',
                        'no_runners' => 2,
                    ]),
                    \Phalcon\Mvc\Model\Row\General::createFromArray([
                        'race_instance_uid' => 591400,
                        'race_datetime' => 'Nov 19 2013 12:45PM',
                        'rp_topspeed' => 112,
                        'race_type_code' => 'H',
                        'course_name' => 'WEXFORD',
                        'course_style_name' => 'Wexford',
                        'distance_yard' => 3960,
                        'services_desc' => 'Sft',
                        'race_outcome_position' => 1,
                        'race_outcome_code' => '1',
                        'rp_postmark' => 138,
                        'rp_close_up_comment' => 'disputed until led from 1st, 1 length clear halfway, jumped slightly left at times, extended advantage from 4 out until pressed before 2 out where steadied, pushed clear again between last 2, easily',
                        'race_group_code' => 'H',
                        'no_runners' => 11,
                    ]),
                    \Phalcon\Mvc\Model\Row\General::createFromArray([
                        'race_instance_uid' => 572711,
                        'race_datetime' => 'Mar 13 2013  5:15PM',
                        'rp_topspeed' => 130,
                        'race_type_code' => 'B',
                        'course_name' => 'CHELTENHAM',
                        'course_style_name' => 'Cheltenham',
                        'distance_yard' => 3630,
                        'services_desc' => 'GS',
                        'race_outcome_position' => 1,
                        'race_outcome_code' => '1',
                        'rp_postmark' => 141,
                        'rp_close_up_comment' => 'held up in last quartet, progress on outer over 4f out, closed on leaders over 2f out, ridden to lead over 1f out, powered clear, readily',
                        'race_group_code' => 'H',
                        'no_runners' => 23,
                    ]),
            ],
            '3fc60fb23cf5ae300e1624725129baca' => [
                \Phalcon\Mvc\Model\Row\General::createFromArray([
                    'race_instance_uid' => 615460,
                    'race_datetime' => 'Dec 28 2014  1:50PM',
                    'rp_topspeed' => 54,
                    'race_type_code' => 'H',
                    'course_name' => 'LEOPARDSTOWN',
                    'course_style_name' => 'Leopardstown',
                    'distance_yard' => 5280,
                    'services_desc' => 'Sft',
                    'race_outcome_position' => 7,
                    'race_outcome_code' => '7',
                    'rp_postmark' => 144,
                    'rp_close_up_comment' => 'chased leaders in 4th until lost place before 2 out, ridden and no extra approaching straight, one pace',
                    'race_group_code' => 'H',
                    'no_runners' => 8,
                ]),
                \Phalcon\Mvc\Model\Row\General::createFromArray([
                    'race_instance_uid' => 614212,
                    'race_datetime' => 'Nov 30 2014  1:30PM',
                    'rp_topspeed' => 0,
                    'race_type_code' => 'H',
                    'course_name' => 'FAIRYHOUSE',
                    'course_style_name' => 'Fairyhouse',
                    'distance_yard' => 4400,
                    'services_desc' => 'Y',
                    'race_outcome_position' => 0,
                    'race_outcome_code' => '0',
                    'rp_postmark' => 0,
                    'rp_close_up_comment' => 'chased leader in 2nd, moderate 2nd when fell 5th',
                    'race_group_code' => 'H',
                    'no_runners' => 5,
                ]),
                \Phalcon\Mvc\Model\Row\General::createFromArray([
                    'race_instance_uid' => 613916,
                    'race_datetime' => 'Nov  9 2014  1:20PM',
                    'rp_topspeed' => 84,
                    'race_type_code' => 'H',
                    'course_name' => 'NAVAN',
                    'course_style_name' => 'Navan',
                    'distance_yard' => 4400,
                    'services_desc' => 'Y/Sft',
                    'race_outcome_position' => 1,
                    'race_outcome_code' => '1',
                    'rp_postmark' => 152,
                    'rp_close_up_comment' => 'made all, over 2 lengths clear at halfway, going best before 2 out, soon pushed along and in command from last, kept on well',
                    'race_group_code' => 'H',
                    'no_runners' => 4,
                ]),
                \Phalcon\Mvc\Model\Row\General::createFromArray([
                    'race_instance_uid' => 604925,
                    'race_datetime' => 'Jun  8 2014  3:10PM',
                    'rp_topspeed' => 0,
                    'race_type_code' => 'H',
                    'course_name' => 'AUTEUIL',
                    'course_style_name' => 'Auteuil',
                    'distance_yard' => 5610,
                    'services_desc' => 'VSft',
                    'race_outcome_position' => 6,
                    'race_outcome_code' => '6',
                    'rp_postmark' => 145,
                    'rp_close_up_comment' => 'tracked leaders, lost place and hard ridden 3 out, kept on under pressure run-in, no impression on leaders',
                    'race_group_code' => 'H',
                    'no_runners' => 13,
                ]),
                \Phalcon\Mvc\Model\Row\General::createFromArray([
                    'race_instance_uid' => 603310,
                    'race_datetime' => 'May 18 2014  4:50PM',
                    'rp_topspeed' => 0,
                    'race_type_code' => 'H',
                    'course_name' => 'AUTEUIL',
                    'course_style_name' => 'Auteuil',
                    'distance_yard' => 4730,
                    'services_desc' => 'VSft',
                    'race_outcome_position' => 5,
                    'race_outcome_code' => '5',
                    'rp_postmark' => 150,
                    'rp_close_up_comment' => 'midfield, shuffled back 3 out and ridden after, rallied under pressure from 2 out and stayed on to go 5th towards finish, never able to challenge',
                    'race_group_code' => 'H',
                    'no_runners' => 14,
                ]),
                \Phalcon\Mvc\Model\Row\General::createFromArray([
                    'race_instance_uid' => 596058,
                    'race_datetime' => 'Feb 16 2014  2:10PM',
                    'rp_topspeed' => 140,
                    'race_type_code' => 'H',
                    'course_name' => 'NAVAN',
                    'course_style_name' => 'Navan',
                    'distance_yard' => 4620,
                    'services_desc' => 'Hy',
                    'race_outcome_position' => 2,
                    'race_outcome_code' => '2',
                    'rp_postmark' => 152,
                    'rp_close_up_comment' => 'settled behind leaders after 1st, slight mistake 4th and niggled along after, reminder after next, not fluent 6th, ridden from 4 out and went 3rd briefly next, no impression 2 out, kept on under pressure into moderate 2nd run-in',
                    'race_group_code' => 'H',
                    'no_runners' => 4,
                ]),
            ],
        ];

        return $data[md5(serialize(func_get_args()))];
    }
}
