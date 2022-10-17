<?php

$di = new \Phalcon\DI\FactoryDefault();

/**
 * Setting up Request ID component
 */
$di->setShared('requestTag', new RP\RequestTag());

$di->setShared('config', new \Api\Config('_', '_API_HORSES'));

$di->setShared('environment', array(
    'className' => '\Phalcon\Config\Environment',
    'arguments' => [
        ['type' => 'service', 'name' => 'request']
    ]
));

$di->setShared('profiler', new \Phalcon\Db\ExtendedProfiler());
$di->setShared('logger', new \Rp\Logger(
    $di->getConfig()->getLoggerConfig()
    + ['tag' => $di->getShared('requestTag')->getValue()]
));

$di->setShared('db', function () use ($di) {
    return (new \Api\Services\Builder\Db())->build($di);
});

$di->setShared('router', function () {
    $router = new \Phalcon\Mvc\Router(false);
    (new \Config\Router())->apply($router);
    return $router;
});

$di->setShared('exceptions', new \Api\Exception\ExceptionsList());

$di->setShared('dispatcher', (new \Api\Services\Builder\Dispatcher())->build($di));

$di->setShared(
    'math',
    function () {
        return new \Api\Tools\Math();
    }
);

$di->setShared('selectors', function () {

    $core = new \Models\Selectors();
    $distance = new \Models\Bo\Selectors\Distance();
    $db = new \Models\Bo\Selectors\Database();

    $core->setDistance($distance);
    $core->setDb($db);

    return $core;
});

$di->setShared('contentAttributes', '\RP\ContentAttributes\Element\ContentAttributes');

$di->setShared(
    \Api\Mvc\DataProvider\TemporaryTableManager::SERVICE_NAME,
    new \Api\Mvc\DataProvider\TemporaryTableManager()
);

# APM Tracer
$di->setShared('tracer', new Api\Tracer\Tracer());

include __DIR__  . '/content-attributes.php';

include __DIR__ . '/redis.php';
