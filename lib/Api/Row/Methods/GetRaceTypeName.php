<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 11/4/14
 * Time: 11:44 AM
 */

namespace Api\Row\Methods;

trait GetRaceTypeName
{
    /**
     * @return string | null
     */
    public function getRaceTypeName()
    {
        $result = '';

        if ($this->isFlatRace()) {
            $result = 'flat';
        } elseif ($this->isJumpRace()) {
            $result = 'jumps';
        } else {
            throw new \Exception('Wrong race type');
        }

        return $result;
    }
}
