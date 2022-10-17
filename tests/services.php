<?php

$di = new \Phalcon\DI\FactoryDefault();

/**
 * Setting up Request ID component
 */
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
        //stubed class
        return new class extends \Api\Tools\Math
        {
            public static function random(?int $min = null, ?int $max = null): int
            {
                return 1;
            }
        };
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

$di->setShared(
    \Api\Mvc\DataProvider\TemporaryTableManager::SERVICE_NAME,
    new \Api\Mvc\DataProvider\TemporaryTableManager()
);

$di->setShared('contentAttributes', '\RP\ContentAttributes\Element\ContentAttributes');

include ROOT_DIR  . '/config/content-attributes.php';

include ROOT_DIR . '/config/redis.php';
