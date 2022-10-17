<?php

declare(strict_types=1);

namespace Api\Mvc\DataProvider;

/**
 * @package Api\Mvc\DataProvider
 */
class TemporaryTableManager
{
    const SERVICE_NAME = 'temporaryTableManager';

    /** @var TemporaryTable[] $tables */
    private $tables = [];

    /**
     * Clear tables array and call dropTemporaryTable for each temporary table.
     */
    public function clear(): void
    {
        $cleanUpTables = $this->tables;
        $this->tables = [];
        $lastException = null;

        foreach ($cleanUpTables as $tables) {
            foreach ($tables as $table) {
                try {
                    $table->dropTemporaryTable();
                } catch (\Throwable $t) {
                    $lastException = $t;
                }
            }
        }

        if ($lastException != null) {
            throw $lastException;
        }
    }

    /**
     * @param TemporaryTable $table
     */
    public function add(TemporaryTable $table): void
    {
        $this->tables[$table->getTemporaryTable()][] = $table;
    }

    /**
     * @param string $regex
     *
     * @return TemporaryTable[]
     */
    public function find(string $regex): array
    {
        $filtered = array_filter(
            $this->tables,
            function ($key) use ($regex) {
                return preg_match($regex, $key);
            },
            ARRAY_FILTER_USE_KEY
        );

        return $filtered;
    }

    /**
     * We can use clear method and call dropTemporaryTable
     * due to dropTemporaryTable method has lazy loading and can not be performed twice
     */
    public function __destruct()
    {
        $this->clear();
    }
}
