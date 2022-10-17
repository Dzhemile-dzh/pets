<?php

namespace Phalcon\Cache\Indexer;

use Phalcon\Http\Response;
use RP\Cache\Core\Indexer\IndexerInterface;
use RP\ContentAttributes\Element\ContentAttributes;

class RedisIndexer implements IndexerInterface
{
    const HEADER_INDEXES = 'Index-Keys';
    const INDX_PREFIX = 'CONTENT_ATTR_IDX';
    /**
     * @var \RedisCluster
     */
    private $redis;
    private $weight;
    private $contentAttributes;

    public function __construct(\RedisCluster $redis, ContentAttributes $ca, $weight = 0)
    {
        $this->redis = $redis;
        $this->weight = $weight;
        $this->contentAttributes = $ca;
    }

    public function save($key, Response $response)
    {
        $indexes = $this->contentAttributes->tags()->buildIndexes();
        $tags = $this->parseTags($indexes);
        $this->storeIndexes($tags, $key);
    }

    /**
     * @param $tags
     * @return array
     */
    private function parseTags($tags)
    {
        $tags = explode(' ', $tags);
        return array_filter($tags, function ($val) {
            return !empty($val);
        });
    }

    private function storeIndexes($tags, $key)
    {
        $redis = $this->redis;

        $ttl = $redis->ttl($key);

        if ($ttl == 0 || $ttl == -2) {
            return;
        }


        $mainIdxValues = [];

        foreach ($tags as $tag) {
            $idxName = self::INDX_PREFIX . '_' . strtoupper($tag);
            $mainIdxValues[] = $idxName;

            $json = json_encode([
                'weight' => $this->weight,
                'created' => (new \DateTime(null, new \DateTimeZone('UTC')))
                    ->format('Y-m-d\TH:i:sP'),
                'expired' => (new \DateTime(null, new \DateTimeZone('UTC')))
                    ->add(new \DateInterval("PT{$ttl}S"))->format('Y-m-d\TH:i:sP'),
            ]);
            $redis->hSet($idxName, $key, $json);
        }

        $this->addToMainIdx($mainIdxValues);
    }

    private function addToMainIdx($mainIdxValues)
    {
        $mainIdxName = self::INDX_PREFIX . 'S';
        array_unshift($mainIdxValues, $mainIdxName);

        if (!empty($mainIdxValues)) {
            //@todo refactor this to ... in PHP 7.0
            $refl = new \ReflectionMethod($this->redis, 'sAdd');
            $refl->invokeArgs($this->redis, $mainIdxValues);
        }
    }
}
