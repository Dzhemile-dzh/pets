<?php

namespace Models\Bo\LookupTable;

class HorseColour extends \Models\HorseColour
{
    /**
     * @return array
     */
    public function getHorseColourTable()
    {
        $res = $this->getReadConnection()->query(
            'SELECT
                rtrim(horse_colour_code) AS horse_colour_code,
                horse_colour_desc,
                rtrim(weatherbys_code) AS weatherbys_code,
                newspaper_output_desc,
                rtrim(rp_newspaper_output_desc) AS rp_newspaper_output_desc
            FROM horse_colour'
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(null, new \Phalcon\Mvc\Model\Row(), $res);

        return $result->toArrayWithRows('horse_colour_code');
    }
}
