<?php
namespace RP\Cache\Core\NoCache\Factory;

use Phalcon\Cache\Frontend\Output;
use RP\Cache\Core\Factory\ICacheComponent;
use RP\Cache\Core\Indexer\IndexerInterface;
use RP\Cache\Core\Locker\LockerInterface;
use RP\Cache\Core\NoCache\Adapter\Dummy;

/**
 * Class Component
 * @package RP\Cache\Core\NoCache\Factory
 * @author  Denys Solyanyk <denys.solyanyk@racingpost.com>
 * @author  Serhii Atiahin <serhii.atiahin@racingpost.com>
 */
class Component implements ICacheComponent
{
    /**
     * @inheritdoc
     */
    public function createAdapter()
    {
        return new Dummy(new Output(), []);
    }

    /**
     * @inheritdoc
     */
    public function getKey()
    {
        return '';
    }

    /**
     * @return null
     */
    public function createResponseDTO()
    {
        return null;
    }

    /**
     * @return IndexerInterface
     */
    public function createIndexer()
    {
        return new \RP\Cache\Core\NoCache\Indexer\Dummy();
    }

    /**
     * @return LockerInterface
     */
    public function createLocker()
    {
        return new \RP\Cache\Core\NoCache\Locker\Dummy();
    }
}
