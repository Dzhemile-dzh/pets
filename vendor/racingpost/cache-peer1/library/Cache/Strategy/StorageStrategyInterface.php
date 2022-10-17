<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 02.12.2015
 * Time: 12:53
 */

namespace Phalcon\Cache\Strategy;


interface StorageStrategyInterface
{
    public function pack(&$data);
    public function unpack(&$data);
}