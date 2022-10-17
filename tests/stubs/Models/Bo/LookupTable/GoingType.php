<?php

namespace Tests\Stubs\Models\Bo\LookupTable;

class GoingType extends \Tests\Stubs\Models\GoingType
{

    /**
     * @return array
     */
    public function getGoingTypeTable()
    {
        return [
            'F ' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'going_type_code' => 'F',
                    'going_type_desc' => 'Firm',
                    'going_band_uid' => 1,
                    'sporting_life_code' => 'F',
                    'services_desc' => 'Fm',
                    'rp_going_type_desc' => 'FIRM',
                    'rp_going_type_value' => 6
                ]
            ),
            'FT' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'going_type_code' => 'FT',
                    'going_type_desc' => 'Fast',
                    'going_band_uid' => 4,
                    'sporting_life_code' => 'A',
                    'services_desc' => 'Fs',
                    'rp_going_type_desc' => 'FAST',
                    'rp_going_type_value' => 10
                ]
            ),
            'FZ' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'going_type_code' => 'FZ',
                    'going_type_desc' => 'Frozen',
                    'going_band_uid' => 4,
                    'sporting_life_code' => 'R',
                    'services_desc' => 'F',
                    'rp_going_type_desc' => 'FROZEN',
                    'rp_going_type_value' => 1
                ]
            ),
            'G ' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'going_type_code' => 'G',
                    'going_type_desc' => 'Good',
                    'going_band_uid' => 2,
                    'sporting_life_code' => 'G',
                    'services_desc' => 'Gd',
                    'rp_going_type_desc' => 'GOOD',
                    'rp_going_type_value' => 4
                ]
            ),
            'GF' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'going_type_code' => 'GF',
                    'going_type_desc' => 'Good To Firm',
                    'going_band_uid' => 1,
                    'sporting_life_code' => 'M',
                    'services_desc' => 'GF',
                    'rp_going_type_desc' => 'GD-FM',
                    'rp_going_type_value' => 5
                ]
            ),
            'GS' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'going_type_code' => 'GS',
                    'going_type_desc' => 'Good To Soft',
                    'going_band_uid' => 3,
                    'sporting_life_code' => 'D',
                    'services_desc' => 'GS',
                    'rp_going_type_desc' => 'GD-SFT',
                    'rp_going_type_value' => 3
                ]
            ),
            'GY' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'going_type_code' => 'GY',
                    'going_type_desc' => 'Good To Yielding',
                    'going_band_uid' => 3,
                    'sporting_life_code' => 'X',
                    'services_desc' => 'Gd/Y',
                    'rp_going_type_desc' => 'GD-YLD',
                    'rp_going_type_value' => 3
                ]
            ),
            'HD' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'going_type_code' => 'HD',
                    'going_type_desc' => 'Hard',
                    'going_band_uid' => 1,
                    'sporting_life_code' => 'H',
                    'services_desc' => 'Hd',
                    'rp_going_type_desc' => 'HARD',
                    'rp_going_type_value' => 7
                ]
            ),
            'HO' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'going_type_code' => 'HO',
                    'going_type_desc' => 'Holding',
                    'going_band_uid' => 3,
                    'sporting_life_code' => 'O',
                    'services_desc' => 'H',
                    'rp_going_type_desc' => 'HOLDING',
                    'rp_going_type_value' => 1
                ]
            ),
            'HY' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'going_type_code' => 'HY',
                    'going_type_desc' => 'Heavy',
                    'going_band_uid' => 3,
                    'sporting_life_code' => 'V',
                    'services_desc' => 'Hy',
                    'rp_going_type_desc' => 'HEAVY',
                    'rp_going_type_value' => 1
                ]
            ),
            'MY' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'going_type_code' => 'MY',
                    'going_type_desc' => 'Muddy',
                    'going_band_uid' => 4,
                    'sporting_life_code' => 'Q',
                    'services_desc' => 'M',
                    'rp_going_type_desc' => 'MUDDY',
                    'rp_going_type_value' => 1
                ]
            ),
            'S ' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'going_type_code' => 'S',
                    'going_type_desc' => 'Soft',
                    'going_band_uid' => 3,
                    'sporting_life_code' => 'S',
                    'services_desc' => 'Sft',
                    'rp_going_type_desc' => 'SOFT',
                    'rp_going_type_value' => 2
                ]
            ),
            'SD' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'going_type_code' => 'SD',
                    'going_type_desc' => 'Standard',
                    'going_band_uid' => 4,
                    'sporting_life_code' => 'B',
                    'services_desc' => 'St',
                    'rp_going_type_desc' => 'STAND',
                    'rp_going_type_value' => 9
                ]
            ),
            'SF' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'going_type_code' => 'SF',
                    'going_type_desc' => 'Standard To Fast',
                    'going_band_uid' => 4,
                    'sporting_life_code' => 'J',
                    'services_desc' => 'St/Fs',
                    'rp_going_type_desc' => 'STD-FST',
                    'rp_going_type_value' => 10
                ]
            ),
            'SH' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'going_type_code' => 'SH',
                    'going_type_desc' => 'Soft To Heavy',
                    'going_band_uid' => 3,
                    'sporting_life_code' => 'W',
                    'services_desc' => 'Sft/Hy',
                    'rp_going_type_desc' => 'SFT-HVY',
                    'rp_going_type_value' => 1
                ]
            ),
            'SN' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'going_type_code' => 'SN',
                    'going_type_desc' => 'Sand',
                    'going_band_uid' => 4,
                    'sporting_life_code' => 'N',
                    'services_desc' => 'Snd',
                    'rp_going_type_desc' => 'SAND',
                    'rp_going_type_value' => 1
                ]
            ),
            'SS' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'going_type_code' => 'SS',
                    'going_type_desc' => 'Standard To Slow',
                    'going_band_uid' => 4,
                    'sporting_life_code' => 'K',
                    'services_desc' => 'St/Slw',
                    'rp_going_type_desc' => 'STD-SLW',
                    'rp_going_type_value' => 8
                ]
            ),
            'SW' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'going_type_code' => 'SW',
                    'going_type_desc' => 'Slow',
                    'going_band_uid' => 4,
                    'sporting_life_code' => 'C',
                    'services_desc' => 'Sl',
                    'rp_going_type_desc' => 'SLOW',
                    'rp_going_type_value' => 8
                ]
            ),
            'SY' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'going_type_code' => 'SY',
                    'going_type_desc' => 'Sloppy',
                    'going_band_uid' => 4,
                    'sporting_life_code' => 'P',
                    'services_desc' => 'S',
                    'rp_going_type_desc' => 'SLOPPY',
                    'rp_going_type_value' => 1
                ]
            ),
            'VS' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'going_type_code' => 'VS',
                    'going_type_desc' => 'Very Soft',
                    'going_band_uid' => 3,
                    'sporting_life_code' => 'E',
                    'services_desc' => 'VSft',
                    'rp_going_type_desc' => 'V SOFT',
                    'rp_going_type_value' => 1
                ]
            ),
            'Y ' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'going_type_code' => 'Y',
                    'going_type_desc' => 'Yielding',
                    'going_band_uid' => 3,
                    'sporting_life_code' => 'Y',
                    'services_desc' => 'Y',
                    'rp_going_type_desc' => 'YIELD',
                    'rp_going_type_value' => 3
                ]
            ),
            'YS' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'going_type_code' => 'YS',
                    'going_type_desc' => 'Yielding To Soft',
                    'going_band_uid' => 3,
                    'sporting_life_code' => 'Z',
                    'services_desc' => 'Y/Sft',
                    'rp_going_type_desc' => 'YLD-SFT',
                    'rp_going_type_value' => 2
                ]
            )
        ];
    }
}
