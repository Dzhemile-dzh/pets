<?php

namespace Phalcon\Cache\Locker;

use RP\Cache\Core\Locker\LockerInterface;

class RedisClusterLocker implements LockerInterface
{
    const WAITING_STEP_MILLISECONDS = 25;
    const MAX_STEP_MILLISECONDS = 1000;

    private $redis;
    private $lockKey = null;
    private $lockValue = null;
    private $lockedTimeMilliseconds = 30000;


    public function __construct(\RedisCluster $redis)
    {
        $this->redis = $redis;

        register_shutdown_function([$this, 'unlock']);

        $time = ini_get_all();
        if (isset($time['max_execution_time'])) {
            $time = $time['max_execution_time']['global_value'];
        }

        if (is_numeric($time)) {
            $this->lockedTimeMilliseconds += $time * 1000;
        }
    }

    /**
     * @param string $content
     * @param string $keyName
     * @throws \Exception
     * @internal param string $key
     */
    public function lock(&$content, $keyName)
    {
        if ($content !== null) {
            return;
        } else {
            /* init $this->lockKey and $this->lockValue by values */
            $this->generateLockData($keyName);

            if ($this->lockedSave($this->lockKey, $this->lockValue, $this->lockedTimeMilliseconds)) {
                $content = null;
                return;
            } else {
                $lockedTime = $this->lockedTimeMilliseconds;
                $step = self::WAITING_STEP_MILLISECONDS;

                while ($lockedTime > 0) {
                    $sleep = ($lockedTime > $step) ? $step : $lockedTime;
                    usleep($sleep * 1000);

                    $content = $this->redis->get($keyName);

                    if ($content !== null && $content !== false) {
                        return;
                    } elseif ($this->lockedSave($this->lockKey, $this->lockValue, $this->lockedTimeMilliseconds)) {//if any script locked the key but die unexpectedly
                        $content = null;
                        return;
                    }
                    $lockedTime -= $step;
                    if ($step < self::MAX_STEP_MILLISECONDS) {
                        $step += $step;
                    } else {
                        $step = self::MAX_STEP_MILLISECONDS;
                    }
                }
                throw new \Exception("Unable to obtain neither lock nor cache within {$this->lockedTimeMilliseconds} milliseconds.");
            }
        }
    }

    /**
     * @return void
     */
    public function unlock()
    {
        if ($this->lockKey !== null) {
            $this->releaseLock($this->lockKey, $this->lockValue);
        }
    }

    private function generateLockData($keyName)
    {
        $this->lockKey = 'LOCK_' . $keyName;
        $this->lockValue = uniqid();
    }

    private function lockedSave($key = null, $value = null, $lifetimeMilliseconds = null)
    {
        $redis = $this->redis;
        return (boolean)$redis->set($key, $value, ['px' => $lifetimeMilliseconds, 'nx']);
    }

    private function releaseLock($key, $value)
    {
        $script = '
			if redis.call("GET", KEYS[1]) == ARGV[1] then
				return redis.call("DEL", KEYS[1])
			else
				return 0
			end
		';
        return $this->redis->eval($script, [$key, $value], 1);
    }
}
