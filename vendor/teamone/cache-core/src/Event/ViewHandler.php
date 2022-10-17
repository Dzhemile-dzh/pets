<?php
namespace RP\Cache\Core\Event;

use Phalcon\Events\Event;
use Phalcon\Http\Response;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\View;
use RP\Cache\Core\Service\Cache;

/**
 * Class ViewHandler
 * Contains handlers for View events
 *
 * @package RP\Cache\Core\Event
 * @author  Serhii Atiahin <serhii.atiahin@racingpost.com>
 * @codeCoverageIgnore
 */
class ViewHandler extends Plugin
{
    /**
     * @var \RP\Cache\Core\Service\Cache
     */
    protected $cacheService = null;

    /**
     * ViewHandler constructor.
     * @param Cache $cacheService
     */
    public function __construct(Cache $cacheService)
    {
        $this->cacheService = $cacheService;
    }

    /**
     * @param Event $event
     * @param View $view
     */
    public function afterRender(Event $event, View $view)
    {
        if (empty($view->getContent())) {
            return;
        }

        $response = $this->createNewResponse()
            ->setHeaders($this->getResponse()->getHeaders())
            ->setContent($view->getContent());

        $this->cacheService->save($response);
    }

    /**
     * @return Response
     */
    protected function getResponse()
    {
        return $this->getDI()->getResponse();
    }

    /**
     * Create new response instance for view to prevent double rendering of content
     * @return Response
     */
    protected function createNewResponse()
    {
        return new Response();
    }
}
