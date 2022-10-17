<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\HorseProfile;

class Form extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'form' => '\Api\Output\Mapper\HorseProfile\Form',
            'form.other_horse' => '\Api\Output\Mapper\HorseProfile\OtherHorse',
            'form.race_tactics' => '\Api\Output\Mapper\HorseProfile\RaceTactics',
            'form.video_detail' => '\Api\Output\Mapper\HorseProfile\VideoDetail',
        ];
    }
}
