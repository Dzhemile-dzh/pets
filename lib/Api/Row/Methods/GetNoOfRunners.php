<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 11/4/14
 * Time: 11:44 AM
 */

namespace Api\Row\Methods;

trait GetNoOfRunners
{
    /**
     * @return bool
     */
    public function getNoOfRunners()
    {
        return MAX($this->no_of_runners, $this->no_of_runners_calculated);
    }
}
