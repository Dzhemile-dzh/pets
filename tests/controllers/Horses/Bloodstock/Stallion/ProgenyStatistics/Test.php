<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Bloodstock\Stallion\ProgenyStatistics;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 * @package Tests\Controllers\Horses\Bloodstock\Stallion\ProgenyStatistics
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/bloodstock/stallion/749313/progeny-statistics';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\Bloodstock\Stallion\ProgenyStatistics:123 ->getProgenyStatistics()
            'b841e629ded18016805746f044f943f2' => [
                [
                    'category' => 'Euro Stakes',
                    'no_of_wins' => 0,
                    'no_of_runs' => 10,
                    'no_of_2nds' => 2,
                    'no_of_3rds' => 3,
                    'no_of_winners' => 0,
                    'no_of_runners' => 6,
                    'win_prize_money' => 0.0,
                    'total_prize_money' => 37802.9646,
                    'section_name' => 'current_year',
                ],
                [
                    'category' => 'Turf',
                    'no_of_wins' => 55,
                    'no_of_runs' => 461,
                    'no_of_2nds' => 60,
                    'no_of_3rds' => 64,
                    'no_of_winners' => 33,
                    'no_of_runners' => 94,
                    'win_prize_money' => 590086.5145,
                    'total_prize_money' => 1213417.5462,
                    'section_name' => '1988_to_date',
                ],
                [
                    'category' => 'S',
                    'no_of_wins' => 6,
                    'no_of_runs' => 54,
                    'no_of_2nds' => 10,
                    'no_of_3rds' => 3,
                    'no_of_winners' => 6,
                    'no_of_runners' => 41,
                    'win_prize_money' => 38649.45,
                    'total_prize_money' => 75579.74,
                    'section_name' => '1988_to_date',
                ],
                [
                    'category' => 'NHF',
                    'no_of_wins' => 0,
                    'no_of_runs' => 2,
                    'no_of_2nds' => 1,
                    'no_of_3rds' => 1,
                    'no_of_winners' => 0,
                    'no_of_runners' => 1,
                    'win_prize_money' => 0.0,
                    'total_prize_money' => 810.9,
                    'section_name' => '1988_to_date',
                ],
                [
                    'category' => 'Jumps',
                    'no_of_wins' => 1,
                    'no_of_runs' => 16,
                    'no_of_2nds' => 3,
                    'no_of_3rds' => 1,
                    'no_of_winners' => 1,
                    'no_of_runners' => 6,
                    'win_prize_money' => 5451.3274,
                    'total_prize_money' => 10839.2148,
                    'section_name' => '1988_to_date',
                ],
                [
                    'category' => 'HY',
                    'no_of_wins' => 2,
                    'no_of_runs' => 34,
                    'no_of_2nds' => 5,
                    'no_of_3rds' => 7,
                    'no_of_winners' => 2,
                    'no_of_runners' => 19,
                    'win_prize_money' => 10811.1329,
                    'total_prize_money' => 39980.67,
                    'section_name' => '1988_to_date',
                ],
                [
                    'category' => 'GS',
                    'no_of_wins' => 10,
                    'no_of_runs' => 97,
                    'no_of_2nds' => 12,
                    'no_of_3rds' => 13,
                    'no_of_winners' => 8,
                    'no_of_runners' => 43,
                    'win_prize_money' => 68268.0,
                    'total_prize_money' => 252393.62,
                    'section_name' => '1988_to_date',
                ],
                [
                    'category' => 'GF',
                    'no_of_wins' => 15,
                    'no_of_runs' => 139,
                    'no_of_2nds' => 21,
                    'no_of_3rds' => 14,
                    'no_of_winners' => 14,
                    'no_of_runners' => 72,
                    'win_prize_money' => 320045.3529,
                    'total_prize_money' => 611408.21,
                    'section_name' => '1988_to_date',
                ],
                [
                    'category' => 'G',
                    'no_of_wins' => 21,
                    'no_of_runs' => 114,
                    'no_of_2nds' => 9,
                    'no_of_3rds' => 19,
                    'no_of_winners' => 18,
                    'no_of_runners' => 65,
                    'win_prize_money' => 148908.2414,
                    'total_prize_money' => 223472.27,
                    'section_name' => '1988_to_date',
                ],
                [
                    'category' => 'Flat',
                    'no_of_wins' => 75,
                    'no_of_runs' => 668,
                    'no_of_2nds' => 87,
                    'no_of_3rds' => 93,
                    'no_of_winners' => 46,
                    'no_of_runners' => 104,
                    'win_prize_money' => 675233.9443,
                    'total_prize_money' => 1360733.7334,
                    'section_name' => '1988_to_date',
                ],
                [
                    'category' => 'First Crop',
                    'no_of_wins' => 12,
                    'no_of_runs' => 156,
                    'no_of_2nds' => 25,
                    'no_of_3rds' => 23,
                    'no_of_winners' => 11,
                    'no_of_runners' => 42,
                    'win_prize_money' => 56172.1242,
                    'total_prize_money' => 128407.6497,
                    'section_name' => '1988_to_date',
                ],
                [
                    'category' => 'F',
                    'no_of_wins' => 1,
                    'no_of_runs' => 6,
                    'no_of_2nds' => 0,
                    'no_of_3rds' => 3,
                    'no_of_winners' => 1,
                    'no_of_runners' => 6,
                    'win_prize_money' => 3881.4,
                    'total_prize_money' => 5965.91,
                    'section_name' => '1988_to_date',
                ],
                [
                    'category' => 'All-weather',
                    'no_of_wins' => 20,
                    'no_of_runs' => 207,
                    'no_of_2nds' => 27,
                    'no_of_3rds' => 29,
                    'no_of_winners' => 17,
                    'no_of_runners' => 67,
                    'win_prize_money' => 85147.4298,
                    'total_prize_money' => 147316.1872,
                    'section_name' => '1988_to_date',
                ],
                [
                    'category' => '7-9f',
                    'no_of_wins' => 28,
                    'no_of_runs' => 314,
                    'no_of_2nds' => 41,
                    'no_of_3rds' => 45,
                    'no_of_winners' => 20,
                    'no_of_runners' => 80,
                    'win_prize_money' => 390255.2947,
                    'total_prize_money' => 730411.5255,
                    'section_name' => '1988_to_date',
                ],
                [
                    'category' => '5-6f',
                    'no_of_wins' => 30,
                    'no_of_runs' => 263,
                    'no_of_2nds' => 34,
                    'no_of_3rds' => 32,
                    'no_of_winners' => 21,
                    'no_of_runners' => 66,
                    'win_prize_money' => 176619.4395,
                    'total_prize_money' => 358846.8731,
                    'section_name' => '1988_to_date',
                ],
                [
                    'category' => '2yo',
                    'no_of_wins' => 27,
                    'no_of_runs' => 298,
                    'no_of_2nds' => 46,
                    'no_of_3rds' => 40,
                    'no_of_winners' => 22,
                    'no_of_runners' => 86,
                    'win_prize_money' => 168714.1742,
                    'total_prize_money' => 344109.47,
                    'section_name' => '1988_to_date',
                ],
                [
                    'category' => '14f+',
                    'no_of_wins' => 0,
                    'no_of_runs' => 4,
                    'no_of_2nds' => 0,
                    'no_of_3rds' => 1,
                    'no_of_winners' => 0,
                    'no_of_runners' => 4,
                    'win_prize_money' => 0.0,
                    'total_prize_money' => 4230.7692,
                    'section_name' => '1988_to_date',
                ],
                [
                    'category' => '12-13f',
                    'no_of_wins' => 3,
                    'no_of_runs' => 22,
                    'no_of_2nds' => 2,
                    'no_of_3rds' => 5,
                    'no_of_winners' => 3,
                    'no_of_runners' => 11,
                    'win_prize_money' => 12881.2129,
                    'total_prize_money' => 33764.39,
                    'section_name' => '1988_to_date',
                ],
                [
                    'category' => '10-11f',
                    'no_of_wins' => 14,
                    'no_of_runs' => 65,
                    'no_of_2nds' => 10,
                    'no_of_3rds' => 10,
                    'no_of_winners' => 10,
                    'no_of_runners' => 24,
                    'win_prize_money' => 95477.9972,
                    'total_prize_money' => 233480.1756,
                    'section_name' => '1988_to_date',
                ],
            ],
        ];
    }
}
