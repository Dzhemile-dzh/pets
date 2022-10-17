<?php

namespace Tests\Stubs\Models\Bo\LookupTable;

class RaceType extends \Tests\Stubs\Models\RaceType
{

    /**
     * @return array
     */
    public function getRaceTypeTable()
    {
        return [
            "B" => \Phalcon\Mvc\Model\Row\General::createFromArray([
                "race_type_code"=> "B",
                "race_type_desc"=> "NH Flat"
            ]),
            "C" => \Phalcon\Mvc\Model\Row\General::createFromArray([
                "race_type_code"=> "C",
                "race_type_desc"=> "Chase Turf"
            ]),
            "F" => \Phalcon\Mvc\Model\Row\General::createFromArray([
                "race_type_code"=> "F",
                "race_type_desc"=> "Flat Turf"
            ]),
            "H" => \Phalcon\Mvc\Model\Row\General::createFromArray([
                "race_type_code"=> "H",
                "race_type_desc"=> "Hurdle Turf"
            ]),
            "P" => \Phalcon\Mvc\Model\Row\General::createFromArray([
                "race_type_code"=> "P",
                "race_type_desc"=> "Point-To-Point"
            ]),
            "U" => \Phalcon\Mvc\Model\Row\General::createFromArray([
                "race_type_code"=> "U",
                "race_type_desc"=> "Hunter Chase"
            ]),
            "W" => \Phalcon\Mvc\Model\Row\General::createFromArray([
                "race_type_code"=> "W",
                "race_type_desc"=> "NH Flat AW"
            ]),
            "X" => \Phalcon\Mvc\Model\Row\General::createFromArray([
                "race_type_code"=> "X",
                "race_type_desc"=> "Flat AW"
            ]),
            "Y" => \Phalcon\Mvc\Model\Row\General::createFromArray([
                "race_type_code"=> "Y",
                "race_type_desc"=> "Hurdle AW"
            ]),
            "Z" => \Phalcon\Mvc\Model\Row\General::createFromArray([
                "race_type_code"=> "Z",
                "race_type_desc"=> "Chase AW"
            ])
        ];
    }
}
