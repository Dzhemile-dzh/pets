<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 11/4/14
 * Time: 11:44 AM
 */

namespace Api\Row\Methods;

trait GetRaceStatusName
{
    /**
     * @return string | null
     */
    public function getRaceStatusName()
    {

        $result = null;

        switch ($this->race_status_code) {
            case "4":
            case "3":
                $result = "Four Day";
                break;
            case "2":
                $result = "Two Day";
                break;
            case "O":
                $result = "Overnight";
                break;
            case "C":
                $result = "Early closer";
                break;
        }

        return $result;
    }
}
