<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 4/15/14
 * Time: 11:29 AM
 */

namespace Phalcon\Db\Dialect;

use Phalcon\Db\Exception;

class Sybase extends \Phalcon\Db\Dialect
{
    protected $_escapeChar = '';

    /**
     *  TODO: Review for Sybase syntax
     * Gets the column definition
     *
     * @param \Phalcon\Db\ColumnInterface column
     *
     * @throws \Phalcon\Db\Exception
     * @return string
     */
    public function getColumnDefinition(\Phalcon\Db\ColumnInterface $column)
    {

        if (!is_object($column)) {
            throw new \Phalcon\Db\Exception(
                "Column definition must be an object compatible with Phalcon\\Db\\ColumnInterface"
            );
        }

        switch ($column->getType()) {
            case \Phalcon\Db\Column::TYPE_INTEGER:
                $columnSql = "INT";
                if ($column->isUnsigned()) {
                    $columnSql = "UNSIGNED " . $columnSql;
                }
                break;

            case \Phalcon\Db\Column::TYPE_DATE:
                $columnSql = "DATE";
                break;

            case \Phalcon\Db\Column::TYPE_VARCHAR:
                $columnSql = "VARCHAR(" . $column->getSize() . ")";
                break;

            case \Phalcon\Db\Column::TYPE_DECIMAL:
                $columnSql =
                    "DECIMAL(" . $column->getSize() . "," . $column->getScale()
                    . ")";
                break;

            case \Phalcon\Db\Column::TYPE_DATETIME:
                $columnSql = "DATETIME";
                break;

            case \Phalcon\Db\Column::TYPE_CHAR:
                $columnSql = "CHAR(" . $column->getSize() . ")";
                break;

            case \Phalcon\Db\Column::TYPE_TEXT:
                $columnSql = "TEXT";
                break;

            case \Phalcon\Db\Column::TYPE_FLOAT:
                $columnSql = "FLOAT";
                $size = $column->getSize();
                if ($size) {
                    $columnSql .= "(" . $size . ")";
                }
                break;

            default:
                throw new Exception("Unrecognized SQL data type");
        }

        return $columnSql;
    }

    /**
     * Generates the SQL for LIMIT clause
     *
     *<code>
     * $sql = $dialect->limit('SELECT * FROM robots', 10);
     * echo $sql; // SELECT * FROM robots LIMIT 10
     *</code>
     *
     * @param string $sqlQuery
     * @param int    $number
     *
     * @return string
     */
    public function limit($sqlQuery, $number)
    {
        //Dirty hack due to Sybase can't proccess with binding int TOP clausem, but Phalcon is trying to set up
        //We will parce that construction further
        $number = is_numeric($number) ? $number : "[[{$number}]]";
        return preg_replace(
            '/^\s*(select|update)\s/i',
            '$1 top ' . $number . ' ',
            $sqlQuery
        );
    }

    /**
     * Checks if definition array contains required keys
     *
     * @param array $definition
     *
     * @throws \Phalcon\Db\Exception
     */
    protected function chechDefinition($definition)
    {
        if (!is_array($definition)) {
            throw new Exception("Invalid SELECT definition");
        }

        if (!isset($definition["tables"])) {
            throw new Exception(
                "The index 'tables' is required in the definition array"
            );
        }

        if (!isset($definition["columns"])) {
            throw new Exception(
                "The index 'columns' is required in the definition array"
            );
        }
    }

    /**
     * Builds a SELECT statement
     *
     * @param array $definition
     *
     * @throws \Phalcon\Db\Exception
     * @return string
     */
    public function select(array $definition)
    {

        $this->chechDefinition($definition);

        $tables = $definition["tables"];
        $columns = $definition["columns"];
        $escapeChar = $this->_escapeChar;

        if (is_array($columns)) {
            $selectedColumns = [];
            foreach ($columns as $column) {
                /**
                 * Escape column name
                 */
                $columnItem = $column[0];
                if (is_array($columnItem)) {
                    $columnSql = $this->getSqlExpression(
                        $columnItem,
                        $escapeChar
                    );
                } else {
                    if ($columnItem == "*") {
                        $columnSql = $columnItem;
                    } else {
                        $columnSql = $escapeChar . $columnItem . $escapeChar;
                    }
                }

                /**
                 * Escape column domain
                 */
                if (isset($column[1])) {
                    $columnDomain = $column[1];
                    if ($columnDomain) {
                        $columnDomainSql =
                            $escapeChar . $columnDomain . $escapeChar . "."
                            . $columnSql;
                    } else {
                        $columnDomainSql = $columnSql;
                    }
                } else {
                    $columnDomainSql = $columnSql;
                }

                /**
                 * Escape column alias
                 */
                if (isset($column[2])) {
                    $columnAlias = $column[2];
                    if ($columnAlias) {
                        $columnAliasSql =
                            $columnDomainSql . " AS " . $escapeChar
                            . $columnAlias . $escapeChar;
                    } else {
                        $columnAliasSql = $columnDomainSql;
                    }
                } else {
                    $columnAliasSql = $columnDomainSql;
                }
                $selectedColumns[] = $columnAliasSql;
            }
            $columnsSql = implode(", ", $selectedColumns);
        } else {
            $columnsSql = $columns;
        }

        /**
         * Check and escape tables
         */
        if (is_array($tables)) {
            $selectedTables = [];
            foreach ($tables as $table) {
                $selectedTables[] = $this->getSqlTable($table, $escapeChar);
            }
            $tablesSql = implode(", ", $selectedTables);
        } else {
            $tablesSql = $tables;
        }

        $sql = "SELECT " . $columnsSql . " FROM " . $tablesSql;

        /**
         * Check for joins
         */
        if (isset($definition["joins"]) && is_array($definition["joins"])) {
            foreach ($definition['joins'] as $join) {
                $sqlTable = $this->getSqlTable($join["source"], $escapeChar);
                $selectedTables[] = $sqlTable;
                $sqlJoin = " " . $join["type"] . " JOIN " . $sqlTable;

                /**
                 * Check if the join has conditions
                 */
                if (isset($join["conditions"])
                    && is_array(
                        $join["conditions"]
                    )
                ) {
                    $joinConditionsArray = $join["conditions"];
                    if (count($joinConditionsArray)) {
                        $joinExpressions = [];
                        foreach ($joinConditionsArray as $joinCondition) {
                            $joinExpressions[] = $this->getSqlExpression(
                                $joinCondition,
                                $escapeChar
                            );
                        }
                        $sqlJoin .= " ON " . implode(" AND ", $joinExpressions)
                            . " ";
                    }
                }
                $sql .= $sqlJoin;
            }
        }

        /**
         * Check for a WHERE clause
         */
        if (isset($definition["where"])) {
            $whereConditions = $definition["where"];
            if (is_array($whereConditions)) {
                $sql .= " WHERE " . $this->getSqlExpression($whereConditions, $escapeChar);
            } else {
                $sql .= " WHERE " . $whereConditions;
            }
        }

        /**
         * Check for a GROUP clause
         */
        if (isset($definition['group']) && is_array($definition["group"])) {
            $groupFields = $definition["group"];
            $groupItems = [];
            foreach ($groupFields as $groupField) {
                $groupItems[] = $this->getSqlExpression($groupField, $escapeChar);
            }
            $sql .= " GROUP BY " . implode(", ", $groupItems);

            /**
             * Check for a HAVING clause
             */
            if (isset($definition['having'])
                && is_array(
                    $definition["having"]
                )
            ) {
                $sql .= " HAVING " . $this->getSqlExpression($definition["having"], $escapeChar);
            }
        }

        /**
         * Check for a ORDER clause
         */
        if (isset($definition['order']) && is_array($definition["order"])) {
            $orderFields = $definition["order"];
            $orderItems = [];
            foreach ($orderFields as $orderItem) {
                $orderSqlItem = $this->getSqlExpression(
                    $orderItem[0],
                    $escapeChar
                );

                /**
                 * In the numeric 1 position could be a ASC/DESC clause
                 */
                if (isset($orderItem[1])) {
                    $orderSqlItemType = $orderSqlItem . " " . $orderItem[1];
                } else {
                    $orderSqlItemType = $orderSqlItem;
                }

                $orderItems[] = $orderSqlItemType;
            }
            $sql .= " ORDER BY " . implode(", ", $orderItems);
        }

        /**
         * Check for a LIMIT condition
         */
        if (isset($definition["limit"])) {
            $limitValue = $definition["limit"];

            if (is_array($limitValue)) {
                /**
                 * Check for a OFFSET condition
                 */
                if (isset($limitValue["offset"]['value'])
                    && $limitValue["offset"]['value'] > 0
                ) {
                    throw new Exception(
                        'Sybase doesn\'t support any kind of "offset" in row limitation.'
                    );
                }

                $limitValue = $limitValue["number"]["value"];
            }

            $sql = $this->limit($sql, $limitValue);
        }

        return $sql;
    }


    /**
     * @codeCoverageIgnore
     *
     * Generate SQL to create a new savepoint
     *
     * @param string $name
     *
     * @return string
     */
    public function createSavepoint($name)
    {
        return "save tran " . $name;
    }

    /**
     * @codeCoverageIgnore
     *
     * Generate SQL to rollback a savepoint
     *
     * @param string $name
     *
     * @return string
     */
    public function rollbackSavepoint($name)
    {
        return "rollback tran " . $name;
    }

    /**
     * @codeCoverageIgnore
     *
     * Generates SQL to add a column to a table
     *
     * @param                                                         $tableName
     * @param                                                         $schemaName
     * @param \Phalcon\Db\ColumnInterface|\Phalcon\Db\ColumnInterface $column
     *
     * @return string
     * @internal param \Phalcon\Db\Dialect\tableName $string
     * @internal param \Phalcon\Db\Dialect\schemaName $string
     * @internal param \Phalcon\Db\Dialect\Phalcon\Db\ColumnInterface $column
     */
    public function addColumn($tableName, $schemaName, \Phalcon\Db\ColumnInterface $column)
    {
        return 'addColumn';
    }

    /**
     * @codeCoverageIgnore
     *
     * Generates SQL to modify a column in a table
     *
     * @param    string                      $tableName
     * @param    string                      $schemaName
     * @param    \Phalcon\Db\ColumnInterface column
     *
     * @return    string
     */
    public function modifyColumn($tableName, $schemaName, \Phalcon\Db\ColumnInterface $column, \Phalcon\Db\ColumnInterface $currentColumn = null)
    {
        return '';
    }

    /**
     * @codeCoverageIgnore
     *
     * Generates SQL to delete a column from a table
     *
     * @param    string $tableName
     * @param    string $schemaName
     * @param    string $columnName
     *
     * @return    string
     */
    public function dropColumn($tableName, $schemaName, $columnName)
    {
        return '';
    }

    /**
     * @codeCoverageIgnore
     *
     * Generates SQL to add an index to a table
     *
     * @param                                                       $tableName
     * @param                                                       $schemaName
     * @param \Phalcon\Db\IndexInterface|\Phalcon\Db\IndexInterface $index
     *
     * @return    string
     */
    public function addIndex($tableName, $schemaName, \Phalcon\Db\IndexInterface $index)
    {
        return '';
    }

    /**
     * @codeCoverageIgnore
     *
     * Generates SQL to delete an index from a table
     *
     * @param    string $tableName
     * @param    string $schemaName
     * @param    string $indexName
     *
     * @return    string
     */
    public function dropIndex($tableName, $schemaName, $indexName)
    {
        return '';
    }

    /**
     * @codeCoverageIgnore
     *
     * Generates SQL to add the primary key to a table
     *
     * @param    string                     $tableName
     * @param    string                     $schemaName
     * @param    \Phalcon\Db\IndexInterface index
     *
     * @return    string
     */
    public function addPrimaryKey($tableName, $schemaName, \Phalcon\Db\IndexInterface $index)
    {
        return '';
    }

    /**
     * @codeCoverageIgnore
     *
     * Generates SQL to delete primary key from a table
     *
     * @param    string $tableName
     * @param    string $schemaName
     *
     * @return    string
     */
    public function dropPrimaryKey($tableName, $schemaName)
    {
        return '';
    }

    /**
     * @codeCoverageIgnore
     *
     * Generates SQL to add an index to a table
     *
     * @param    string                         $tableName
     * @param    string                         $schemaName
     * @param    \Phalcon\Db\ReferenceInterface reference
     *
     * @return    string
     */
    public function addForeignKey($tableName, $schemaName, \Phalcon\Db\ReferenceInterface $reference)
    {
        return '';
    }

    /**
     * @codeCoverageIgnore
     *
     * Generates SQL to delete a foreign key from a table
     *
     * @param    string $tableName
     * @param    string $schemaName
     * @param    string $referenceName
     *
     * @return    string
     */
    public function dropForeignKey($tableName, $schemaName, $referenceName)
    {
        return '';
    }

    /**
     * @codeCoverageIgnore
     *
     * Generates SQL to add the table creation options
     *
     * @param    array $definition
     *
     * @return    array
     */
    protected function _getTableOptions($definition)
    {
        return "";
    }

    /**
     * @codeCoverageIgnore
     *
     * Generates SQL to create a table in MySQL
     *
     * @param    string $tableName
     * @param    string $schemaName
     * @param    array  $definition
     *
     * @return    string
     */
    public function createTable($tableName, $schemaName, array $definition)
    {
        return '';
    }

    /**
     * @codeCoverageIgnore
     *
     * Generates SQL to drop a table
     *
     * @param  string  $tableName
     * @param  string  $schemaName
     * @param  boolean $ifExists
     *
     * @return string
     */
    public function dropTable($tableName, $schemaName, $ifExists = true)
    {
        return '';
    }

    /**
     * @codeCoverageIgnore
     *
     * @param $sqlQuery
     * @return string
     */
    public function sharedLock($sqlQuery)
    {
        return '';
    }

    /**
     * @codeCoverageIgnore
     *
     * Generates SQL to create a view
     *
     * @param string $viewName
     * @param array  $definition
     * @param string $schemaName
     *
     * @return string
     */
    public function createView($viewName, array $definition, $schemaName = null)
    {
        return '';
    }

    /**
     * @codeCoverageIgnore
     *
     * Generates SQL to drop a view
     *
     * @param string  $viewName
     * @param string  $schemaName
     * @param boolean $ifExists
     *
     * @return string
     */
    public function dropView($viewName, $schemaName = null, $ifExists = null)
    {
        return '';
    }

    /**
     * @codeCoverageIgnore
     *
     * Generates SQL checking for the existence of a schema.table
     *
     * <code>
     * echo $dialect->tableExists("posts", "blog");
     * echo $dialect->tableExists("posts");
     * </code>
     *
     * @param string $tableName
     * @param string $schemaName
     *
     * @return string
     */
    public function tableExists($tableName, $schemaName = null)
    {
        $rtn =  "SELECT 1 FROM sysobjects WHERE name = '{$tableName}' AND type = 'U'";
        return $rtn;
    }

    /**
     * @codeCoverageIgnore
     *
     * Generates SQL checking for the existence of a schema.view
     *
     * @param string $viewName
     * @param string $schemaName
     *
     * @return string
     */
    public function viewExists($viewName, $schemaName = null)
    {
        return '';
    }

    /**
     * @codeCoverageIgnore
     *
     * Generates SQL describing a table
     *
     *<code>
     *    print_r($dialect->describeColumns("posts"));
     *</code>
     *
     * @param string $table
     * @param string $schema
     *
     * @return string
     */
    public function describeColumns($table, $schema = null)
    {
        return "
            SELECT
                c.name AS Field,
                t.name AS Type,
                c.length AS Size,
                c.length AS NumericSize,
                c.scale AS NumericScale,
                CASE WHEN c.status & 8 = 8 THEN 'Y' ELSE 'N' END 'Null',
                CASE WHEN i.indid IS NULL THEN '' ELSE 'PRI' END AS 'Key',
                CASE WHEN c.status & 0x80 = 0x80 THEN 'A' ELSE '' END AS Extra,
                c.colid  AS Position,
                sc.text AS 'Default'
            FROM syscolumns c
            INNER JOIN sysobjects o ON c.id = o.id
            INNER JOIN systypes t ON t.usertype = c.usertype
            LEFT JOIN sysindexes i ON o.id = i.id AND i.status & 2048 = 2048 AND
                (
                --Dirty hack :(
                index_col(o.name, i.indid, 1) = c.name
                OR index_col(o.name, i.indid, 2) = c.name
                OR index_col(o.name, i.indid, 3) = c.name
                OR index_col(o.name, i.indid, 4) = c.name
                OR index_col(o.name, i.indid, 5) = c.name
                OR index_col(o.name, i.indid, 6) = c.name
                OR index_col(o.name, i.indid, 7) = c.name
                OR index_col(o.name, i.indid, 8) = c.name
                OR index_col(o.name, i.indid, 9) = c.name
                OR index_col(o.name, i.indid, 10) = c.name
                )
            LEFT JOIN syscomments sc ON c.cdefault = sc.id
            WHERE o.name = '" . $this->prepareTableName($table, $schema) . "'
        ";
    }

    /**
     * @codeCoverageIgnore
     *
     * List all tables on database
     *
     *<code>
     *    print_r($dialect->listTables("blog"))
     *</code>
     *
     * @param       string $schemaName
     *
     * @return      array
     */
    public function listTables($schemaName = null)
    {
        $sql = '
        select ob.name,st.rowcnt
        from sysobjects ob, systabstats st
        where ob.type="U"
        and st.id=ob.id
        order by ob.name
        ';

        return $sql;
    }

    /**
     * @codeCoverageIgnore
     *
     * Generates the SQL to list all views of a schema or user
     *
     * @param string $schemaName
     *
     * @return array
     */
    public function listViews($schemaName = null)
    {
        return '';
    }

    /**
     * @codeCoverageIgnore
     *
     * Generates SQL to query indexes on a table
     *
     * @param    string $table
     * @param    string $schema
     *
     * @return    string
     */
    public function describeIndexes($table, $schema = null)
    {
        return '';
    }

    /**
     * @codeCoverageIgnore
     *
     * Generates SQL to query foreign keys on a table
     *
     * @param    string $table
     * @param    string $schema
     *
     * @return    string
     */
    public function describeReferences($table, $schema = null)
    {
        return 'SELECT NULL';
    }

    /**
     * @codeCoverageIgnore
     *
     * Generates the SQL to describe the table creation options
     *
     * @param    string $table
     * @param    string $schema
     *
     * @return    string
     */
    public function tableOptions($table, $schema = null)
    {
        return '';
    }

    private function prepareTableName($tableName, $schemaName)
    {
        return $tableName;
    }
}
