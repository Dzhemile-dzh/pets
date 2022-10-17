<?php

$cacheOn = false;
$config = $di->getShared('config');
if ($config->offsetExists('redis')) {
    $cacheOn = (bool)$config->get('redis')->get('cacheon', 0);
}

$cacheConfig = $config->get('redis', null);
$clusterConfig = ($cacheConfig !== null) ? $cacheConfig->get('cluster', null) : null;

if ($clusterConfig !== null) {
    $logger = $di->get('logger');
    $cluster = explode(';', $clusterConfig);

    try {
        $redis = new \RedisCluster('racingpost', $cluster);
        $di->setShared('redis', $redis);
    } catch (\RedisClusterException $e) {
        $logger->error('Redis error: ' . $e->getMessage());
        $cacheOn = false;
    }
} else {
    $cacheOn = false;
}

if ($cacheOn) {
    /**@var $contentAttributes \RP\ContentAttributes\Element\ContentAttributes*/
    $eventsManagerHelper = new RP\Cache\Core\EventsManager(
        new \Phalcon\Cache\Factory\Peer1CacheComponent($redis, $di->getShared('contentAttributes'), $config),
        $di->getDispatcher(),
        null
    );
}
