<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 2/29/2016
 * Time: 2:33 PM
 */

namespace Tests\Stubs\Models\Bo\LookupTable;

class AdditionalCourseInfo extends \Tests\Stubs\Models\CourseType
{
    /**
     * @return array
     */
    public function getAdditionalCourseInfoTable($straight_round_jubilee_code = null)
    {

        $data = [
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
        ];

        if (!empty($straight_round_jubilee_code)) {
            $key = strtoupper($straight_round_jubilee_code);
            return [$key => $data[$key]];
        } else {
            return $data;
        }
    }
}
