<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 8/30/2016
 * Time: 4:40 PM
 */

namespace Api\Result\GoingToSuit;

class GoingToSuit extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'race' => '\Api\Output\Mapper\GoingToSuit\Race',
            'race.horses' => '\Api\Output\Mapper\GoingToSuit\Horses',

            'race.horses.going_form' => '\Api\Output\Mapper\GoingToSuit\GoingForm',
            'race.horses.going_form.topspeed_flat_race' => '\Api\Output\Mapper\HorseProfile\TopspeedRace',
            'race.horses.going_form.topspeed_jumps_race' => '\Api\Output\Mapper\HorseProfile\TopspeedRace',
            'race.horses.going_form.top_rpr_flat' => '\Api\Output\Mapper\GoingToSuit\TopRprRace',
            'race.horses.going_form.top_rpr_jumps' => '\Api\Output\Mapper\GoingToSuit\TopRprRace',

            'race.horses.sire_going_form' => '\Api\Output\Mapper\GoingToSuit\SireGoingForm',
        ];
    }
}
