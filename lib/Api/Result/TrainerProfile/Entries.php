<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\TrainerProfile;

class Entries extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'entries' => '\Api\Output\Mapper\TrainerProfile\Entry'
        ];
    }
}
