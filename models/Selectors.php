<?php

namespace Models;

use Api\Constants\Horses as Constants;

/**
 * Class Selectors
 *
 * @package Models
 */
class Selectors
{
    const MIN_DATE_RESULTS_SEARCH = '1988-01-01';
    const MAX_DATE_SYBASE_SMALLDATETIME = '2079-06-06';

    const MEETING_TYPE_FLAT = 'flat';
    const MEETING_TYPE_JUMPS = 'jumps';
    const MEETING_TYPE_MIXED = 'mixed';

    /**
     * @var array
     */
    private $raceTypes = [
        'flat' => "Flat",
        'jumps' => "Jumps",
    ];

    /**
     * @var array
     */
    private $surfaces = [
        'aw' => "AW",
        'turf' => "Turf",
    ];

    private $championships = [
        'trainer' => 'Trainer Title',
        'jockey' => 'Jockey Title',
    ];

    /**
     * @var array
     */
    private $raceTypeCodes = [
        'flat' => [
            'turf' => ['F'],
            'aw' => ['X'],
        ],
        'jumps' => [
            'hurdle' => ['H', 'Y'],
            'chase' => ['C', 'U', 'Z'],
            'nhf' => ['B', 'W'],
        ],
        'other' => [
            'p2p' => ['P'],
        ],
    ];

    /**
     * @var \Models\Bo\Selectors\Distance
     */
    private $distance;

    /**
     * @var \Models\Bo\Selectors\Database
     */
    private $db;

    /**
     * @var array
     */
    private $seasonTypeMap = [
        'flat' => [
            'title' => 'Flat',
            'code' => 'F',
            'inSeasonalStatistics' => [
                'bloodstock_horse',
            ],
            'countries' => [
                'gb' => [
                    'title' => 'GB Flat',
                    'code' => 'F',
                    'inSeasonalStatistics' => [
                        'jockey',
                        'trainer',
                        'owner',
                        'sire',
                        'horse',
                    ],
                    'isDefaultSeason' => [
                        'owner',
                        'horse',
                    ],
                ],
                'ire' => [
                    'title' => 'IRE Flat',
                    'code' => 'F',
                    'inSeasonalStatistics' => [
                        'jockey',
                        'trainer',
                        'owner',
                        'sire',
                        'horse',
                    ],
                ],
                'gb-ire' => [
                    'title' => 'GB & IRE Flat',
                    'code' => 'F',
                    'inSeasonalStatistics' => [
                        'horse',
                    ],
                ],
            ],

            'championship' => [
                'trainer' => [
                    'countries' => [
                        'gb' => [
                            'title' => 'GB Flat Trainers Championship',
                            'code' => 'L',
                            'inSeasonalStatistics' => [
                                'trainer',
                            ],
                            'isDefaultSeason' => [
                                'trainer',
                            ],
                        ],
                        'ire' => [
                            'title' => 'IRE Flat Trainer Championship',
                            'code' => 'N',
                            'inSeasonalStatistics' => [
                                'trainer',
                            ],
                        ],
                    ],
                ],
                'owner' => [
                    'countries' => [
                        'gb' => [
                            'title' => 'GB Flat Owners Championship',
                            'code' => 'K',
                            'inSeasonalStatistics' => [
                                'owner',
                            ],
                        ],
                        'ire' => [
                            'title' => 'IRE Flat Owner Championship',
                            'code' => 'N',
                            'inSeasonalStatistics' => [
                                'owner',
                            ],
                        ],
                    ],
                ],
                'jockey' => [
                    'countries' => [
                        'gb' => [
                            'title' => 'GB Flat Jockeys Championship',
                            'code' => 'K',
                            'inSeasonalStatistics' => [
                                'jockey',
                            ],
                            'isDefaultSeason' => [
                                'jockey',
                            ],
                        ],
                        'ire' => [
                            'title' => 'IRE Flat Jockey Championship',
                            'code' => 'M',
                            'inSeasonalStatistics' => [
                                'jockey',
                            ],
                        ],
                    ],
                ],
                'sire' => [
                    'countries' => [
                        'gb' => [
                            'title' => 'GB Flat Sires Championship',
                            'code' => 'F',
                            'categories' => ['Flat', 'All-weather'],
                            'inSeasonalStatistics' => [
                                'sire',
                            ],
                            'isDefaultSeason' => [
                                'sire',
                            ],
                        ],
                    ],
                ],
                'horse' => [
                    'countries' => [
                        'gb' => [
                            'title' => 'GB Flat Horse Championship',
                            'code' => 'K',
                            'inSeasonalStatistics' => [
                                'horse',
                            ],
                        ],
                        'ire' => [
                            'title' => 'IRE Flat Horse Championship',
                            'code' => 'E',
                            'inSeasonalStatistics' => [
                                'horse',
                            ],
                        ],
                    ],
                ],
            ],

            'turf' => [
                'title' => 'Flat Turf',
                'code' => 'F',

                'inSeasonalStatistics' => [
                    'bloodstock_horse',
                ],

                'countries' => [
                    'gb' => [
                        'title' => 'GB Flat Turf',
                        'code' => 'F',
                        'inSeasonalStatistics' => [
                            'jockey',
                            'trainer',
                            'owner',
                            'sire',
                            'horse',
                        ],
                    ],
                    'ire' => [
                        'title' => 'IRE Flat Turf',
                        'code' => 'F',
                        'inSeasonalStatistics' => [
                            'jockey',
                            'trainer',
                            'sire',
                            'owner',
                            'horse',
                        ],
                    ],
                ],

                'championship' => [
                    'trainer' => [
                        'countries' => [
                            'gb' => [
                                'title' => 'GB Flat Turf Trainers Championship',
                                'code' => 'L',
                                'inSeasonalStatistics' => [
                                    'trainer',
                                ],
                            ],
                            'ire' => [
                                'title' => 'IRE Flat Turf Trainer Championship',
                                'code' => 'N',
                                'inSeasonalStatistics' => [
                                    'trainer',
                                ],
                                'isDefaultSeason' => [
                                    'trainer',
                                ],
                            ],
                        ],
                    ],
                    'sire' => [
                        'countries' => [
                            'gb' => [
                                'title' => 'GB Flat Turf Sires Championship',
                                'code' => 'T',
                                'categories' => ['Flat'],
                                'inSeasonalStatistics' => [
                                    'sire',
                                ],
                            ],
                        ],
                    ],
                    'jockey' => [
                        'countries' => [
                            'gb' => [
                                'title' => 'GB Flat Turf Jockeys Championship',
                                'code' => 'K',
                                'inSeasonalStatistics' => [
                                    'jockey',
                                ],
                            ],
                            'ire' => [
                                'title' => 'IRE Flat Turf Jockey Championship',
                                'code' => 'M',
                                'inSeasonalStatistics' => [
                                    'jockey',
                                ],
                                'isDefaultSeason' => [
                                    'jockey',
                                ],
                            ],
                        ],
                    ],
                    'owner' => [
                        'countries' => [
                            'gb' => [
                                'title' => 'GB Flat Turf Owners Championship',
                                'code' => 'K',
                                'inSeasonalStatistics' => [
                                    'owner',
                                ],
                            ],
                            'ire' => [
                                'title' => 'IRE Flat Turf Owner Championship',
                                'code' => 'E',
                                'inSeasonalStatistics' => [
                                    'owner',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'aw' => [
                'title' => 'All-weather',
                'code' => 'F',

                'inSeasonalStatistics' => [
                    'bloodstock_horse',
                ],

                'countries' => [
                    'gb' => [
                        'title' => 'GB Flat AW',
                        'code' => 'F',
                        'inSeasonalStatistics' => [
                            'jockey',
                            'trainer',
                            'owner',
                            'sire',
                            'horse',
                        ],
                    ],
                    'ire' => [
                        'title' => 'IRE Flat AW',
                        'code' => 'F',
                        'inSeasonalStatistics' => [
                            'jockey',
                            'trainer',
                            'owner',
                            'sire',
                            'horse',
                        ],
                    ],
                ],

                'championship' => [
                    'trainer' => [
                        'countries' => [
                            'gb' => [
                                'title' => 'GB Flat AW Trainers Championship',
                                'code' => 'A',
                                'inSeasonalStatistics' => [
                                    'trainer',
                                ],
                                'isDefaultSeason' => [
                                    'trainer',
                                ],
                            ],
                            'ire' => [
                                'title' => 'IRE Flat AW Trainer Championship',
                                'code' => 'W',
                                'inSeasonalStatistics' => [
                                    'trainer',
                                ],
                                'isDefaultSeason' => [
                                    'trainer',
                                ],
                            ],
                        ],
                    ],
                    'owner' => [
                        'countries' => [
                            'gb' => [
                                'title' => 'GB Flat AW Owners Championship',
                                'code' => 'A',
                                'inSeasonalStatistics' => [
                                    'owner',
                                ],
                            ],
                            'ire' => [
                                'title' => 'IRE Flat AW Owner Championship',
                                'code' => 'W',
                                'inSeasonalStatistics' => [
                                    'owner',
                                ],
                            ],
                        ],
                    ],
                    'jockey' => [
                        'countries' => [
                            'gb' => [
                                'title' => 'GB Flat AW Jockeys Championship',
                                'code' => 'A',
                                'inSeasonalStatistics' => [
                                    'jockey',
                                ],
                                'isDefaultSeason' => [
                                    'jockey',
                                ],
                            ],
                            'ire' => [
                                'title' => 'IRE Flat AW Jockey Championship',
                                'code' => 'W',
                                'inSeasonalStatistics' => [
                                    'jockey',
                                ],
                                'isDefaultSeason' => [
                                    'jockey',
                                ],
                            ],
                        ],
                    ],
                    'sire' => [
                        'countries' => [
                            'gb' => [
                                'title' => 'GB Flat AW Sires Championship',
                                'code' => 'A',
                                'categories' => ['All-weather'],
                                'inSeasonalStatistics' => [
                                    'sire',
                                ],
                            ],
                        ],
                    ],
                    'horse' => [
                        'countries' => [
                            'gb' => [
                                'title' => 'GB Flat AW Horse Championship',
                                'code' => 'A',
                                'inSeasonalStatistics' => [
                                    'horse',
                                ],
                            ],
                            'ire' => [
                                'title' => 'IRE Flat AW Horse Championship',
                                'code' => 'W',
                                'inSeasonalStatistics' => [
                                    'horse',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'jumps' => [
            'title' => 'Jumps',
            'code' => 'J',

            'inSeasonalStatistics' => [
                'bloodstock_horse',
            ],

            'countries' => [
                'gb' => [
                    'title' => 'GB Jumps',
                    'code' => 'J',
                    'inSeasonalStatistics' => [
                        'jockey',
                        'trainer',
                        'owner',
                        'sire',
                        'horse',
                    ],
                    'isDefaultSeason' => [
                        'jockey',
                        'trainer',
                        'owner',
                        'horse',
                    ],
                ],
                'ire' => [
                    'title' => 'IRE Jumps',
                    'code' => 'I',
                    'inSeasonalStatistics' => [
                        'jockey',
                        'trainer',
                        'owner',
                        'sire',
                        'horse',
                    ],
                ],
                'gb-ire' => [
                    'title' => 'GB & IRE Jumps',
                    'code' => 'J',
                    'inSeasonalStatistics' => [
                        'horse',
                    ],
                ],
            ],

            'championship' => [
                'trainer' => [
                    'countries' => [
                        'gb' => [
                            'title' => 'GB Jumps Trainers Championship',
                            'code' => 'J',
                            'inSeasonalStatistics' => [
                                'trainer',
                            ],
                        ],
                        'ire' => [
                            'title' => 'IRE Jumps Trainer Championship',
                            'code' => 'I',
                            'inSeasonalStatistics' => [
                                'trainer',
                            ],
                        ],
                    ],
                ],
                'owner' => [
                    'countries' => [
                        'gb' => [
                            'title' => 'GB Jumps Owners Championship',
                            'code' => 'J',
                            'categories' => ['Jumps'],
                            'inSeasonalStatistics' => [
                                'owner',
                            ],
                        ],
                        'ire' => [
                            'title' => 'IRE Jumps Owner Championship',
                            'code' => 'I',
                            'inSeasonalStatistics' => [
                                'owner',
                            ],
                        ],
                    ],
                ],
                'sire' => [
                    'countries' => [
                        'gb' => [
                            'title' => 'GB Jump Sires Championship',
                            'code' => 'J',
                            'categories' => ['Jumps'],
                            'inSeasonalStatistics' => [
                                'sire',
                            ],
                        ],
                    ],
                ],
                'horse' => [
                    'countries' => [
                        'gb' => [
                            'title' => 'GB Jumps Horse Championship',
                            'code' => 'J',
                            'inSeasonalStatistics' => [
                                'horse',
                            ],
                        ],
                        'ire' => [
                            'title' => 'IRE Jumps Horse Championship',
                            'code' => 'I',
                            'inSeasonalStatistics' => [
                                'horse',
                            ],
                        ],
                    ],
                ],
            ],

            'hurdle' => [
                'title' => 'Jumps Hurdle',
                'code' => 'H',
                'inSeasonalStatistics' => [
                    'bloodstock_horse',
                ],
            ],
            'chase' => [
                'title' => 'Jumps Chase',
                'code' => 'C',
                'inSeasonalStatistics' => [
                    'bloodstock_horse',
                ],
            ],
            'nhf' => [
                'title' => 'Jumps Nhf',
                'code' => 'B',
                'inSeasonalStatistics' => [
                    'bloodstock_horse',
                ],
            ],
        ],
    ];

    /**
     * @var array
     */
    private $statisticsTypeCodes = [
        'jockey' => [
            'course' => 'Course',
            'distance' => 'Distance',
            'month' => 'Month',
            'race-type' => 'Race Type',
            'trainer' => 'Trainer',
            'age-of-horse' => 'Age Of Horse',
            'race-category' => 'Race Category',
            'race-class' => 'Race Class',
        ],
        'trainer' => [
            'course' => 'Course',
            'distance' => 'Distance',
            'month' => 'Month',
            'race-type' => 'Race Type',
            'jockey' => 'Jockey',
            'age-of-horse' => 'Age Of Horse',
            'race-category' => 'Race Category',
            'race-class' => 'Race Class',
        ],
        'owner' => [
            'course' => 'Course',
            'distance' => 'Distance',
            'month' => 'Month',
            'race-type' => 'Race Type',
            'trainer' => 'Trainer',
            'jockey' => 'Jockey',
            'horse' => 'Horse',
            'age-of-horse' => 'Age Of Horse',
            'race-category' => 'Race Category',
            'race-class' => 'Race Class',
        ],
    ];

    /**
     * @var array
     */
    private $goingTypes = [
        'F' => 'Firm',
        'FT' => 'Fast',
        'FZ' => 'Frozen',
        'G' => 'Good',
        'GF' => 'Good To Firm',
        'GS' => 'Good To Soft',
        'GY' => 'Good To Yielding',
        'HD' => 'Hard',
        'HO' => 'Holding',
        'HY' => 'Heavy',
        'MY' => 'Muddy',
        'S' => 'Soft',
        'SD' => 'Standard',
        'SF' => 'Standard To Fast',
        'SH' => 'Soft To Heavy',
        'SN' => 'Sand',
        'SS' => 'Standard To Slow',
        'SW' => 'Slow',
        'SY' => 'Sloppy',
        'VS' => 'Very Soft',
        'Y' => 'Yielding',
        'YS' => 'Yielding To Soft',
    ];
    private $countryCodesMap = [
        'A' => ['GB'],
        'C' => ['GB'],
        'D' => ['GB'],
        'E' => ['IRE'],
        'F' => ['GB', 'IRE'],
        'I' => ['IRE'],
        'J' => ['GB'],
        'K' => ['GB'],
        'L' => ['GB'],
        'M' => ['IRE'],
        'N' => ['IRE'],
        'P' => ['GB'],
        'S' => ['GB'],
        'T' => ['GB'],
        'W' => ['IRE'],
        'H' => ['HK'],
    ];

    /**
     * @param $key
     *
     * @return string
     * @throws \Exception
     */
    public function getGoing($key)
    {
        if (!isset($this->goingTypes[$key])) {
            throw new \Exception('Wrong going type key');
        }

        return $this->goingTypes[$key];
    }

    /**
     *
     * @return string
     * @throws \Exception
     */
    public function getGoingKeys()
    {
        return array_keys($this->goingTypes);
    }

    /**
     * @param \Models\Bo\Selectors\Distance $distance
     */
    public function setDistance(\Models\Bo\Selectors\Distance $distance)
    {
        $this->distance = $distance;
    }

    /**
     * @return \Models\Bo\Selectors\Distance
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * @return \Models\Bo\Selectors\Database
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @param \Models\Bo\Selectors\Database $db
     */
    public function setDb($db)
    {
        $this->db = $db;
    }

    /**
     * @param string $entity (trainer|jockey|owner|sire|horse)
     *
     * @return mixed
     * @throws \Exception
     */
    public function getSeasonDefaultTypeCodes($entity)
    {
        $codes = [];
        $getSeasonDefaultTypeCodes = function ($item, $key) use (&$getSeasonDefaultTypeCodes, &$codes, $entity) {
            if (is_array($item)) {
                if (isset($item['isDefaultSeason']) && in_array($entity, $item['isDefaultSeason'])) {
                    $codes[] = $item['code'];
                } else {
                    array_walk($item, $getSeasonDefaultTypeCodes);
                }
            }
        };

        array_walk($this->seasonTypeMap, $getSeasonDefaultTypeCodes);

        if (empty($codes)) {
            throw new \Exception('Wrong seasonal statistic key');
        }

        return $codes;
    }

    /**
     * @param string $entity (trainer|jockey|owner|sire|horse)
     *
     * @return array
     * @throws \Exception
     */
    public function getAvailableSeasonTypeCodes($entity)
    {
        $codes = [];
        $getSeasonDefaultTypeCodes = function ($item) use (&$getSeasonDefaultTypeCodes, &$codes, $entity) {
            if (is_array($item)) {
                if (isset($item['inSeasonalStatistics']) && in_array($entity, $item['inSeasonalStatistics'])) {
                    $codes[] = $item['code'];
                } else {
                    array_walk($item, $getSeasonDefaultTypeCodes);
                }
            }
        };

        array_walk($this->seasonTypeMap, $getSeasonDefaultTypeCodes);

        if (empty($codes)) {
            throw new \Exception('Wrong seasonal statistic key');
        }

        return $codes;
    }

    /**
     * Get categories for conditions in ss_stal_proj table
     *
     * @param      $country
     * @param      $raceType
     * @param null $surface
     * @param null $championship
     *
     * @return string
     * @throws \Exception
     */
    public function getSiresCategories($country, $raceType, $surface = null, $championship = null)
    {
        $choice = $this->getSeasonTypeMapSection($country, $raceType, $surface, $championship);
        if (!isset($choice['categories'])) {
            throw new \Exception('Wrong season type key');
        }

        return $choice['categories'];
    }

    /**
     * @param $key
     *
     * @return mixed
     * @throws \Exception
     */
    public function getSurface($key)
    {
        if (!isset($this->surfaces[$key])) {
            throw new \Exception('Wrong surface');
        }

        return $this->surfaces[$key];
    }

    /**
     * @return array
     */
    public function getSurfaces()
    {
        return array_keys($this->surfaces);
    }

    /**
     * @param $key
     *
     * @return mixed
     * @throws \Exception
     */
    public function getChampionship($key)
    {
        if (!isset($this->championships[$key])) {
            throw new \Exception('Wrong championship');
        }

        return $this->championships[$key];
    }

    /**
     * @param $key
     *
     * @return mixed
     * @throws \Exception
     */
    public function getStatisticsTypeCode($key)
    {
        if (!isset($this->statisticsTypeCodes[$key])) {
            throw new \Exception('Wrong statisticsType');
        }

        return $this->statisticsTypeCodes[$key];
    }

    /**
     * @return array
     */
    public function getStatisticsTypeKeys()
    {
        return array_keys($this->statisticsTypeCodes);
    }

    /**
     * @param $key
     *
     * @return array
     * @throws \Exception
     */
    public function getStatisticsTypeCodeKeys($key)
    {
        if (!isset($this->statisticsTypeCodes[$key])) {
            throw new \Exception('Wrong key for statisticsType');
        }

        return array_keys($this->statisticsTypeCodes[$key]);
    }

    /**
     * @param string $country
     * @param string $raceType
     * @param string $surface
     * @param string $championship
     * @param bool   $strict
     *
     * @return char
     * @throws \Exception
     */
    public function getSeasonTypeCode($country, $raceType, $surface = null, $championship = null, $strict = false)
    {
        try {
            $choice = $this->getSeasonTypeMapSection($country, $raceType, $surface, $championship);
        } catch (\Exception $e) {
            if ($strict) {
                throw $e;
            }
            $choice = $this->getSeasonTypeMapSection('gb', Constants::RACE_TYPE_FLAT_ALIAS, null, null);
        }

        return $choice['code'];
    }

    /**
     * @param      $entity
     * @param      $country
     * @param      $raceType
     * @param null $surface
     * @param null $championship
     *
     * @return bool
     * @throws \Exception
     */
    public function isSeasonalStatisticsAvailable($entity, $country, $raceType, $surface = null, $championship = null)
    {
        $choice = $this->getSeasonTypeMapSection($country, $raceType, $surface, $championship);
        if (isset($choice['inSeasonalStatistics']) && in_array($entity, $choice['inSeasonalStatistics'])) {
            return true;
        }

        return false;
    }

    /**
     * @param $country
     * @param $raceType
     * @param $code
     * @param $championship
     *
     * @return mixed
     * @throws \Exception
     */
    private function getSeasonTypeMapSection($country, $raceType, $code, $championship)
    {
        if (($raceType = strtolower($raceType)) && isset($this->seasonTypeMap[$raceType])) {
            $choice = $this->seasonTypeMap[$raceType];
        } else {
            throw new \Exception('Wrong race type');
        }
        if ($code) {
            $code = strtolower($code);

            if (isset($choice[$code])) {
                $choice = $choice[$code];
            } else {
                throw new \Exception('Wrong code for specified race type');
            }
        }
        if ($championship) {
            $championship = strtolower($championship);

            if (isset($choice['championship'][$championship])) {
                $choice = $choice['championship'][$championship];
            } else {
                throw new \Exception('Wrong championship');
            }
        }
        if ($country) {
            $country = strtolower($country);

            if (isset($choice['countries'][$country])) {
                $choice = $choice['countries'][$country];
            } else {
                throw new \Exception('Wrong country');
            }
        }

        return $choice;
    }

    /**
     * race_type_code    race_type_desc
     * B NH Flat
     * C Chase Turf
     * F Flat Turf
     * H Hurdle Turf
     * P Point-To-Point
     * U Hunter Chase
     * W NH Flat AW
     * X Flat AW
     * Y Hurdle AW
     * Z Chase AW
     * What is NH?
     * OK so NH  is National Hunt which means that although this is a Flat Race (i.e race type code = B)
     * is comes under the rules / category of Jumps (and not Flat)
     * Then  there are different codes for the surface used i.e C = a race over chase fences on turf whereas Z is a
     * race over chase fences on an all-weather surface I.e not grass / turf) -- Both C & Z
     * come under  'Jumps' type of races
     *
     * @param      $key
     * @param null $type
     *
     * @return mixed
     * @throws \Exception
     */
    public function getRaceTypeCode($key, $type = null)
    {
        $key = strtolower($key);
        if ($type) {
            $type = strtolower($type);
        }

        if (!isset($this->raceTypeCodes[$key]) || (isset($type) && !isset($this->raceTypeCodes[$key][$type]))) {
            throw new \Exception('Wrong race type code, surface or jumps code');
        }

        $allRaceTypeCodes = $this->raceTypeCodes[$key];
        $raceTypeCodes = [];
        if (isset($type)) {
            $raceTypeCodes = $allRaceTypeCodes[$type];
        } else {
            array_walk_recursive(
                $allRaceTypeCodes,
                function ($e, $i) use (&$raceTypeCodes) {
                    $raceTypeCodes[] = $e;
                }
            );
        }

        return $raceTypeCodes;
    }

    /**
     * @param $code
     *
     * @return int|string
     */
    public function getRaceTypeByRaceTypeCode($code)
    {
        if (strpos(Constants::SEASON_TYPE_CODE_JUMPS . Constants::SEASON_TYPE_CODE_JUMPS_IRE, $code) !== false) {
            return Constants::RACE_TYPE_JUMPS_ALIAS;
        }

        foreach ($this->raceTypeCodes as $raceType => $raceTypeCodes) {
            foreach ($raceTypeCodes as $type => $codes) {
                if (in_array($code, $codes, true)) {
                    return $raceType;
                }
            }
        }

        return Constants::RACE_TYPE_FLAT_ALIAS;
    }

    /**
     * @return array
     */
    public function getGroupedRaceTypeCodes()
    {
        $flat = array_merge(
            $this->raceTypeCodes['flat']['turf'],
            $this->raceTypeCodes['flat']['aw']
        );
        $jumps = array_merge(
            $this->raceTypeCodes['jumps']['hurdle'],
            $this->raceTypeCodes['jumps']['chase'],
            $this->raceTypeCodes['jumps']['nhf']
        );

        return [
            Constants::RACE_TYPE_FLAT_ALIAS => $flat,
            Constants::RACE_TYPE_JUMPS_ALIAS => $jumps
        ];
    }

    /**
     * @param $key
     *
     * @return mixed
     * @throws \Exception
     */
    public function getRaceType($key)
    {
        if (!isset($this->raceTypes[$key])) {
            throw new \Exception('Wrong race type');
        }

        return $this->raceTypes[$key];
    }

    /**
     * @return array
     */
    public function getRaceTypeKeys()
    {
        return array_keys($this->raceTypes);
    }

    /**
     * @param $key
     *
     * @return mixed
     * @throws \Exception
     */
    public function getDistanceGroup($key)
    {
        return $this->distance->getDistanceGroup($key);
    }

    /**
     * @param $raceType
     *
     * @return mixed
     * @throws \Exception
     */
    public function getDistanceByRaceType($raceType)
    {
        return $this->distance->getDistanceByRaceType($raceType);
    }

    /**
     * @param string $type
     *
     * @return array
     * @throws \Exception
     */
    public function getJumpsTypeCodes($type)
    {
        return $this->getRaceTypeCode(Constants::RACE_TYPE_JUMPS_ALIAS, $type);
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getJumpsTypeCodesKeys()
    {
        return $this->getRaceTypeCode(Constants::RACE_TYPE_JUMPS_ALIAS);
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getJumpsTypeKeys()
    {
        return array_keys($this->raceTypeCodes[Constants::RACE_TYPE_JUMPS_ALIAS]);
    }

    /**
     * @param $race_type_code
     *
     * @return string
     */
    public function getRaceTypeKey($race_type_code)
    {
        if (isset($race_type_code)) {
            return (strpos(Constants::RACE_TYPE_FLAT, $race_type_code) !== false)
                ? Constants::RACE_TYPE_FLAT_ALIAS
                : Constants::RACE_TYPE_JUMPS_ALIAS;
        } else {
            return null;
        }
    }

    /**
     * @return string
     */
    public function getRaceTypeByDate()
    {
        $currentMonth = date('n');
        // From Apr - Sep => flat
        if ($currentMonth >= 4 && $currentMonth <= 9) {
            return Constants::RACE_TYPE_FLAT_ALIAS;
        } else {
            return Constants::RACE_TYPE_JUMPS_ALIAS;
        }
    }

    /**
     * @param $raceTitle
     * @param $courseId
     * @param $endDate
     *
     * @return bool|string
     */
    public function getSearchDefaultStartDate($raceTitle, $courseId, $endDate)
    {
        if (!is_null($raceTitle)) {
            return self::MIN_DATE_RESULTS_SEARCH;
        } elseif (!is_null($courseId)) {
            $diff = 365;
        } else {
            $diff = 7;
        }

        return date('Y-m-d', strtotime('-' . $diff . ' day', strtotime($endDate)));
    }

    /**
     * @param $isFlatRace
     *
     * @return array
     */
    public function getRaceCardStatsGroups($isFlatRace)
    {
        if ($isFlatRace) {
            return [
                '2yo',
                '3yo',
                '4yo',
            ];
        } else {
            return [
                'chase',
                'hurdle',
                'nhf',
            ];
        }
    }

    /**
     * @param array $racesTypes
     *
     * @return string Meeting type MEETING_TYPE_FLAT | MEETING_TYPE_JUMPS | MEETING_TYPE_MIXED
     * @throws \Api\Exception\ValidationError
     * @throws \Exception
     */
    public function getMeetingTypeByRacesTypes($racesTypes)
    {
        if (empty($racesTypes) || !is_array($racesTypes)) {
            throw  new \InvalidArgumentException('Incorrect race types');
        }
        $isJumpsMeetingType = !empty(array_intersect(
            $this->getRaceTypeCode(Constants::RACE_TYPE_JUMPS_ALIAS),
            $racesTypes
        ));
        $isFlatMeetingType = !empty(array_intersect(
            $this->getRaceTypeCode(Constants::RACE_TYPE_FLAT_ALIAS),
            $racesTypes
        ));

        if (!$isFlatMeetingType && !$isJumpsMeetingType) {
            throw new \Api\Exception\ValidationError(21);
        }

        if ($isFlatMeetingType && $isJumpsMeetingType) {
            $meetingType = self::MEETING_TYPE_MIXED;
        } elseif ($isJumpsMeetingType) {
            $meetingType = self::MEETING_TYPE_JUMPS;
        } else {
            $meetingType = self::MEETING_TYPE_FLAT;
        }

        return $meetingType;
    }

    /**
     * @param $seasonTypeCode
     *
     * @return string
     */
    public function getRaceTypeBySeasonTypeCode($seasonTypeCode)
    {
        $getSeasonTypeCodes = function ($item, $key) use (&$getSeasonTypeCodes, &$codes) {
            if (is_array($item)) {
                if (isset($item['code'])) {
                    $codes[$item['code']] = $item['code'];
                }
                array_walk($item, $getSeasonTypeCodes);
            }
        };
        $codes = [];
        $raceType = Constants::RACE_TYPE_FLAT_ALIAS;
        array_walk($this->seasonTypeMap[$raceType], $getSeasonTypeCodes);
        if (!in_array($seasonTypeCode, $codes, true)) {
            $codes = [];
            $raceType = Constants::RACE_TYPE_JUMPS_ALIAS;
            array_walk($this->seasonTypeMap[$raceType], $getSeasonTypeCodes);
            if (!in_array($seasonTypeCode, $codes, true)) {
                throw new \InvalidArgumentException("The season type code '{$seasonTypeCode}' does not confirm any race type code");
            }
        }

        return $raceType;
    }

    /**
     * @param string $seasonTypeCode
     *
     * @return string[]
     */
    public function getCountryCodesBySeasonType($seasonTypeCode)
    {
        if (!is_string($seasonTypeCode) || !array_key_exists($seasonTypeCode, $this->countryCodesMap)) {
            $ret = [];
        } else {
            $ret = $this->countryCodesMap[$seasonTypeCode];
        }

        return $ret;
    }

    /**
     * @param string $date_of_birth
     * @param string $country_code
     * @param string $to_date
     *
     * @return string
     */
    public function getHorseAgeSQL($date_of_birth, $country_code, $to_date = '')
    {
        // We need the date as a string without single quotes to check it against the current date
        $comparisonDate = trim($to_date, "'");

        if (strlen($to_date) < 1 || strtotime($comparisonDate) > $this->getCurrentTime()) {
            $to_date = 'getdate()';
        }

        $ageSql = 'datediff(year, %1$s, %2$s) - (
                        CASE WHEN (%3$s IN (\'AUS\', \'NZ\', \'SAF\', \'ZIM\', \'NDO\') AND datepart(mm, %2$s) < 8)
                            OR
                            (%3$s IN (\'ARG\', \'BRZ\', \'CHI\', \'COL\', \'ECU\', \'PER\', \'URU\', \'VEN\', \'FI\') AND datepart(mm, %2$s) < 7)
                        THEN 1
                        ELSE 0 END
                    )';

        return sprintf($ageSql, $date_of_birth, $to_date, $country_code);
    }

    /**
     * We create this function to be able to mock the time in the unit tests.
     *
     * @return int
     */
    protected function getCurrentTime()
    {
        return time();
    }

    /**
     * @param $race_group_uid
     * @param $race_type_code
     * @param $prize_sterling
     *
     * @return string
     */
    public function getBigRaceSql($race_group_uid, $race_type_code, $prize_sterling)
    {
        return "(
            $race_group_uid IN (1, 2, 3, 7, 8, 9, 11, 12, 13, 14, 15, 16)
            OR ($race_type_code = 'F' AND $prize_sterling >= 60000.00)
            OR ($race_type_code = 'J' AND $prize_sterling >= 40000.00)
        )";
    }

    /**
     * @codeCoverageIgnore
     *
     * @param string $dateField
     *
     * @return string
     */
    public function getCurrencySqlCriteria($dateField = 'bs.sale_date')
    {
        return "CASE
            WHEN v.currency_code = 'EUR' AND YEAR($dateField) < 2002
            THEN CASE
                WHEN v.country_flag = 'I' AND YEAR($dateField) < 2001 THEN 'IRP'
                ELSE CASE
                    WHEN v.country_flag = 'I' THEN 'IRG'
                    WHEN v.country_flag = 'F' THEN 'FFR'
                    WHEN v.country_flag = 'G' THEN 'DM'
                    WHEN v.country_flag = 'Y' THEN 'ITY'
                    WHEN v.country_flag = 'S' THEN 'ESP'
                END
            END
            ELSE CASE
                WHEN v.currency_code = 'GNS' THEN 'GBG'
                ELSE v.currency_code
            END
        END";
    }

    /**
     * @codeCoverageIgnore
     *
     * @param string $dateField
     *
     * @return string
     */
    public function getCurrencySqlField($dateField = 'bs.sale_date')
    {
        return "CASE
            WHEN v.currency_code = 'EUR' AND YEAR($dateField) < 2002
                THEN CASE
                    WHEN v.country_flag = 'I' AND YEAR($dateField) < 2001 THEN 'IRP'
                    ELSE CASE
                        WHEN v.country_flag = 'I' THEN 'IRG'
                        WHEN v.country_flag = 'F' THEN 'FFR'
                        WHEN v.country_flag = 'G' THEN 'DM'
                        WHEN v.country_flag = 'Y' THEN 'ITY'
                        WHEN v.country_flag = 'S' THEN 'ESP'
                    END
                END
            ELSE
                v.currency_code
            END";
    }

    /**
     * @return string
     */
    public function getSqlForStake()
    {
        return "SUM(CASE
                    WHEN hr.final_race_outcome_uid IN (1, 71) THEN
                        CASE
                            WHEN hr.final_race_outcome_uid = 71 THEN
                                (odds.odds_value / 2) - 0.50
                            ELSE
                                odds.odds_value
                        END
                    ELSE
                        -1
                END
            )";
    }

    /**
     * The method intends to purge query from unnecessary comments. The lines that contain $prefix will be uncommented,
     * and all other lines with comments will be removed
     *
     * @param $query
     * @param $prefix
     *
     * @return string A pure query
     */
    public static function purgeQuery($query, $prefix)
    {
        //if $prefix is array - next expression nothing to change, otherwise - we cast it to an array, so
        //we can traverse across it
        $prefixes = (array)$prefix;
        foreach ($prefixes as $prefix) {
            $search = '--' . $prefix . '>>';
            $query = str_replace($search, '', $query);
        }

        $query = preg_replace("/--[^\n]+\n/m", "", $query);

        return $query;
    }

    /**
     * Returns array or Race Type SubGroup values
     *
     * @param string $raceType
     *
     * @return array
     */
    public function getRaceTypeSubGroup(string $raceType): array
    {
        $raceGroup = $this->getRaceTypeByRaceTypeCode($raceType);
        if ($raceGroup == Constants::RACE_TYPE_JUMPS_ALIAS) {
            return $this->raceTypeCodes[$raceGroup][$this->getRaceTypeGroupNameByRaceType($raceType)];
        } elseif ($raceGroup == Constants::RACE_TYPE_FLAT_ALIAS) {
            return [
                $this->raceTypeCodes[$raceGroup]['turf'][0],
                $this->raceTypeCodes[$raceGroup]['aw'][0]
            ];
        } else {
            return [
                $this->raceTypeCodes[$raceGroup]['p2p'][0]
            ];
        }
    }

    /**
     * Returns Race Type SubGroup names for Jump ('hurdle', 'chase' or 'nhf') and 'flat' for Flat
     *
     * @param string $raceType
     *
     * @return string
     */
    public function getRaceTypeGroupNameByRaceType(string $raceType): string
    {
        foreach ($this->raceTypeCodes as $raceTypeGroup => $groups) {
            foreach ($groups as $raceTypeSubGroup => $codes) {
                if (in_array($raceType, $codes) && $raceTypeGroup == Constants::RACE_TYPE_FLAT_ALIAS) {
                    return $raceTypeGroup;
                }
                if (in_array($raceType, $codes) && $raceTypeGroup == Constants::RACE_TYPE_JUMPS_ALIAS) {
                    return $raceTypeSubGroup;
                }
            }
        }

        return 'Unknown';
    }
}
