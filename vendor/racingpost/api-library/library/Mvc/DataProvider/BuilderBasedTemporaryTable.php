<?php

declare(strict_types=1);

namespace Api\Mvc\DataProvider;

use Phalcon\Db\Sql\Builder;

/**
 * Note!: Builder must contain BuilderBasedTemporaryTable::TEMPLATE_FOR_TABLE_NAME expression in INTO section
 * @package Api\Mvc\DataProvider
 */
class BuilderBasedTemporaryTable extends TemporaryTable
{
    const TEMPLATE_FOR_TABLE_NAME = "/*{EXPRESSION(temporaryTableName)}*/";
    private $builder;
    private $baseTableName;

    /**
     * BuiltTemporaryTable constructor.
     *
     * @param Builder $builder
     * @param string $baseTableName
     */
    public function __construct(Builder $builder, string $baseTableName)
    {
        $this->baseTableName = $baseTableName;
        $this->builder = $builder;
    }

    /**
     * @param string $tableName
     * @codeCoverageIgnore
     * @return void
     */
    protected function createTemporaryTable(string $tableName): void
    {
        $this->builder->expression("temporaryTableName", $tableName);
        $this->queryBuilder($this->builder);
    }

    /**
     * @return string
     */
    protected function getTemporaryTableName(): string
    {
        return $this->baseTableName;
    }
}