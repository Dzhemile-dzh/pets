<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 9/28/2016
 * Time: 2:32 PM
 */

namespace Api\Result\RaceCards;

class TopSelections extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'top_selections' => '\Api\Output\Mapper\RaceCards\Selections\TopSelections'
        ];
    }
}
