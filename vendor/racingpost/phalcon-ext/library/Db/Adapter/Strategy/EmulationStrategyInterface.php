<?php

declare(strict_types=1);

namespace Phalcon\Db\Adapter\Strategy;

/**
 * @package Phalcon\Db\Adapter\Strategy
 */
interface EmulationStrategyInterface
{
    /**
     * @param string $sqlStatement
     * @param array|null $bindParams
     * @param array|null $bindTypes
     *
     * @return string
     */
    public function emulateQuery(string $sqlStatement, array $bindParams = null, array $bindTypes = null): string;
}
