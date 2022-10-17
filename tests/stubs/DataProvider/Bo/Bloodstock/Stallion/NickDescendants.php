<?php
namespace Tests\Stubs\DataProvider\Bo\Bloodstock\Stallion;

use Api\Input\Request\HorsesRequest;

class NickDescendants extends \Api\DataProvider\Bo\Bloodstock\Stallion\NickDescendants
{
    /**
     * @param HorsesRequest $request
     *
     * @return \Api\Row\Bloodstock\Stallion\Nick[]
     */
    public function getNickDescendants(HorsesRequest $request)
    {
        $data = [
            '653884_43127_total-prize' => [
                0 => \Api\Row\Bloodstock\Stallion\Nick::createFromArray(
                    [
                        'horse_uid' => 859459,
                        'style_name' => 'Vodka Wells',
                        'runs' => 20,
                        'wins' => 2,
                        'win_prize_money' => 11696.4,
                        'total_money' => 20203.650000000001,
                    ]
                ),
                1 => \Api\Row\Bloodstock\Stallion\Nick::createFromArray(
                    [
                        'horse_uid' => 870205,
                        'style_name' => 'Wells De Lune',
                        'runs' => 5,
                        'wins' => 1,
                        'win_prize_money' => 3898.8000000000002,
                        'total_money' => 3898.8000000000002,
                    ]
                ),
            ],
            '58025_301128_a-z' => array(
                0 => \Api\Row\Bloodstock\Stallion\Nick::createFromArray(
                    array(
                        'horse_uid' => 463607,
                        'style_name' => 'Bombay Mix',
                        'runs' => 21,
                        'wins' => 3,
                        'win_prize_money' => 8660.5499999999993,
                        'total_money' => 10021.93,
                    )
                ),
                1 => \Api\Row\Bloodstock\Stallion\Nick::createFromArray(
                    array(
                        'horse_uid' => 519052,
                        'style_name' => 'Diamond Rachael',
                        'runs' => 29,
                        'wins' => 4,
                        'win_prize_money' => 12222.5,
                        'total_money' => 15644.5,
                    )
                ),
                2 => \Api\Row\Bloodstock\Stallion\Nick::createFromArray(
                    array(
                        'horse_uid' => 475575,
                        'style_name' => 'Pass The Rest',
                        'runs' => 23,
                        'wins' => 2,
                        'win_prize_money' => 9556,
                        'total_money' => 14040,
                    )
                ),
            ),
        ];

        return $data[$request->getStallionId() . '_' . $request->getStallionAncestorId() . '_' . $request->getOrder()];
    }
}
