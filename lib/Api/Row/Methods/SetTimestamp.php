<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 11/4/14
 * Time: 11:44 AM
 */

namespace Api\Row\Methods;

trait SetTimestamp
{
    /**
     * @throws \Api\Exception\NotFound
     */
    protected function setTimestamp()
    {

        if (!isset($this->timestamp)) {
            $this->timestamp = strtotime($this->race_datetime);

            if (empty($this->timestamp)) {
                throw new \Api\Exception\InternalServerError(
                    2104,
                    $this->race_instance_uid
                );
            }
        }
    }
}
