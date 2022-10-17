<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\RaceMeetings;

class RunnersIndex extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'runners_index.runners' => '\Api\Output\Mapper\RaceMeetings\RunnersIndex',
            'runners_index.non_runners' => '\Api\Output\Mapper\RaceMeetings\RunnersIndex',
        ];
    }
}
