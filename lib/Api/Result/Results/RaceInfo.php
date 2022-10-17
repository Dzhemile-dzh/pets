<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\Results;

class RaceInfo extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'race_info' => '\Api\Output\Mapper\Results\RaceInfo',
            'race_info.prizes' => '\Api\Output\Mapper\Results\Prize',
            'race_info.dividends' => '\Api\Output\Mapper\Results\Dividend',
            'race_info.video_detail' => '\Api\Output\Mapper\Results\VideoDetail',
        ];
    }
}
