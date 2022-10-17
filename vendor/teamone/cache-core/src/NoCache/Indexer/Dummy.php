<?php

namespace RP\Cache\Core\NoCache\Indexer;

use Phalcon\Http\Response;
use RP\Cache\Core\Indexer\IndexerInterface;

/**
 * Class Dummy
 * @package RP\Cache\Core\NoCache\Indexer
 * @codeCoverageIgnore
 */
class Dummy implements IndexerInterface
{

    /**
     * @param string $key
     * @param Response $response
     * @return mixed|void
     */
    public function save($key, Response $response)
    {

    }
}
