<?php

namespace Tests\Adapter;

use Phalcon\Adapter\RedisCache;
use Phalcon\Cache\Frontend\Output;

require_once realpath(dirname(__FILE__) . '/../') . '/Stubs/Root/RedisCluster.php';

class RedisCacheTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RedisCache
     */
    private $adapter;
    /**
     * @var Output
     */
    private $frontend;

    public function setUp()
    {
        $this->frontend = new Output([
            'lifetime' => 100
        ]);
        $redisCluster = new \RedisCluster();
        $this->adapter = new RedisCache($this->frontend, $redisCluster);
    }

    public function testSaveContentFromFrontend()
    {
        $adapter = $this->adapter;
        $adapter->save('test');
        $data = $adapter->get('test');
        $this->assertEquals('', $data);
    }

    public function testExists()
    {
        $adapter = $this->adapter;
        $adapter->save('test', 'test');
        $data = $adapter->exists('test');
        $this->assertEquals(true, $data);

        $data = $adapter->exists('notExists');
        $this->assertEquals(false, $data);

        $data = $adapter->exists('');
        $this->assertEquals(false, $data);
    }

    /**
     * @param $config
     * @param $exceptionMessage
     * @dataProvider providerConnect
     */
    public function testConnect($config, $exceptionMessage)
    {
        $frontend = new Output([
            'lifetime' => 100
        ]);

        if ($exceptionMessage !== null) {
            $this->setExpectedException("\Exception", $exceptionMessage);
        }

        $adapter = new RedisCache($frontend, $config);
    }

    public function providerConnect()
    {
        return [
            [
                123,
                'Element host is not found in config array.'
            ],
            [
                [],
                'Element host is not found in config array.'
            ],
            [
                ['host' => '***'],
                'Element port is not found in config array.'
            ],
            [
                [
                    'host' => '***',
                    'port' => '***'
                ],
                'Element persistent is not found in config array.'
            ],
            [
                [
                    'host' => '***',
                    'port' => '1234',
                    'persistent' => 1
                ],
                null
            ],
        ];
    }

    /**
     * @expectedException \Exception
     */
    public function testSaveException()
    {
        $adapter = $this->adapter;
        $this->setExpectedException("\Exception", 'The cache must be started first');
        $adapter->save(null, 'asd');
    }

    /**
     * @param $data
     * @dataProvider providerStore
     */
    public function testStore($data)
    {
        $key = $data->key;
        $content = $data->content;
        $alternativeContent = $data->alternativeContent;
        $adapter = $this->adapter;

        $adapter->save($key, $content, 30);
        $data = $adapter->get($key);
        $this->assertEquals($content, $data);

        $adapter->save(null, $alternativeContent, 30);
        $data = $adapter->get($key);
        $this->assertEquals($alternativeContent, $data);

        $adapter->delete($key);

        $data = $adapter->get($key);
        $this->assertEquals(null, $data);
    }

    public function providerStore()
    {
        return [
            [
                (object)[
                    'key' => 'key',
                    'content' => 'content',
                    'alternativeContent' => 'content'
                ]
            ]
        ];
    }
}
