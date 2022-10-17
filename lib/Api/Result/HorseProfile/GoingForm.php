<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 8/22/2016
 * Time: 5:22 PM
 */

namespace Api\Result\HorseProfile;

class GoingForm extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'going_form.heavy_soft' => '\Api\Output\Mapper\HorseProfile\GoingForm',
            'going_form.heavy_soft.topspeed_flat_race' => '\Api\Output\Mapper\HorseProfile\TopspeedRace',
            'going_form.heavy_soft.topspeed_jumps_race' => '\Api\Output\Mapper\HorseProfile\TopspeedRace',
            'going_form.good_to_soft' => '\Api\Output\Mapper\HorseProfile\GoingForm',
            'going_form.good_to_soft.topspeed_flat_race' => '\Api\Output\Mapper\HorseProfile\TopspeedRace',
            'going_form.good_to_soft.topspeed_jumps_race' => '\Api\Output\Mapper\HorseProfile\TopspeedRace',
            'going_form.good' => '\Api\Output\Mapper\HorseProfile\GoingForm',
            'going_form.good.topspeed_flat_race' => '\Api\Output\Mapper\HorseProfile\TopspeedRace',
            'going_form.good.topspeed_jumps_race' => '\Api\Output\Mapper\HorseProfile\TopspeedRace',
            'going_form.good_to_firm' => '\Api\Output\Mapper\HorseProfile\GoingForm',
            'going_form.good_to_firm.topspeed_flat_race' => '\Api\Output\Mapper\HorseProfile\TopspeedRace',
            'going_form.good_to_firm.topspeed_jumps_race' => '\Api\Output\Mapper\HorseProfile\TopspeedRace',
            'going_form.firm' => '\Api\Output\Mapper\HorseProfile\GoingForm',
            'going_form.firm.topspeed_flat_race' => '\Api\Output\Mapper\HorseProfile\TopspeedRace',
            'going_form.firm.topspeed_jumps_race' => '\Api\Output\Mapper\HorseProfile\TopspeedRace',
        ];
    }
}
