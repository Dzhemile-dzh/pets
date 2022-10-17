<?php
namespace RP\Cache\Core;

use Phalcon\Http\Response;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\View;

/**
 * Class Response
 * Build Response object for caching
 *
 * @package RP\Cache\Core
 * @author  Serhii Atiahin <serhii.atiahin@racingpost.com>
 */
class ResponseBuilder
{
    /**
     * @var \Phalcon\Mvc\Dispatcher
     */
    protected $dispatcher;

    /**
     * @var \Phalcon\Http\Response
     */
    protected $response;

    /**
     * @var View|null
     */
    protected $view = null;

    /**
     * ResponseBuilder constructor.
     * @param Dispatcher $dispatcher
     * @param Response $response
     * @param View|null $view
     */
    public function __construct(Dispatcher $dispatcher, Response $response, View $view = null)
    {
        $this->dispatcher = $dispatcher;
        $this->response = $response;
        $this->view = $view;

        $this->buildResponse();
    }

    /**
     * Build response content
     */
    protected function buildResponse()
    {
        $content = $this->response->getContent();

        if (is_null($content)) {
            $content = $this->getReturnedValue();
        }

        if (is_null($content) && !is_null($this->view)) {
            $this->renderView();
            return;
        }

        if ($content instanceof Response) {
            $this->response = $content;
        } else {
            $this->response->setContent($content);
        }
    }

    /**
     * @return object|\Phalcon\Http\Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Get content directly from Dispatcher
     *
     * @return mixed
     */
    protected function getReturnedValue()
    {
        return $this->dispatcher->getReturnedValue();
    }

    /**
     * Get content of rendered view
     * Run rendering of view if not rendered in the controller
     * @return string
     */
    protected function renderView()
    {
        $content = $this->view->getContent();
        $controller = $this->view->getControllerName();
        if (empty($content) && empty($controller)) {
            $this->view->start();
            $this->view->render($this->dispatcher->getControllerName(), $this->dispatcher->getActionName());
            $this->view->finish();
        }

        return $this->view->getContent();
    }
}
