# Cache lifetime service

This package can be used to get predefined cache lifetime values.

## Table of contents
1. [How to install](#s-0)
2. [List of predefined lifetime values](#s-1)
3. [Usage examples](#s-2)

# <a name="s-0"></a>How to install

* Make sure you have correct `repositories` property in your `composer.json`

```json
{
    ...
    
    "repositories": [
        {
          "type": "composer",
          "url": "http://library.rp-digital.com/packages/"
        }
    ],
    
    ...
}
```
    
* Install composer component

<code>$ composer require rp/cache-lifetime</code>

## <a name="s-1"></a>List of predefined lifetime values

```
RP\Cache\LifeTime::ZERO      --> $_SERVER['CTRL_CACHE_TTL_SEC_ZERO'];
RP\Cache\LifeTime::SHORT     --> $_SERVER['CTRL_CACHE_TTL_SEC_SHORT'];
RP\Cache\LifeTime::MEDIUM    --> $_SERVER['CTRL_CACHE_TTL_SEC_MEDIUM'];
RP\Cache\LifeTime::LONG      --> $_SERVER['CTRL_CACHE_TTL_SEC_LONG'];
RP\Cache\LifeTime::NO_EXPIRE --> $_SERVER['CTRL_CACHE_TTL_SEC_NOEXPIRE'];
RP\Cache\LifeTime::PAGE_404  --> $_SERVER['CTRL_CACHE_TTL_SEC_PAGE_404'];
RP\Cache\LifeTime::PAGE_503  --> $_SERVER['CTRL_CACHE_TTL_SEC_PAGE_503'];
```

## <a name="s-2"></a>Usage examples

* Caching actions configuration example

```php
<?php

use RP\Cache\LifeTime;

$router = new Phalcon\Mvc\Router(false);

$router->add(
    '/',
    [
        'controller' => 'myController',
        'action'     => 'index',
        'cache'      => LifeTime::LONG
    ]
);

$router->add(
    "/:controller/:action/:params",
    array(
        "controller" => 1,
        "action"     => 2,
        "params"     => 3,
        "cache"      => LifeTime::SHORT,
    )
);
```

* Usage of static method `readPredefinedLifeTime` to retrieve lifetime

```php
<?php

use RP\Cache\LifeTime;

LifeTime::readPredefinedLifeTime(60);  // will return 60
LifeTime::readPredefinedLifeTime(120); // will return 120

LifeTime::readPredefinedLifeTime(LifeTime::LONG); // will return a value of CTRL_CACHE_TTL_SEC_LONG server var
LifeTime::readPredefinedLifeTime(LifeTime::ZERO); // a same for CTRL_CACHE_TTL_SEC_ZERO server var
```