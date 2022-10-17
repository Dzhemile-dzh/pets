<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\HorseProfile;

class Wins extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'wins' => '\Api\Output\Mapper\HorseProfile\Wins',
            'wins.other_horse' => '\Api\Output\Mapper\HorseProfile\OtherHorse',
            'wins.video_detail' => '\Api\Output\Mapper\HorseProfile\VideoDetail'
        ];
    }
}
