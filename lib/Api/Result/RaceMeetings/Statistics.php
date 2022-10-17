<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\RaceMeetings;

class Statistics extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'statistics.top_jockeys' => '\Api\Output\Mapper\RaceMeetings\Statistics\Jockey',
            'statistics.top_trainers' => '\Api\Output\Mapper\RaceMeetings\Statistics\Trainer',
            'statistics.top_owners' => '\Api\Output\Mapper\RaceMeetings\Statistics\Owner'
        ];
    }
}
