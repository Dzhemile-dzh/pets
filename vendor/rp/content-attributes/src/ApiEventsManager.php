<?php

namespace RP\ContentAttributes;

use Phalcon\Events\Event;
use Phalcon\Events\EventsAwareInterface;
use Phalcon\Events\Manager;
use Phalcon\Http\Response;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\View;
use RP\ContentAttributes\CDN\Fastly;
use RP\ContentAttributes\Element\ContentAttributes;
use Rp\Logger;

/**
 * Class EventsManager
 * @package RP\ContentAttributes
 * @author Denys Solyanyk <denys.solyanyk@racingpost.com>
 * @link https://racingpost.atlassian.net/browse/ATT-6
 */
class ApiEventsManager extends Plugin
{
    const EVENT_PREFIX_DISPATCH = 'dispatch';

    const EVENT_PRIORITY = 9999;

    /**
     * @var null|Logger
     */
    protected $logger = null;

    /**
     * @var ContentAttributes
     */
    protected $contentAttributes = null;

    /**
     * @var CDN
     */
    protected $cdn = null;

    /**
     * @var bool
     */
    protected $handled = false;

    /**
     * EventsManager constructor.
     *
     * @param Logger $logger
     * @param ContentAttributes $contentAttributes
     * @param CDN $cdn
     */
    public function __construct(Logger $logger, ContentAttributes $contentAttributes, CDN $cdn)
    {
        $this->logger = $logger;
        $this->contentAttributes = $contentAttributes;
        $this->cdn = $cdn;

        $eventsManager = $this->retrieveEventsManager($this->getDispatcher());
        $eventsManager->attach(
            self::EVENT_PREFIX_DISPATCH,
            $this,
            self::EVENT_PRIORITY
        );
    }

    /**
     * @param EventsAwareInterface $service
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
     * @return \Phalcon\Events\EventsAwareInterface
     */
    protected function getDispatcher()
    {
        return $this->getDI()->getDispatcher();
    }

    /**
     * @param Event $event
     * @param Dispatcher $dispatcher
     */
    public function afterDispatchLoop(Event $event, Dispatcher $dispatcher)
    {
        $this->run($this->getResponse());
    }

    /**
     * @param Response $response
     */
    protected function run(Response $response)
    {
        if ($this->handled) {
            return;
        }

        $this->contentAttributes->accept($this->cdn);
        $this->cdn->apply($response);

        $this->handled = true;
    }

    /**
     * @return Response
     */
    protected function getResponse()
    {
        return $this->getDI()->getResponse();
    }

    /**
     * @param Event $event
     * @param View $view
     */
    public function beforeRender(Event $event, $view)
    {
        $this->run($this->getResponse());
    }

}
