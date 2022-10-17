<?php

namespace Tests;

class IsWorldwideStakeRaceTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param \Api\Row\RaceInstance $row
     * @param array $expectedResult
     *
     * @dataProvider dataProvider
     */
    public function testIsWorldwideStakeRace(
        \Api\Row\RaceInstance $row,
        $expectedResult
    ) {

        $this->assertEquals($expectedResult, $row->isWorldwideStakeRace());
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        $correctGroups = [
            'Group 1',
            'Group 2',
            'Group 3',
            'Listed',
            'Grade 1',
            'Grade 2',
            'Grade 3',
            'Grade 1 Handicap',
            'Grade 2 Handicap',
            'Grade 3 Handicap',
        ];

        $correctRaceTypes = ['F', 'X'];

        $wrongGroups = [
            'Listed Handicap',
            'Grade A Handicap',
            '99',
            'Handicap',
        ];

        $wrongRaceTypes = ['H', 'B', 'A'];

        $result = [];

        foreach ($correctGroups as $group) {
            foreach ($correctRaceTypes as $raceType) {
                $result[] = [
                    \Api\Row\RaceInstance::createFromArray(
                        [
                            'race_group_desc' => $group,
                            'race_type_code' => $raceType
                        ]
                    ),
                    true
                ];
            }
        }

        foreach ($wrongGroups as $group) {
            foreach ($wrongRaceTypes as $raceType) {
                $result[] = [
                    \Api\Row\RaceInstance::createFromArray(
                        [
                            'race_group_desc' => $group,
                            'race_type_code' => $raceType
                        ]
                    ),
                    false
                ];
            }
        }

        return $result;
    }
}
