<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 11/4/14
 * Time: 11:44 AM
 */

namespace Api\Row\Methods;

trait IsScoop6Race
{
    /**
     * @return bool
     */
    public function isScoop6Race()
    {
        if (isset($this->is_scoop6_race)) {
            return boolval($this->is_scoop6_race);
        }
        return $this->scoop == 'S6';
    }
}
