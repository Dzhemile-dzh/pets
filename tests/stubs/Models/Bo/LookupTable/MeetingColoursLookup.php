<?php

namespace Tests\Stubs\Models\Bo\LookupTable;

class MeetingColoursLookup extends \Tests\Stubs\Models\MeetingColoursLookup
{

    /**
     * @return array
     */
    public function getMeetingColoursLookupTable()
    {
        return [
            "1" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    "meeting_number"=> 1,
                    "c_colour"=> 0,
                    "m_colour"=> 100,
                    "y_colour"=> 100,
                    "k_colour"=> 0,
                    "colour_description"=> "Card 1",
                    "r_colour"=> 237,
                    "g_colour"=> 28,
                    "b_colour"=> 36
                ]
            ),
            "2" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    "meeting_number"=> 2,
                    "c_colour"=> 100,
                    "m_colour"=> 90,
                    "y_colour"=> 0,
                    "k_colour"=> 50,
                    "colour_description"=> "Card 2",
                    "r_colour"=> 10,
                    "g_colour"=> 26,
                    "b_colour"=> 92
                ]
            )
        ];
    }
}
