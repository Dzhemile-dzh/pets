<?php
namespace RP\Cache\Core\NoCache\Adapter;

use Phalcon\Cache\Backend;
use Phalcon\Cache\BackendInterface;

/**
 * Class Dummy
 * @package RP\Cache\Core\NoCache\Adapter
 * @author  Denys Solyanyk <denys.solyanyk@racingpost.com>
 */
class Dummy extends Backend implements BackendInterface
{

    /**
     * Returns a cached content
     *
     * @param int|string $keyName
     * @param int $lifetime
     *
     * @return  mixed
     */
    public function get($keyName, $lifetime = null)
    {
        return null;
    }

    /**
     * Stores cached content into the file backend and stops the frontend
     *
     * @param int|string $keyName
     * @param string $content
     * @param int $lifetime
     * @param boolean $stopBuffer
     */
    public function save($keyName = null, $content = null, $lifetime = null, $stopBuffer = null)
    {
    }

    /**
     * Deletes a value from the cache by its key
     *
     * @param int|string $keyName
     *
     * @return boolean
     */
    public function delete($keyName)
    {
        return true;
    }

    /**
     * Query the existing cached keys
     *
     * @param string $prefix
     *
     * @return array
     */
    public function queryKeys($prefix = null)
    {
        return array();
    }

    /**
     * Checks if cache exists and it hasn't expired
     *
     * @param  string $keyName
     * @param  int $lifetime
     *
     * @return boolean
     */
    public function exists($keyName = null, $lifetime = null)
    {
        return false;
    }

    /**
     * Immediately invalidates all existing items.
     *
     * @return boolean
     */
    public function flush()
    {
        return true;
    }
}
