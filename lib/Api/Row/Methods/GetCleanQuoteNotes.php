<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 7/23/2015
 * Time: 11:09 AM
 */

namespace Api\Row\Methods;

trait GetCleanQuoteNotes
{
    /** Delete useless symbols
     *
     * @return float
     */
    public function getCleanQuoteNotes()
    {
        $result = $this->notes;
        $result = str_replace(['\b', '\n', '\p'], '', $result);
        return str_replace("\x92", "'", $result);
    }
}
