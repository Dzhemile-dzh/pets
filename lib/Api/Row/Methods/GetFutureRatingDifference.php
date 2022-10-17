<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 11/4/14
 * Time: 11:44 AM
 */

namespace Api\Row\Methods;

trait GetFutureRatingDifference
{
    /**
     * @return string | null
     */
    public function getFutureRatingDifference()
    {
        $result = null;
        if (isset($this->diff_or)) {
            $result = $this->diff_or - (int)$this->extra_weight;
        }
        return $result;
    }
}
