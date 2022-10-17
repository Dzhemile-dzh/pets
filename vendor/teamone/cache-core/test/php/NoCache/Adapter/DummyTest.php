<?php
namespace RP\Test\Cache\Core\NoCache\Adapter;

/**
 * Class DummyTest
 * @package RP\Test\Cache\Core\NoCache\Adapter
 */
class DummyTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \RP\Cache\Core\NoCache\Adapter\Dummy
     */
    protected $sut;

    public function setUp()
    {
        $this->sut = $this->getMockBuilder('RP\Cache\Core\NoCache\Adapter\Dummy')
            ->disableOriginalConstructor()
            ->setMethods(null)
            ->getMock();
    }

    /**
     * @test
     */
    public function get()
    {
        $this->assertNull($this->sut->get('key', 0));
    }

    /**
     * @test
     */
    public function save()
    {
        $this->assertNull($this->sut->save('key', 'content', 0, null));
    }

    /**
     * @test
     */
    public function delete()
    {
        $this->assertTrue($this->sut->delete('key'));
    }

    /**
     * @test
     */
    public function queryKeys()
    {
        $this->assertEquals([], $this->sut->queryKeys('prefix'));
    }

    /**
     * @test
     */
    public function exists()
    {
        $this->assertFalse($this->sut->exists('key', 0));
    }

    /**
     * @test
     */
    public function flush()
    {
        $this->assertTrue($this->sut->flush());
    }
}