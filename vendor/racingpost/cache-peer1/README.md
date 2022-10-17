# Peer1 Cache Component

This package contains a default implementation of caching strategy for peer1 caching.

## Table of contents
1. [How to install](#s-0)
    1. [Update composer dependencies](#s-0-0)
    2. [Create cache initialization file](#s-0-1)
    3. [Update application entry point](#s-0-2)
    4. [Update application configuration](#s-0-3)
2. [Usage examples](#s-1)

# <a name="s-0"></a>How to install

## <a name="s-0-0"></a>Update composer dependencies

### file: composer.json
    
    ...

        "minimum-stability": "dev",
        "prefer-stable": true,
    
        "repositories": [
            {
                "type": "vcs",
                "url":  "ssh://git@stash.rp-dev.com:7999/api/redis-cache-adapter.git"
            },
            {
                "type": "vcs",
                "url":  "ssh://git@stash.rp-dev.com:7999/api/cache-peer1.git"
            },
            {
                "type": "composer",
                "url": "http://library.rp-digital.com/packages/"
            },
            ...
        ],
    
        ...
    
        "require": {
            ...
            
            "teamone/cache-core": ">=0.2.0",
            "teamone/util" : "dev-develop",
            "racingpost/cache-peer1": "v0.*",
            "racingpost/redis-cache-adapter": "v0.*",
        }
        
    ...

### Resolve all dependencies

<code>$ composer update</code>

## <a name="s-0-1"></a>Create cache initialization file

### file: app\config\cache.php

    <?php
    $eventsManagerHelper = new RP\Cache\EventsManager(
        new \Phalcon\Cache\Factory\Peer1CacheComponent()
    );
    
    $eventsManagerHelper->initEventsDispatcher($di->getShared('dispatcher'));
    $eventsManagerHelper->initEventsView($di->getShared('view'));
    
## <a name="s-0-2"></a>Update application entry point

### file: public\index.php

    ...

    /**
     * Setup cache
     */
    include __DIR__ . "/../lib/config/cache.php";  // Put this line after including services.php
    
    /**
     * Application init
     */
    $application = new Application($di);

    /**
     * Disable autorender
     */
    $application->useImplicitView(false); // This line is highly important

    /**
     * Handle the request
     */
    echo $application->handle()->getContent();
    
    ...

## <a name="s-0-3"></a>Update application configuration

Set new Server Variables
	
	SetEnv CTRL_CACHE_TTL_SEC_ZERO 0
    SetEnv CTRL_CACHE_TTL_SEC_SHORT 60
    SetEnv CTRL_CACHE_TTL_SEC_MEDIUM 3600
    SetEnv CTRL_CACHE_TTL_SEC_LONG 86400
    SetEnv CTRL_CACHE_TTL_SEC_NOEXPIRE 31536000
	
	SetEnv AUTH_REDIS_HOST_API_HORSES "localhost"
    SetEnv AUTH_REDIS_PORT_API_HORSES 6379
    SetEnv AUTH_REDIS_AUTHKEY_API_HORSES "racingpost"
    SetEnv CTRL_REDIS_PERSISTENT_API_HORSES 0
    SetEnv CTRL_REDIS_PACKING_API_HORSES 1
    
and restart web server

## <a name="s-0-4"></a>Add needed constants

Product key is necessary

	define("PRODUCT_KEY", 'horses_api');
	
Procuct version is optional
	
    define("PRODUCT_VERSION", '1');
    
and restart web server

# <a name="s-1"></a>Usage examples

* Set a specific cache lifetime 

```
<?php

use Phalcon\Mvc\Router;
use RP\Cache\Service\LifeTimeService as LifeTime;

// Create the router
$router = new Router();

// Define a routes
$router->add(
    "/first/index/:params",
    [
        "controller" => "first",
        "action"     => "index",
        "params"     => 1,
        "cache"      => LifeTime::SHORT   // set caching to 1 minute for this route (for beta environment)
    ]
);

$router->add(
    "/second/index/:params",
    [
        "controller" => "second",
        "action"     => "index",
        "params"     => 1,
        "cache"      => LifeTime::MEDIUM   // set caching to 1 hour for this route (for beta environment)
    ]
);

$router->add(
    "/third/index/:params",
    [
        "controller" => "second",
        "action"     => "index",
        "params"     => 1,
        "cache"      => 15   // set caching to 15 sec for this route (for beta environment)
    ]
);
```

__Note__: List of predefined lifetime values retrieves from server variables:

```
LifeTime::ZERO      --> $_SERVER['CTRL_CACHE_TTL_SEC_ZERO'];
LifeTime::SHORT     --> $_SERVER['CTRL_CACHE_TTL_SEC_SHORT'];
LifeTime::MEDIUM    --> $_SERVER['CTRL_CACHE_TTL_SEC_MEDIUM'];
LifeTime::LONG      --> $_SERVER['CTRL_CACHE_TTL_SEC_LONG'];
LifeTime::NO_EXPIRE --> $_SERVER['CTRL_CACHE_TTL_SEC_NOEXPIRE'];
```

* Set a specific GET or POST params that affects a cahce key. 
By default any parameters not described in cacheInvolvedParams section will not affect a cache key. 
```
__Note__: If cacheInvolvedParams is not described, the page index.php and index.php?asd=1 will have the same cache key and common cache.
```

```
<?php

use Phalcon\Mvc\Router;
use RP\Cache\Service\LifeTimeService as LifeTime;

// Create the router
$router = new Router();

// Define a routes
$router->add(
    "/first/index/:params",
    [
        "controller" => "first",
        "action"     => "index",
        "params"     => 1,
        "cacheInvolvedParams"      => ['firstGet', 'secondPost', 'etc']   // params as array
    ]
);

$router->add(
    "/first/index/:params",
    [
        "controller" => "first",
        "action"     => "index",
        "params"     => 1,
        "cacheInvolvedParams"      => "firstGet,secondPost,etc"   // params as string
    ]
);
```
__Note__: cacheInvolvedParams may be only flat array or comma separated string 