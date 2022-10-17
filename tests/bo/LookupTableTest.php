<?php

namespace Tests\Bo;

class LookupTableTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param \Api\Input\Request\Horses\LookupTable\Going $request
     * @param array                                       $expectedResult
     *
     * @dataProvider providerTestGetGoingTypeTable
     */
    public function testGetGoingTypeTable(
        \Api\Input\Request\Horses\LookupTable\Going $request,
        array $expectedResult
    ) {
        $bo = new \Tests\Stubs\Bo\LookupTable($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($bo->getGoingTypeTable())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetGoingTypeTable()
    {
        return [
            [
                new \Api\Input\Request\Horses\LookupTable\Going([]),
                [
                    'F ' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'going_type_code' => 'F',
                            'going_type_desc' => 'Firm',
                            'going_band_uid' => 1,
                            'sporting_life_code' => 'F',
                            'services_desc' => 'Fm',
                            'rp_going_type_desc' => 'FIRM',
                            'rp_going_type_value' => 6
                        ]
                    ),
                    'FT' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'going_type_code' => 'FT',
                            'going_type_desc' => 'Fast',
                            'going_band_uid' => 4,
                            'sporting_life_code' => 'A',
                            'services_desc' => 'Fs',
                            'rp_going_type_desc' => 'FAST',
                            'rp_going_type_value' => 10
                        ]
                    ),
                    'FZ' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'going_type_code' => 'FZ',
                            'going_type_desc' => 'Frozen',
                            'going_band_uid' => 4,
                            'sporting_life_code' => 'R',
                            'services_desc' => 'F',
                            'rp_going_type_desc' => 'FROZEN',
                            'rp_going_type_value' => 1
                        ]
                    ),
                    'G ' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'going_type_code' => 'G',
                            'going_type_desc' => 'Good',
                            'going_band_uid' => 2,
                            'sporting_life_code' => 'G',
                            'services_desc' => 'Gd',
                            'rp_going_type_desc' => 'GOOD',
                            'rp_going_type_value' => 4
                        ]
                    ),
                    'GF' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'going_type_code' => 'GF',
                            'going_type_desc' => 'Good To Firm',
                            'going_band_uid' => 1,
                            'sporting_life_code' => 'M',
                            'services_desc' => 'GF',
                            'rp_going_type_desc' => 'GD-FM',
                            'rp_going_type_value' => 5
                        ]
                    ),
                    'GS' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'going_type_code' => 'GS',
                            'going_type_desc' => 'Good To Soft',
                            'going_band_uid' => 3,
                            'sporting_life_code' => 'D',
                            'services_desc' => 'GS',
                            'rp_going_type_desc' => 'GD-SFT',
                            'rp_going_type_value' => 3
                        ]
                    ),
                    'GY' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'going_type_code' => 'GY',
                            'going_type_desc' => 'Good To Yielding',
                            'going_band_uid' => 3,
                            'sporting_life_code' => 'X',
                            'services_desc' => 'Gd/Y',
                            'rp_going_type_desc' => 'GD-YLD',
                            'rp_going_type_value' => 3
                        ]
                    ),
                    'HD' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'going_type_code' => 'HD',
                            'going_type_desc' => 'Hard',
                            'going_band_uid' => 1,
                            'sporting_life_code' => 'H',
                            'services_desc' => 'Hd',
                            'rp_going_type_desc' => 'HARD',
                            'rp_going_type_value' => 7
                        ]
                    ),
                    'HO' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'going_type_code' => 'HO',
                            'going_type_desc' => 'Holding',
                            'going_band_uid' => 3,
                            'sporting_life_code' => 'O',
                            'services_desc' => 'H',
                            'rp_going_type_desc' => 'HOLDING',
                            'rp_going_type_value' => 1
                        ]
                    ),
                    'HY' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'going_type_code' => 'HY',
                            'going_type_desc' => 'Heavy',
                            'going_band_uid' => 3,
                            'sporting_life_code' => 'V',
                            'services_desc' => 'Hy',
                            'rp_going_type_desc' => 'HEAVY',
                            'rp_going_type_value' => 1
                        ]
                    ),
                    'MY' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'going_type_code' => 'MY',
                            'going_type_desc' => 'Muddy',
                            'going_band_uid' => 4,
                            'sporting_life_code' => 'Q',
                            'services_desc' => 'M',
                            'rp_going_type_desc' => 'MUDDY',
                            'rp_going_type_value' => 1
                        ]
                    ),
                    'S ' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'going_type_code' => 'S',
                            'going_type_desc' => 'Soft',
                            'going_band_uid' => 3,
                            'sporting_life_code' => 'S',
                            'services_desc' => 'Sft',
                            'rp_going_type_desc' => 'SOFT',
                            'rp_going_type_value' => 2
                        ]
                    ),
                    'SD' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'going_type_code' => 'SD',
                            'going_type_desc' => 'Standard',
                            'going_band_uid' => 4,
                            'sporting_life_code' => 'B',
                            'services_desc' => 'St',
                            'rp_going_type_desc' => 'STAND',
                            'rp_going_type_value' => 9
                        ]
                    ),
                    'SF' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'going_type_code' => 'SF',
                            'going_type_desc' => 'Standard To Fast',
                            'going_band_uid' => 4,
                            'sporting_life_code' => 'J',
                            'services_desc' => 'St/Fs',
                            'rp_going_type_desc' => 'STD-FST',
                            'rp_going_type_value' => 10
                        ]
                    ),
                    'SH' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'going_type_code' => 'SH',
                            'going_type_desc' => 'Soft To Heavy',
                            'going_band_uid' => 3,
                            'sporting_life_code' => 'W',
                            'services_desc' => 'Sft/Hy',
                            'rp_going_type_desc' => 'SFT-HVY',
                            'rp_going_type_value' => 1
                        ]
                    ),
                    'SN' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'going_type_code' => 'SN',
                            'going_type_desc' => 'Sand',
                            'going_band_uid' => 4,
                            'sporting_life_code' => 'N',
                            'services_desc' => 'Snd',
                            'rp_going_type_desc' => 'SAND',
                            'rp_going_type_value' => 1
                        ]
                    ),
                    'SS' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'going_type_code' => 'SS',
                            'going_type_desc' => 'Standard To Slow',
                            'going_band_uid' => 4,
                            'sporting_life_code' => 'K',
                            'services_desc' => 'St/Slw',
                            'rp_going_type_desc' => 'STD-SLW',
                            'rp_going_type_value' => 8
                        ]
                    ),
                    'SW' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'going_type_code' => 'SW',
                            'going_type_desc' => 'Slow',
                            'going_band_uid' => 4,
                            'sporting_life_code' => 'C',
                            'services_desc' => 'Sl',
                            'rp_going_type_desc' => 'SLOW',
                            'rp_going_type_value' => 8
                        ]
                    ),
                    'SY' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'going_type_code' => 'SY',
                            'going_type_desc' => 'Sloppy',
                            'going_band_uid' => 4,
                            'sporting_life_code' => 'P',
                            'services_desc' => 'S',
                            'rp_going_type_desc' => 'SLOPPY',
                            'rp_going_type_value' => 1
                        ]
                    ),
                    'VS' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'going_type_code' => 'VS',
                            'going_type_desc' => 'Very Soft',
                            'going_band_uid' => 3,
                            'sporting_life_code' => 'E',
                            'services_desc' => 'VSft',
                            'rp_going_type_desc' => 'V SOFT',
                            'rp_going_type_value' => 1
                        ]
                    ),
                    'Y ' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'going_type_code' => 'Y',
                            'going_type_desc' => 'Yielding',
                            'going_band_uid' => 3,
                            'sporting_life_code' => 'Y',
                            'services_desc' => 'Y',
                            'rp_going_type_desc' => 'YIELD',
                            'rp_going_type_value' => 3
                        ]
                    ),
                    'YS' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'going_type_code' => 'YS',
                            'going_type_desc' => 'Yielding To Soft',
                            'going_band_uid' => 3,
                            'sporting_life_code' => 'Z',
                            'services_desc' => 'Y/Sft',
                            'rp_going_type_desc' => 'YLD-SFT',
                            'rp_going_type_value' => 2
                        ]
                    )
                ]
            ]
        ];
    }

    /**
     * @param \Api\Input\Request\Horses\LookupTable\RaceType $request
     * @param array                                          $expectedResult
     *
     * @dataProvider providerTestGetRaceTypeTable
     */
    public function testGetRaceTypeTable(
        \Api\Input\Request\Horses\LookupTable\RaceType $request,
        array $expectedResult
    ) {
        $bo = new \Tests\Stubs\Bo\LookupTable($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($bo->getRaceTypeTable())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetRaceTypeTable()
    {
        return [
            [
                new \Api\Input\Request\Horses\LookupTable\RaceType([]),
                [
                    "B" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            "race_type_code" => "B",
                            "race_type_desc" => "NH Flat"
                        ]
                    ),
                    "C" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            "race_type_code" => "C",
                            "race_type_desc" => "Chase Turf"
                        ]
                    ),
                    "F" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            "race_type_code" => "F",
                            "race_type_desc" => "Flat Turf"
                        ]
                    ),
                    "H" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            "race_type_code" => "H",
                            "race_type_desc" => "Hurdle Turf"
                        ]
                    ),
                    "P" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            "race_type_code" => "P",
                            "race_type_desc" => "Point-To-Point"
                        ]
                    ),
                    "U" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            "race_type_code" => "U",
                            "race_type_desc" => "Hunter Chase"
                        ]
                    ),
                    "W" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            "race_type_code" => "W",
                            "race_type_desc" => "NH Flat AW"
                        ]
                    ),
                    "X" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            "race_type_code" => "X",
                            "race_type_desc" => "Flat AW"
                        ]
                    ),
                    "Y" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            "race_type_code" => "Y",
                            "race_type_desc" => "Hurdle AW"
                        ]
                    ),
                    "Z" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            "race_type_code" => "Z",
                            "race_type_desc" => "Chase AW"
                        ]
                    )
                ]
            ]
        ];
    }

    /**
     * @param \Api\Input\Request\Horses\LookupTable\CourseType $request
     * @param array                                            $expectedResult
     *
     * @dataProvider providerTestGetCourseTypeTable
     */
    public function testGetCourseTypeTable(
        \Api\Input\Request\Horses\LookupTable\CourseType $request,
        array $expectedResult
    ) {
        $bo = new \Tests\Stubs\Bo\LookupTable($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($bo->getCourseTypeTable())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetCourseTypeTable()
    {
        return [
            [
                new \Api\Input\Request\Horses\LookupTable\CourseType([]),
                [
                    "B" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            "course_type_code" => "B",
                            "course_type_desc" => "Flat & Jump"
                        ]
                    ),
                    "F" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            "course_type_code" => "F",
                            "course_type_desc" => "Flat"
                        ]
                    ),
                    "J" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            "course_type_code" => "J",
                            "course_type_desc" => "Jump"
                        ]
                    ),
                    "P" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            "course_type_code" => "P",
                            "course_type_desc" => "Point-to-point"
                        ]
                    ),
                    "X" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            "course_type_code" => "X",
                            "course_type_desc" => "All-Weather"
                        ]
                    )
                ]
            ]
        ];
    }

    /**
     * @param \Api\Input\Request\Horses\LookupTable\Country $request
     * @param array                                         $expectedResult
     *
     * @dataProvider providerTestGetCountryTable
     */
    public function testGetCountryTable(
        \Api\Input\Request\Horses\LookupTable\Country $request,
        array $expectedResult
    ) {
        $bo = new \Tests\Stubs\Bo\LookupTable($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($bo->getCountryTable())
        );
    }

    public function providerTestGetCountryTable()
    {
        return [
            [
                new \Api\Input\Request\Horses\LookupTable\Country([]),
                [
                    "ALG" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            "country_code" => "ALG",
                            "country_desc" => "Algeria"
                        ]
                    ),
                    "ARG" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            "country_code" => "ARG",
                            "country_desc" => "Argentina"
                        ]
                    ),
                    "ARO" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            "country_code" => "ARO",
                            "country_desc" => "Arabia"
                        ]
                    ),
                ]
            ]
        ];
    }

    /**
     * @param \Api\Input\Request\Horses\LookupTable\FinishingPositions $request
     * @param array                                                    $expectedResult
     *
     * @dataProvider providerTestGetRaceOutcomeTable
     */
    public function testGetRaceOutcomeTable(
        \Api\Input\Request\Horses\LookupTable\FinishingPositions $request,
        array $expectedResult
    ) {
        $bo = new \Tests\Stubs\Bo\LookupTable($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($bo->getRaceOutcomeTable())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetRaceOutcomeTable()
    {
        return [
            [
                new \Api\Input\Request\Horses\LookupTable\FinishingPositions([]),
                array(
                    'Unplaced' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => 'Unplaced',
                            'race_outcome_uid' => 0,
                            'race_outcome_code' => '0  ',
                            'race_outcome_position' => 0,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 97,
                            'rp_race_outcome_desc' => 'unplaced',
                            'selby_code' => '0',
                        )
                    ),
                    '1st' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '1st',
                            'race_outcome_uid' => 1,
                            'race_outcome_code' => '1  ',
                            'race_outcome_position' => 1,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '1',
                            'race_output_order' => 1,
                            'rp_race_outcome_desc' => 'first',
                            'selby_code' => '1',
                        )
                    ),
                    '2nd' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '2nd',
                            'race_outcome_uid' => 2,
                            'race_outcome_code' => '2  ',
                            'race_outcome_position' => 2,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '2',
                            'race_output_order' => 2,
                            'rp_race_outcome_desc' => 'second',
                            'selby_code' => '2',
                        )
                    ),
                    '3rd' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '3rd',
                            'race_outcome_uid' => 3,
                            'race_outcome_code' => '3  ',
                            'race_outcome_position' => 3,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '3',
                            'race_output_order' => 3,
                            'rp_race_outcome_desc' => 'third',
                            'selby_code' => '3',
                        )
                    ),
                    '4th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '4th',
                            'race_outcome_uid' => 4,
                            'race_outcome_code' => '4  ',
                            'race_outcome_position' => 4,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '4',
                            'race_output_order' => 4,
                            'rp_race_outcome_desc' => 'fourth',
                            'selby_code' => '4',
                        )
                    ),
                    '5th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '5th',
                            'race_outcome_uid' => 5,
                            'race_outcome_code' => '5  ',
                            'race_outcome_position' => 5,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '5',
                            'race_output_order' => 5,
                            'rp_race_outcome_desc' => 'fifth',
                            'selby_code' => '5',
                        )
                    ),
                    '6th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '6th',
                            'race_outcome_uid' => 6,
                            'race_outcome_code' => '6  ',
                            'race_outcome_position' => 6,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '6',
                            'race_output_order' => 6,
                            'rp_race_outcome_desc' => 'sixth',
                            'selby_code' => '6',
                        )
                    ),
                    '7th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '7th',
                            'race_outcome_uid' => 7,
                            'race_outcome_code' => '7  ',
                            'race_outcome_position' => 7,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 7,
                            'rp_race_outcome_desc' => 'seventh',
                            'selby_code' => '7',
                        )
                    ),
                    '8th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '8th',
                            'race_outcome_uid' => 8,
                            'race_outcome_code' => '8  ',
                            'race_outcome_position' => 8,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 8,
                            'rp_race_outcome_desc' => 'eighth',
                            'selby_code' => '8',
                        )
                    ),
                    '9th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '9th',
                            'race_outcome_uid' => 9,
                            'race_outcome_code' => '9  ',
                            'race_outcome_position' => 9,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 9,
                            'rp_race_outcome_desc' => 'ninth',
                            'selby_code' => '9',
                        )
                    ),
                    '10th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '10th',
                            'race_outcome_uid' => 10,
                            'race_outcome_code' => '10 ',
                            'race_outcome_position' => 10,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 10,
                            'rp_race_outcome_desc' => 'tenth',
                            'selby_code' => '10',
                        )
                    ),
                    '11th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '11th',
                            'race_outcome_uid' => 11,
                            'race_outcome_code' => '11 ',
                            'race_outcome_position' => 11,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 11,
                            'rp_race_outcome_desc' => 'eleventh',
                            'selby_code' => '11',
                        )
                    ),
                    '12th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '12th',
                            'race_outcome_uid' => 12,
                            'race_outcome_code' => '12 ',
                            'race_outcome_position' => 12,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 12,
                            'rp_race_outcome_desc' => 'twelfth',
                            'selby_code' => '12',
                        )
                    ),
                    '13th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '13th',
                            'race_outcome_uid' => 13,
                            'race_outcome_code' => '13 ',
                            'race_outcome_position' => 13,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 13,
                            'rp_race_outcome_desc' => 'thirteenth',
                            'selby_code' => '13',
                        )
                    ),
                    '14th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '14th',
                            'race_outcome_uid' => 14,
                            'race_outcome_code' => '14 ',
                            'race_outcome_position' => 14,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 14,
                            'rp_race_outcome_desc' => 'fourteenth',
                            'selby_code' => '14',
                        )
                    ),
                    '15th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '15th',
                            'race_outcome_uid' => 15,
                            'race_outcome_code' => '15 ',
                            'race_outcome_position' => 15,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 15,
                            'rp_race_outcome_desc' => 'fifteenth',
                            'selby_code' => '15',
                        )
                    ),
                    '16th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '16th',
                            'race_outcome_uid' => 16,
                            'race_outcome_code' => '16 ',
                            'race_outcome_position' => 16,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 16,
                            'rp_race_outcome_desc' => 'sixteenth',
                            'selby_code' => '16',
                        )
                    ),
                    '17th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '17th',
                            'race_outcome_uid' => 17,
                            'race_outcome_code' => '17 ',
                            'race_outcome_position' => 17,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 17,
                            'rp_race_outcome_desc' => 'seventeenth',
                            'selby_code' => '17',
                        )
                    ),
                    '18th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '18th',
                            'race_outcome_uid' => 18,
                            'race_outcome_code' => '18 ',
                            'race_outcome_position' => 18,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 18,
                            'rp_race_outcome_desc' => 'eighteenth',
                            'selby_code' => '18',
                        )
                    ),
                    '19th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '19th',
                            'race_outcome_uid' => 19,
                            'race_outcome_code' => '19 ',
                            'race_outcome_position' => 19,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 19,
                            'rp_race_outcome_desc' => 'nineteenth',
                            'selby_code' => '19',
                        )
                    ),
                    '20th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '20th',
                            'race_outcome_uid' => 20,
                            'race_outcome_code' => '20 ',
                            'race_outcome_position' => 20,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 20,
                            'rp_race_outcome_desc' => 'twentieth',
                            'selby_code' => '20',
                        )
                    ),
                    '21st' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '21st',
                            'race_outcome_uid' => 21,
                            'race_outcome_code' => '21 ',
                            'race_outcome_position' => 21,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 21,
                            'rp_race_outcome_desc' => 'twenty-first',
                            'selby_code' => '21',
                        )
                    ),
                    '22nd' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '22nd',
                            'race_outcome_uid' => 22,
                            'race_outcome_code' => '22 ',
                            'race_outcome_position' => 22,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 22,
                            'rp_race_outcome_desc' => 'twenty-second',
                            'selby_code' => '22',
                        )
                    ),
                    '23rd' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '23rd',
                            'race_outcome_uid' => 23,
                            'race_outcome_code' => '23 ',
                            'race_outcome_position' => 23,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 23,
                            'rp_race_outcome_desc' => 'twenty-third',
                            'selby_code' => '23',
                        )
                    ),
                    '24th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '24th',
                            'race_outcome_uid' => 24,
                            'race_outcome_code' => '24 ',
                            'race_outcome_position' => 24,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 24,
                            'rp_race_outcome_desc' => 'twenty-fourth',
                            'selby_code' => '24',
                        )
                    ),
                    '25th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '25th',
                            'race_outcome_uid' => 25,
                            'race_outcome_code' => '25 ',
                            'race_outcome_position' => 25,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 25,
                            'rp_race_outcome_desc' => 'twenty-fifth',
                            'selby_code' => '25',
                        )
                    ),
                    '26th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '26th',
                            'race_outcome_uid' => 26,
                            'race_outcome_code' => '26 ',
                            'race_outcome_position' => 26,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 26,
                            'rp_race_outcome_desc' => 'twenty-sixth',
                            'selby_code' => '26',
                        )
                    ),
                    '27th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '27th',
                            'race_outcome_uid' => 27,
                            'race_outcome_code' => '27 ',
                            'race_outcome_position' => 27,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 27,
                            'rp_race_outcome_desc' => 'twenty-seventh',
                            'selby_code' => '27',
                        )
                    ),
                    '28th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '28th',
                            'race_outcome_uid' => 28,
                            'race_outcome_code' => '28 ',
                            'race_outcome_position' => 28,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 28,
                            'rp_race_outcome_desc' => 'twenty-eigth',
                            'selby_code' => '28',
                        )
                    ),
                    '29th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '29th',
                            'race_outcome_uid' => 29,
                            'race_outcome_code' => '29 ',
                            'race_outcome_position' => 29,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 29,
                            'rp_race_outcome_desc' => 'twenty-ninth',
                            'selby_code' => '29',
                        )
                    ),
                    '30th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '30th',
                            'race_outcome_uid' => 30,
                            'race_outcome_code' => '30 ',
                            'race_outcome_position' => 30,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 30,
                            'rp_race_outcome_desc' => 'thirtieth',
                            'selby_code' => '30',
                        )
                    ),
                    '31st' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '31st',
                            'race_outcome_uid' => 31,
                            'race_outcome_code' => '31 ',
                            'race_outcome_position' => 31,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 31,
                            'rp_race_outcome_desc' => 'thirty-first',
                            'selby_code' => '31',
                        )
                    ),
                    '32nd' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '32nd',
                            'race_outcome_uid' => 32,
                            'race_outcome_code' => '32 ',
                            'race_outcome_position' => 32,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 32,
                            'rp_race_outcome_desc' => 'thirty-second',
                            'selby_code' => '32',
                        )
                    ),
                    '33rd' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '33rd',
                            'race_outcome_uid' => 33,
                            'race_outcome_code' => '33 ',
                            'race_outcome_position' => 33,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 33,
                            'rp_race_outcome_desc' => 'thirty-third',
                            'selby_code' => '33',
                        )
                    ),
                    '34th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '34th',
                            'race_outcome_uid' => 34,
                            'race_outcome_code' => '34 ',
                            'race_outcome_position' => 34,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 34,
                            'rp_race_outcome_desc' => 'thirty-fourth',
                            'selby_code' => '34',
                        )
                    ),
                    '35th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '35th',
                            'race_outcome_uid' => 35,
                            'race_outcome_code' => '35 ',
                            'race_outcome_position' => 35,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 35,
                            'rp_race_outcome_desc' => 'thirty-fifth',
                            'selby_code' => '35',
                        )
                    ),
                    '36th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '36th',
                            'race_outcome_uid' => 36,
                            'race_outcome_code' => '36 ',
                            'race_outcome_position' => 36,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 36,
                            'rp_race_outcome_desc' => 'thirty-sixth',
                            'selby_code' => '36',
                        )
                    ),
                    '37th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '37th',
                            'race_outcome_uid' => 37,
                            'race_outcome_code' => '37 ',
                            'race_outcome_position' => 37,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 37,
                            'rp_race_outcome_desc' => 'thirty-seventh',
                            'selby_code' => '37',
                        )
                    ),
                    '38th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '38th',
                            'race_outcome_uid' => 38,
                            'race_outcome_code' => '38 ',
                            'race_outcome_position' => 38,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 38,
                            'rp_race_outcome_desc' => 'thirty-eigth',
                            'selby_code' => '38',
                        )
                    ),
                    '39th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '39th',
                            'race_outcome_uid' => 39,
                            'race_outcome_code' => '39 ',
                            'race_outcome_position' => 39,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 39,
                            'rp_race_outcome_desc' => 'thirty-ninth',
                            'selby_code' => '39',
                        )
                    ),
                    '40th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '40th',
                            'race_outcome_uid' => 40,
                            'race_outcome_code' => '40 ',
                            'race_outcome_position' => 40,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 40,
                            'rp_race_outcome_desc' => 'fourtieth',
                            'selby_code' => '40',
                        )
                    ),
                    '41st' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '41st',
                            'race_outcome_uid' => 41,
                            'race_outcome_code' => '41 ',
                            'race_outcome_position' => 41,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 41,
                            'rp_race_outcome_desc' => 'forty-first',
                            'selby_code' => '41',
                        )
                    ),
                    '42nd' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '42nd',
                            'race_outcome_uid' => 42,
                            'race_outcome_code' => '42 ',
                            'race_outcome_position' => 42,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 42,
                            'rp_race_outcome_desc' => 'forty-second',
                            'selby_code' => '42',
                        )
                    ),
                    '43rd' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '43rd',
                            'race_outcome_uid' => 43,
                            'race_outcome_code' => '43 ',
                            'race_outcome_position' => 43,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 43,
                            'rp_race_outcome_desc' => 'forty-third',
                            'selby_code' => '43',
                        )
                    ),
                    '44th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '44th',
                            'race_outcome_uid' => 44,
                            'race_outcome_code' => '44 ',
                            'race_outcome_position' => 44,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 44,
                            'rp_race_outcome_desc' => 'forty-fourth',
                            'selby_code' => '44',
                        )
                    ),
                    '45th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '45th',
                            'race_outcome_uid' => 45,
                            'race_outcome_code' => '45 ',
                            'race_outcome_position' => 45,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 45,
                            'rp_race_outcome_desc' => 'forty-fifth',
                            'selby_code' => '45',
                        )
                    ),
                    '46th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '46th',
                            'race_outcome_uid' => 46,
                            'race_outcome_code' => '46 ',
                            'race_outcome_position' => 46,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 46,
                            'rp_race_outcome_desc' => 'forty-sixth',
                            'selby_code' => '46',
                        )
                    ),
                    '47th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '47th',
                            'race_outcome_uid' => 47,
                            'race_outcome_code' => '47 ',
                            'race_outcome_position' => 47,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 47,
                            'rp_race_outcome_desc' => 'forty-seventh',
                            'selby_code' => '47',
                        )
                    ),
                    '48th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '48th',
                            'race_outcome_uid' => 48,
                            'race_outcome_code' => '48 ',
                            'race_outcome_position' => 48,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 48,
                            'rp_race_outcome_desc' => 'forty-eigth',
                            'selby_code' => '48',
                        )
                    ),
                    '49th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '49th',
                            'race_outcome_uid' => 49,
                            'race_outcome_code' => '49 ',
                            'race_outcome_position' => 49,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 49,
                            'rp_race_outcome_desc' => 'forty-ninth',
                            'selby_code' => '49',
                        )
                    ),
                    '50th' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '50th',
                            'race_outcome_uid' => 50,
                            'race_outcome_code' => '50 ',
                            'race_outcome_position' => 50,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 50,
                            'rp_race_outcome_desc' => 'fiftieth',
                            'selby_code' => '50',
                        )
                    ),
                    'Fell' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => 'Fell',
                            'race_outcome_uid' => 51,
                            'race_outcome_code' => 'F  ',
                            'race_outcome_position' => 0,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => 'F',
                            'race_output_order' => 99,
                            'rp_race_outcome_desc' => 'fell',
                            'selby_code' => 'F',
                        )
                    ),
                    'Unseated Rider' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => 'Unseated Rider',
                            'race_outcome_uid' => 52,
                            'race_outcome_code' => 'UR ',
                            'race_outcome_position' => 0,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => 'U',
                            'race_output_order' => 99,
                            'rp_race_outcome_desc' => 'unseated rider',
                            'selby_code' => 'U',
                        )
                    ),
                    'Carried Out' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => 'Carried Out',
                            'race_outcome_uid' => 53,
                            'race_outcome_code' => 'CO ',
                            'race_outcome_position' => 0,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => 'C',
                            'race_output_order' => 99,
                            'rp_race_outcome_desc' => 'carried out',
                            'selby_code' => 'C',
                        )
                    ),
                    'Refused' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => 'Refused',
                            'race_outcome_uid' => 54,
                            'race_outcome_code' => 'REF',
                            'race_outcome_position' => 0,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => 'R',
                            'race_output_order' => 99,
                            'rp_race_outcome_desc' => 'refused',
                            'selby_code' => 'R',
                        )
                    ),
                    'Ran Out' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => 'Ran Out',
                            'race_outcome_uid' => 55,
                            'race_outcome_code' => 'RO ',
                            'race_outcome_position' => 0,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => 'O',
                            'race_output_order' => 99,
                            'rp_race_outcome_desc' => 'ran out',
                            'selby_code' => 'O',
                        )
                    ),
                    'Brought Down' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => 'Brought Down',
                            'race_outcome_uid' => 56,
                            'race_outcome_code' => 'BD ',
                            'race_outcome_position' => 0,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => 'B',
                            'race_output_order' => 99,
                            'rp_race_outcome_desc' => 'brought down',
                            'selby_code' => 'B',
                        )
                    ),
                    'Slipped Up' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => 'Slipped Up',
                            'race_outcome_uid' => 57,
                            'race_outcome_code' => 'SU ',
                            'race_outcome_position' => 0,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => 'S',
                            'race_output_order' => 99,
                            'rp_race_outcome_desc' => 'slipped up',
                            'selby_code' => 'S',
                        )
                    ),
                    'Refused To Race' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => 'Refused To Race',
                            'race_outcome_uid' => 58,
                            'race_outcome_code' => 'RR ',
                            'race_outcome_position' => 0,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => 'R',
                            'race_output_order' => 99,
                            'rp_race_outcome_desc' => 'refused to race',
                            'selby_code' => 'RR',
                        )
                    ),
                    'Left at Start' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => 'Left at Start',
                            'race_outcome_uid' => 59,
                            'race_outcome_code' => 'LFT',
                            'race_outcome_position' => 0,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => 'L',
                            'race_output_order' => 99,
                            'rp_race_outcome_desc' => 'left at start',
                            'selby_code' => 'LFT',
                        )
                    ),
                    'Withdrawn n.u.o' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => 'Withdrawn n.u.o',
                            'race_outcome_uid' => 60,
                            'race_outcome_code' => 'WDN',
                            'race_outcome_position' => 0,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => null,
                            'race_output_order' => 100,
                            'rp_race_outcome_desc' => 'withdrawn not under starters',
                            'selby_code' => 'WDN',
                        )
                    ),
                    'Withdrawn u.o' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => 'Withdrawn u.o',
                            'race_outcome_uid' => 61,
                            'race_outcome_code' => 'WDU',
                            'race_outcome_position' => 0,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => 'W',
                            'race_output_order' => 100,
                            'rp_race_outcome_desc' => 'withdrawn under starters order',
                            'selby_code' => 'W',
                        )
                    ),
                    'Non-runner' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => 'Non-runner',
                            'race_outcome_uid' => 62,
                            'race_outcome_code' => 'NR ',
                            'race_outcome_position' => 0,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => null,
                            'race_output_order' => 100,
                            'rp_race_outcome_desc' => 'non-runner',
                            'selby_code' => 'NR',
                        )
                    ),
                    'Pulled Up' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => 'Pulled Up',
                            'race_outcome_uid' => 63,
                            'race_outcome_code' => 'PU ',
                            'race_outcome_position' => 0,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => 'P',
                            'race_output_order' => 99,
                            'rp_race_outcome_desc' => 'pulled up',
                            'selby_code' => 'P',
                        )
                    ),
                    'Last Disq' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => 'Last Disq',
                            'race_outcome_uid' => 64,
                            'race_outcome_code' => 'DSQ',
                            'race_outcome_position' => 0,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 99,
                            'rp_race_outcome_desc' => 'last disqualified',
                            'selby_code' => 'DSQ',
                        )
                    ),
                    '1st Dead-heat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '1st Dead-heat',
                            'race_outcome_uid' => 71,
                            'race_outcome_code' => '1  ',
                            'race_outcome_position' => 1,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '1',
                            'race_output_order' => 1,
                            'rp_race_outcome_desc' => 'first',
                            'selby_code' => '1',
                        )
                    ),
                    '2nd Dead-heat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '2nd Dead-heat',
                            'race_outcome_uid' => 72,
                            'race_outcome_code' => '2  ',
                            'race_outcome_position' => 2,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '2',
                            'race_output_order' => 2,
                            'rp_race_outcome_desc' => 'second',
                            'selby_code' => '2',
                        )
                    ),
                    '3rd Dead-heat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '3rd Dead-heat',
                            'race_outcome_uid' => 73,
                            'race_outcome_code' => '3  ',
                            'race_outcome_position' => 3,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '3',
                            'race_output_order' => 3,
                            'rp_race_outcome_desc' => 'third',
                            'selby_code' => '3',
                        )
                    ),
                    '4th Dead-heat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '4th Dead-heat',
                            'race_outcome_uid' => 74,
                            'race_outcome_code' => '4  ',
                            'race_outcome_position' => 4,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '4',
                            'race_output_order' => 4,
                            'rp_race_outcome_desc' => 'fourth',
                            'selby_code' => '4',
                        )
                    ),
                    '5th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '5th Deadheat',
                            'race_outcome_uid' => 75,
                            'race_outcome_code' => '5  ',
                            'race_outcome_position' => 5,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '5',
                            'race_output_order' => 5,
                            'rp_race_outcome_desc' => 'fifth',
                            'selby_code' => '5',
                        )
                    ),
                    '6th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '6th Deadheat',
                            'race_outcome_uid' => 76,
                            'race_outcome_code' => '6  ',
                            'race_outcome_position' => 6,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '6',
                            'race_output_order' => 6,
                            'rp_race_outcome_desc' => 'sixth',
                            'selby_code' => '6',
                        )
                    ),
                    '7th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '7th Deadheat',
                            'race_outcome_uid' => 77,
                            'race_outcome_code' => '7  ',
                            'race_outcome_position' => 7,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 7,
                            'rp_race_outcome_desc' => 'seventh',
                            'selby_code' => '7',
                        )
                    ),
                    '8th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '8th Deadheat',
                            'race_outcome_uid' => 78,
                            'race_outcome_code' => '8  ',
                            'race_outcome_position' => 8,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 8,
                            'rp_race_outcome_desc' => 'eigth',
                            'selby_code' => '8',
                        )
                    ),
                    '9th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '9th Deadheat',
                            'race_outcome_uid' => 79,
                            'race_outcome_code' => '9  ',
                            'race_outcome_position' => 9,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 9,
                            'rp_race_outcome_desc' => 'ninth',
                            'selby_code' => '9',
                        )
                    ),
                    '10th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '10th Deadheat',
                            'race_outcome_uid' => 80,
                            'race_outcome_code' => '10 ',
                            'race_outcome_position' => 10,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 10,
                            'rp_race_outcome_desc' => 'tenth',
                            'selby_code' => '10',
                        )
                    ),
                    '11th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '11th Deadheat',
                            'race_outcome_uid' => 81,
                            'race_outcome_code' => '11 ',
                            'race_outcome_position' => 11,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 11,
                            'rp_race_outcome_desc' => 'eleventh',
                            'selby_code' => '11',
                        )
                    ),
                    '12th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '12th Deadheat',
                            'race_outcome_uid' => 82,
                            'race_outcome_code' => '12 ',
                            'race_outcome_position' => 12,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 12,
                            'rp_race_outcome_desc' => 'twelfth',
                            'selby_code' => '12',
                        )
                    ),
                    '13th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '13th Deadheat',
                            'race_outcome_uid' => 83,
                            'race_outcome_code' => '13 ',
                            'race_outcome_position' => 13,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 13,
                            'rp_race_outcome_desc' => 'thirteenth',
                            'selby_code' => '13',
                        )
                    ),
                    '14th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '14th Deadheat',
                            'race_outcome_uid' => 84,
                            'race_outcome_code' => '14 ',
                            'race_outcome_position' => 14,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 14,
                            'rp_race_outcome_desc' => 'fourteenth',
                            'selby_code' => '14',
                        )
                    ),
                    '15th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '15th Deadheat',
                            'race_outcome_uid' => 85,
                            'race_outcome_code' => '15 ',
                            'race_outcome_position' => 15,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 15,
                            'rp_race_outcome_desc' => 'fifteenth',
                            'selby_code' => '15',
                        )
                    ),
                    '16th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '16th Deadheat',
                            'race_outcome_uid' => 86,
                            'race_outcome_code' => '16 ',
                            'race_outcome_position' => 16,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 16,
                            'rp_race_outcome_desc' => 'sixteenth',
                            'selby_code' => '16',
                        )
                    ),
                    '17th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '17th Deadheat',
                            'race_outcome_uid' => 87,
                            'race_outcome_code' => '17 ',
                            'race_outcome_position' => 17,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 17,
                            'rp_race_outcome_desc' => 'seventeenth',
                            'selby_code' => '17',
                        )
                    ),
                    '18th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '18th Deadheat',
                            'race_outcome_uid' => 88,
                            'race_outcome_code' => '18 ',
                            'race_outcome_position' => 18,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 18,
                            'rp_race_outcome_desc' => 'eighteenth',
                            'selby_code' => '18',
                        )
                    ),
                    '19th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '19th Deadheat',
                            'race_outcome_uid' => 89,
                            'race_outcome_code' => '19 ',
                            'race_outcome_position' => 19,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 19,
                            'rp_race_outcome_desc' => 'ninteenth',
                            'selby_code' => '19',
                        )
                    ),
                    '20th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '20th Deadheat',
                            'race_outcome_uid' => 90,
                            'race_outcome_code' => '20 ',
                            'race_outcome_position' => 20,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 20,
                            'rp_race_outcome_desc' => 'twentieth',
                            'selby_code' => '20',
                        )
                    ),
                    '21st Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '21st Deadheat',
                            'race_outcome_uid' => 91,
                            'race_outcome_code' => '21 ',
                            'race_outcome_position' => 21,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 21,
                            'rp_race_outcome_desc' => 'twenty-first',
                            'selby_code' => '21',
                        )
                    ),
                    '22nd Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '22nd Deadheat',
                            'race_outcome_uid' => 92,
                            'race_outcome_code' => '22 ',
                            'race_outcome_position' => 22,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 22,
                            'rp_race_outcome_desc' => 'twenty-second',
                            'selby_code' => '22',
                        )
                    ),
                    '23rd Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '23rd Deadheat',
                            'race_outcome_uid' => 93,
                            'race_outcome_code' => '23 ',
                            'race_outcome_position' => 23,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 23,
                            'rp_race_outcome_desc' => 'twenty-third',
                            'selby_code' => '23',
                        )
                    ),
                    '24th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '24th Deadheat',
                            'race_outcome_uid' => 94,
                            'race_outcome_code' => '24 ',
                            'race_outcome_position' => 24,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 24,
                            'rp_race_outcome_desc' => 'twenty-fourth',
                            'selby_code' => '24',
                        )
                    ),
                    '25th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '25th Deadheat',
                            'race_outcome_uid' => 95,
                            'race_outcome_code' => '25 ',
                            'race_outcome_position' => 25,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 25,
                            'rp_race_outcome_desc' => 'twenty-fifth',
                            'selby_code' => '25',
                        )
                    ),
                    '26th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '26th Deadheat',
                            'race_outcome_uid' => 96,
                            'race_outcome_code' => '26 ',
                            'race_outcome_position' => 26,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 26,
                            'rp_race_outcome_desc' => 'twenty-sixth',
                            'selby_code' => '26',
                        )
                    ),
                    '27th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '27th Deadheat',
                            'race_outcome_uid' => 97,
                            'race_outcome_code' => '27 ',
                            'race_outcome_position' => 27,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 27,
                            'rp_race_outcome_desc' => 'twenty-seventh',
                            'selby_code' => '27',
                        )
                    ),
                    '28th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '28th Deadheat',
                            'race_outcome_uid' => 98,
                            'race_outcome_code' => '28 ',
                            'race_outcome_position' => 28,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 28,
                            'rp_race_outcome_desc' => 'twenty-eigth',
                            'selby_code' => '28',
                        )
                    ),
                    '29th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '29th Deadheat',
                            'race_outcome_uid' => 99,
                            'race_outcome_code' => '29 ',
                            'race_outcome_position' => 29,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 29,
                            'rp_race_outcome_desc' => 'twenty-ninth',
                            'selby_code' => '29',
                        )
                    ),
                    '30th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '30th Deadheat',
                            'race_outcome_uid' => 100,
                            'race_outcome_code' => '30 ',
                            'race_outcome_position' => 30,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 30,
                            'rp_race_outcome_desc' => 'thirtieth',
                            'selby_code' => '30',
                        )
                    ),
                    '31st Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '31st Deadheat',
                            'race_outcome_uid' => 101,
                            'race_outcome_code' => '31 ',
                            'race_outcome_position' => 31,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 31,
                            'rp_race_outcome_desc' => 'thirty-first',
                            'selby_code' => '31',
                        )
                    ),
                    '32nd Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '32nd Deadheat',
                            'race_outcome_uid' => 102,
                            'race_outcome_code' => '32 ',
                            'race_outcome_position' => 32,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 32,
                            'rp_race_outcome_desc' => 'thirty-second',
                            'selby_code' => '32',
                        )
                    ),
                    '33rd Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '33rd Deadheat',
                            'race_outcome_uid' => 103,
                            'race_outcome_code' => '33 ',
                            'race_outcome_position' => 33,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 33,
                            'rp_race_outcome_desc' => 'thirty-third',
                            'selby_code' => '33',
                        )
                    ),
                    '34th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '34th Deadheat',
                            'race_outcome_uid' => 104,
                            'race_outcome_code' => '34 ',
                            'race_outcome_position' => 34,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 34,
                            'rp_race_outcome_desc' => 'thirty-fourth',
                            'selby_code' => '34',
                        )
                    ),
                    '35th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '35th Deadheat',
                            'race_outcome_uid' => 105,
                            'race_outcome_code' => '35 ',
                            'race_outcome_position' => 35,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 35,
                            'rp_race_outcome_desc' => 'thirty-fifth',
                            'selby_code' => '35',
                        )
                    ),
                    '36th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '36th Deadheat',
                            'race_outcome_uid' => 106,
                            'race_outcome_code' => '36 ',
                            'race_outcome_position' => 36,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 36,
                            'rp_race_outcome_desc' => 'thirty-sixth',
                            'selby_code' => '36',
                        )
                    ),
                    '37th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '37th Deadheat',
                            'race_outcome_uid' => 107,
                            'race_outcome_code' => '37 ',
                            'race_outcome_position' => 37,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 37,
                            'rp_race_outcome_desc' => 'thirty-seventh',
                            'selby_code' => '37',
                        )
                    ),
                    '38th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '38th Deadheat',
                            'race_outcome_uid' => 108,
                            'race_outcome_code' => '38 ',
                            'race_outcome_position' => 38,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 38,
                            'rp_race_outcome_desc' => 'thirty-eigth',
                            'selby_code' => '38',
                        )
                    ),
                    '39th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '39th Deadheat',
                            'race_outcome_uid' => 109,
                            'race_outcome_code' => '39 ',
                            'race_outcome_position' => 39,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 39,
                            'rp_race_outcome_desc' => 'thirty-ninth',
                            'selby_code' => '39',
                        )
                    ),
                    '40th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '40th Deadheat',
                            'race_outcome_uid' => 110,
                            'race_outcome_code' => '40 ',
                            'race_outcome_position' => 40,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 40,
                            'rp_race_outcome_desc' => 'fourtieth',
                            'selby_code' => '40',
                        )
                    ),
                    '41st Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '41st Deadheat',
                            'race_outcome_uid' => 111,
                            'race_outcome_code' => '41 ',
                            'race_outcome_position' => 41,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 41,
                            'rp_race_outcome_desc' => 'forty-first',
                            'selby_code' => '41',
                        )
                    ),
                    '42nd Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '42nd Deadheat',
                            'race_outcome_uid' => 112,
                            'race_outcome_code' => '42 ',
                            'race_outcome_position' => 42,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 42,
                            'rp_race_outcome_desc' => 'frty-second',
                            'selby_code' => '42',
                        )
                    ),
                    '43rd Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '43rd Deadheat',
                            'race_outcome_uid' => 113,
                            'race_outcome_code' => '43 ',
                            'race_outcome_position' => 43,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 43,
                            'rp_race_outcome_desc' => 'forty-third',
                            'selby_code' => '43',
                        )
                    ),
                    '44th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '44th Deadheat',
                            'race_outcome_uid' => 114,
                            'race_outcome_code' => '44 ',
                            'race_outcome_position' => 44,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 44,
                            'rp_race_outcome_desc' => 'forty-fourth',
                            'selby_code' => '44',
                        )
                    ),
                    '45th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '45th Deadheat',
                            'race_outcome_uid' => 115,
                            'race_outcome_code' => '45 ',
                            'race_outcome_position' => 45,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 45,
                            'rp_race_outcome_desc' => 'forty-fifth',
                            'selby_code' => '45',
                        )
                    ),
                    '46th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '46th Deadheat',
                            'race_outcome_uid' => 116,
                            'race_outcome_code' => '46 ',
                            'race_outcome_position' => 46,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 46,
                            'rp_race_outcome_desc' => 'forty-sixth',
                            'selby_code' => '46',
                        )
                    ),
                    '47th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '47th Deadheat',
                            'race_outcome_uid' => 117,
                            'race_outcome_code' => '47 ',
                            'race_outcome_position' => 47,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 47,
                            'rp_race_outcome_desc' => 'forty-seventh',
                            'selby_code' => '47',
                        )
                    ),
                    '48th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '48th Deadheat',
                            'race_outcome_uid' => 118,
                            'race_outcome_code' => '48 ',
                            'race_outcome_position' => 48,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 48,
                            'rp_race_outcome_desc' => 'forty-eigth',
                            'selby_code' => '48',
                        )
                    ),
                    '49th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '49th Deadheat',
                            'race_outcome_uid' => 119,
                            'race_outcome_code' => '49 ',
                            'race_outcome_position' => 49,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 49,
                            'rp_race_outcome_desc' => 'forty-ninth',
                            'selby_code' => '49',
                        )
                    ),
                    '50th Deadheat' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => '50th Deadheat',
                            'race_outcome_uid' => 120,
                            'race_outcome_code' => '50 ',
                            'race_outcome_position' => 50,
                            'race_outcome_joint_yn' => 'Y',
                            'race_outcome_form_char' => '0',
                            'race_output_order' => 50,
                            'rp_race_outcome_desc' => 'fiftieth',
                            'selby_code' => '50',
                        )
                    ),
                    'Void' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_outcome_desc' => 'Void',
                            'race_outcome_uid' => 121,
                            'race_outcome_code' => 'VOI',
                            'race_outcome_position' => 0,
                            'race_outcome_joint_yn' => 'N',
                            'race_outcome_form_char' => 'V',
                            'race_output_order' => 99,
                            'rp_race_outcome_desc' => 'race void',
                            'selby_code' => null,
                        )
                    ),
                )
            ]
        ];
    }

    /**
     * @param \Api\Input\Request\Horses\LookupTable\HorseColour $request
     * @param array                                             $expectedResult
     *
     * @dataProvider providerTestGetHorseColourTable
     */
    public function testGetHorseColourTable(
        \Api\Input\Request\Horses\LookupTable\HorseColour $request,
        array $expectedResult
    ) {
        $bo = new \Tests\Stubs\Bo\LookupTable($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($bo->getHorseColourTable())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetHorseColourTable()
    {
        return [
            [
                new \Api\Input\Request\Horses\LookupTable\HorseColour([]),
                [
                    'B' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_colour_code' => 'B',
                            'horse_colour_desc' => 'Bay',
                            'weatherbys_code' => 'B',
                            'newspaper_output_desc' => 'b',
                            'rp_newspaper_output_desc' => 'b'
                        ]
                    ),
                    'BB' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_colour_code' => 'BB',
                            'horse_colour_desc' => 'Bay or Brown',
                            'weatherbys_code' => 'B BR',
                            'newspaper_output_desc' => 'b or br',
                            'rp_newspaper_output_desc' => 'b/br'
                        ]
                    ),
                    'BG' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_colour_code' => 'BG',
                            'horse_colour_desc' => 'Brown or Grey',
                            'weatherbys_code' => 'BRGR',
                            'newspaper_output_desc' => 'br or gr',
                            'rp_newspaper_output_desc' => 'br/gr'
                        ]
                    ),
                    'BL' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_colour_code' => 'BL',
                            'horse_colour_desc' => 'Black',
                            'weatherbys_code' => 'BL',
                            'newspaper_output_desc' => 'bl',
                            'rp_newspaper_output_desc' => 'bl'
                        ]
                    ),
                    'BR' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_colour_code' => 'BR',
                            'horse_colour_desc' => 'Brown',
                            'weatherbys_code' => 'BR',
                            'newspaper_output_desc' => 'br',
                            'rp_newspaper_output_desc' => 'br'
                        ]
                    ),
                    'BZ' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_colour_code' => 'BZ',
                            'horse_colour_desc' => 'Bay or Roan',
                            'weatherbys_code' => 'B RO',
                            'newspaper_output_desc' => 'b or ro',
                            'rp_newspaper_output_desc' => 'b/ro'
                        ]
                    ),
                    'CH' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_colour_code' => 'CH',
                            'horse_colour_desc' => 'Chestnut',
                            'weatherbys_code' => 'CH',
                            'newspaper_output_desc' => 'ch',
                            'rp_newspaper_output_desc' => 'ch'
                        ]
                    ),
                    'D' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_colour_code' => 'D',
                            'horse_colour_desc' => 'Dun',
                            'weatherbys_code' => 'D',
                            'newspaper_output_desc' => 'd',
                            'rp_newspaper_output_desc' => 'd'
                        ]
                    ),
                    'GB' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_colour_code' => 'GB',
                            'horse_colour_desc' => 'Grey or Bay',
                            'weatherbys_code' => 'GB',
                            'newspaper_output_desc' => 'gr or b',
                            'rp_newspaper_output_desc' => 'gr/b'
                        ]
                    ),
                    'GR' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_colour_code' => 'GR',
                            'horse_colour_desc' => 'Grey',
                            'weatherbys_code' => 'GR',
                            'newspaper_output_desc' => 'gr',
                            'rp_newspaper_output_desc' => 'gr'
                        ]
                    ),
                    'P' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_colour_code' => 'P',
                            'horse_colour_desc' => 'Piebald',
                            'weatherbys_code' => 'P',
                            'newspaper_output_desc' => 'p',
                            'rp_newspaper_output_desc' => 'p'
                        ]
                    ),
                    'RG' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_colour_code' => 'RG',
                            'horse_colour_desc' => 'Grey or Roan',
                            'weatherbys_code' => 'GRRO',
                            'newspaper_output_desc' => 'gr or ro',
                            'rp_newspaper_output_desc' => 'gr/ro'
                        ]
                    ),
                    'RO' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_colour_code' => 'RO',
                            'horse_colour_desc' => 'Roan',
                            'weatherbys_code' => 'RO',
                            'newspaper_output_desc' => 'ro',
                            'rp_newspaper_output_desc' => 'ro'
                        ]
                    ),
                    'SK' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_colour_code' => 'SK',
                            'horse_colour_desc' => 'Skewbald',
                            'weatherbys_code' => 'SK',
                            'newspaper_output_desc' => 'sk',
                            'rp_newspaper_output_desc' => 'sk'
                        ]
                    ),
                    'U' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_colour_code' => 'U',
                            'horse_colour_desc' => 'Unknown',
                            'weatherbys_code' => null,
                            'newspaper_output_desc' => ' ',
                            'rp_newspaper_output_desc' => null
                        ]
                    ),
                    'WH' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_colour_code' => 'WH',
                            'horse_colour_desc' => 'White',
                            'weatherbys_code' => 'WH',
                            'newspaper_output_desc' => 'wh',
                            'rp_newspaper_output_desc' => 'wh'
                        ]
                    )
                ]
            ]
        ];
    }

    /**
     * @param \Api\Input\Request\Horses\LookupTable\HorseSex $request
     * @param array                                          $expectedResult
     *
     * @dataProvider providerTestGetHorseSexTable
     */
    public function testGetHorseSexTable(
        \Api\Input\Request\Horses\LookupTable\HorseSex $request,
        array $expectedResult
    ) {
        $bo = new \Tests\Stubs\Bo\LookupTable($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($bo->getHorseSexTable())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetHorseSexTable()
    {
        return [
            [
                new \Api\Input\Request\Horses\LookupTable\HorseSex([]),
                [
                    "C" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            "horse_sex_code" => "C",
                            "horse_sex_desc" => "colt",
                            "horse_sex_flag" => "M"
                        ]
                    ),
                    "F" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            "horse_sex_code" => "F",
                            "horse_sex_desc" => "filly",
                            "horse_sex_flag" => "F"
                        ]
                    ),
                    "G" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            "horse_sex_code" => "G",
                            "horse_sex_desc" => "gelding",
                            "horse_sex_flag" => "M"
                        ]
                    ),
                ]
            ]
        ];
    }

    /**
     * @param \Api\Input\Request\Horses\LookupTable\MeetingColoursLookup $request
     * @param array                                                      $expectedResult
     *
     * @dataProvider providerTestGetMeetingColoursLookupTable
     */
    public function testGetMeetingColoursLookupTable(
        \Api\Input\Request\Horses\LookupTable\MeetingColoursLookup $request,
        array $expectedResult
    ) {
        $bo = new \Tests\Stubs\Bo\LookupTable($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($bo->getMeetingColoursLookupTable())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetMeetingColoursLookupTable()
    {
        return [
            [
                new \Api\Input\Request\Horses\LookupTable\MeetingColoursLookup([]),
                [
                    "1" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            "meeting_number" => 1,
                            "c_colour" => 0,
                            "m_colour" => 100,
                            "y_colour" => 100,
                            "k_colour" => 0,
                            "colour_description" => "Card 1",
                            "r_colour" => 237,
                            "g_colour" => 28,
                            "b_colour" => 36
                        ]
                    ),
                    "2" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            "meeting_number" => 2,
                            "c_colour" => 100,
                            "m_colour" => 90,
                            "y_colour" => 0,
                            "k_colour" => 50,
                            "colour_description" => "Card 2",
                            "r_colour" => 10,
                            "g_colour" => 26,
                            "b_colour" => 92
                        ]
                    )
                ]
            ]
        ];
    }

    /**
     * @param \Api\Input\Request\Horses\LookupTable\Odds $request
     * @param array                                      $expectedResult
     *
     * @dataProvider providerTestGetOddsTable
     */
    public function testGetOddsTable(
        \Api\Input\Request\Horses\LookupTable\Odds $request,
        array $expectedResult
    ) {
        $bo = new \Tests\Stubs\Bo\LookupTable($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($bo->getOddsTable())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetOddsTable()
    {
        return [
            [
                new \Api\Input\Request\Horses\LookupTable\Odds([]),
                [
                    1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'odds_uid' => 1,
                            'odds_desc' => '14/1',
                            'odds_value' => 14,
                        ]
                    ),
                    2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'odds_uid' => 2,
                            'odds_desc' => '11/10F',
                            'odds_value' => 1.1000000000000001,
                        ]
                    ),
                    3 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'odds_uid' => 3,
                            'odds_desc' => '6/1',
                            'odds_value' => 6,
                        ]
                    )
                ]
            ]
        ];
    }

    /**
     * @param \Api\Input\Request\Horses\LookupTable\AdditionalCourseInfo $request
     * @param array                                                      $expectedResult
     *
     * @dataProvider providerTestGetAdditionalCourseInfoTable
     */
    public function testGetAdditionalCourseInfoTable(
        \Api\Input\Request\Horses\LookupTable\AdditionalCourseInfo $request,
        array $expectedResult
    ) {
        $bo = new \Tests\Stubs\Bo\LookupTable($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($bo->getAdditionalCourseInfoTable())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetAdditionalCourseInfoTable()
    {
        return [
            [
                new \Api\Input\Request\Horses\LookupTable\AdditionalCourseInfo([]),
                [
                    'A' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'straight_round_jubilee_code' => 'A',
                            'straight_round_jubilee_desc' => 'Summer Course',
                            'rp_straight_round_jubilee_desc' => 'Summer',
                        ]
                    ),
                    'B' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'straight_round_jubilee_code' => 'B',
                            'straight_round_jubilee_desc' => 'Winter Course',
                            'rp_straight_round_jubilee_desc' => 'Winter',
                        ]
                    ),
                    'C' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'straight_round_jubilee_code' => 'C',
                            'straight_round_jubilee_desc' => 'Bank course',
                            'rp_straight_round_jubilee_desc' => 'Bank',
                        ]
                    ),
                    'D' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'straight_round_jubilee_code' => 'D',
                            'straight_round_jubilee_desc' => 'Fibresand',
                            'rp_straight_round_jubilee_desc' => 'Fibresand',
                        ]
                    ),
                    'E' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'straight_round_jubilee_code' => 'E',
                            'straight_round_jubilee_desc' => 'Old Style Measure - GN',
                            'rp_straight_round_jubilee_desc' => 'omsGN',
                        ]
                    ),
                    'F' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'straight_round_jubilee_code' => 'F',
                            'straight_round_jubilee_desc' => 'Fixed Brush',
                            'rp_straight_round_jubilee_desc' => 'Brush',
                        ]
                    ),
                    'G' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'straight_round_jubilee_code' => 'G',
                            'straight_round_jubilee_desc' => 'Grand National',
                            'rp_straight_round_jubilee_desc' => 'Grand National',
                        ]
                    ),
                    'H' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'straight_round_jubilee_code' => 'H',
                            'straight_round_jubilee_desc' => 'Old Style Measure - New',
                            'rp_straight_round_jubilee_desc' => 'omsNew',
                        ]
                    ),
                    'I' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'straight_round_jubilee_code' => 'I',
                            'straight_round_jubilee_desc' => 'Inner',
                            'rp_straight_round_jubilee_desc' => 'Inner',
                        ]
                    ),
                    'J' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'straight_round_jubilee_code' => 'J',
                            'straight_round_jubilee_desc' => 'Jubilee',
                            'rp_straight_round_jubilee_desc' => 'Jub',
                        ]
                    ),
                    'K' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'straight_round_jubilee_code' => 'K',
                            'straight_round_jubilee_desc' => 'Kelso Old',
                            'rp_straight_round_jubilee_desc' => 'KelsoOld',
                        ]
                    ),
                    'L' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'straight_round_jubilee_code' => 'L',
                            'straight_round_jubilee_desc' => 'Old Course',
                            'rp_straight_round_jubilee_desc' => 'Old',
                        ]
                    ),
                    'M' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'straight_round_jubilee_code' => 'M',
                            'straight_round_jubilee_desc' => 'Mildmay',
                            'rp_straight_round_jubilee_desc' => 'Mildmay',
                        ]
                    ),
                    'N' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'straight_round_jubilee_code' => 'N',
                            'straight_round_jubilee_desc' => 'New',
                            'rp_straight_round_jubilee_desc' => 'New',
                        ]
                    ),
                    'O' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'straight_round_jubilee_code' => 'O',
                            'straight_round_jubilee_desc' => 'Old Mile',
                            'rp_straight_round_jubilee_desc' => 'Old',
                        ]
                    ),
                    'P' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'straight_round_jubilee_code' => 'P',
                            'straight_round_jubilee_desc' => 'Park',
                            'rp_straight_round_jubilee_desc' => 'Park',
                        ]
                    ),
                    'Q' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'straight_round_jubilee_code' => 'Q',
                            'straight_round_jubilee_desc' => 'Old Style Measure - Old',
                            'rp_straight_round_jubilee_desc' => 'omsOld',
                        ]
                    ),
                    'R' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'straight_round_jubilee_code' => 'R',
                            'straight_round_jubilee_desc' => 'Round',
                            'rp_straight_round_jubilee_desc' => 'Rnd',
                        ]
                    ),
                    'S' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'straight_round_jubilee_code' => 'S',
                            'straight_round_jubilee_desc' => 'Straight',
                            'rp_straight_round_jubilee_desc' => 'Str',
                        ]
                    ),
                    'T' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'straight_round_jubilee_code' => 'T',
                            'straight_round_jubilee_desc' => 'Tapeta',
                            'rp_straight_round_jubilee_desc' => 'Tap',
                        ]
                    ),
                    'U' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'straight_round_jubilee_code' => 'U',
                            'straight_round_jubilee_desc' => 'Polytrack',
                            'rp_straight_round_jubilee_desc' => 'Poly',
                        ]
                    ),
                    'V' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'straight_round_jubilee_code' => 'V',
                            'straight_round_jubilee_desc' => 'Old Style Measure - Brush',
                            'rp_straight_round_jubilee_desc' => 'omsBrush',
                        ]
                    ),
                    'W' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'straight_round_jubilee_code' => 'W',
                            'straight_round_jubilee_desc' => 'Rowley',
                            'rp_straight_round_jubilee_desc' => 'Row',
                        ]
                    ),
                    'X' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'straight_round_jubilee_code' => 'X',
                            'straight_round_jubilee_desc' => 'X-Country',
                            'rp_straight_round_jubilee_desc' => 'X-Country',
                        ]
                    ),
                    'Y' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'straight_round_jubilee_code' => 'Y',
                            'straight_round_jubilee_desc' => 'July',
                            'rp_straight_round_jubilee_desc' => 'July',
                        ]
                    ),
                    'Z' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'straight_round_jubilee_code' => 'Z',
                            'straight_round_jubilee_desc' => 'Old Measurement System',
                            'rp_straight_round_jubilee_desc' => 'OMS',
                        ]
                    ),
                ]
            ],
            [
                new \Api\Input\Request\Horses\LookupTable\AdditionalCourseInfo(['a']),
                [
                    'A' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'straight_round_jubilee_code' => 'A',
                            'straight_round_jubilee_desc' => 'Summer Course',
                            'rp_straight_round_jubilee_desc' => 'Summer',
                        ]
                    ),
                ]
            ]
        ];
    }
}
