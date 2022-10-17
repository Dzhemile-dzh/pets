<?php

namespace Tests\Stubs\Models\Bo\LookupTable;

class HorseSex extends \Tests\Stubs\Models\HorseSex
{

    /**
     * @return array
     */
    public function getHorseSexTable()
    {
        return [
            "C" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    "horse_sex_code" => "C",
                    "horse_sex_desc" => "colt",
                    "horse_sex_flag" => "M"
                ]
            ),
            "F" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    "horse_sex_code" => "F",
                    "horse_sex_desc" => "filly",
                    "horse_sex_flag" => "F"
                ]
            ),
            "G" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    "horse_sex_code" => "G",
                    "horse_sex_desc" => "gelding",
                    "horse_sex_flag" => "M"
                ]
            ),
        ];
    }
}
