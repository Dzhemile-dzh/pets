<?php

namespace Tests\Stubs\Models\Bo\Results;


class RaceAttribLookup extends \Phalcon\Mvc\Model
{

    /**
     * @param integer $raceId
     * @return mixed
     */
    public function getRaceClass($raceId) {

        return (Object)[
            'race_attrib_desc' => '4',
        ];
    }

}
