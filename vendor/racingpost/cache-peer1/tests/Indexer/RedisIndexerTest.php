<?php

namespace Tests\Adapter;

require_once realpath(dirname(__FILE__) . '/../') . '/Stubs/Root/RedisCluster.php';

use Phalcon\Cache\Indexer\RedisIndexer;
use Phalcon\Http\Response;
use RP\ContentAttributes\Element\ContentAttributes;

class RedisIndexerTest extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        \Mockery::close();
    }

    /**
     * @param $key
     * @param Response $response
     * @dataProvider providerSave
     */
    public function testSkipSave($key, \RedisCluster $redis, ContentAttributes $ca, Response $response)
    {
        $redisSpy = \Mockery::spy($redis);
        $caSpy = \Mockery::spy($ca);

        $indexer = new RedisIndexer($redisSpy, $caSpy);
        $indexer->save($key, $response);


        $caSpy->shouldHaveReceived("tags")->times(1);
        $redisSpy->shouldHaveReceived("ttl")->times(1);
        $redisSpy->shouldNotHaveReceived("hSet");
        $redisSpy->shouldNotHaveReceived("sAdd");
    }

    /**
     * @param $key
     * @param Response $response
     * @dataProvider providerSave
     */
    public function testSave($key, \RedisCluster $redis, ContentAttributes $ca, Response $response, $expected)
    {
        $redis->set($key, '111', 1);
        $redisSpy = \Mockery::spy($redis);
        $caSpy = \Mockery::spy($ca);

        $indexer = new RedisIndexer($redisSpy, $caSpy);
        $indexer->save($key, $response);

        $caSpy->shouldHaveReceived("tags")->times(1);
        $redisSpy->shouldHaveReceived("ttl")->times(1);
        $redisSpy->shouldHaveReceived("hSet")->times(2);
        $redisSpy->shouldHaveReceived("sAdd")->times(1);

        $actual = $redis->hGet();
        $this->clearDate($actual);
        $this->clearDate($expected);
        $this->assertEquals($expected, $actual);
    }

    public function providerSave()
    {
        $redis = new \RedisCluster();

        $ca = new ContentAttributes();
        $ca->tags()->addHorse(111);

        $response = new Response();
        $response->setContent('test');

        return [
            [
                'http://api.v/horses/racecards/verdict/674720#2',
                $redis,
                $ca,
                $response,
                [
                    'CONTENT_ATTR_IDX_HR111' => [
                        'http://api.v/horses/racecards/verdict/674720#2' => '{"weight":0,"created":"0000-00-00T00:00:00+00:00","expired":"0000-00-00T00:00:00+00:00"}'
                    ],
                    'CONTENT_ATTR_IDX_UNKNOWN' => [
                        'http://api.v/horses/racecards/verdict/674720#2' => '{"weight":0,"created":"0000-00-00T00:00:00+00:00","expired":"0000-00-00T00:00:00+00:00"}'
                    ]
                ]
            ]
        ];
    }

    private function clearDate(&$data)
    {
        if (is_array($data)) {
            foreach ($data as &$val) {
                $this->clearDate($val);
            }
        } elseif (is_string($data)) {
            $data = preg_replace("|\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}|", "0000-00-00T00:00:00", $data);
        } else {
            throw new \Exception('Incorrect type');
        }
    }
}
