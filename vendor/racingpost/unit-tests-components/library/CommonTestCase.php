<?php

declare(strict_types=1);

namespace UnitTestsComponents;

use Api\Controller;
use Phalcon\Db\Adapter\Sybase;
use UnitTestsComponents\Stubs\FakePdo;
use UnitTestsComponents\Stubs\StubDataInterface;

/**
 * @package UnitTestsComponents
 */
class CommonTestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @var FakePdo
     */
    private static $fakePdo = null;
    /**
     * @param StubDataInterface $stubData
     */
    public function initPseudoPdo(StubDataInterface $stubData)
    {
        if (CommonTestCase::$fakePdo === null) {
            CommonTestCase::$fakePdo = new FakePdo();
            Sybase::setCustomPdoObject(CommonTestCase::$fakePdo);
        }

        CommonTestCase::$fakePdo->clear();

        foreach ($stubData->getPseudoPdoData() as $k => $value) {
            CommonTestCase::$fakePdo->mock("SELECT * FROM {$k}", $value);
        }

        CommonTestCase::$fakePdo->setReplacements($stubData->getReplacement());
    }

    /**
     * @param Controller $controller
     * @param StubDataInterface $stubData
     */
    public function assertControllerResultEqualsJson(Controller $controller, StubDataInterface $stubData)
    {
        $result = $controller->getResult();
        
        $actual = json_decode($result->getContent());
        if (json_last_error()) {
            throw new \Exception("Actual. Could not decode json. Reason: " . json_last_error_msg());
        }
        
        $expected = json_decode($stubData->getExpected());
        if (json_last_error()) {
            throw new \Exception("Expected. Could not decode json. Reason: " . json_last_error_msg());
        }

        $this->assertEquals($expected, $actual);
    }

    /**
     * @param Controller $controller
     * @param StubDataInterface $stubData
     */
    public function assertControllerResultEqualsXml(Controller $controller, StubDataInterface $stubData)
    {
        $result = $controller->getResult();

        $actual = $result->getContent();

        $d1 = new \DOMDocument('1.0');
        $d2 = new \DOMDocument('1.0');

        $d1->preserveWhiteSpace = false;
        $d2->preserveWhiteSpace = false;

        $d1->formatOutput = true;
        $d2->formatOutput = true;

        $d1->loadXML($actual);
        $d2->loadXML($stubData->getExpected());

        $actual = $d1->saveXML();
        $expected = $d2->saveXML();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @param string $originalClassName
     * @param array|null $methods
     * @param array $constructorArguments
     * @param string $mockClassName
     * @param bool $callOriginalConstructor
     * @param bool $callOriginalClone
     * @param bool $callAutoload
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getMock(
        string $originalClassName,
        ?array $methods,
        array $constructorArguments = [],
        string $mockClassName = '',
        bool $callOriginalConstructor = true,
        $callOriginalClone = true,
        $callAutoload = true
    ) {
        $mockBuilder = $this->getMockBuilder($originalClassName)
            ->setMethods($methods)
            ->setConstructorArgs($constructorArguments)
            ->setMockClassName($mockClassName);

        if (!$callOriginalConstructor) {
            $mockBuilder->disableOriginalConstructor();
        }

        if (!$callOriginalClone) {
            $mockBuilder->disableOriginalClone();
        }

        if (!$callAutoload) {
            $mockBuilder->disableAutoload();
        }

        return $mockBuilder->getMock();
    }
}