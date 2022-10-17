<?php

/**
 * @var \Phalcon\DI\FactoryDefault $di
 */
new RP\ContentAttributes\ApiEventsManager(
    $di->getShared('logger'),
    $di->getShared('contentAttributes'),
    new \RP\ContentAttributes\CDN\Fastly(
        $di->getShared('logger')
    )
);
