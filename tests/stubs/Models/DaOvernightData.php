<?php

namespace Tests\Stubs\Models;

use Phalcon\Mvc\Model\Exception as Exception;
use Phalcon\Mvc\Model as Model;

class DaOvernightData extends \Models\RaceInstance
{
    use StubDataGetter;

    protected static $_stubData = [
        'runnersData' => [
            599203 => array(
                0 => array(
                        'horse_uid' => 857784,
                        'horse_name' => 'Stormfly',
                        'sequence' => 1,
                        'draw' => 1,
                        'y_norm_length' => 2.1000000000000001,
                        'y_norm_pound' => 4.8300000000000001,
                        'y_norm_going' => 3.4860000000000002,
                    ),
                1 => array(
                    'horse_uid' => 857781,
                    'horse_name' => 'Double Windsor',
                    'sequence' => 2,
                    'draw' => 2,
                    'y_norm_length' => 1.5,
                    'y_norm_pound' => 3.4500000000000002,
                    'y_norm_going' => 2.4900000000000002,
                ),
                2 => array(
                        'horse_uid' => 857783,
                        'horse_name' => 'Sors',
                        'sequence' => 3,
                        'draw' => 3,
                        'y_norm_length' => 0.90000000000000002,
                        'y_norm_pound' => 2.0699999999999998,
                        'y_norm_going' => 1.494,
                    ),
                3 => array(
                        'horse_uid' => 856813,
                        'horse_name' => 'Alainn',
                        'sequence' => 4,
                        'draw' => 4,
                        'y_norm_length' => 0.29999999999999999,
                        'y_norm_pound' => 0.68999999999999995,
                        'y_norm_going' => 0.498,
                    ),
                4 => array(
                        'horse_uid' => 857780,
                        'horse_name' => 'Alp D\'Huez',
                        'sequence' => 5,
                        'draw' => 5,
                        'y_norm_length' => -0.29999999999999999,
                        'y_norm_pound' => -0.68999999999999995,
                        'y_norm_going' => -0.498,
                    ),
                5 => array(
                        'horse_uid' => 857702,
                        'horse_name' => 'Ellenvelyn',
                        'sequence' => 6,
                        'draw' => 6,
                        'y_norm_length' => -0.90000000000000002,
                        'y_norm_pound' => -2.0699999999999998,
                        'y_norm_going' => -1.494,
                    ),
                6 => array(
                        'horse_uid' => 857782,
                        'horse_name' => 'Lastdanceforme',
                        'sequence' => 7,
                        'draw' => 7,
                        'y_norm_length' => -1.5,
                        'y_norm_pound' => -3.4500000000000002,
                        'y_norm_going' => -2.4900000000000002,
                    ),
                7 => array(
                        'horse_uid' => 856816,
                        'horse_name' => 'Bwana',
                        'sequence' => 8,
                        'draw' => 8,
                        'y_norm_length' => -2.1000000000000001,
                        'y_norm_pound' => -4.8300000000000001,
                        'y_norm_going' => -3.4860000000000002,
                    ),
            ),
            599206 => array(
                0 => array(
                        'horse_uid' => 680107,
                        'horse_name' => 'Beacon Lodge',
                        'sequence' => 1,
                        'draw' => 1,
                        'y_norm_length' => 2.3999999999999999,
                        'y_norm_pound' => 5.5199999999999996,
                        'y_norm_going' => 3.984,
                    ),
                1 => array(
                        'horse_uid' => 832972,
                        'horse_name' => 'Sun On The Run',
                        'sequence' => 2,
                        'draw' => 2,
                        'y_norm_length' => 1.8,
                        'y_norm_pound' => 4.1399999999999997,
                        'y_norm_going' => 2.988,
                    ),
                2 => array(
                        'horse_uid' => 787316,
                        'horse_name' => 'Srucahan',
                        'sequence' => 3,
                        'draw' => 3,
                        'y_norm_length' => 1.2,
                        'y_norm_pound' => 2.7599999999999998,
                        'y_norm_going' => 1.992,
                    ),
                3 => array(
                        'horse_uid' => 637281,
                        'horse_name' => 'Maundy Money',
                        'sequence' => 4,
                        'draw' => 4,
                        'y_norm_length' => 0.59999999999999998,
                        'y_norm_pound' => 1.3799999999999999,
                        'y_norm_going' => 0.996,
                    ),
                4 => array(
                        'horse_uid' => 785217,
                        'horse_name' => 'Caprella',
                        'sequence' => 5,
                        'draw' => 5,
                        'y_norm_length' => 0,
                        'y_norm_pound' => 0,
                        'y_norm_going' => 0,
                    ),
                5 => array(
                        'horse_uid' => 765704,
                        'horse_name' => 'Cash Or Casualty',
                        'sequence' => 6,
                        'draw' => 6,
                        'y_norm_length' => -0.59999999999999998,
                        'y_norm_pound' => -1.3799999999999999,
                        'y_norm_going' => -0.996,
                    ),
                6 => array(
                        'horse_uid' => 806737,
                        'horse_name' => 'Canary Row',
                        'sequence' => 7,
                        'draw' => 7,
                        'y_norm_length' => -1.2,
                        'y_norm_pound' => -2.7599999999999998,
                        'y_norm_going' => -1.992,
                    ),
                7 => array(
                        'horse_uid' => 812052,
                        'horse_name' => 'Ballyorban',
                        'sequence' => 8,
                        'draw' => 8,
                        'y_norm_length' => -1.8,
                        'y_norm_pound' => -4.1399999999999997,
                        'y_norm_going' => -2.988,
                    ),
                8 => array(
                        'horse_uid' => 753712,
                        'horse_name' => 'Flic Flac',
                        'sequence' => 9,
                        'draw' => 9,
                        'y_norm_length' => -2.3999999999999999,
                        'y_norm_pound' => -5.5199999999999996,
                        'y_norm_going' => -3.984,
                    ),
            ),
            599210 => array(
                0 => array(
                        'horse_uid' => 857790,
                        'horse_name' => 'Golden Sky',
                        'sequence' => 1,
                        'draw' => 1,
                        'y_norm_length' => 1.5,
                        'y_norm_pound' => 3.4500000000000002,
                        'y_norm_going' => 2.4900000000000002,
                    ),
                1 => array(
                        'horse_uid' => 849164,
                        'horse_name' => 'Ebeyina',
                        'sequence' => 2,
                        'draw' => 2,
                        'y_norm_length' => 0.90000000000000002,
                        'y_norm_pound' => 2.0699999999999998,
                        'y_norm_going' => 1.494,
                    ),
                2 => array(
                        'horse_uid' => 842615,
                        'horse_name' => 'Lovely Dancer',
                        'sequence' => 3,
                        'draw' => 3,
                        'y_norm_length' => 0.29999999999999999,
                        'y_norm_pound' => 0.68999999999999995,
                        'y_norm_going' => 0.498,
                    ),
                3 => array(
                        'horse_uid' => 838242,
                        'horse_name' => 'Committal',
                        'sequence' => 4,
                        'draw' => 4,
                        'y_norm_length' => -0.29999999999999999,
                        'y_norm_pound' => -0.68999999999999995,
                        'y_norm_going' => -0.498,
                    ),
                4 => array(
                        'horse_uid' => 840664,
                        'horse_name' => 'Upper Silesian',
                        'sequence' => 5,
                        'draw' => 5,
                        'y_norm_length' => -0.90000000000000002,
                        'y_norm_pound' => -2.0699999999999998,
                        'y_norm_going' => -1.494,
                    ),
                5 => array(
                        'horse_uid' => 856827,
                        'horse_name' => 'Magic Magnolia',
                        'sequence' => 6,
                        'draw' => 6,
                        'y_norm_length' => -1.5,
                        'y_norm_pound' => -3.4500000000000002,
                        'y_norm_going' => -2.4900000000000002,
                    ),
            )
        ]
    ];

    public function getRaceData($raceId)
    {

        if (!is_integer($raceId)) {
            throw new Exception('Set race ID before retrieving it');
        }

        if (!array_key_exists($raceId, self::getStubData('runnersData'))) {
            return false;
        }

        $res = [];

        foreach (self::getStubData('runnersData')[$raceId] as $rowData) {
            $res[] = \Phalcon\Mvc\Model\Row\General::createFromArray($rowData);
        }

        return $res;
    }
}
