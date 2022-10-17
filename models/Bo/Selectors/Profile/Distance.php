<?php
namespace Models\Bo\Selectors\Profile;

class Distance extends \Models\Bo\Selectors\Distance
{
    public function __construct()
    {
        $this->distanceGroups['flat'] = [
            "0-1210" => [
                'from' => 0,
                'to' => 1210
            ],
            "1211-1430" => [
                'from' => 1211,
                'to' => 1430
            ],
            "1431-1650" => [
                'from' => 1431,
                'to' => 1650
            ],
            "1651-2090" => [
                'from' => 1651,
                'to' => 2090
            ],
            "2091-2530" => [
                'from' => 2091,
                'to' => 2530
            ],
            "2531-2970" => [
                'from' => 2531,
                'to' => 2970
            ],
            "2971-3410" => [
                'from' => 2971,
                'to' => 3410
            ],
            "3411-null" => [
                'from' => 3411,
                'to' => null
            ],
            "3080-null" => [
                'from' => 3080,
                'to' => null
            ]
        ];
    }
}
