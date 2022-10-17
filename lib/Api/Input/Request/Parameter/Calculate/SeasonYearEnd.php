<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 12/29/2016
 * Time: 11:43 AM
 */

namespace Api\Input\Request\Parameter\Calculate;

use Phalcon\Input\Request\Parameter\Calculate\ByDefault;

class SeasonYearEnd extends ByDefault
{
    /**
     * @return int|null
     */
    public function getValue()
    {
        if (!$this->getRequest()->isRegisterEmpty()) {
            return (int)(new \DateTime($this->getRequest()->getSeasonDateEnd()))->format('Y');
        }
    }
}
