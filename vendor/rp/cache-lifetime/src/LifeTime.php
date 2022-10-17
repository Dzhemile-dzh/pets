<?php

namespace RP\Cache;

/**
 * Class LifeTime
 *
 * Uses for getting cache lifetime values.
 *
 * @package RP\Cache
 * @author Denys Solyanyk <denys.solyanyk@racingpost.com>
 * @author Serhii Atiahin <serhii.atiahin@racingpost.com>
 */
class LifeTime
{
    /**
     * Shortcuts for cache server variables
     */
    const ZERO = 'CTRL_CACHE_TTL_SEC_ZERO';
    const SHORT = 'CTRL_CACHE_TTL_SEC_SHORT';
    const MEDIUM = 'CTRL_CACHE_TTL_SEC_MEDIUM';
    const LONG = 'CTRL_CACHE_TTL_SEC_LONG';
    const EXTRALONG = 'CTRL_CACHE_TTL_SEC_EXTRALONG';
    const NO_EXPIRE = 'CTRL_CACHE_TTL_SEC_NOEXPIRE';
    const PAGE_404 = 'CTRL_CACHE_TTL_SEC_PAGE_404';
    const PAGE_503 = 'CTRL_CACHE_TTL_SEC_PAGE_503';

    /**
     * Read cache lifetime predefined values from server variables
     *
     * @param int|string $lifetime
     * @throws \Exception
     * @return string|int
     */
    public static function readPredefinedLifeTime($lifetime)
    {
        if (is_numeric($lifetime)) {
            return (int)$lifetime;
        }

        if (is_string($lifetime)) {
            return self::retrieveServerVariable($lifetime);
        }

        return self::retrieveServerVariable(self::LONG);
    }

    /**
     * Checks server variable and returns value. Otherwise throw exception.
     **
     * @param $name string
     * @throws \Exception
     * @return string
     */
    protected static function retrieveServerVariable($name)
    {
        if (!array_key_exists($name, $_SERVER)) {
            throw new \Exception(sprintf('Server variable %s doesn\'t exist', $name));
        }

        return $_SERVER[$name];
    }
}
