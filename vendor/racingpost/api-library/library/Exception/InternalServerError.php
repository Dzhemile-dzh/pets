<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/4/14
 * Time: 10:30 AM
 */

namespace Api\Exception;


class InternalServerError extends Base {

    /**
     * @return int
     */
    public function getStatus()
    {
        return 500;
    }

    /**
     * @return string
     */
    public function getStatusMessage()
    {
        return 'Internal Server Error';
    }
}