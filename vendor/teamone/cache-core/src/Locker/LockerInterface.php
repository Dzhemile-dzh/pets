<?php

namespace RP\Cache\Core\Locker;

/**
 * Interface LockerInterface
 * @package RP\Cache\Core\Locker
 * @codeCoverageIgnore
 */
interface LockerInterface
{
    /**
     * @param string $content
     * @param string $key
     * @return void
     */
    public function lock(&$content, $key);

    /**
     * @return void
     */
    public function unlock();
}
