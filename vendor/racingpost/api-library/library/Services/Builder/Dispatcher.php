<?php

namespace Api\Services\Builder;

class Dispatcher
{
    /**
     * @param \Phalcon\DI $di
     *
     * @return \Phalcon\Mvc\Dispatcher
     */
    public function build(\Phalcon\DI $di)
    {
        $eventsManager = new \Phalcon\Events\Manager();
        $eventsManager->enablePriorities(true);

        $eventsManager->attach("dispatch", new DispatcherHandler(), 1000);

        $dispatcher = new \Phalcon\Mvc\Dispatcher();
        $dispatcher->setControllerSuffix('');
        $dispatcher->setActionSuffix('');
        $dispatcher->setEventsManager($eventsManager);

        return $dispatcher;
    }
}
