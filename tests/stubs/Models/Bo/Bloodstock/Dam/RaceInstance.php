<?php

namespace Tests\Stubs\Models\Bo\Bloodstock\Dam;

class RaceInstance extends \Tests\Stubs\Models\RaceInstance
{
    /**
     * @param $horseId
     *
     * @return array
     */
    public function getProgenyEntries($damId)
    {
        $data = [
            585723 => [
                [
                    "race_instance_uid" => 614446,
                    "race_datetime" => "Jun  4 2016  4:00PM",
                    "distance_yard" => 2650,
                    "race_instance_title" => "Investec Derby (Group 1) (Entire Colts & Fillies)",
                    "race_status_code" => "C",
                    "prize_sterling" => 751407,
                    "course_name" => "EPSOM",
                    "course_style_name" => "Epsom",
                    "course_uid" => 17,
                    "rp_going_type_desc" => null,
                    "no_of_runners" => 475,
                    "style_name" => "00ouija Board",
                    "horse_uid" => 875278
                ]
            ]
        ];

        return $data[$damId];
    }
}
