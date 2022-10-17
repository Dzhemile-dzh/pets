<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\RaceCards;

class StandardForm extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'form.races' => '\Api\Output\Mapper\RaceCards\StandardForm',
            'form.races.other_horse' => '\Api\Output\Mapper\RaceCards\OtherHorse',
            'form.races.video_detail' => '\Api\Output\Mapper\RaceCards\VideoDetail'
        ];
    }
}
