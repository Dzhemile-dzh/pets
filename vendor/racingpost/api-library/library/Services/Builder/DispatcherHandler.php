<?php

namespace Api\Services\Builder;

class DispatcherHandler
{
    public function beforeException($event, $dispatcher, $exception)
    {
        throw $exception;
    }

    public function beforeDispatchLoop($event, $dispatcher)
    {
        $inputRequest = null;
        $inputRequestNamedParams = [];
        $inputRequestOrderedParams = [];

        $this->checkAction($dispatcher);

        $inputRequestClass = $this->getRequestClass($dispatcher);

        //build arrays with named and ordered parameters
        parse_str($dispatcher->getDI()->getRequest()->getRawBody(), $inputRequestNamedParams);
        $inputRequestNamedParams = array_merge(
            $inputRequestNamedParams,
            $dispatcher->getDI()->getRequest()->get()
        );

        $this->validateUrl($inputRequestNamedParams['_url']);
        unset($inputRequestNamedParams['_url']);

        foreach ($dispatcher->getParams() as $key => $value) {
            if (is_string($key)) {
                $inputRequestNamedParams[$key] = $value;
            } else {
                $inputRequestOrderedParams[] = $value;
            }
        }

        $dispatcher->setParams([new $inputRequestClass($inputRequestOrderedParams, $inputRequestNamedParams)]);
    }

    private function checkAction($dispatcher)
    {
        if ($this->isActionAndControllerExists($dispatcher)) {
            return;
        }

        //update action name for default router
        if ($dispatcher->getActionName() && preg_match('/[A-Z]/', $dispatcher->getActionName()) === 0) {
            $dispatcher->setActionName(
                "action"
                . ucfirst(strtolower($dispatcher->getDi()->getShared("request")->getMethod()))
                . \Phalcon\Text::camelize($dispatcher->getActionName())
            );
        }

        //check if controller and action exists
        if (!$this->isActionAndControllerExists($dispatcher)) {
            throw new \Api\Exception\NotFound(404);
        }
    }

    private function isActionAndControllerExists($dispatcher)
    {
        return !(!$dispatcher->getActionName()
            || !$dispatcher->getControllerName()
            || !class_exists($dispatcher->getControllerName())
            || !in_array($dispatcher->getActionName(), get_class_methods($dispatcher->getControllerName()))
        );
    }

    private function getRequestClass($dispatcher)
    {
        if (isset($dispatcher->getParams()['request'])) {
            $rtn = $dispatcher->getParams()['request'];
            if (class_exists($rtn)) {
                return $rtn;
            } else {
                throw new \Exception(
                    "Request class {$rtn} specified in a Router but is not found."
                );
            }
        }

        //Make class name for input request
        $inputRequestClass = str_replace('Controllers', 'Api\Input\Request', $dispatcher->getControllerName());
        $inputRequestClass .= '\\' . str_replace('action', '', $dispatcher->getActionName());

        if (class_exists($inputRequestClass)) {
            return $inputRequestClass;
        } elseif (class_exists($inputRequestClass . 'Request')) {
            return $inputRequestClass = $inputRequestClass . 'Request';
        }

        //Make class name for input request
        $inputRequestClass = str_replace('Controllers', 'Api\Input\Request', $dispatcher->getControllerName());
        $inputRequestClass .= '\\' . str_replace(
            ['actionGet', 'actionPost', 'actionPut', 'actionDelete'],
            [],
            $dispatcher->getActionName()
        );

        if (!class_exists($inputRequestClass)) {
            if (class_exists($inputRequestClass . 'Request')) {
                return $inputRequestClass = $inputRequestClass . 'Request';
            } else {
                throw new \Exception(
                    "Request class {$inputRequestClass} or {$inputRequestClass}Request not found"
                );
            }
        }

        return $inputRequestClass;
    }

    /**
     * @param string $url
     *
     * @throws \Api\Exception\NotFound
     */
    private function validateUrl($url)
    {
        if ($url[strlen($url) - 1] === '/' || strpos($url, '/?') !== false) {
            throw new \Api\Exception\NotFound(452);
        }
    }
}
