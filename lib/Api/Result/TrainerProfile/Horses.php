<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\TrainerProfile;

class Horses extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'horses' => '\Api\Output\Mapper\TrainerProfile\Horses',
            'season_info' => '\Api\Output\Mapper\SeasonInfo\HorsesSeasonInfo'
        ];
    }
}
