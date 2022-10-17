<?php

namespace Tests\Stubs\Models;

class Course extends \Models\Course
{
    use StubDataGetter;

    protected static $_stubData = [
        'courses' =>[
            1079 => [
                'course_uid' => 1079,
                'course_name' => 'KEMPTON (A.W)',
                'address_uid' => null,
                'country_code' => 'GB',
                'course_code' => 'KEMW',
                'mirror_code' => 'KM',
                'weatherbys_uid' => null,
                'irb_code' => null,
                'course_type_code' => 'X',
                'direction_flag' => 'R',
                'mnemonic' => 'KEW',
                'timestamp' => null,
                'rp_abbrev_3' => 'KEM',
                'rp_x_coord' => 511,
                'rp_y_coord' => 170,
                'rp_abbrev_4' => 'Kemp',
                'style_name' => null,
                'latitude' => 51.417743,
                'longitude' => -0.406065,
                'zoom' => 16
            ],
            513 => [
                'course_uid' => 513,
                'course_name' => 'WOLVERHAMPTON (A.W)',
                'address_uid' => null,
                'country_code' => 'GB',
                'course_code' => 'WOLW',
                'mirror_code' => 'WO',
                'weatherbys_uid' => null,
                'irb_code' => null,
                'course_type_code' => 'X',
                'direction_flag' => 'L',
                'mnemonic' => 'WOW',
                'timestamp' => null,
                'rp_abbrev_3' => 'WOL',
                'rp_x_coord' => 391,
                'rp_y_coord' => 298,
                'rp_abbrev_4' => 'Wolv',
                'style_name' => null,
                'latitude' => 52.604012,
                'longitude' => -2.144823,
                'zoom' => 15
            ],
            37 => [
                'course_uid' => 37,
                'course_name' => 'NEWCASTLE',
                'address_uid' => null,
                'country_code' => 'GB',
                'course_code' => 'NEWC',
                'mirror_code' => 'NC',
                'weatherbys_uid' => null,
                'irb_code' => null,
                'course_type_code' => 'B',
                'direction_flag' => 'L',
                'mnemonic' => 'NEC',
                'timestamp' => null,
                'rp_abbrev_3' => 'NCS',
                'rp_x_coord' => 424,
                'rp_y_coord' => 564,
                'rp_abbrev_4' => 'Newc',
                'style_name' => null,
                'latitude' => 55.033483,
                'longitude' => -1.613102,
                'zoom' => 14
            ]
        ]
    ];

    /**
     * @param int $horseUid
     * @return array
     */
    public function getByCourseUid($courseUid)
    {
        return \Phalcon\Mvc\Model\Row\General::createFromArray(self::getStubData('courses')[$courseUid]);
    }
}
