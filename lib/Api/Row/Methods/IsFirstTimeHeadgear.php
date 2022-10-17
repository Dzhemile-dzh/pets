<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 11/4/14
 * Time: 11:44 AM
 */

namespace Api\Row\Methods;

trait IsFirstTimeHeadgear
{
    /**
     * @return bool
     */
    public function isFirstTimeHeadgear()
    {
        return $this->first_time_yn == 'Y';
    }
}
