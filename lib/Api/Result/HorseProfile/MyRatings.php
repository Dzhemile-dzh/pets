<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\HorseProfile;

class MyRatings extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'my_ratings' => '\Api\Output\Mapper\HorseProfile\MyRatings',
            'my_ratings.other_horse' => '\Api\Output\Mapper\HorseProfile\OtherHorse',
            'my_ratings.video_detail' => '\Api\Output\Mapper\HorseProfile\VideoDetail'

        ];
    }
}
