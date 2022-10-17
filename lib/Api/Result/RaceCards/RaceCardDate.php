<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\RaceCards;

class RaceCardDate extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'list' => '\Api\Output\Mapper\RaceCards\RaceCardsDate\Meeting',
            'list.races' => '\Api\Output\Mapper\RaceCards\RaceCardsDate\Race'
        ];
    }
}
