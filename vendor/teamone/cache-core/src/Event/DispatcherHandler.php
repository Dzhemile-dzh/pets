<?php
namespace RP\Cache\Core\Event;

use Phalcon\Events\Event;
use Phalcon\Http\Response;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\View;
use RP\Cache\Core\ResponseBuilder;
use RP\Cache\Core\Service\Cache;

/**
 * Class DispatcherHandler
 * Contains handlers for Dispatcher events
 *
 * @package RP\Cache\Core\Event
 * @author  Serhii Atiahin <serhii.atiahin@racingpost.com>
 * @codeCoverageIgnore
 */
class DispatcherHandler extends Plugin
{
    const HEADER_CACHE_HIT = 'Cache-Hit';
    const VALUE_YES = 'yes';

    const SERVICE_VIEW = 'view';

    /**
     * @var \RP\Cache\Core\Service\Cache
     */
    protected $cacheService = null;

    /**
     * DispatcherHandler constructor.
     *
     * @param \RP\Cache\Core\Service\Cache $cacheService
     */
    public function __construct(Cache $cacheService)
    {
        $this->cacheService = $cacheService;
    }

    /**
     * @param Event $event
     * @param Dispatcher $dispatcher
     * @return bool
     */
    public function beforeDispatchLoop(Event $event, Dispatcher $dispatcher)
    {
        if (\Phalcon\Di::getDefault()->has('startSpan')) \Phalcon\Di::getDefault()->get('startSpan', ['cache-read']);
        $response = $this->cacheService->read();
        if (\Phalcon\Di::getDefault()->has('endSpan')) \Phalcon\Di::getDefault()->get('endSpan', ['cache-read']);
        if (is_null($response)) {
            return true;
        }

        $response->setHeader(self::HEADER_CACHE_HIT, self::VALUE_YES);

        $dispatcher->setReturnedValue($response);

        return false;
    }

    /**
     * @param Event $event
     * @param Dispatcher $dispatcher
     */
    public function afterDispatchLoop(Event $event, Dispatcher $dispatcher)
    {
        $responseBuilder = new ResponseBuilder(
            $dispatcher,
            $this->getResponse(),
            $this->getView()
        );
        $response = $responseBuilder->getResponse();

        $content = $response->getContent();
        if (empty($content)) {
            return;
        }

        if (\Phalcon\Di::getDefault()->has('startSpan')) \Phalcon\Di::getDefault()->get('startSpan', ['cache-save']);
        $this->cacheService->save($response);
        if (\Phalcon\Di::getDefault()->has('endSpan')) \Phalcon\Di::getDefault()->get('endSpan', ['cache-save']);
    }

    /**
     * @return Response
     */
    protected function getResponse()
    {
        return $this->getDI()->getResponse();
    }

    /**
     * @return View|null
     */
    protected function getView()
    {
        $di = $this->getDI();
        return $di->has(self::SERVICE_VIEW) ? $this->getDI()->getView() : null;
    }
}
