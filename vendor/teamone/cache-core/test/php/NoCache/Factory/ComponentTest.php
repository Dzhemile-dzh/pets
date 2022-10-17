<?php
namespace RP\Test\Cache\Core\NoCache\Factory;

/**
 * Class ComponentTest
 * @package RP\Test\Cache\Core\NoCache\Factory
 */
class ComponentTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \RP\Cache\Core\NoCache\Factory\Component
     */
    protected $sut;

    public function setUp()
    {
        $this->sut = $this->getMockBuilder('RP\Cache\Core\NoCache\Factory\Component')
            ->disableOriginalConstructor()
            ->setMethods(null)
            ->getMock();
    }

    /**
     * @test
     */
    public function createAdapter()
    {
        $this->assertInstanceOf('\RP\Cache\Core\NoCache\Adapter\Dummy', $this->sut->createAdapter());
    }

    /**
     * @test
     */
    public function getKey()
    {
        $this->assertEquals('', $this->sut->getKey());
    }

    /**
     * @test
     */
    public function createResponseDTO()
    {
        $this->assertNull($this->sut->createResponseDTO());
    }

    /**
     * @test
     */
    public function createIndexer()
    {
        $this->assertInstanceOf('\RP\Cache\Core\NoCache\Indexer\Dummy', $this->sut->createIndexer());
    }

    /**
     * @test
     */
    public function createLocker()
    {
        $this->assertInstanceOf('\RP\Cache\Core\NoCache\Locker\Dummy', $this->sut->createLocker());
    }
}