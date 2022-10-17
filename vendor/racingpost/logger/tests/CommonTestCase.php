<?php

declare(strict_types=1);

namespace Tests;

/**
 * Class CommonTestCase
 * @package Tests
 */
class CommonTestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @param string $expectedException
     */
    public function setExpectedException(string $expectedException)
    {
        $this->expectException($expectedException);
    }

    /**
     * @param string $originalClassName
     * @param array|null $methods
     * @param array $constructorArguments
     * @param string $mockClassName
     * @param bool $callOriginalConstructor
     * @param bool $callOriginalClone
     * @param bool $callAutoload
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getMock(
        string $originalClassName,
        ?array $methods,
        array $constructorArguments,
        string $mockClassName,
        bool $callOriginalConstructor = true,
        $callOriginalClone = true,
        $callAutoload = true
    )
    {
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
