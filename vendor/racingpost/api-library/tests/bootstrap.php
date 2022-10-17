<?php
require realpath(__DIR__ . '/../vendor/composer/autoload.php');
$di = new \Phalcon\DI\FactoryDefault();

$di->setShared(
    \Api\Mvc\DataProvider\TemporaryTableManager::SERVICE_NAME,
    new \Api\Mvc\DataProvider\TemporaryTableManager()
);
