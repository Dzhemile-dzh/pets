<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\RaceCards;

class Postdata extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'postdata' => '\Api\Output\Mapper\RaceCards\Postdata\Postdata',
            'postdata.race_details' => '\Api\Output\Mapper\RaceCards\Postdata\RaceDetails',
            'postdata.runners' => '\Api\Output\Mapper\RaceCards\Postdata\Runners',
            'postdata.postdata_selection' => '\Api\Output\Mapper\RaceCards\Postdata\Selection'
        ];
    }
}
