<?php

declare(strict_types=1);

namespace UnitTestsComponents\ApiRouteTest;

use Api\Controller;
use Api\Input\Request;
use Api\Mvc\DataProvider\TemporaryTableManager;
use Phalcon\Di;
use Phalcon\Mvc\Router;
use PHPUnit\Framework\Exception;
use UnitTestsComponents\ApiRouteTestPrototype;
use UnitTestsComponents\Stubs\StubDataInterface;

abstract class Json extends ApiRouteTestPrototype
{
    /**
     * @param $ctrl
     * @param $obj
     */
    protected function assertContent(Controller $controller, StubDataInterface $stubData): void
    {
        $this->assertControllerResultEqualsJson($controller, $stubData);
    }

    public function getExpected(): string
    {
        $reflector = new \ReflectionClass(get_class($this));
        $file = dirname($reflector->getFileName()) . '/expected.json';
        if (!file_exists($file)) {
            throw \Exception ('File with expected data was not found. ' . $file);
        }
        return file_get_contents($file);
    }
}
