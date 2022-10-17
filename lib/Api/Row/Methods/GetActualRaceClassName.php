<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 11/4/14
 * Time: 11:44 AM
 */

namespace Api\Row\Methods;

trait GetActualRaceClassName
{
    /**
     * @return string | null
     */
    public function getActualRaceClassName()
    {

        $result = null;

        if (is_null($this->actual_race_class)) {
            $result = 'Races outside GB';
        } elseif (is_numeric($this->actual_race_class)) {
            $result = 'Cl' . $this->actual_race_class;
        }

        return $result;
    }
}
