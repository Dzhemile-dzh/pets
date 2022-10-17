<?php

namespace Tests\Stubs\Models\Bo\LookupTable;

class Country extends \Tests\Stubs\Models\Country
{

    /**
     * @return array
     */
    public function getCountryTable()
    {
        return [
            "ALG" => \Phalcon\Mvc\Model\Row\General::createFromArray([
                "country_code"=> "ALG",
                "country_desc"=> "Algeria"
            ]),
            "ARG" => \Phalcon\Mvc\Model\Row\General::createFromArray([
                "country_code"=> "ARG",
                "country_desc"=> "Argentina"
            ]),
            "ARO" => \Phalcon\Mvc\Model\Row\General::createFromArray([
                "country_code"=> "ARO",
                "country_desc"=> "Arabia"
            ]),
        ];
    }
}
