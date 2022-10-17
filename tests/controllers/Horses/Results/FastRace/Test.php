<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Results\FastRace;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 * @package Tests\Controllers\Horses\RaceResultsCards\FastRace
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/results/fast/257042';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Models\Bo\Results\FastHorseRace:18 ->getRaceFastResult()
            '7b77b76b17e0effaf05daff203d9f1e1' => [
                [
                    'race_instance_uid' => 744623,
                    'fast_race_instance_uid' => 257042,
                    'race_datetime' => '2019-12-15T13:55:00+00:00',
                    'course_name' => 'CARLISLE',
                    'diffusion_course_name' => 'CARLISLE',
                    'course_key' => 'carlisle',
                    'tote_win_money' => 2.8,
                    'dual_forecast' => 15,
                    'csf' => 21.14,
                    'tricast' => null,
                    'placepot' => null,
                    'favorite' => 'Planet Nine 5/4F',
                    '2nd_favourite' => 'Taxmeifyoucan 9/4 2ndF',
                    'no_of_runners' => 4,
                    'non_runners' => 'Justatenner',
                    'miscellaneous' => '; Trifecta: £26.10; Weighed In',
                    'formbook_yn' => 'Y',
                    'fav_position' => 2,
                    'pa_horse_name' => "Taxmeifyoucan",
                    'pa_odds' => "9-4",
                    'fav_joint' => 1,
                    'horse_name' => 'Taxmeifyoucan',
                    'saddle_cloth_number' => 4,
                    'jockey_name' => 'B S Hughes',
                    'odds_desc' => '9/4',
                    'race_outcome_position' => 1,
                ],
            ]
        ];
    }
}
