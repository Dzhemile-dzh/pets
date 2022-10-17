<?php

/**
 * Class RedisCluster
 * @method eval
 */
class RedisCluster
{
    /**
     * @var null Temp property for multithread sharing
     */
    public $setContent = null;
    private $lastLock;
    private $data = [];
    private $sets = [];

    public function __call($name, $arguments)
    {
        if ($name == 'eval') {
            return call_user_func_array([$this, 'evalQuoted'], $arguments);
        }
    }

    public function evalQuoted($script, $args = [], $numKeys = null)
    {
        $this->lastLock = null;
    }

    public function close()
    {
    }

    /**
     * @param string $key
     * @return string
     */
    public function get($key)
    {

        if ($this->setContent !== null) {
            $tmp = $this->setContent;
            $this->setContent = null;
            return $tmp;
        }

        if (isset($this->data[$key])) {
            return $this->data[$key];
        } else {
            return null;
        }
    }

    /**
     * @param $key string
     * @param $value string
     * @param $mixed mixed
     * @return bool
     */
    public function set($key, $value, $mixed = null)
    {
        if (isset($mixed['px'])) {
            if ($this->lastLock !== null) {
                return false;
            } else {
                $this->lastLock = $key;
            }
        }
        $this->data[$key] = $value;
        return true;
    }

    public function mget()
    {
    }

    public function mset()
    {
    }

    public function msetnx()
    {
    }

    public function del($key)
    {
        if (isset($this->data[$key])) {
            unset($this->data[$key]);
            return true;
        } else {
            return false;
        }
    }

    public function setex()
    {
    }

    public function psetex()
    {
    }

    public function setnx()
    {
    }

    public function getset()
    {
    }

    public function exists()
    {
    }

    public function keys()
    {
    }

    public function type()
    {
    }

    public function lpop()
    {
    }

    public function rpop()
    {
    }

    public function lset()
    {
    }

    public function spop()
    {
    }

    public function lpush()
    {
    }

    public function rpush()
    {
    }

    public function blpop()
    {
    }

    public function brpop()
    {
    }

    public function rpushx()
    {
    }

    public function lpushx()
    {
    }

    public function linsert()
    {
    }

    public function lindex()
    {
    }

    public function lrem()
    {
    }

    public function brpoplpush()
    {
    }

    public function rpoplpush()
    {
    }

    public function llen()
    {
    }

    public function scard()
    {
    }

    public function smembers()
    {
    }

    public function sismember()
    {
    }

    public function sAdd()
    {
    }

    public function srem()
    {
    }

    public function sunion()
    {
    }

    public function sunionstore()
    {
    }

    public function sinter()
    {
    }

    public function sinterstore()
    {
    }

    public function sdiff()
    {
    }

    public function sdiffstore()
    {
    }

    public function srandmember()
    {
    }

    public function strlen()
    {
    }

    public function persist()
    {
    }

    public function ttl($key)
    {
        return ($this->get($key) !== null) ? 1 : -2;
    }

    public function pttl()
    {
    }

    public function zcard()
    {
    }

    public function zcount()
    {
    }

    public function zremrangebyscore()
    {
    }

    public function zscore()
    {
    }

    public function zadd()
    {
    }

    public function zincrby()
    {
    }

    public function hlen()
    {
    }

    public function hkeys()
    {
    }

    public function hvals()
    {
    }

    public function hGet($key = null)
    {
        if (isset($this->sets[$key])) {
            return $this->sets[$key];
        } elseif ($key === null) {
            return $this->sets;
        } else {
            return null;
        }
    }

    public function hgetall()
    {
    }

    public function hexists()
    {
    }

    public function hincrby()
    {
    }

    public function hSet($idxName, $key, $data)
    {
        $this->sets[$idxName] = [
            $key => $data
        ];
    }

    public function hsetnx()
    {
    }

    public function hmget()
    {
    }

    public function hmset()
    {
    }

    public function hdel()
    {
    }

    public function hincrbyfloat()
    {
    }

    public function dump()
    {
    }

    public function zrank()
    {
    }

    public function zrevrank()
    {
    }

    public function incr()
    {
    }

    public function decr()
    {
    }

    public function incrby()
    {
    }

    public function decrby()
    {
    }

    public function incrbyfloat()
    {
    }

    public function expire()
    {
    }

    public function pexpire()
    {
    }

    public function expireat()
    {
    }

    public function pexpireat()
    {
    }

    /**
     * @param $key string
     * @param $value2 string
     * @return int
     */
    public function append($key, $value2)
    {
    }

    public function getbit()
    {
    }

    public function setbit()
    {
    }

    public function bitop()
    {
    }

    public function bitpos()
    {
    }

    public function bitcount()
    {
    }

    public function lget()
    {
    }

    public function getrange()
    {
    }

    public function ltrim()
    {
    }

    public function lrange()
    {
    }

    public function zremrangebyrank()
    {
    }

    public function publish()
    {
    }

    public function rename()
    {
    }

    public function renamenx()
    {
    }

    public function pfcount()
    {
    }

    public function pfadd()
    {
    }

    public function pfmerge()
    {
    }

    public function setrange()
    {
    }

    public function restore()
    {
    }

    public function smove()
    {
    }

    public function zrange()
    {
    }

    public function zrevrange()
    {
    }

    public function zrangebyscore()
    {
    }

    public function zrevrangebyscore()
    {
    }

    public function zrangebylex()
    {
    }

    public function zrevrangebylex()
    {
    }

    public function zlexcount()
    {
    }

    public function zremrangebylex()
    {
    }

    public function zunionstore()
    {
    }

    public function zinterstore()
    {
    }

    public function zrem()
    {
    }

    public function sort()
    {
    }

    public function object()
    {
    }

    public function subscribe()
    {
    }

    public function psubscribe()
    {
    }

    public function unsubscribe()
    {
    }

    public function punsubscribe()
    {
    }

    /**
     * @param $script
     * @param array $args
     * @param int $numKeys
     * @return mixed
     */
    public function evalsha()
    {
    }

    public function scan($i_iterator, $str_node, $str_pattern, $i_count)
    {
    }

    public function sscan($str_key, $i_iterator, $str_pattern, $i_count)
    {
    }

    public function zscan($str_key, $i_iterator, $str_pattern, $i_count)
    {
    }

    public function hscan($str_key, $i_iterator, $str_pattern, $i_count)
    {
    }

    public function getmode()
    {
    }

    public function getlasterror()
    {
    }

    public function clearlasterror()
    {
    }

    public function getoption()
    {
    }

    public function setoption()
    {
    }

    public function _prefix()
    {
    }

    public function _serialize()
    {
    }

    public function _unserialize()
    {
    }

    public function _masters()
    {
    }

    public function _redir()
    {
    }

    public function multi()
    {
    }

    public function exec()
    {
    }

    public function discard()
    {
    }

    public function watch()
    {
    }

    public function unwatch()
    {
    }

    public function save()
    {
    }

    public function bgsave()
    {
    }

    public function flushdb()
    {
    }

    public function flushall()
    {
    }

    public function dbsize()
    {
    }

    public function bgrewriteaof()
    {
    }

    public function lastsave()
    {
    }

    public function info()
    {
    }

    public function role()
    {
    }

    public function time()
    {
    }

    public function randomkey()
    {
    }

    public function ping()
    {
    }

    public function command()
    {
    }

    public function rawcommand()
    {
    }

    public function cluster()
    {
    }

    public function client()
    {
    }

    public function config()
    {
    }

    public function pubsub()
    {
    }

    public function script()
    {
    }

    public function slowlog()
    {
    }
}
