<?php

namespace Tests\Stubs\DataProvider\Bo;

use Phalcon\Mvc\Model\Row\General as GeneralRow;

/**
 * Class VideoProviders
 *
 * @package Tests\Stubs\DataProvider\Bo
 */
class VideoProviders extends \Api\DataProvider\Bo\VideoProviders
{
    /**
     * @param array $raceIDs
     *
     * @return array
     *
     * @codeCoverageIgnore
     */
    public function getDetails($raceIDs)
    {
        $key = md5(implode('_', $raceIDs));
        $data = [
            '07a374df00446fdcbe7c17a005922d12' => array(
                537772 =>
                    array(
                        0 =>
                            GeneralRow::createFromArray(array(
                                'race_instance_uid' => 537772,
                                'ptv_video_id' => 1803205,
                                'video_provider' => 'ATR',
                                'complete_race_uid' => 1803205,
                                'complete_race_start' => 2747,
                                'complete_race_end' => 2954,
                                'finish_race_uid' => 1803207,
                                'finish_race_start' => 2910,
                                'finish_race_end' => 2954,
                            )),
                    ),
                593973 =>
                    array(
                        0 =>
                            GeneralRow::createFromArray(array(
                                'race_instance_uid' => 593973,
                                'ptv_video_id' => 1803205,
                                'video_provider' => 'RUK',
                                'complete_race_uid' => 2340580,
                                'complete_race_start' => 352,
                                'complete_race_end' => 695,
                                'finish_race_uid' => 2340581,
                                'finish_race_start' => 415,
                                'finish_race_end' => 467,
                            )),
                    ),
                595296 =>
                    array(
                        0 =>
                            GeneralRow::createFromArray(array(
                                'race_instance_uid' => 595296,
                                'ptv_video_id' => 40979,
                                'video_provider' => 'ATR',
                                'complete_race_uid' => 2340580,
                                'complete_race_start' => 0,
                                'complete_race_end' => 1,
                                'finish_race_uid' => 40979,
                                'finish_race_start' => 0,
                                'finish_race_end' => 1,
                            )),
                    ),
            ),
            'd6d01b84d74cd33ccb4b2bbc3be790fd' => array(
                659318 =>
                    array(
                        0 =>
                            GeneralRow::createFromArray(array(
                                'race_instance_uid' => 659318,
                                'ptv_video_id' => 151586,
                                'video_provider' => 'ATR',
                                'complete_race_uid' => 151586,
                                'complete_race_start' => 0,
                                'complete_race_end' => 1,
                                'finish_race_uid' => 151586,
                                'finish_race_start' => 0,
                                'finish_race_end' => 1,
                            )),
                    ),
            ),
            'dea509c1471b2b240f1b94530941a484' => array(
                646612 =>
                    array(
                        0 =>
                            GeneralRow::createFromArray(array(
                                'race_instance_uid' => 646612,
                                'ptv_video_id' => 1121573,
                                'video_provider' => 'RUK',
                                'complete_race_uid' => 2590473,
                                'complete_race_start' => 308,
                                'complete_race_end' => 717,
                                'finish_race_uid' => 2590474,
                                'finish_race_start' => 608,
                                'finish_race_end' => 663,
                            )),
                    ),
                668478 =>
                    array(
                        0 =>
                            GeneralRow::createFromArray(array(
                                'race_instance_uid' => 668478,
                                'ptv_video_id' => 185545,
                                'video_provider' => 'ATR',
                                'complete_race_uid' => 248,
                                'complete_race_start' => 0,
                                'complete_race_end' => 1,
                                'finish_race_uid' => 248,
                                'finish_race_start' => 0,
                                'finish_race_end' => 1,
                            )),
                    ),
            ),
            '174882033225436b1440b7de44686450' => array(
                684858 =>
                    array(
                        0 =>
                            GeneralRow::createFromArray(array(
                                'race_instance_uid' => 684858,
                                'ptv_video_id' => 1309809,
                                'video_provider' => 'RUK',
                                'complete_race_uid' => 2722291,
                                'complete_race_start' => 316,
                                'complete_race_end' => 756,
                                'finish_race_uid' => 2722248,
                                'finish_race_start' => 511,
                                'finish_race_end' => 575,
                            )),
                    ),
                684860 =>
                    array(
                        0 =>
                            GeneralRow::createFromArray(array(
                                'race_instance_uid' => 684860,
                                'ptv_video_id' => 1309813,
                                'video_provider' => 'RUK',
                                'complete_race_uid' => 2722314,
                                'complete_race_start' => 344,
                                'complete_race_end' => 598,
                                'finish_race_uid' => 2722315,
                                'finish_race_start' => 536,
                                'finish_race_end' => 598,
                            )),
                    ),
            ),
            '82bdc74364091e6e71e1b71128e7306f' => array(
                684474 =>
                    array(
                        0 =>
                            GeneralRow::createFromArray(array(
                                'race_instance_uid' => 684474,
                                'ptv_video_id' => 247149,
                                'video_provider' => 'ATR',
                                'complete_race_uid' => 248,
                                'complete_race_start' => 0,
                                'complete_race_end' => 1,
                                'finish_race_uid' => 248,
                                'finish_race_start' => 0,
                                'finish_race_end' => 1,
                            )),
                    ),
                686289 =>
                    array(
                        0 =>
                            GeneralRow::createFromArray(array(
                                'race_instance_uid' => 686289,
                                'ptv_video_id' => 246823,
                                'video_provider' => 'ATR',
                                'complete_race_uid' => 248,
                                'complete_race_start' => 0,
                                'complete_race_end' => 1,
                                'finish_race_uid' => 248,
                                'finish_race_start' => 0,
                                'finish_race_end' => 1,
                            )),
                    ),
            ),
            '78dfe44a0dd283c9150419dec734d63a' => array(
                667040 =>
                    array(
                        0 =>
                            GeneralRow::createFromArray(array(
                                'race_instance_uid' => 667040,
                                'ptv_video_id' => 177336,
                                'video_provider' => 'ATR',
                                'complete_race_uid' => 248,
                                'complete_race_start' => 0,
                                'complete_race_end' => 1,
                                'finish_race_uid' => 248,
                                'finish_race_start' => 0,
                                'finish_race_end' => 1,
                            )),
                    ),
                669615 =>
                    array(
                        0 =>
                            GeneralRow::createFromArray(array(
                                'race_instance_uid' => 669615,
                                'ptv_video_id' => 184110,
                                'video_provider' => 'ATR',
                                'complete_race_uid' => 248,
                                'complete_race_start' => 0,
                                'complete_race_end' => 1,
                                'finish_race_uid' => 248,
                                'finish_race_start' => 0,
                                'finish_race_end' => 1,
                            )),
                    ),
            ),
            'e95b28eed1f7be20869c7e2b49b8856d' => array(
                684818 =>
                    array(
                        0 =>
                            GeneralRow::createFromArray(array(
                                'race_instance_uid' => 684818,
                                'ptv_video_id' => 248363,
                                'video_provider' => 'ATR',
                                'complete_race_uid' => 248363,
                                'complete_race_start' => 0,
                                'complete_race_end' => 1,
                                'finish_race_uid' => 248363,
                                'finish_race_start' => 0,
                                'finish_race_end' => 1,
                            )),
                    ),
            ),
            'a8527d487c33870a508e6b6dcd4be1e8' => array(
                650030 =>
                    array(
                        0 =>
                            GeneralRow::createFromArray(array(
                                'race_instance_uid' => 650030,
                                'ptv_video_id' => 1136577,
                                'video_provider' => 'RUK',
                                'complete_race_uid' => 2601911,
                                'complete_race_start' => 402,
                                'complete_race_end' => 536,
                                'finish_race_uid' => 2601912,
                                'finish_race_start' => 425,
                                'finish_race_end' => 484,
                            )),
                    ),
                654428 =>
                    array(
                        0 =>
                            GeneralRow::createFromArray(array(
                                'race_instance_uid' => 654428,
                                'ptv_video_id' => 1155363,
                                'video_provider' => 'RUK',
                                'complete_race_uid' => 2616033,
                                'complete_race_start' => 351,
                                'complete_race_end' => 464,
                                'finish_race_uid' => 2616034,
                                'finish_race_start' => 409,
                                'finish_race_end' => 464,
                            )),
                    ),
            ),
            '07cd606129db7d4163f8dfa0cbae0930' => array(
                627834 =>
                    array(
                        0 =>
                            GeneralRow::createFromArray(array(
                                'race_instance_uid' => 627834,
                                'ptv_video_id' => 1043559,
                                'video_provider' => 'RUK',
                                'complete_race_uid' => 2529151,
                                'complete_race_start' => 479,
                                'complete_race_end' => 776,
                                'finish_race_uid' => 2529152,
                                'finish_race_start' => 590,
                                'finish_race_end' => 701,
                            )),
                    ),
                631698 =>
                    array(
                        0 =>
                            GeneralRow::createFromArray(array(
                                'race_instance_uid' => 631698,
                                'ptv_video_id' => 1068617,
                                'video_provider' => 'RUK',
                                'complete_race_uid' => 2548248,
                                'complete_race_start' => 566,
                                'complete_race_end' => 794,
                                'finish_race_uid' => 2548250,
                                'finish_race_start' => 652,
                                'finish_race_end' => 713,
                            )),
                    ),
            ),
            '563f6d34fa01e8c6a89d087a4191308d' => array(
                647800 =>
                    array(
                        0 =>
                            GeneralRow::createFromArray(array(
                                'race_instance_uid' => 647800,
                                'ptv_video_id' => 1126993,
                                'video_provider' => 'RUK',
                                'complete_race_uid' => 2594970,
                                'complete_race_start' => 316,
                                'complete_race_end' => 555,
                                'finish_race_uid' => 2594971,
                                'finish_race_start' => 389,
                                'finish_race_end' => 440,
                            )),
                    ),
                649705 =>
                    array(
                        0 =>
                            GeneralRow::createFromArray(array(
                                'race_instance_uid' => 649705,
                                'ptv_video_id' => 1124581,
                                'video_provider' => 'RUK',
                                'complete_race_uid' => 2593347,
                                'complete_race_start' => 506,
                                'complete_race_end' => 700,
                                'finish_race_uid' => 2593368,
                                'finish_race_start' => 572,
                                'finish_race_end' => 631,
                            )),
                    ),
            ),
            '972f496c2eb3c242e7410eb5e61d3ed2' => array(
                640767 =>
                    array(
                        0 =>
                            GeneralRow::createFromArray(array(
                                'race_instance_uid' => 640767,
                                'ptv_video_id' => 90252,
                                'video_provider' => 'ATR',
                                'complete_race_uid' => 90252,
                                'complete_race_start' => 0,
                                'complete_race_end' => 1,
                                'finish_race_uid' => 90252,
                                'finish_race_start' => 0,
                                'finish_race_end' => 1,
                            )),
                    ),
                641118 =>
                    array(
                        0 =>
                            GeneralRow::createFromArray(array(
                                'race_instance_uid' => 641118,
                                'ptv_video_id' => 91020,
                                'video_provider' => 'ATR',
                                'complete_race_uid' => 91020,
                                'complete_race_start' => 0,
                                'complete_race_end' => 1,
                                'finish_race_uid' => 91020,
                                'finish_race_start' => 0,
                                'finish_race_end' => 1,
                            )),
                    ),
            ),
            '8e090d316df4421e420211a582215164' => array(
                599697 =>
                    array(
                        0 =>
                            GeneralRow::createFromArray(array(
                                'race_instance_uid' => 599697,
                                'ptv_video_id' => 42532,
                                'video_provider' => 'ATR',
                                'complete_race_uid' => 42532,
                                'complete_race_start' => 0,
                                'complete_race_end' => 1,
                                'finish_race_uid' => 42532,
                                'finish_race_start' => 0,
                                'finish_race_end' => 1,
                            )),
                    ),
            ),
            '644146998f42dba7899985eef172d5bf' => [],
            '7ed57028b5858fb45d96908977e73247' => [],
            '202cb962ac59075b964b07152d234b70' => array(
                123 =>
                    array(
                        0 =>
                            GeneralRow::createFromArray(array(
                                'race_instance_uid' => 123,
                                'ptv_video_id' => 42532,
                                'video_provider' => 'ATR',
                                'complete_race_uid' => 42532,
                                'complete_race_start' => 0,
                                'complete_race_end' => 1,
                                'finish_race_uid' => 42532,
                                'finish_race_start' => 0,
                                'finish_race_end' => 1,
                            )),
                    ),
            ),
            'c329c23e6d498fe85ac7c62a0459b2ba' => array(
                123 =>
                    array(
                        0 =>
                            GeneralRow::createFromArray(array(
                                'race_instance_uid' => 123,
                                'ptv_video_id' => 177336,
                                'video_provider' => 'ATR',
                                'complete_race_uid' => 248,
                                'complete_race_start' => 0,
                                'complete_race_end' => 1,
                                'finish_race_uid' => 248,
                                'finish_race_start' => 0,
                                'finish_race_end' => 1,
                            )),
                        1 =>
                            GeneralRow::createFromArray(array(
                                'race_instance_uid' => 123,
                                'ptv_video_id' => 42532,
                                'video_provider' => 'RUK',
                                'complete_race_uid' => 42532,
                                'complete_race_start' => 1253,
                                'complete_race_end' => 356,
                                'finish_race_uid' => 42532,
                                'finish_race_start' => 4565,
                                'finish_race_end' => 36,
                            )),
                    ),
                456 =>
                    array(
                        0 =>
                            GeneralRow::createFromArray(array(
                                'race_instance_uid' => 456,
                                'ptv_video_id' => 184110,
                                'video_provider' => 'ATR',
                                'complete_race_uid' => 248,
                                'complete_race_start' => 0,
                                'complete_race_end' => 1,
                                'finish_race_uid' => 248,
                                'finish_race_start' => 0,
                                'finish_race_end' => 1,
                            )),
                    ),
            ),
            '68053af2923e00204c3ca7c6a3150cf7' => [],
            'b9986c7d44c4fdea2f0c07db3170411b' => [
                536417 =>
                    [
                        0 =>
                            GeneralRow::createFromArray([
                                'race_instance_uid' => 536417,
                                'ptv_video_id' => 24549,
                                'video_provider' => 'ATR',
                                'complete_race_uid' => 1803061,
                                'complete_race_start' => 2713,
                                'complete_race_end' => 2941,
                                'finish_race_uid' => 1803063,
                                'finish_race_start' => 2898,
                                'finish_race_end' => 2941,
                            ]),
                    ],
            ],
            '5c8d37e65399bc4aaaba9e4ce0c79e4d' => [
                688527 =>
                    [
                        0 =>
                            GeneralRow::createFromArray([
                                'race_instance_uid' => 688527,
                                'ptv_video_id' => 1323495,
                                'video_provider' => 'RUK',
                                'complete_race_uid' => 2732276,
                                'complete_race_start' => 322,
                                'complete_race_end' => 893,
                                'finish_race_uid' => 2732263,
                                'finish_race_start' => 522,
                                'finish_race_end' => 583,
                            ]),
                    ],
            ]
        ];

        return $data[$key];
    }
}
