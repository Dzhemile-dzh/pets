<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 02.12.2015
 * Time: 14:36
 */

namespace Phalcon\Cache\Strategy;


class ZipStorageStrategy implements StorageStrategyInterface
{
    public function __construct()
    {

    }

    public function pack(&$data)
    {
        if (is_string($data) || is_numeric($data) || is_object($data) || is_array($data)) {
            $compressed = gzcompress(serialize($data), 6);
        } elseif ($data === null) {
            $compressed = null;
        }
        else {
            throw new \Phalcon\Exception("Strategy doesn't know how to pack type " . gettype($data));
        }

        return $compressed;
    }

    public function unpack(&$data)
    {
        if (!is_string($data)) {
            return null;
        }
        $uncompressed = gzuncompress($data);

        $tmp = unserialize($uncompressed);
        return $tmp;
    }
}