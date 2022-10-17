<?php

namespace RP\Cache\Core\NoCache\Locker;

use RP\Cache\Core\Locker\LockerInterface;

/**
 * Class Dummy
 * @package RP\Cache\Core\NoCache\Locker
 * @codeCoverageIgnore
 */
class Dummy implements LockerInterface
{
    /**
     * @param $content
     * @param string $key
     * @return string | null
     */
    public function lock(&$content, $key)
    {
        return $content;
    }

    /**
     * @return void
     */
    public function unlock()
    {
    }
}
