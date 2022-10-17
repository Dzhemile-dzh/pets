<?php

namespace ApiStatus;

use Phalcon\Config;

/**
 * Class FactoryStatuses
 * @package ApiStatus
 */
abstract class FactoryStatuses implements \SplObserver
{
    /**
     * @var \Phalcon\Config
     */
    private $config;

    /**
     * @var Status
     */
    private $cache;

    /**
     * @var Status
     */
    private $serverVars;

    /**
     * @var Status
     */
    private $sql;

    /**
     * @var Status
     */
    private $accessMonitor;

    /**
     * @var Status
     */
    private $replication;

    /**
     * @var bool
     */
    private $healthy;

    /**
     * This method has to instantiate all need us status objects (cache, serverVars, sql)
     */
    abstract protected function buildStatuses();

    /**
     * FactoryStatuses constructor.
     *
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->healthy = true;
        $this->config = $config;
        $this->buildStatuses();
        $this->subscribeStatuses();
    }

    /**
     * @return Status
     */
    public function getSql()
    {
        return $this->sql;
    }

    /**
     * @return Status
     */
    public function getAccessMonitor()
    {
        return $this->accessMonitor;
    }

    /**
     * @return Status
     */
    public function getReplication()
    {
        return $this->replication;
    }

    /**
     * @return Status
     */
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * @return Status
     */
    public function getServerVars()
    {
        return $this->serverVars;
    }

    public function getStatus($type)
    {
        $statuses = $this->getStatusByType($type);
        return $statuses;
    }

    public function getMapper($type, $section = null)
    {
        $info = (array)$this->getStatus($type);
        $data = $info;
        if (isset($section)) {
            $data = $this->retrieveProperties($info, $section);
        }
        $keys = array_keys($data);
        $map = array_combine($keys, $keys);

        return $map;
    }

    private function retrieveProperties(array $fields, $section)
    {
        $res = [];
        if (!isset($fields[$section])) {
            foreach ($fields as $field) {
                if ($field instanceof \stdClass) {
                    $field = (array)$field;
                }
                if (is_array($field) && !empty($field)) {
                    $res += $this->retrieveProperties($field, $section);
                }
            }
            return $res;
        } else {
            if (is_array($fields[$section])) {
                foreach ($fields[$section] as $item) {
                    $res += (array)$item;
                }
                return $res;
            } else {
                return (array)$fields[$section];
            }
        }
    }

    public function update(\SplSubject $status)
    {
        if (!$status->isHealthy()) {
            $this->healthy = false;
        }
    }

    /**
     * @return boolean
     */
    public function isHealthy()
    {
        return $this->healthy;
    }

    /**
     * @param Status $cache
     */
    protected function setCache(Status $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @param Status $sql
     */
    protected function setSql(Status $sql)
    {
        $this->sql = $sql;
    }

    /**
     * @param Status $accessMonitor
     */
    protected function setAccessMonitor(Status $accessMonitor)
    {
        $this->accessMonitor = $accessMonitor;
    }

    /**
     * @param Status $replication
     */
    public function setReplication($replication)
    {
        $this->replication = $replication;
    }

    /**
     * @param Status $serverVars
     */
    protected function setServerVars(Status $serverVars)
    {
        $this->serverVars = $serverVars;
    }

    /**
     * @return Config
     */
    protected function getConfig()
    {
        return $this->config;
    }

    /**
     * @param string $type
     *
     * @return array
     */
    private function getStatusByType($type)
    {
        $strategy = $this->getStragegy($type);
        if (!method_exists($this, $strategy)) {
            throw new \UnexpectedValueException("Undefined status: {$type}");
        }
        $statuses = $this->{$strategy}()->getStatuses();
        return $statuses;
    }

    /**
     * @param $type
     *
     * @return string
     */
    private function getStragegy($type)
    {
        $strategy = 'get' . implode('', array_map('ucfirst', explode('_', $type)));
        return $strategy;
    }

    private function subscribeStatuses()
    {
        if ($this->getSql()) {
            $this->getSql()->attach($this);
        }
        if ($this->getReplication()) {
            $this->getReplication()->attach($this);
        }
        if ($this->getCache()) {
            $this->getCache()->attach($this);
        }
        if ($this->getServerVars()) {
            $this->getServerVars()->attach($this);
        }
        if ($this->getAccessMonitor()) {
            $this->getAccessMonitor()->attach($this);
        }
    }
}
