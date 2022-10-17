<?php

namespace Tests\Stubs\Models\Bo\HorseProfile;

/**
 * Class PreHorseRace
 *
 * @package Tests\Stubs\Models\Bo\HorseProfile
 */
class PreHorseRace extends \Tests\Stubs\Models\PreHorseRace
{
    /**
     * @param $horseId
     * @return mixed
     */
    public function getTips($horseId)
    {
        $tips = [
            867979 => [
                [
                    "race_instance_uid" => 614655,
                    "newspaper_uid" => 14,
                    "naps_style" => "Newsboy"
                ],
                [
                    "race_instance_uid" => 614655,
                    "newspaper_uid" => 15,
                    "naps_style" => "Templegate"
                ]
            ]
        ];

        return $tips[$horseId];
    }

    /**
     * @param $horseId
     * @return mixed
     */
    public function getComments($horseId)
    {
        $comments = [
            867979 => [
                [
                    "race_instance_uid" => 613712,
                    "individual_spotlight" => "RPRs h 50s when well held in pair of 8.6f  a handicap prospect.",
                    "individual_comment" => "RPRs in the high 50s",
                    "rp_owner_choice" => null
                ],
                [
                    "race_instance_uid" => 614655,
                    "individual_spotlight" => "Moderate maidens here and most recently Kempton, but probably",
                    "individual_comment" => "Moderate so far",
                    "rp_owner_choice" => "a"
                ]
            ]
        ];

        return $comments[$horseId];
    }
}
