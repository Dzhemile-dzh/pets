<?php
namespace RP\Cache\Core\Factory;

use RP\Cache\Core\Indexer\IndexerInterface;
use RP\Cache\Core\Locker\LockerInterface;

/**
 * Interface ICacheComponent
 * @package RP\Cache\Core\Factory
 * @codeCoverageIgnore
 */
interface ICacheComponent
{
    /**
     * @return \Phalcon\Cache\BackendInterface
     */
    public function createAdapter();

    /**
     * @return string
     */
    public function getKey();

    /**
     * @return \RP\Cache\Core\IResponseDTO
     */
    public function createResponseDTO();

    /**
     * @return IndexerInterface
     */
    public function createIndexer();

    /**
     * @return LockerInterface
     */
    public function createLocker();
}
