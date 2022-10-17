<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 5/23/2016
 * Time: 5:46 PM
 */

namespace Models\Bo\Selectors;

class Distance
{
    /**
     * @var string
     */
    protected $raceType = 'legacy';

    /**
     * @var array
     */
    protected $distanceGroups = [
        'flat' => [
            "0-1210" => [
                'from' => 0,
                'to' => 1210
            ],
            "1100-1320" => [
                'from' => 1100,
                'to' => 1320
            ],
            "1540-1980" => [
                'from' => 1540,
                'to' => 1980
            ],
            "2200-2420" => [
                'from' => 2200,
                'to' => 2420
            ],
            "2640-2860" => [
                'from' => 2640,
                'to' => 2860
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
        ],
        'jumps' => [
            "0-3850" => [
                'from' => 0,
                'to' => 3850
            ],
            "3520-3740" => [
                'from' => 3520,
                'to' => 3740
            ],
            "3851-4290" => [
                'from' => 3851,
                'to' => 4290
            ],
            "4291-4950" => [
                'from' => 4291,
                'to' => 4950
            ],
            "4951-5830" => [
                'from' => 4951,
                'to' => 5830
            ],
            "5831-null" => [
                'from' => 5831,
                'to' => null
            ]
        ],
        'legacy' => [
            "5-6f" => [
                'from' => 1100,
                'to' => 1429
            ],
            "7f-1m" => [
                'from' => 1430,
                'to' => 1869
            ],
            "9f-10f" => [
                'from' => 1870,
                'to' => 2309
            ],
            "11f-12f" => [
                'from' => 2310,
                'to' => 2749
            ],
            "13f+" => [
                'from' => 2750,
                'to' => null
            ]
        ],
        'legacy_alt' => [
            "5f" => [
                'from' => 0,
                'to' => 1209
            ],
            "6f" => [
                'from' => 1210,
                'to' => 1429
            ],
            "7f" => [
                'from' => 1430,
                'to' => 1649
            ],
            "1m" => [
                'from' => 1650,
                'to' => 1759
            ],
            "1m-1m1f" => [
                'from' => 1760,
                'to' => 2089
            ],
            "1m2f-1m3f" => [
                'from' => 2090,
                'to' => 2529
            ],
            "1m4f-1m5f" => [
                'from' => 2530,
                'to' => 2969
            ],
            "1m6f-1m7f" => [
                'from' => 2970,
                'to' => 3409
            ],
            "2m-null" => [
                'from' => 3410,
                'to' => null
            ]
        ],
        'bloodstock' => [
            "5-6f" => [
                'from' => 990,
                'to' => 1429
            ],
            "7-9f" => [
                'from' => 1430,
                'to' => 2089
            ],
            "10-11f" => [
                'from' => 2090,
                'to' => 2529
            ],
            "12-13f" => [
                'from' => 2530,
                'to' => 2969
            ],
            "14f+" => [
                'from' => 2970,
                'to' => null
            ]
        ]
    ];

    /**
     * @param $raceType
     *
     * @throws \Exception
     */
    public function setRaceType($raceType)
    {
        if (!empty($this->raceType) && empty($this->distanceGroups[$raceType])) {
            throw new \Exception("Wrong race type");
        }
        $this->raceType = $raceType;
    }

    /**
     * @param string $key
     *
     * @return string Representation of distance grouping
     * @throws \Exception
     */
    public function getDistanceGroup($key)
    {
        if (!empty($this->raceType) && !isset($this->distanceGroups[$this->raceType][$key])) {
            throw new \Exception('Wrong distance group');
        }

        return $this->distanceGroups[$this->raceType][$key];
    }

    /**
     * @param string $raceType
     *
     * @return string Representation of race type grouping
     * @throws \Exception
     */
    public function getDistanceByRaceType($raceType)
    {
        if (!empty($this->raceType) && empty($this->distanceGroups[$raceType])) {
            throw new \Exception("Wrong race type");
        }
        return $this->distanceGroups[$raceType];
    }

    public function getQueryDistanceYard()
    {
        static $sql = null;
        if (!$sql) {
            $indent = '                    ';
            $sql = 'CASE' . PHP_EOL;

            foreach ($this->distanceGroups[$this->raceType] as $key => $val) {
                if (!is_null($val['to'])) {
                    $sql .= $indent . "    WHEN distance_yard BETWEEN {$val['from']} AND {$val['to']} THEN '{$key}'" . PHP_EOL;
                } else {
                    $sql .= $indent . "    ELSE '{$key}'" . PHP_EOL;
                    break;
                }
            }
            $sql .= $indent . 'END' . PHP_EOL;
        }
        return $sql;
    }
}
