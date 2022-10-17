<?php
namespace RP\Cache\Core\Service;

use Phalcon\DI\Injectable;
use Phalcon\Cache\BackendInterface;
use RP\Cache\LifeTime as LifeTimeService;

/**
 * Class LifeTime
 * Creates cache lifetime based on router params or on project's configuration
 * @package RP\Cache\Core\Service
 * @author  Serhii Atiahin <serhii.atiahin@racingpost.com>
 */
class LifeTime extends Injectable
{
    const KEY_ROUTER_CACHE_TIME = 'cache';

    /**
     * @var \Phalcon\Cache\BackendInterface
     */
    protected $cacheAdapter;

    /**
     * @var \Phalcon\Mvc\Router
     */
    protected $router;

    /**
     * @param \Phalcon\Cache\BackendInterface $cacheAdapter
     * @codeCoverageIgnore
     */
    public function __construct(BackendInterface $cacheAdapter)
    {
        $this->cacheAdapter = $cacheAdapter;
        $this->router = $this->getDI()->getShared('router');
    }

    /**
     * Gets cache time from router
     *
     * @return int cache time in seconds
     */
    public function getCacheLifeTimeSeconds()
    {
        $cacheTime = null;

        if (!is_null($this->router)) {
            $params = $this->router->getParams();
            if (array_key_exists(self::KEY_ROUTER_CACHE_TIME, $params)) {
                $cacheTime = $this->getPredefinedLifetime($params[self::KEY_ROUTER_CACHE_TIME]);
            }
        }

        if (is_null($cacheTime)) {
            $cacheTime = $this->getLifetime();
        }

        return $cacheTime;
    }

    /**
     * @return int
     * @codeCoverageIgnore
     */
    protected function getPredefinedLifetime($lifetime)
    {
        return LifeTimeService::readPredefinedLifeTime($lifetime);
    }

    /**
     * @return int
     * @codeCoverageIgnore
     */
    protected function getLifetime()
    {
        return $this->cacheAdapter->getFrontend()->getLifetime();
    }
}
