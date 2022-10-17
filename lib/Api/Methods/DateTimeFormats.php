<?php

namespace Api\Methods;

trait DateTimeFormats
{
    /**
     * Turns '2018-06-09 15:05:00' datetime in format '09 Jun 18'
     * @param   $ymd_his          Datetime in format '2018-06-19 15:05:00'
     * @return  string
     */
    public function ymdhis2jMy(string $ymd_his) : string
    {
        return date('d M y', strtotime($ymd_his));
    }
}
