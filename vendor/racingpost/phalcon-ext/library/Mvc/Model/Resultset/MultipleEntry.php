<?php

declare(strict_types=1);

namespace Phalcon\Mvc\Model\Resultset;

use Phalcon\Cache\BackendInterface;
use Phalcon\Mvc\Model;

/**
 * @package Phalcon\Mvc\Model\Resultset
 */
class MultipleEntry
{
    private $model;
    private $columnMap;
    private $keepSnapshots;
    private $cache;

    /**
     * General constructor.
     *
     * @param Model\Row $model
     * @param array $columnMap
     * @param BackendInterface|null $cache
     * @param bool $keepSnapshots
     */
    public function __construct(
        Model\Row $model,
        ?array $columnMap = null,
        ?BackendInterface $cache = null,
        bool $keepSnapshots = false
    ) {
        $this->model = $model;
        $this->columnMap = $columnMap;
        $this->keepSnapshots = $keepSnapshots;
        $this->cache = $cache;
    }

    /**
     * @return Model\Row
     */
    public function getModel(): Model\Row
    {
        return $this->model;
    }

    /**
     * @return array|null
     */
    public function getColumnMap(): ?array
    {
        return $this->columnMap;
    }

    /**
     * @return bool
     */
    public function getKeepSnapshots(): bool
    {
        return $this->keepSnapshots;
    }

    /**
     * @return null|BackendInterface
     */
    public function getCache(): ?BackendInterface
    {
        return $this->cache;
    }
}
