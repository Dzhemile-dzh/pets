<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\RaceCards;

class Form extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'form.races' => '\Api\Output\Mapper\RaceCards\Form',
            'form.races.video_detail' => '\Api\Output\Mapper\RaceCards\VideoDetail',
            'form.races.other_horse' => '\Api\Output\Mapper\RaceCards\OtherHorse',
            'form.races.next_run' => '\Api\Output\Mapper\RaceCards\NextRunHeader',
            'form.races.next_run.first_three' => '\Api\Output\Mapper\RaceCards\NextRun',
            'form.races.next_run.also_rans' => '\Api\Output\Mapper\RaceCards\NextRun',
        ];
    }
}
