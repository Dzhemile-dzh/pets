<?php

namespace Tests\Stubs\Models\Bo\LookupTable;

class HorseColour extends \Tests\Stubs\Models\HorseColour
{

    /**
     * @return array
     */
    public function getHorseColourTable()
    {
        return [
            'B' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_colour_code' => 'B',
                    'horse_colour_desc' => 'Bay',
                    'weatherbys_code' => 'B',
                    'newspaper_output_desc' => 'b',
                    'rp_newspaper_output_desc' => 'b'
                ]
            ),
            'BB' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_colour_code' => 'BB',
                    'horse_colour_desc' => 'Bay or Brown',
                    'weatherbys_code' => 'B BR',
                    'newspaper_output_desc' => 'b or br',
                    'rp_newspaper_output_desc' => 'b/br'
                ]
            ),
            'BG' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_colour_code' => 'BG',
                    'horse_colour_desc' => 'Brown or Grey',
                    'weatherbys_code' => 'BRGR',
                    'newspaper_output_desc' => 'br or gr',
                    'rp_newspaper_output_desc' => 'br/gr'
                ]
            ),
            'BL' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_colour_code' => 'BL',
                    'horse_colour_desc' => 'Black',
                    'weatherbys_code' => 'BL',
                    'newspaper_output_desc' => 'bl',
                    'rp_newspaper_output_desc' => 'bl'
                ]
            ),
            'BR' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_colour_code' => 'BR',
                    'horse_colour_desc' => 'Brown',
                    'weatherbys_code' => 'BR',
                    'newspaper_output_desc' => 'br',
                    'rp_newspaper_output_desc' => 'br'
                ]
            ),
            'BZ' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_colour_code' => 'BZ',
                    'horse_colour_desc' => 'Bay or Roan',
                    'weatherbys_code' => 'B RO',
                    'newspaper_output_desc' => 'b or ro',
                    'rp_newspaper_output_desc' => 'b/ro'
                ]
            ),
            'CH' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_colour_code' => 'CH',
                    'horse_colour_desc' => 'Chestnut',
                    'weatherbys_code' => 'CH',
                    'newspaper_output_desc' => 'ch',
                    'rp_newspaper_output_desc' => 'ch'
                ]
            ),
            'D' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_colour_code' => 'D',
                    'horse_colour_desc' => 'Dun',
                    'weatherbys_code' => 'D',
                    'newspaper_output_desc' => 'd',
                    'rp_newspaper_output_desc' => 'd'
                ]
            ),
            'GB' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_colour_code' => 'GB',
                    'horse_colour_desc' => 'Grey or Bay',
                    'weatherbys_code' => 'GB',
                    'newspaper_output_desc' => 'gr or b',
                    'rp_newspaper_output_desc' => 'gr/b'
                ]
            ),
            'GR' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_colour_code' => 'GR',
                    'horse_colour_desc' => 'Grey',
                    'weatherbys_code' => 'GR',
                    'newspaper_output_desc' => 'gr',
                    'rp_newspaper_output_desc' => 'gr'
                ]
            ),
            'P' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_colour_code' => 'P',
                    'horse_colour_desc' => 'Piebald',
                    'weatherbys_code' => 'P',
                    'newspaper_output_desc' => 'p',
                    'rp_newspaper_output_desc' => 'p'
                ]
            ),
            'RG' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_colour_code' => 'RG',
                    'horse_colour_desc' => 'Grey or Roan',
                    'weatherbys_code' => 'GRRO',
                    'newspaper_output_desc' => 'gr or ro',
                    'rp_newspaper_output_desc' => 'gr/ro'
                ]
            ),
            'RO' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_colour_code' => 'RO',
                    'horse_colour_desc' => 'Roan',
                    'weatherbys_code' => 'RO',
                    'newspaper_output_desc' => 'ro',
                    'rp_newspaper_output_desc' => 'ro'
                ]
            ),
            'SK' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_colour_code' => 'SK',
                    'horse_colour_desc' => 'Skewbald',
                    'weatherbys_code' => 'SK',
                    'newspaper_output_desc' => 'sk',
                    'rp_newspaper_output_desc' => 'sk'
                ]
            ),
            'U' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_colour_code' => 'U',
                    'horse_colour_desc' => 'Unknown',
                    'weatherbys_code' => null,
                    'newspaper_output_desc' => ' ',
                    'rp_newspaper_output_desc' => null
                ]
            ),
            'WH' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_colour_code' => 'WH',
                    'horse_colour_desc' => 'White',
                    'weatherbys_code' => 'WH',
                    'newspaper_output_desc' => 'wh',
                    'rp_newspaper_output_desc' => 'wh'
                ]
            )
        ];
    }
}
