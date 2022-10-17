<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 11/4/14
 * Time: 11:44 AM
 */

namespace Api\Row\Methods;

trait GetTimeBeforeUpdate
{
    /**
     * @return int
     */
    public function getTimeBeforeUpdate()
    {
        $timeBeforeUpdate = strtotime($this->race_datetime) - strtotime('+10 minutes');
        return ($timeBeforeUpdate < 0) ? 0 : $timeBeforeUpdate;
    }
}
