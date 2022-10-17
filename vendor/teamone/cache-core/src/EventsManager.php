<?php
namespace RP\Cache\Core;

use Phalcon\Config;
use Phalcon\Events\EventsAwareInterface;
use Phalcon\Events\Manager;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\View;
use RP\Cache\Core\Event\DispatcherHandler;
use RP\Cache\Core\Event\ViewHandler;
use RP\Cache\Core\Factory\ICacheComponent;
use RP\Cache\Core\NoCache\Factory\Component as NoCacheComponent;
use RP\Cache\Core\Service\Cache;

/**
 * Class EventsManager
 * Helps attach required events
 * @package RP\Cache\Core
 * @author  Serhii Atiahin <serhii.atiahin@racingpost.com>
 */
class EventsManager
{
    const EVENT_PREFIX_DISPATCH = 'dispatch';
    const EVENT_PREFIX_VIEW = 'view';

    const EVENT_PRIORITY = 999; // high priority

    const COOKIE_CACHE_CONTROL_NAME = 'ndp_cache';
    const COOKIE_CACHE_VALUE_DISABLE = 'off';
    const COOKIE_CACHE_VALUE_FORCE = 'force';

    /**
     * @var \RP\Cache\Core\Service\Cache
     */
    private $cacheService;

    /**
     * @var Config $_COOKIE
     */
    private $cookieConfig;

    /**
     * EventsManager constructor.
     * @param ICacheComponent $cacheComponent
     * @param Dispatcher $dispatcher
     * @param View|null $view
     */
    public function __construct(ICacheComponent $cacheComponent, Dispatcher $dispatcher, View $view = null)
    {
        $this->cookieConfig = $this->createCookieConfig();

        if ($this->isCacheDisabled()) {
            $cacheComponent = new NoCacheComponent();
        }

        $this->cacheService = $this->createCacheService($cacheComponent);
        $this->cacheService->forceMode($this->isCacheForced());

        $this->initEventsDispatcher($dispatcher);

        if (!is_null($view)) {
            $this->initEventsView($view);
        }
    }

    /**
     * @param \Phalcon\Events\EventsAwareInterface $service
     *
     * @return Manager
     */
    protected function retrieveEventsManager(EventsAwareInterface $service)
    {
        if (is_null($service->getEventsManager())) {
            $service->setEventsManager(new Manager());
        }

        /**
         * @var $eventsManager \Phalcon\Events\Manager
         */
        $eventsManager = $service->getEventsManager();
        if (!$eventsManager->arePrioritiesEnabled()) {
            $eventsManager->enablePriorities(true);
        }

        return $eventsManager;
    }

    /**
     * @param Dispatcher $service
     */
    protected function initEventsDispatcher(Dispatcher $service)
    {
        $eventsManager = $this->retrieveEventsManager($service);

        $eventsManager->attach(
            self::EVENT_PREFIX_DISPATCH,
            new DispatcherHandler($this->cacheService),
            self::EVENT_PRIORITY
        );
    }

    /**
     * @param View $service
     */
    protected function initEventsView(View $service)
    {
        $eventsManager = $this->retrieveEventsManager($service);

        $eventsManager->attach(
            self::EVENT_PREFIX_VIEW,
            new ViewHandler($this->cacheService),
            self::EVENT_PRIORITY
        );
    }

    /**
     * @param ICacheComponent $cacheComponent
     * @return Cache
     */
    protected function createCacheService(ICacheComponent $cacheComponent)
    {
        return new Cache($cacheComponent);
    }

    /**
     * @return Config
     */
    protected function createCookieConfig()
    {
        return new Config($_COOKIE);
    }

    /**
     * @return bool
     */
    protected function isCacheDisabled()
    {
        return $this->getCacheControlCookie() === self::COOKIE_CACHE_VALUE_DISABLE;
    }

    /**
     * @return bool
     */
    protected function isCacheForced()
    {
        return $this->getCacheControlCookie() === self::COOKIE_CACHE_VALUE_FORCE;
    }

    /**
     * @return string
     */
    protected function getCacheControlCookie()
    {
        return $this->cookieConfig->get(self::COOKIE_CACHE_CONTROL_NAME, null);
    }
}
