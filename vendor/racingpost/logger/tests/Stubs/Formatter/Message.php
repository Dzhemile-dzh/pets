<?php

namespace Tests\Stubs\Formatter;

/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 12/2/2016
 * Time: 4:35 PM
 */
class Message
{
    public function message($param)
    {
        return 'callback: ' . $param;
    }
}
