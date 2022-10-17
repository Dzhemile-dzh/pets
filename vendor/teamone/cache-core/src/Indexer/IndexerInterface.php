<?php

namespace RP\Cache\Core\Indexer;

use Phalcon\Http\Response;

/**
 * Interface IndexerInterface
 * @package RP\Cache\Core\Indexer
 * @codeCoverageIgnore
 */
interface IndexerInterface
{
    /**
     * @param string $key
     * @param Response $response
     * @return mixed
     */
    public function save($key, Response $response);
}
