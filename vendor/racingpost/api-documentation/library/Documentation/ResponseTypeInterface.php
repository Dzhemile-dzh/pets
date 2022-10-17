<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 2016-12-14
 * Time: 17:03
 */

namespace RP\Documentation;

interface ResponseTypeInterface
{
    public function getExample();
    public function getSchema();
}
