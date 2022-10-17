<?php

declare(strict_types=1);

namespace UnitTestsComponents;

use Api\Controller;
use Api\Input\Request;
use Api\Mvc\DataProvider\TemporaryTableManager;
use Phalcon\Di;
use Phalcon\Mvc\Router;
use PHPUnit\Framework\Exception;
use UnitTestsComponents\Stubs\StubDataInterface;

abstract class ApiRouteTestPrototype extends CommonTestCase implements StubDataInterface
{
    abstract function getRoute(): string;

    /**
     * @return Router
     */
    private function getRouter(): Router
    {
        return $this->getDI()->getShared('router');
    }

    /**
     * Test runner function. It's a main method that allows to execute test in childs.
     * @group route
     */
    public function testRoute(): void
    {
        try {
            $router = $this->getRouter();
            $route = $this->getRoute();
            $uri = parse_url($route);
            $queryParams = [];

            if (isset($uri['query'])) {
                parse_str($uri['query'], $queryParams);
            }

            $router->handle($uri['path']);
            $controller = $router->getControllerName();
            $action = $router->getActionName();
            $routeParams = $router->getParams();

            if ($controller === null) {
                throw new Exception('Controller is not found in Router for route ' . $route);
            }

            if (!method_exists($controller, $action)) {
                throw new Exception("Action {$action} is not found in controller {$controller}");
            }

            $request = $this->buildRequest($routeParams, $queryParams);

            $this->initPseudoPdo($this);

            $ctrl = new $controller();
            $ctrl->{$action}($request);
            $this->assertContent($ctrl, $this);
        } catch (\Throwable $t) {
            throw $t;
        } finally {
            $this->cleanTmpTables();
        }
    }

    /**
     * @param $ctrl
     * @param $obj
     */
    abstract protected function assertContent(Controller $controller, StubDataInterface $stubData): void;

    /**
     * @return \Phalcon\DiInterface
     */
    private function getDI()
    {
        return Di::getDefault();
    }

    /**
     * @param array $routeParams
     * @param array $queryParams
     *
     * @return Request
     */
    private function buildRequest(array $routeParams, array $queryParams): Request
    {
        if (!isset($routeParams['request'])) {
            throw new Exception('Parameter request is not found in Router for route ' . $this->getRoute());
        }

        $namedParams = [];
        $orderedParams = [];

        foreach ($routeParams as $k => $value) {
            if (is_numeric($k)) {
                $orderedParams[] = $value;
            } else {
                $namedParams[$k] = $value;
            }
        }

        $namedParams = array_merge($namedParams, $queryParams);
        return new $routeParams['request']($orderedParams, $namedParams);
    }

    /**
     * @return array
     */
    public function getReplacement(): array
    {
        return [];
    }

    /**
     * clean method
     */
    private function cleanTmpTables(): void
    {
        $di = $this->getDI();
        if ($di->has(TemporaryTableManager::SERVICE_NAME)) {
            $manager = $di->getShared(TemporaryTableManager::SERVICE_NAME);

            if ($manager instanceof TemporaryTableManager) {
                $manager->clear();
            }
        }
    }
}
