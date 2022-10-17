<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\RaceCards;

class Selections extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'selections' => '\Api\Output\Mapper\RaceCards\Selections\Selections',
            'race_details' => '\Api\Output\Mapper\RaceCards\Selections\RaceDetails',
            'selections_selection' => '\Api\Output\Mapper\RaceCards\Selections\Selection'
        ];
    }
}
