<?php

namespace ApiStatus;

use Phalcon\Config;

/**
 * Class Status
 * @package ApiStatus
 */
abstract class Status implements \SplSubject
{
    const HEALTHY_FLAG_FOR_EMPTY_RESULT = false;
    /**
     * @var Config
     */
    private $config;

    /**
     * @var array
     */
    protected $statuses = [];

    /**
     * @var callable
     */
    private $callable;

    /**
     * @var \SplObjectStorage
     */
    private $storage;

    /**
     * @return array|null
     */
    abstract protected function obtainStatuses();

    /**
     * Status constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->storage = new \SplObjectStorage();
        $this->config = $config;
        $this->callable = $this->obtainStatuses();
    }

    /**
     * @return array
     */
    public function getStatuses()
    {
        if (is_callable($this->callable) && is_array($this->statuses)) {
            $callable = $this->callable;
            $callable();
        }
        $this->notify();
        return $this->statuses;
    }

    /**
     * @return bool
     */
    public function getHealthyFlagForEmptyResult()
    {
        $this->notify();
        return static::HEALTHY_FLAG_FOR_EMPTY_RESULT;
    }

    public function isHealthy()
    {
        if (empty((array)$this->statuses)) {
            return static::HEALTHY_FLAG_FOR_EMPTY_RESULT;
        } else {
            return $this->statuses->healthy;
        }

    }

    /**
     * @param \SplObserver $observer
     */
    public function attach(\SplObserver $observer)
    {
        $this->storage->attach($observer);
    }

    /**
     * @param \SplObserver $observer
     */
    public function detach(\SplObserver $observer)
    {
        $this->storage->detach($observer);
    }

    /**
     * @inheritdoc
     */
    public function notify()
    {
        foreach ($this->storage as $storage) {
            $storage->update($this);
        }
    }

    /**
     * @return Config
     */
    protected function getConfig()
    {
        return $this->config;
    }
}
