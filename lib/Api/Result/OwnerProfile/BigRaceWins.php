<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\OwnerProfile;

class BigRaceWins extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'big_race_wins' => '\Api\Output\Mapper\OwnerProfile\BigRaceWins',
            'big_race_wins.video_detail' => '\Api\Output\Mapper\OwnerProfile\VideoDetail',
        ];
    }
}
