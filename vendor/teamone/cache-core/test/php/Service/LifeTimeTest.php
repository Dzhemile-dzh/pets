<?php
namespace RP\Test\Cache\Core\Service;

/**
 * Class LifeTimeTest
 * @package RP\Test\Cache\Core\Service
 */
class LifeTimeTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function getCacheLifeTimeSecondsNullRouter()
    {
        $sut = $this->getMockBuilder('RP\Cache\Core\Service\LifeTime')
            ->disableOriginalConstructor()
            ->setMethods(['getLifetime'])
            ->getMock();

        $sut->expects($this->once())
            ->method('getLifetime')
            ->willReturn(200);

        $this->setProtectedProperty($sut, 'router', null);

        $this->assertEquals(200, $sut->getCacheLifeTimeSeconds());
    }

    /**
     * @test
     */
    public function getCacheLifeTimeSecondsNotExistRouterParameter()
    {
        $routerMock = $this->getMockBuilder('stdClass')
            ->disableOriginalConstructor()
            ->setMethods(['getParams'])
            ->getMock();

        $routerMock->expects($this->once())
            ->method('getParams')
            ->willReturn([]);

        $sut = $this->getMockBuilder('RP\Cache\Core\Service\LifeTime')
            ->disableOriginalConstructor()
            ->setMethods(['getLifetime'])
            ->getMock();

        $sut->expects($this->once())
            ->method('getLifetime')
            ->willReturn(200);

        $this->setProtectedProperty($sut, 'router', $routerMock);

        $this->assertEquals(200, $sut->getCacheLifeTimeSeconds());
    }

    /**
     * @test
     */
    public function getCacheLifeTimeSeconds()
    {
        $routerMock = $this->getMockBuilder('stdClass')
            ->disableOriginalConstructor()
            ->setMethods(['getParams'])
            ->getMock();

        $routerMock->expects($this->once())
            ->method('getParams')
            ->willReturn(['cache' => 100]);

        $sut = $this->getMockBuilder('RP\Cache\Core\Service\LifeTime')
            ->disableOriginalConstructor()
            ->setMethods(['getPredefinedLifetime'])
            ->getMock();

        $sut->expects($this->once())
            ->method('getPredefinedLifetime')
            ->willReturn(300);

        $this->setProtectedProperty($sut, 'router', $routerMock);

        $this->assertEquals(300, $sut->getCacheLifeTimeSeconds());
    }

    /**
     * Sets a protected property on a given object via reflection
     *
     * @param $object - instance in which protected value is being modified
     * @param $property - property on instance being modified
     * @param $value - new value of the property being modified
     *
     * @return void
     */
    public function setProtectedProperty($object, $property, $value)
    {
        $reflection = new \ReflectionClass($object);
        $reflection_property = $reflection->getProperty($property);
        $reflection_property->setAccessible(true);
        $reflection_property->setValue($object, $value);
    }
}