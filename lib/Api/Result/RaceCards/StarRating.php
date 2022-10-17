<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\RaceCards;

class StarRating extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'star_rating' => '\Api\Output\Mapper\RaceCards\StarRating\RaceInfo',
            'star_rating.horses' => '\Api\Output\Mapper\RaceCards\StarRating\Horses',
        ];
    }
}
