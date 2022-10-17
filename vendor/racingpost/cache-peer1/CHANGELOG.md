# Cache-Peer1 Change Log #

## 1.0.2 ##

Changed set to setEx in RedisCache to prevent erros on RedisCluster

## 1.0.1 ##

Storing keys in RedisAdapted now is atomic operation instead of 2 separate operations (set + expire).

## 1.0.0 ##

Migration to PHP 7 and PHPUnit 6.4

## 0.6.7 ##

Improved test coverage, removed excess code.

## 0.6.6 ##

Fixed bug for RedisClusterLocker when empty content was returned


## 0.6.5 ##

Rewrited RedisIndexer to avoid use any extra headers, just to call content attributes

## 0.6.4 ##

Removed extra header "Index-Keys" from response.

## 0.6.2 ##

Incresed performance RedisIndexer
Peer1CacheComponent constructor. Third param now is not neccessary

## 0.6.1 ##

RedisIndexer now provides created and expired time in UTC format and weight for ordernig inside index.
Weight have to be set in server vars in redis->weight section. For example SetEnv CTRL_REDIS_WEIGHT_API_HORSES "100"

## 0.6.0 ##

Moved Peer1Strategy to content-attributes
Added compatibility to cache-core v5.0 

## 0.5.0 ##

Removed _PHCR prefix from adapter and added to Strategy
Added Indexer for Redis

## 0.4.0 ##

Added support to core v4.0.0
Added Locker as separate class
Moved RedisCache Adapter to this repository

## 0.2.3 ##

Added **X-RP-Generated** and **X-RP-INT-RequestURL** headers.


## 0.2.0 ##

Added **CustomKeyStrategy** class, that allows to generate custom key for Redis using params.

Added **$latestBuiltKey** *static* variable in **Peer1Strategy** that allows to know latest generated key is this session.