<?php

namespace Tests\Stubs\Models;

class RaceOutcome extends \Models\RaceOutcome
{
    use StubDataGetter;

    protected static $_stubData = [
        'raceOutcomes' => [
            1 => [
                'race_outcome_uid' => 1,
                'race_outcome_desc' => null,
                'race_outcome_code' => 1,
                'race_outcome_position' => 1,
                'race_outcome_joint_yn' => null,
                'race_outcome_form_char' => null,
                'race_output_order' => null,
                'rp_race_outcome_desc' => null,
                'selby_code' => null,
            ],
            2 => [
                'race_outcome_uid' => 2,
                'race_outcome_desc' => null,
                'race_outcome_code' => 2,
                'race_outcome_position' => 2,
                'race_outcome_joint_yn' => null,
                'race_outcome_form_char' => null,
                'race_output_order' => null,
                'rp_race_outcome_desc' => null,
                'selby_code' => null,
            ],
            3 => [
                'race_outcome_uid' => 3,
                'race_outcome_desc' => null,
                'race_outcome_code' => 3,
                'race_outcome_position' => 3,
                'race_outcome_joint_yn' => null,
                'race_outcome_form_char' => null,
                'race_output_order' => null,
                'rp_race_outcome_desc' => null,
                'selby_code' => null,
            ],
            4 => [
                'race_outcome_uid' => 4,
                'race_outcome_desc' => null,
                'race_outcome_code' => 4,
                'race_outcome_position' => 4,
                'race_outcome_joint_yn' => null,
                'race_outcome_form_char' => null,
                'race_output_order' => null,
                'rp_race_outcome_desc' => null,
                'selby_code' => null,
            ],
            5 => [
                'race_outcome_uid' => 5,
                'race_outcome_desc' => null,
                'race_outcome_code' => 5,
                'race_outcome_position' => 5,
                'race_outcome_joint_yn' => null,
                'race_outcome_form_char' => null,
                'race_output_order' => null,
                'rp_race_outcome_desc' => null,
                'selby_code' => null,
            ],
            6 => [
                'race_outcome_uid' => 6,
                'race_outcome_desc' => null,
                'race_outcome_code' => 6,
                'race_outcome_position' => 6,
                'race_outcome_joint_yn' => null,
                'race_outcome_form_char' => null,
                'race_output_order' => null,
                'rp_race_outcome_desc' => null,
                'selby_code' => null,
            ],
            7 => [
                'race_outcome_uid' => 7,
                'race_outcome_desc' => null,
                'race_outcome_code' => 7,
                'race_outcome_position' => 7,
                'race_outcome_joint_yn' => null,
                'race_outcome_form_char' => null,
                'race_output_order' => null,
                'rp_race_outcome_desc' => null,
                'selby_code' => null,
            ],
            8 => [
                'race_outcome_uid' => 8,
                'race_outcome_desc' => null,
                'race_outcome_code' => 8,
                'race_outcome_position' => 8,
                'race_outcome_joint_yn' => null,
                'race_outcome_form_char' => null,
                'race_output_order' => null,
                'rp_race_outcome_desc' => null,
                'selby_code' => null,
            ],
            9 => [
                'race_outcome_uid' => 9,
                'race_outcome_desc' => null,
                'race_outcome_code' => 9,
                'race_outcome_position' => 9,
                'race_outcome_joint_yn' => null,
                'race_outcome_form_char' => null,
                'race_output_order' => null,
                'rp_race_outcome_desc' => null,
                'selby_code' => null,
            ],
            10 => [
                'race_outcome_uid' => 10,
                'race_outcome_desc' => null,
                'race_outcome_code' => 10,
                'race_outcome_position' => 10,
                'race_outcome_joint_yn' => null,
                'race_outcome_form_char' => null,
                'race_output_order' => null,
                'rp_race_outcome_desc' => null,
                'selby_code' => null,
            ],
            11 => [
                'race_outcome_uid' => 11,
                'race_outcome_desc' => null,
                'race_outcome_code' => 11,
                'race_outcome_position' => 11,
                'race_outcome_joint_yn' => null,
                'race_outcome_form_char' => null,
                'race_output_order' => null,
                'rp_race_outcome_desc' => null,
                'selby_code' => null,
            ],
            62 => [
                'race_outcome_uid' => 62,
                'race_outcome_desc' => null,
                'race_outcome_code' => 'NR',
                'race_outcome_position' => 0,
                'race_outcome_joint_yn' => null,
                'race_outcome_form_char' => null,
                'race_output_order' => null,
                'rp_race_outcome_desc' => null,
                'selby_code' => null,
            ]
        ]
    ];

    /**
     * @param int $horseUid
     * @return array
     */
    public function getByRaceOutcomeUid($raceOutcomeUid)
    {
        return \Phalcon\Mvc\Model\Row\General::createFromArray(self::getStubData('raceOutcomes')[$raceOutcomeUid]);
    }
}
