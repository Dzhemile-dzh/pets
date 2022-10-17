<?php

declare(strict_types=1);

namespace Phalcon\Db\Sql;

use Phalcon\Input\Request;
use Phalcon\Mvc\Model\Row;

/**
 * Class Builder
 *
 * @package Phalcon\Db\Sql
 */
class Builder
{
    const INNER_JOIN = 'INNER JOIN';
    const LEFT_JOIN = 'LEFT JOIN';

    const TEMPLATE_EXPRESSION = '/*{EXPRESSION(#)}*/';
    const TEMPLATE_COLUMNS = '/*{COLUMNS}*/';
    const TEMPLATE_JOINS = '/*{JOINS}*/';
    const TEMPLATE_WHERE = '/*{WHERE}*/';
    const TEMPLATE_GROUPING = '/*{GROUPING}*/';
    const TEMPLATE_HAVING = '/*{HAVING}*/';
    const TEMPLATE_ORDER = '/*{ORDER}*/';

    /**
     * @var string
     */
    private $sqlTemplate;

    /**
     * @var string[]|Builder[]
     */
    private $expressions = [];

    /**
     * @var string[]
     */
    private $columns = [];

    /**
     * @var string[]
     */
    private $joins = [];

    /**
     * @var string[]
     */
    private $where = [];

    /**
     * @var string[]
     */
    private $groupBy = [];

    /**
     * @var string[]
     */
    private $having = [];

    /**
     * @var string[]
     */
    private $orderBy = [];

    /**
     * @var \Phalcon\Input\Request
     */
    private $request;

    /**
     * @var string[]
     */
    private $customParams = [];

    /**
     * @var integer[]
     */
    private $phalconColumnTypes;

    /**
     * @var \Phalcon\Mvc\Model\Row
     */
    private $row;

    /**
     * @var boolean
     */
    private $preparedStmtUsed;

    /**
     * @var string
     */
    private $sql;

    /**
     * @var array
     */
    private $templateParams;

    /**
     * @var array
     */
    private $params;

    /**
     * @var string
     */
    private $debugSql;

    /**
     * @var int
     */
    protected static $nestedSuffix = 0;

    /**
     * Builder constructor.
     *
     * @param Request|null $request Optional param. Using if we want to auto bind params from Request
     */
    public function __construct(Request $request = null)
    {
        $this->usePreparedStmt(true);

        if ($request !== null) {
            $this->setRequest($request);
        }
    }

    /**
     * You can specify necessity of using prepared stmt.
     * By default if is true
     *
     * @param boolean $boolean
     */
    public function usePreparedStmt($boolean)
    {
        $this->preparedStmtUsed = (bool)$boolean;
    }

    /**
     * Method takes plain SQL string with special comments
     * which will be substituted by SQLs. You can see possible templates
     * and appropriate methods that responsible for substitution content below:
     *
     * ----------------------------------------------------------------------------------
     *        Template                   |    Method's name
     * ----------------------------------------------------------------------------------
     * {EXPRESSION(namedExpression)}    -> expression(namedExpression, value)
     * {COLUMNS}                        -> columns(string columns)
     * {JOINS}                          -> innerJoin(string stmt), leftJoin(string stmt)
     * {WHERE}                          -> where(string stmt)
     * {GROUPING}                       -> group(string stmt)
     * {HAVING}                         -> having(string stmt)
     * {ORDER}                          -> order(string stmt
     * ----------------------------------------------------------------------------------
     *
     * @param string $sqlTemplate
     */
    public function setSqlTemplate($sqlTemplate)
    {
        $this->sqlTemplate = $sqlTemplate;
    }

    /**
     * Method specifies $name of expression with appropriate value.
     * An {EXPRESSION(name)} will be substituted by $value
     *
     * @param string $name
     * @param string|Builder $value
     */
    public function expression($name, $value)
    {
        if (is_string($value) || ($value instanceof Builder)) {
            $this->expressions[$name] = $value;
        } else {
            throw new \LogicException(
                'Value in expression ' . $name . ' is not a string or a Builder instance.'
            );
        }
    }

    /**
     * The $stmt is plain SQL string of columns that will substitute {COLUMNS} template
     * if you want to add column that contains comma(,) e.g CONVERT(CHAR(20), order_date, 7) need to use array instead
     * of string.
     *
     * @example ['CONVERT(CHAR(20), order_date, 7)']
     *
     * @param array|string $stmt
     */
    public function columns($stmt)
    {
        if (!is_string($stmt) & !is_array($stmt)) {
            return;
        }

        if (is_string($stmt)) {
            $stmt = explode(',', $stmt);
        }

        foreach ($stmt as $value) {
            $value = trim($value);

            if (empty($value)) {
                continue;
            }

            $this->columns[] = $value;
        }
    }

    /**
     * The $stmt is plain SQL string of table and condition(s) for inner join statement
     * that will substitute {JOINS} template.
     * The sequence of join's statements depends just from sequence of call this method
     * and related leftJoin. There are not rules like inner joins will be substituted
     * at first and left joins at second.
     *
     * @param string $stmt
     */
    public function innerJoin($stmt)
    {
        $this->joins[] = [self::INNER_JOIN, $stmt];
    }

    /**
     * The $stmt is plain SQL string of table and condition(s) for left join statement
     * that will substitute {JOINS} template.
     * The sequence of join's statements depends just from sequence of call this method
     * and related innerJoin. There are not rules like inner joins will be substituted
     * at first and left joins at second.
     *
     * @param string $stmt
     */
    public function leftJoin($stmt)
    {
        $this->joins[] = [self::LEFT_JOIN, $stmt];
    }

    /**
     * The $stmt is plain SQL string of conditions that will substitute {WHERE} template
     *
     * @param string $stmt
     */
    public function where($stmt)
    {
        $stmt = $this->prepareWhere($stmt);

        if (!in_array($stmt, $this->where)) {
            $this->where[] = $stmt;
        }
    }

    /**
     * @param string $stmt
     *
     * @return bool|string
     */
    private function prepareWhere($stmt)
    {
        $stmt = trim($stmt);

        if (strtolower(substr($stmt, 0, 3)) == 'and'
            && in_array($stmt[3], [' ', "\t", "\n", "\r"])
        ) { //Remove opening AND , if exists
            $stmt = substr($stmt, 4);
        }

        return $stmt;
    }

    /**
     * The $stmt is plain SQL string of grouping statement that will substitute {GROUPING} template
     *
     * @param string $stmt
     */
    public function groupBy($stmt)
    {
        if (!in_array($stmt, $this->groupBy)) {
            $this->groupBy[] = $stmt;
        }
    }

    /**
     * The $stmt is plain SQL string of having statement that will substitute {HAVING} template
     *
     * @param string $stmt
     */
    public function having($stmt)
    {
        if (!in_array($stmt, $this->having)) {
            $this->having[] = $stmt;
        }
    }

    /**
     * The $stmt is plain SQL string of needed ordering that will substitute {ORDER} template
     *
     * @param string $stmt
     */
    public function orderBy($stmt)
    {
        if (!in_array($stmt, $this->orderBy)) {
            $this->orderBy[] = $stmt;
        }
    }

    /**
     * Method accepts list of builders for creation of UNION stmt.
     *
     * @param Builder[] $builders Restriction - count($builders) > 1
     *
     * @return self
     */
    public function union(array $builders)
    {
        $sqls = $this->collectSqlFromBuilders($builders);
        $this->setSqlTemplate(implode("UNION", $sqls));

        return $this;
    }

    /**
     * Method accepts list of builders for creation of UNION ALL stmt.
     *
     * @param Builder[] $builders Restriction - count($builders) > 1
     *
     * @return self
     */
    public function unionAll(array $builders)
    {
        $sqls = $this->collectSqlFromBuilders($builders);
        $this->setSqlTemplate(implode("UNION ALL", $sqls));

        return $this;
    }

    /**
     * Method allows to specify parameters that cannot be retrieved from Request object.
     * These parameters have the highest priority and
     * if some of these parameters have intersection with Request parameters
     *  - exactly these parameters will be taken into account.
     *
     * @param string|integer $name
     * @param mixed $value
     *
     * @return Builder
     */
    public function setParam($name, $value): Builder
    {
        $this->customParams[$name] = $value;
        return $this;
    }

    /**
     * @return array|null
     */
    protected function getCustomParams(): ?array
    {
        return $this->customParams;
    }

    /**
     * Through this method you can specify Phalcon\Db\Column\Type for all incoming params
     * By default it is null
     *
     * @param array $phalconColumnTypes
     */
    public function setParamsColumnTypes(array $phalconColumnTypes)
    {
        $this->phalconColumnTypes = $phalconColumnTypes;
    }

    /**
     * Through this method you can specify Phalcon\Db\Column\Type for all incoming params
     * By default it is null
     *
     * @param $name
     * @param $value
     */
    public function setParamsColumnType($name, $value)
    {
        $this->phalconColumnTypes[$name] = $value;
    }

    /**
     * @return integer[]|null
     */
    public function getParamsColumnTypes()
    {
        return $this->phalconColumnTypes;
    }

    /**
     * All parameters which are came with Request object will be used as parameters in the prepared stmt
     *
     * @param \Phalcon\Input\Request $request
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return \Phalcon\Input\Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return boolean
     */
    public function isPreparedStmtUsed()
    {
        return $this->preparedStmtUsed;
    }

    /**
     * You can specify particular type of Row object that will be used during creation of result set.
     * By default it is \Phalcon\Mvc\Model\Row
     *
     * @param Row $row
     */
    public function setRow(Row $row)
    {
        $this->row = $row;
    }

    /**
     * @return \Phalcon\Mvc\Model\Row
     */
    public function getRow()
    {
        return $this->row ?: new Row();
    }

    /**
     * This is core method.
     * It builds SQL and prepares parameters.
     *
     * @return void
     */
    public function build()
    {
        $this->sql = $this->sqlTemplate;
        $remainingExpressions = [];

        $this->processExpressions(
            $this->expressions,
            false,
            $remainingExpressions
        );

        $this->processColumns();
        $this->processJoins();
        $this->processWhere();
        $this->processGroupBy();
        $this->processHaving();
        $this->processOrderBy();

        if (!empty($remainingExpressions)) {
            $this->processExpressions($remainingExpressions, true);
        }

        $this->retrieveTemplateParams();
        $this->retrieveParams();
    }

    /**
     * Method fills and returns SQL query ready for execution.
     * Thus, if SQL contains placeholders,
     * they will be substituted by values of parameters.
     *
     * @return string
     */
    public function debug()
    {
        if (!$this->sql) {
            $this->build();
        }

        $this->debugSql = $this->sql;

        if ($this->getParams()) {
            foreach ($this->getParams() as $name => $value) {
                $value = (array)$value;
                $substitution = '** UNDEFINED **';

                if (count($value)) {
                    $substitution = is_string(reset($value))
                        ? "'" . implode("', '", $value) . "'"
                        : implode(', ', $value);
                }

                $this->debugSql = preg_replace(
                    '/:(' . preg_quote($name) . '):?([\s\(\)]){1}/im',
                    $substitution . '$2',
                    $this->debugSql
                );
            }
        }

        return $this->debugSql;
    }

    /**
     * This is prepared SQL string that is a result of call \Phalcon\Db\Sql\Builder::build() method
     *
     * @return string
     */
    public function getSql()
    {
        return $this->sql;
    }

    /**
     * This is prepared parameters that is a result of call \Phalcon\Db\Sql\Builder::build() method
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Method resets parameters that have to be different.
     * It is intended for using during construction of the UNION statements
     */
    public function __clone()
    {
        $this->expressions = [];
        $this->columns = [];
        $this->joins = [];
        $this->where = [];
        $this->groupBy = [];
        $this->having = [];
        $this->orderBy = [];
    }

    /**
     * Method substitutes {COLUMNS} by specified strings
     */
    private function processColumns()
    {
        if (!empty($this->columns)) {
            if (strpos($this->sql, self::TEMPLATE_COLUMNS) === false) {
                throw new \LogicException(
                    'You try to use columns but the placeholder '
                    . self::TEMPLATE_COLUMNS
                    . ' is absent in the template'
                );
            }
            $this->sql = $this->resolveColumnsConcatenation();
        } else {
            $this->sql = str_replace(self::TEMPLATE_COLUMNS, '', $this->sql);
        }
    }

    /**
     * @return mixed
     */
    private function resolveColumnsConcatenation()
    {
        $columns = implode(', ', $this->columns);

        list($wordBefore, $wordAfter) = $this->findWordsBeforeAndAfter(self::TEMPLATE_COLUMNS, $this->sql);

        if (!in_array(strtoupper($wordBefore), ['SELECT', 'DISTINCT'])) {
            $columns = ' ,' . $columns;
        }
        if (!in_array(
            strtoupper($wordAfter),
            ['FROM', 'INTO']
        )) {
            $columns = $columns . ', ';
        }


        return str_replace(self::TEMPLATE_COLUMNS, " {$columns} ", $this->sql);
    }

    /**
     * Method substitutes {EXPRESSION(nameExpression)} by specified named expression
     */
    private function processExpressions(
        array $expressions,
        $throwNotFoundException = true,
        array &$remainingExpressions = null
    ) {
        if (!empty($expressions)) {
            foreach ($expressions as $name => $expression) {
                $templateExpression = str_replace('#', $name, self::TEMPLATE_EXPRESSION);

                if (strpos($this->sql, $templateExpression) === false) {
                    if ($throwNotFoundException || !isset($remainingExpressions)) {
                        throw new \LogicException(
                            'You try to use expressions but the placeholder '
                            . $templateExpression
                            . ' is absent in the template'
                        );
                    } else {
                        $remainingExpressions[$name] = $expression;
                        continue;
                    }
                }

                if ($expression instanceof Builder) {
                    $replacement = $this->compileSqlFromBuilder($expression);
                } else {
                    $replacement = $expression;
                }
                $this->sql = str_replace($templateExpression, $replacement, $this->sql);
            }
        }
    }

    /**
     * Method substitutes {JOINS} by specified [inner|left] join instruction.
     * An order of joins will be preserved.
     */
    private function processJoins()
    {
        if (!empty($this->joins)) {
            if (strpos($this->sql, self::TEMPLATE_JOINS) === false) {
                throw new \LogicException(
                    'You try to use joins but the placeholder '
                    . self::TEMPLATE_JOINS
                    . ' is absent in the template'
                );
            }

            $joins = [];
            foreach ($this->joins as $join) {
                list($joinType, $joinCondition) = $join;
                $joins[] = $joinType . ' ' . $joinCondition;
            }

            $this->sql = str_replace(self::TEMPLATE_JOINS, implode(' ', $joins), $this->sql);
        }
    }

    /**
     * Method substitutes {WHERE} by specified conditions
     */
    private function processWhere()
    {
        if (!empty($this->where)) {
            if (strpos($this->sql, self::TEMPLATE_WHERE) === false) {
                throw new \LogicException(
                    'You try to use condition but the placeholder '
                    . self::TEMPLATE_WHERE
                    . ' is absent in the template'
                );
            }
        }

        $this->sql = $this->where === []
            ? str_replace(self::TEMPLATE_WHERE, '', $this->sql)
            : $this->resolveWhereConcatenation();
    }

    /**
     * @return mixed
     */
    private function resolveWhereConcatenation()
    {
        $where = implode(' AND ', $this->where);

        list($wordBefore, $wordAfter) = $this->findWordsBeforeAndAfter(self::TEMPLATE_WHERE, $this->sql);

        if (!in_array(
            strtoupper($wordBefore),
            [
                'AND',
                'WHERE',
            ]
        )) {
            $where = 'AND ' . $where;
        }

        if (!empty($wordAfter)
            && !in_array(
                strtoupper($wordAfter),
                [
                    'AND',
                    'GROUP',
                    'HAVING',
                    'ORDER',
                    'LIMIT',
                    'OFFSET',
                    'UNION',
                    'EXCEPT',
                    'INTERSECT',
                    'AS',
                    'PLAN',
                ]
            )) {
            $where .= ' AND';
        }

        return str_replace(self::TEMPLATE_WHERE, " {$where} ", $this->sql);
    }

    /**
     * @param string $separator
     * @param string $string
     *
     * @return array
     */
    private function findWordsBeforeAndAfter($separator, $string)
    {
        $before = null;
        $after = null;

        $parts = explode($separator, $string);

        if (count($parts) != 2) {
            throw new \LogicException(
                $separator
                . " has to be used strictly once in string. Found "
                . (count($parts) - 1)
            );
        }

        $parts[0] = strrev($parts[0]);
        $pattern = "|\W*(\w+?)\W{0,1}|sU";

        preg_match($pattern, $parts[0], $matches);

        if (!empty($matches)) {
            $before = strrev($matches[1]);
        }

        preg_match($pattern, $parts[1], $matches);

        if (!empty($matches)) {
            $after = $matches[1];
        }

        return [$before, $after];
    }

    /**
     * Method substitutes {GROUPING} by specified grouping instructions
     */
    private function processGroupBy()
    {
        if (!empty($this->groupBy)) {
            if (strpos($this->sql, self::TEMPLATE_GROUPING) === false) {
                throw new \LogicException(
                    'You try to use grouping but the placeholder '
                    . self::TEMPLATE_GROUPING
                    . ' is absent in the template'
                );
            }

            $this->sql = str_replace(self::TEMPLATE_GROUPING, implode('', $this->groupBy), $this->sql);
        }
    }

    /**
     * Method substitutes {HAVING} by specified having instructions
     */
    private function processHaving()
    {
        if (!empty($this->having)) {
            if (strpos($this->sql, self::TEMPLATE_HAVING) === false) {
                throw new \LogicException(
                    'You try to use having but the placeholder '
                    . self::TEMPLATE_HAVING
                    . ' is absent in the template'
                );
            }

            $this->sql = str_replace(self::TEMPLATE_HAVING, implode('', $this->having), $this->sql);
        }
    }

    /**
     * Method substitutes {ORDER} by specified ordering instructions
     */
    private function processOrderBy()
    {
        if (!empty($this->orderBy)) {
            if (strpos($this->sql, self::TEMPLATE_ORDER) === false) {
                throw new \LogicException(
                    'You try to use having but the placeholder '
                    . self::TEMPLATE_ORDER
                    . ' is absent in the template'
                );
            }

            $this->sql = str_replace(self::TEMPLATE_ORDER, implode('', $this->orderBy), $this->sql);
        }
    }

    /**
     * Method parses prepared SQL to find all specified parameters (placeholders).
     * All placeholders have to be specified as follow - :placeholder:
     */
    private function retrieveTemplateParams()
    {
        $this->templateParams = [];
        $this->templateParamsPlaceholders = [];

        preg_match_all('/:([a-z]+[_a-z0-9]+):?/im', $this->sql, $matches);

        if (array_key_exists(1, $matches)) {
            $this->templateParams = array_unique($matches[1]);
        }
    }

    /**
     * Method loops through template parameters to assign their into appropriate parameters
     * that will be passed to DataProvider.
     * It raises exception in case when present in the SQL placeholder does not have appropriate
     * parameter among prepared for this query parameters.
     */
    private function retrieveParams()
    {
        foreach ($this->templateParams as $templateParam) {
            if (!$this->retrieveCustomParams($templateParam)) {
                if (!$this->retrieveRequestParams($templateParam)) {
                    throw new \LogicException(
                        'Placeholder '
                        . $templateParam
                        . ' is absent in the list of specified parameters. '
                        . 'Need to set valid request or param using setParam() method.'
                    );
                }
            }
        }
    }

    /**
     * Method returns true if parameter is in the Request object and false otherwise
     *
     * @param string $templateParam
     *
     * @return bool
     */
    private function retrieveRequestParams($templateParam)
    {
        if (($this->getRequest() instanceof Request) && $this->getRequest()->isParameterSet($templateParam)) {
            $this->params[$templateParam] = $this->getRequest()->{'get' . ucfirst($templateParam)}();

            return true;
        }

        return false;
    }

    /**
     * Method returns true if parameter is assigned to Builder and false otherwise
     *
     * @param string $templateParam
     *
     * @return bool
     */
    private function retrieveCustomParams($templateParam)
    {
        if (in_array($templateParam, array_keys($this->customParams))) {
            $this->params[$templateParam] = $this->customParams[$templateParam];

            return true;
        }

        return false;
    }

    /**
     * Method collects SQLs from list of builders for UNION (ALL) query
     *
     * @param Builder[] $builders
     *
     * @return string[]
     */
    private function collectSqlFromBuilders(array $builders)
    {
        if (count($builders) === 1) {
            throw new \LogicException('You need use in UNION [ALL] at least 2 stmt - but 1 was specified');
        }

        $sqls = [];
        foreach ($builders as $builder) {
            $sqls[] = $this->compileSqlFromBuilder($builder);
        }

        return $sqls;
    }

    /**
     * @param Builder $builder
     *
     * @return string
     */
    private function compileSqlFromBuilder(Builder $builder)
    {
        if ($builder->getRequest() && !$this->getRequest()) {
            $this->setRequest($builder->getRequest());
        } else {
            $builder->setRequest($this->getRequest());
        }

        if ($builder->isPreparedStmtUsed() === false) {
            $this->usePreparedStmt(false);
        } else {
            $builder->usePreparedStmt($this->isPreparedStmtUsed());
        }

        if ($builder->row && !$this->row) {
            $this->setRow($builder->row);
        }

        if ($builder->getParamsColumnTypes() && !$this->getParamsColumnTypes()) {
            $this->setParamsColumnTypes($builder->getParamsColumnTypes());
        }

        $builder->build();

        $sql = $builder->getSql();

        if (!empty($builder->getCustomParams())) {
            $suffix = static::getNextSuffix();
            $customParams = [];
            foreach ($builder->getCustomParams() as $name => $parameter) {
                $sql = preg_replace(
                    '/:(' . preg_quote($name) . ':?)([\s\(\)]){1}/im',
                    ':' . $name . $suffix . '$2',
                    $sql
                );
                $customParams[$name . $suffix] = $parameter;
            }
            $this->customParams += $customParams;
        }

        return $sql;
    }

    /**
     * @return string
     */
    protected static function getNextSuffix()
    {
        return dechex(static::$nestedSuffix++);
    }
}
