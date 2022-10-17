<?php

namespace Tests\Db\Sql;

use Phalcon\Db\Column;
use Phalcon\Db\Sql\Builder;

/**
 * Class BuilderTest
 *
 * @package Tests\Db\Sql
 */
class BuilderTest extends \Tests\CommonTestCase
{
    /*
     * Testing strategy:
     *
     * Partition inputs as follows:
     *
     *                                  S - success, F - failure
     *        Templates                 S   S   S   S   F   F   S
     * -----------------------------------------------------------
     *                                  [0-9] amount of placeholders
     *                                  which are represented in the template
     *
     * {EXPRESSION(namedExpression)}    0   1   3   1   1   1   1   |
     * {COLUMNS}                        1   0   1   1   1   1   1   |
     * {JOINS}                          1   1   0   1   1   1   1   |
     * {WHERE}                          1   1   1   0   1   1   1   |
     * {GROUPING}                       1   0   1   1   0   1   1   | Failure
     * {HAVING}                         1   0   1   1   1   0   1   |
     * {ORDER}                          1   1   1   0   1   1   0   |
     *
     *        Parameters               [0-9] amount of parameters
     *
     * Request parameters               3   0   0   2   1   1   2   |
     * Custom parameters                2   3   0   2   0   0   1   |
     * Overlapping Request/Custom       1   -   -   2   -   -   -   |
     * Actual needed parameters         4   3   0   1   1   2   2   | Failure
     *
     *     Other conditions
     *
     * prepared stmt                    +   -   -   +   +   +   +   |
     * custom object Row                -   +   -   +   -   -   -   |
     * using Phalcon column type        -   +   -   -   -   -   +   |
     *
     *     Cases for UNION
     * ------------------------------------------------------------
     *                                  [0-9] amount of builders
     *                                  create    clone
     *                                     1         0              | Failure
     *                                     1         1              | Success
     *
     */

    /**
     * @param string $sql
     * @param string $expectedSql
     * @param string $expectedDebugSql
     * @param array  $sqlParts
     * @param array  $params
     * @param array  $expectedParams
     * @param array  $additions
     *
     * @dataProvider dataProviderTestCoreLogicSuccess
     */
    public function testCoreLogicSuccess(
        $sql,
        $expectedSql,
        $expectedDebugSql,
        array $sqlParts,
        array $params,
        $expectedParams,
        array $additions
    ) {
        $builder = $this->createBuilder($sql, $sqlParts, $params, $additions);
        $builder->build();

        $this->assertSame($this->clearExcessCharacters($expectedSql), $this->clearExcessCharacters($builder->getSql()));
        $this->assertEquals($expectedParams, $builder->getParams());

        isset($additions['usePreparedStmt'])
            ? $this->assertSame($additions['usePreparedStmt'], $builder->isPreparedStmtUsed())
            : $this->assertTrue($builder->isPreparedStmtUsed());
        isset($additions['setRow'])
            ? $this->assertSame($additions['setRow'], $builder->getRow())
            : $this->assertInstanceOf('\Phalcon\Mvc\Model\Row', $builder->getRow());
        isset($additions['setParamsColumnTypes'])
            ? $this->assertSame($additions['setParamsColumnTypes'], $builder->getParamsColumnTypes())
            : $this->assertNull($builder->getParamsColumnTypes());
    }

    public function dataProviderTestCoreLogicSuccess()
    {
        return [
            [
                "
                SELECT
                    /*{COLUMNS}*/
                FROM
                     foo_table t1
                    INNER JOIN bar_table t2 ON t2.id = t1.id
                    /*{JOINS}*/
                WHERE
                    t1.a > t2.b
                    AND /*{WHERE}*/
                GROUP BY
                      t1.name
                    , t2.date
                    , exp
                    /*{GROUPING}*/
                HAVING
                    /*{HAVING}*/
                ORDER BY
                    /*{ORDER}*/
	            ",
                "
                SELECT
                     t3.third_name, t4.fourth_id 
                FROM
                     foo_table t1
                    INNER JOIN bar_table t2 ON t2.id = t1.id
                    INNER JOIN third_table t3 ON t3.ext_id = t2.id INNER JOIN fourth_table t4 ON t1.id = t4.ext_id LEFT JOIN fifth_table t5 ON t3.id = t5.ext_id
                WHERE
                    t1.a > t2.b
                    AND  t3.year > :year AND t5.code IN(:code0) AND t4.country = :countryCode 
                GROUP BY
                      t1.name
                    , t2.date
                    , exp
                    , t1.name, t2.date
                HAVING
                    COUNT(t1.name) > :count
                ORDER BY
                    t4.fourth_id
	            ",
                "
                SELECT
                     t3.third_name, t4.fourth_id 
                FROM
                     foo_table t1
                    INNER JOIN bar_table t2 ON t2.id = t1.id
                    INNER JOIN third_table t3 ON t3.ext_id = t2.id INNER JOIN fourth_table t4 ON t1.id = t4.ext_id LEFT JOIN fifth_table t5 ON t3.id = t5.ext_id
                WHERE
                    t1.a > t2.b
                    AND  t3.year > :year AND t5.code IN(:code) AND t4.country = :countryCode 
                GROUP BY
                      t1.name
                    , t2.date
                    , exp
                    , t1.name, t2.date
                HAVING
                    COUNT(t1.name) > :count
                ORDER BY
                    t4.fourth_id
	            ",
                [
                    'columns' => [[['t3.third_name', 't4.fourth_id']]],
                    'innerJoin' => ['third_table t3 ON t3.ext_id = t2.id', 'fourth_table t4 ON t1.id = t4.ext_id'],
                    'leftJoin' => ['fifth_table t5 ON t3.id = t5.ext_id'],
                    'where' => ['t3.year > :year', 't5.code IN(:code)', 't4.country = :countryCode'],
                    'groupBy' => [', t1.name, t2.date'],
                    'having' => ['COUNT(t1.name) > :count'],
                    'orderBy' => ['t4.fourth_id'],
                ],
                [
                    'request' => ['year' => 2017, 'code' => ['F', 'X'], 'countryCode' => 'GB'],
                    'custom' => ['count' => 5, 'countryCode' => 'IRE'],
                ],
                ['year' => 2017, 'code' => ['F', 'X'], 'countryCode' => 'IRE', 'count' => 5],
                [
                    'usePreparedStmt' => true,
                ],
            ],
            [
                "
                SELECT
                      t1.name
                    , t2.date
                    /*{COLUMNS}*/
                FROM
                     foo_table t1
                    INNER JOIN bar_table t2 ON t2.id = t1.id
                    /*{JOINS}*/
                WHERE
                    t1.a > t2.b
                    AND /*{WHERE}*/
                GROUP BY
                      t1.name
                    , t2.date
                    , exp
                    /*{GROUPING}*/
                HAVING
                    /*{HAVING}*/
                ORDER BY
                    /*{ORDER}*/
	            ",
                "
                SELECT
                      t1.name
                    , t2.date
                      ,t3.third_name, t4.fourth_id 
                FROM
                     foo_table t1
                    INNER JOIN bar_table t2 ON t2.id = t1.id
                    INNER JOIN third_table t3 ON t3.ext_id = t2.id INNER JOIN fourth_table t4 ON t1.id = t4.ext_id LEFT JOIN fifth_table t5 ON t3.id = t5.ext_id
                WHERE
                    t1.a > t2.b
                    AND  t3.year > :year AND t5.code IN(:code) AND t4.country = :countryCode 
                GROUP BY
                      t1.name
                    , t2.date
                    , exp
                    , t1.name, t2.date
                HAVING
                    COUNT(t1.name) > :count
                ORDER BY
                    t4.fourth_id
	            ",
                "
                SELECT
                      t1.name
                    , t2.date
                    , t3.third_name, t4.fourth_id
                FROM
                     foo_table t1
                    INNER JOIN bar_table t2 ON t2.id = t1.id
                    INNER JOIN third_table t3 ON t3.ext_id = t2.id INNER JOIN fourth_table t4 ON t1.id = t4.ext_id LEFT JOIN fifth_table t5 ON t3.id = t5.ext_id
                WHERE
                    t1.a > t2.b
                    AND t3.year > 2017 AND t5.code IN('F', 'X') AND t4.country = 'IRE'
                GROUP BY
                      t1.name
                    , t2.date
                    , exp
                    , t1.name, t2.date
                HAVING
                    COUNT(t1.name) > :count
                ORDER BY
                    t4.fourth_id
	            ",
                [
                    'columns' => [[['t3.third_name', 't4.fourth_id']]],
                    'innerJoin' => ['third_table t3 ON t3.ext_id = t2.id', 'fourth_table t4 ON t1.id = t4.ext_id'],
                    'leftJoin' => ['fifth_table t5 ON t3.id = t5.ext_id'],
                    'where' => ['t3.year > :year', 't5.code IN(:code)', 't4.country = :countryCode'],
                    'groupBy' => [', t1.name, t2.date'],
                    'having' => ['COUNT(t1.name) > :count'],
                    'orderBy' => ['t4.fourth_id'],
                ],
                [
                    'request' => ['year' => 2017, 'code' => ['F', 'X'], 'countryCode' => 'GB'],
                    'custom' => ['count' => 5, 'countryCode' => 'IRE'],
                ],
                ['year' => 2017, 'code' => ['F', 'X'], 'countryCode' => 'IRE', 'count' => 5],
                [
                    'usePreparedStmt' => true,
                ],
            ],
            [
                "
                SELECT
                      t1.name
                    , t2.date
                    /*{COLUMNS}*/
                FROM
                     foo_table t1
                    INNER JOIN bar_table t2 ON t2.id = t1.id
                    /*{JOINS}*/
                WHERE
                    t1.a > t2.b
                    AND /*{WHERE}*/
                GROUP BY
                      t1.name
                    , t2.date
                    , exp
                    /*{GROUPING}*/
                HAVING
                    /*{HAVING}*/
                ORDER BY
                    /*{ORDER}*/
	            ",
                "
                SELECT
                      t1.name
                    , t2.date
                      ,t3.third_name, t4.fourth_id 
                FROM
                     foo_table t1
                    INNER JOIN bar_table t2 ON t2.id = t1.id
                    INNER JOIN third_table t3 ON t3.ext_id = t2.id INNER JOIN fourth_table t4 ON t1.id = t4.ext_id LEFT JOIN fifth_table t5 ON t3.id = t5.ext_id
                WHERE
                    t1.a > t2.b
                    AND  t3.year > :year AND t5.code IN(:code) AND t4.country = :countryCode 
                GROUP BY
                      t1.name
                    , t2.date
                    , exp
                    , t1.name, t2.date
                HAVING
                    COUNT(t1.name) > :count
                ORDER BY
                    t4.fourth_id
	            ",
                "
                SELECT
                      t1.name
                    , t2.date
                    , t3.third_name, t4.fourth_id
                FROM
                     foo_table t1
                    INNER JOIN bar_table t2 ON t2.id = t1.id
                    INNER JOIN third_table t3 ON t3.ext_id = t2.id INNER JOIN fourth_table t4 ON t1.id = t4.ext_id LEFT JOIN fifth_table t5 ON t3.id = t5.ext_id
                WHERE
                    t1.a > t2.b
                    AND t3.year > 2017 AND t5.code IN('F', 'X') AND t4.country = 'IRE'
                GROUP BY
                      t1.name
                    , t2.date
                    , exp
                    , t1.name, t2.date
                HAVING
                    COUNT(t1.name) > :count
                ORDER BY
                    t4.fourth_id
	            ",
                [
                    'columns' => [', t3.third_name, t4.fourth_id'],
                    'innerJoin' => ['third_table t3 ON t3.ext_id = t2.id', 'fourth_table t4 ON t1.id = t4.ext_id'],
                    'leftJoin' => ['fifth_table t5 ON t3.id = t5.ext_id'],
                    'where' => ['t3.year > :year', 't5.code IN(:code)', 't4.country = :countryCode'],
                    'groupBy' => [', t1.name, t2.date'],
                    'having' => ['COUNT(t1.name) > :count'],
                    'orderBy' => ['t4.fourth_id'],
                ],
                [
                    'request' => ['year' => 2017, 'code' => ['F', 'X'], 'countryCode' => 'GB'],
                    'custom' => ['count' => 5, 'countryCode' => 'IRE'],
                ],
                ['year' => 2017, 'code' => ['F', 'X'], 'countryCode' => 'IRE', 'count' => 5],
                [
                    'usePreparedStmt' => true,
                ],
            ],
            [
                "
                SELECT
                      t1.name
                    , t2.date
                    , exp = CASE WHEN /*{EXPRESSION(isToday)}*/ THEN 1 ELSE 0 END
                FROM
                     foo_table t1
                    INNER JOIN bar_table t2 ON t2.id = t1.id
                    /*{JOINS}*/
                WHERE
                    t1.a > t2.b
                    AND /*{WHERE}*/
                GROUP BY
                      t1.name
                    , t2.date
                    , exp
                ORDER BY
                    /*{ORDER}*/
	            ",
                "
                SELECT
                      t1.name
                    , t2.date
                    , exp = CASE WHEN t4.date > today THEN 1 ELSE 0 END
                FROM
                     foo_table t1
                    INNER JOIN bar_table t2 ON t2.id = t1.id
                    LEFT JOIN fifth_table t5 ON t3.id = t5.ext_id INNER JOIN third_table t3 ON t3.ext_id = t2.id INNER JOIN fourth_table t4 ON t1.id = t4.ext_id
                WHERE
                    t1.a > t2.b
                    AND  t3.year > :year AND t5.code IN(:code) AND t4.country = :countryCode 
                GROUP BY
                      t1.name
                    , t2.date
                    , exp
                ORDER BY
                    t4.fourth_id
	            ",
                "
                SELECT
                      t1.name
                    , t2.date
                    , exp = CASE WHEN t4.date > today THEN 1 ELSE 0 END
                FROM
                     foo_table t1
                    INNER JOIN bar_table t2 ON t2.id = t1.id
                    LEFT JOIN fifth_table t5 ON t3.id = t5.ext_id INNER JOIN third_table t3 ON t3.ext_id = t2.id INNER JOIN fourth_table t4 ON t1.id = t4.ext_id
                WHERE
                    t1.a > t2.b
                    AND t3.year > 2017 AND t5.code IN('F', 'X') AND t4.country = 'GB'
                GROUP BY
                      t1.name
                    , t2.date
                    , exp
                ORDER BY
                    t4.fourth_id
	            ",
                [
                    'expression' => [['isToday', 't4.date > today']],
                    'leftJoin' => ['fifth_table t5 ON t3.id = t5.ext_id'],
                    'innerJoin' => ['third_table t3 ON t3.ext_id = t2.id', 'fourth_table t4 ON t1.id = t4.ext_id'],
                    'where' => ['t3.year > :year', 't5.code IN(:code)', 't4.country = :countryCode'],
                    'orderBy' => ['t4.fourth_id'],
                ],
                [
                    'custom' => ['year' => 2017, 'code' => ['F', 'X'], 'countryCode' => 'GB'],
                ],
                [
                    'year' => 2017,
                    'code' => ['F', 'X'],
                    'countryCode' => 'GB',
                ],
                [
                    'usePreparedStmt' => false,
                    'setRow' => new \Phalcon\Mvc\Model\Row\General(),
                    'setParamsColumnTypes' => [
                        'year' => Column::BIND_PARAM_INT,
                        'code' => Column::BIND_PARAM_STR,
                        'count' => Column::BIND_PARAM_INT,
                    ],
                ],
            ],
            [
                "
                SELECT
                      t1.name
                    , t2.date
                    , exp = /*{EXPRESSION(isToday)}*/
                    /*{COLUMNS}*/
                FROM
                     foo_table t1
                    INNER JOIN bar_table t2 ON /*{EXPRESSION(joinCondition)}*/
                WHERE
                    t1.a > t2.b
                    AND /*{WHERE}*/
                GROUP BY
                      t1.name
                    , t2.date
                    , /*{EXPRESSION(isToday)}*/
                    /*{GROUPING}*/
                HAVING
                    /*{HAVING}*/
                ORDER BY
                    /*{ORDER}*/
	            ",
                "
                SELECT
                      t1.name
                    , t2.date
                    , exp = CASE WHEN t4.date > today THEN 1 ELSE 0 END
                      ,t2.third_name, t2.fourth_id 
                FROM
                     foo_table t1
                    INNER JOIN bar_table t2 ON t2.id = t1.id
                WHERE
                    t1.a > t2.b
                    AND  t2.year > 1980 AND t2.code IN('F', 'X') AND t2.country = 'GB' 
                GROUP BY
                      t1.name
                    , t2.date
                    , CASE WHEN t4.date > today THEN 1 ELSE 0 END
                    , t1.name, t2.date
                HAVING
                    COUNT(t1.name) > 5
                ORDER BY
                    t2.fourth_id
	            ",
                "
                SELECT
                      t1.name
                    , t2.date
                    , exp = CASE WHEN t4.date > today THEN 1 ELSE 0 END
                      ,t2.third_name, t2.fourth_id 
                FROM
                     foo_table t1
                    INNER JOIN bar_table t2 ON t2.id = t1.id
                WHERE
                    t1.a > t2.b
                    AND  t2.year > 1980 AND t2.code IN('F', 'X') AND t2.country = 'GB' 
                GROUP BY
                      t1.name
                    , t2.date
                    , CASE WHEN t4.date > today THEN 1 ELSE 0 END
                    , t1.name, t2.date
                HAVING
                    COUNT(t1.name) > 5
                ORDER BY
                    t2.fourth_id
	            ",
                [
                    'expression' => [
                        ['isToday', 'CASE WHEN t4.date > today THEN 1 ELSE 0 END'],
                        ['joinCondition', 't2.id = t1.id'],
                    ],
                    'columns' => ['t2.third_name, t2.fourth_id,'],
                    'where' => ["AND t2.year > 1980", "t2.code IN('F', 'X')", "t2.country = 'GB'"],
                    'groupBy' => [', t1.name, t2.date'],
                    'having' => ['COUNT(t1.name) > 5'],
                    'orderBy' => ['t2.fourth_id'],
                ],
                [],
                null,
                [
                    'usePreparedStmt' => false,
                ],
            ],
            [
                "
                SELECT
                      t1.name
                    , t2.date
                    , exp = /*{EXPRESSION(isToday)}*/
                    /*{COLUMNS}*/
                FROM
                     foo_table t1
                    INNER JOIN bar_table t2 ON t2.id = t1.id
                    /*{JOINS}*/
                WHERE
                    t1.a > t2.b
                    /*{WHERE}*/
                GROUP BY
                      t1.name
                    , t2.date
                    /*{GROUPING}*/
                HAVING
                    /*{HAVING}*/
                ORDER BY
                    /*{ORDER}*/
	            ",
                "
                SELECT
                      t1.name
                    , t2.date
                    , exp = CASE WHEN t4.code IN (:code) THEN 1 ELSE 0 END
                      ,t3.third_name, t4.fourth_id 
                FROM
                     foo_table t1
                    INNER JOIN bar_table t2 ON t2.id = t1.id
                    INNER JOIN third_table t3 ON t3.ext_id = t2.id INNER JOIN fourth_table t4 ON t1.id = t4.ext_id LEFT JOIN fifth_table t5 ON t3.id = t5.ext_id
                WHERE
                    t1.a > t2.b
                    
                GROUP BY
                      t1.name
                    , t2.date
                    , t1.name, t2.date
                HAVING
                    COUNT(t1.name) > 5
                ORDER BY
                    t4.fourth_id
	            ",
                "
                SELECT
                      t1.name
                    , t2.date
                    , exp = CASE WHEN t4.code IN ('J', 'M', 'K', 'N') THEN 1 ELSE 0 END
                    , t3.third_name, t4.fourth_id
                FROM
                     foo_table t1
                    INNER JOIN bar_table t2 ON t2.id = t1.id
                    INNER JOIN third_table t3 ON t3.ext_id = t2.id INNER JOIN fourth_table t4 ON t1.id = t4.ext_id LEFT JOIN fifth_table t5 ON t3.id = t5.ext_id
                WHERE
                    t1.a > t2.b
                    
                GROUP BY
                      t1.name
                    , t2.date
                    , t1.name, t2.date
                HAVING
                    COUNT(t1.name) > 5
                ORDER BY
                    t4.fourth_id
	            ",
                [
                    'expression' => [
                        ['isToday', 'CASE WHEN t4.code IN (:code) THEN 1 ELSE 0 END'],
                    ],
                    'columns' => [', t3.third_name, t4.fourth_id'],
                    'innerJoin' => ['third_table t3 ON t3.ext_id = t2.id', 'fourth_table t4 ON t1.id = t4.ext_id'],
                    'leftJoin' => ['fifth_table t5 ON t3.id = t5.ext_id'],
                    'where' => [],
                    'groupBy' => [', t1.name, t2.date'],
                    'having' => ['COUNT(t1.name) > 5'],
                    'orderBy' => ['t4.fourth_id'],
                ],
                [
                    'request' => ['code' => ['F', 'X'], 'countryCode' => 'GB'],
                    'custom' => ['code' => ['J', 'M', 'K', 'N'], 'countryCode' => 'IRE'],
                ],
                ['code' => ['J', 'M', 'K', 'N']],
                [
                    'usePreparedStmt' => true,
                    'setRow' => new \Phalcon\Mvc\Model\Row\General(),
                ],
            ],
            [
                "
                SELECT
                      t1.name
                    , t2.date
                    , exp = CASE WHEN /*{EXPRESSION(isToday)}*/ THEN 1 ELSE 0 END
                FROM
                     foo_table t1
                    INNER JOIN bar_table t2 ON t2.id = t1.id
                    /*{JOINS}*/
                WHERE
                    t1.a > t2.b
                    AND /*{WHERE}*/
                GROUP BY
                      t1.name
                    , t2.date
                    , /*{GROUPING}*/
                ORDER BY
                    t4.fourth_id
	            ",
                "
                SELECT
                      t1.name
                    , t2.date
                    , exp = CASE WHEN t4.date > today THEN 1 ELSE 0 END
                FROM
                     foo_table t1
                    INNER JOIN bar_table t2 ON t2.id = t1.id
                    LEFT JOIN fifth_table t5 ON t3.id = t5.ext_id INNER JOIN third_table t3 ON t3.ext_id = t2.id INNER JOIN fourth_table t4 ON t1.id = t4.ext_id
                WHERE
                    t1.a > t2.b
                    AND  t3.year > :year AND t5.code IN(:code) AND t4.country = :countryCode 
                GROUP BY
                      t1.name
                    , t2.date
                    , exp
                ORDER BY
                    t4.fourth_id
	            ",
                "
                SELECT
                      t1.name
                    , t2.date
                    , exp = CASE WHEN t4.date > today THEN 1 ELSE 0 END
                FROM
                     foo_table t1
                    INNER JOIN bar_table t2 ON t2.id = t1.id
                    LEFT JOIN fifth_table t5 ON t3.id = t5.ext_id INNER JOIN third_table t3 ON t3.ext_id = t2.id INNER JOIN fourth_table t4 ON t1.id = t4.ext_id
                WHERE
                    t1.a > t2.b
                    AND t3.year > 2017 AND t5.code IN('F', 'X') AND t4.country = 'GB'
                GROUP BY
                      t1.name
                    , t2.date
                    , exp
                ORDER BY
                    t4.fourth_id
	            ",
                [
                    'expression' => [['isToday', 't4.date > today']],
                    'leftJoin' => ['fifth_table t5 ON t3.id = t5.ext_id'],
                    'innerJoin' => ['third_table t3 ON t3.ext_id = t2.id', 'fourth_table t4 ON t1.id = t4.ext_id'],
                    'where' => ['t3.year > :year', 't5.code IN(:code)', 't4.country = :countryCode'],
                    'groupBy' => ['exp'],
                ],
                [
                    'custom' => ['year' => 2017, 'code' => ['F', 'X'], 'countryCode' => 'GB'],
                ],
                [
                    'year' => 2017,
                    'code' => ['F', 'X'],
                    'countryCode' => 'GB',
                ],
                [
                    'usePreparedStmt' => false,
                    'setRow' => new \Phalcon\Mvc\Model\Row\General(),
                    'setParamsColumnTypes' => [
                        'year' => Column::BIND_PARAM_INT,
                        'code' => Column::BIND_PARAM_STR,
                        'count' => Column::BIND_PARAM_INT,
                    ],
                ],
            ],
        ];
    }

    /**
     * @param string $sql
     * @param array  $sqlParts
     * @param array  $params
     * @param array  $additions
     *
     * @dataProvider dataProviderTestCoreLogicFailure
     */
    public function testCoreLogicFailure($sql, array $sqlParts, array $params, array $additions = [])
    {
        $builder = $this->createBuilder($sql, $sqlParts, $params, $additions);

        $this->setExpectedException('\LogicException');
        $builder->build();
    }

    public function dataProviderTestCoreLogicFailure()
    {
        return [
            [//absence some statement in the template but presence in the parameters
             "
                SELECT
                      t1.name
                    , t2.date
                    , exp = CASE WHEN /*{EXPRESSION(isToday)}*/ THEN 1 ELSE 0 END
                    /*{COLUMNS}*/
                FROM
                     foo_table t1
                    INNER JOIN bar_table t2 ON t2.id = t1.id
                    /*{JOINS}*/
                WHERE
                    t1.a > t2.b
                    AND /*{WHERE}*/
                GROUP BY
                      t1.name
                    , t2.date
                HAVING
                    /*{HAVING}*/
                ORDER BY
                    /*{ORDER}*/
	            ",
             [
                 'expression' => [['isToday', 't4.date > today']],
                 'columns' => ['t3.third_name, t4.fourth_id'],
                 'innerJoin' => ['third_table t3 ON t3.ext_id = t2.id', 'fourth_table t4 ON t1.id = t4.ext_id'],
                 'leftJoin' => ['fifth_table t5 ON t3.id = t5.ext_id'],
                 'where' => ['t3.year > 2017', 't5.code IN(:code)', "t4.country = 'GB'"],
                 'groupBy' => [', t1.name, t2.date'],
                 'having' => ['COUNT(t1.name) > 5'],
                 'orderBy' => ['t4.fourth_id'],
             ],
             [
                 'request' => ['code' => ['F', 'X']],
             ],
            ],
            [//inconsistency of parameters
             "
                SELECT
                      t1.name
                    , t2.date
                    , exp = CASE WHEN /*{EXPRESSION(isToday)}*/ THEN 1 ELSE 0 END
                    /*{COLUMNS}*/
                FROM
                     foo_table t1
                    INNER JOIN bar_table t2 ON t2.id = t1.id
                    /*{JOINS}*/
                WHERE
                    t1.a > t2.b
                    /*{WHERE}*/
                GROUP BY
                      t1.name
                    , t2.date
                    /*{GROUPING}*/
                ORDER BY
                    /*{ORDER}*/
	            ",
             [
                 'expression' => [['isToday', 't4.date > today']],
                 'columns' => [['t3.third_name', 't4.fourth_id']],
                 'innerJoin' => ['third_table t3 ON t3.ext_id = t2.id', 'fourth_table t4 ON t1.id = t4.ext_id'],
                 'leftJoin' => ['fifth_table t5 ON t3.id = t5.ext_id'],
                 'where' => ['t3.year > :year', 't5.code IN(:code)', "t4.country = 'GB'"],
                 'groupBy' => [', t1.name, t2.date'],
                 'orderBy' => ['t4.fourth_id'],
             ],
             [
                 'request' => ['code' => ['F', 'X']],
             ],
            ],
        ];
    }

    /**
     * @param         $sql
     * @param         $expectedSql
     * @param array   $sqlPartsFirst
     * @param array   $sqlPartsSecond
     * @param array   $params
     * @param         $expectedParams
     * @param array   $additions
     * @param boolean $isUnionAll
     *
     * @dataProvider dataProviderTestUnionLogicSuccess
     */
    public function testUnionLogicSuccess(
        $sql,
        $expectedSql,
        array $sqlPartsFirst,
        array $sqlPartsSecond,
        array $params,
        $expectedParams,
        array $additions,
        $isUnionAll = false
    ) {

        $builder = new Builder();

        if ($isUnionAll) {
            $secondBuilder = $this->createBuilder($sql, $sqlPartsSecond, $params, $additions);
            $firstBuilder = clone $secondBuilder;
            $this->setSqlPartsOfBuilder($sqlPartsFirst, $firstBuilder);

            $builder->unionAll([$firstBuilder, $secondBuilder]);
        } else {
            $firstBuilder = $this->createBuilder($sql, $sqlPartsFirst, $params, $additions);
            $secondBuilder = clone $firstBuilder;
            $this->setSqlPartsOfBuilder($sqlPartsSecond, $secondBuilder);

            $builder->union([$firstBuilder, $secondBuilder]);
        }
        $builder->build();

        $this->assertSame($this->clearExcessCharacters($expectedSql), $this->clearExcessCharacters($builder->getSql()));
        $this->assertEquals($expectedParams, $this->clearExcessCharactersArray($builder->getParams()));

        isset($additions['usePreparedStmt'])
            ? $this->assertSame($additions['usePreparedStmt'], $builder->isPreparedStmtUsed())
            : $this->assertTrue($builder->isPreparedStmtUsed());
        isset($additions['setRow'])
            ? $this->assertSame($additions['setRow'], $builder->getRow())
            : $this->assertInstanceOf('\Phalcon\Mvc\Model\Row', $builder->getRow());
        isset($additions['setParamsColumnTypes'])
            ? $this->assertSame($additions['setParamsColumnTypes'], $builder->getParamsColumnTypes())
            : $this->assertNull($builder->getParamsColumnTypes());
    }

    /**
     * @return array
     */
    public function dataProviderTestUnionLogicSuccess()
    {
        $builder = new Builder();
        $builder->setSqlTemplate('INSERT INTO #tmp_table tmp');

        $data = [
            [
                "
                SELECT
                      t1.name
                    , t2.date
                    , exp = CASE WHEN /*{EXPRESSION(isToday)}*/ THEN 1 ELSE 0 END
                /*{EXPRESSION(insertIntoStmt)}*/
                FROM
                     foo_table t1
                    INNER JOIN bar_table t2 ON t2.id = t1.id
                    /*{JOINS}*/
                WHERE
                    t1.a > t2.b
                    AND /*{WHERE}*/
                GROUP BY
                      t1.name
                    , t2.date
                    , exp
                ORDER BY
                    /*{ORDER}*/
                ",
                "
                SELECT
                      t1.name
                    , t2.date
                    , exp = CASE WHEN t4.date > today THEN 1 ELSE 0 END
                INSERT INTO #tmp_table tmp
                FROM
                     foo_table t1
                    INNER JOIN bar_table t2 ON t2.id = t1.id
                    INNER JOIN third_table t3 ON t3.ext_id = t2.id
                WHERE
                    t1.a > t2.b
                    AND  t5.code IN(:code) 
                GROUP BY
                      t1.name
                    , t2.date
                    , exp
                ORDER BY
                    t4.fourth_id
                UNION
                SELECT
                      t1.name
                    , t2.date
                    , exp = CASE WHEN t4.date > today THEN 1 ELSE 0 END
                FROM
                     foo_table t1
                    INNER JOIN bar_table t2 ON t2.id = t1.id
                    LEFT JOIN fifth_table t5 ON t3.id = t5.ext_id INNER JOIN fourth_table t4 ON t1.id = t4.ext_id
                WHERE
                    t1.a > t2.b
                    AND t3.year > :year AND t4.country = :countryCode
                GROUP BY
                      t1.name
                    , t2.date
                    , exp
                ORDER BY
                    t4.fourth_id
                ",
                [
                    'expression' => [['isToday', 't4.date > today'], ['insertIntoStmt', $builder]],
                    'innerJoin' => ['third_table t3 ON t3.ext_id = t2.id'],
                    'where' => ['t5.code IN(:code)'],
                    'orderBy' => ['t4.fourth_id'],
                ],
                [
                    'expression' => [['isToday', 't4.date > today'], ['insertIntoStmt', '']],
                    'leftJoin' => ['fifth_table t5 ON t3.id = t5.ext_id'],
                    'innerJoin' => ['fourth_table t4 ON t1.id = t4.ext_id'],
                    'where' => ['t3.year > :year', 't4.country = :countryCode'],
                    'orderBy' => ['t4.fourth_id'],
                ],
                [
                    'custom' => ['year' => 2017, 'code' => ['F', 'X'], 'countryCode' => 'GB'],
                ],
                [
                    'year' => 2017,
                    'code' => ['F', 'X'],
                    'countryCode' => 'GB',
                ],
                [
                    'usePreparedStmt' => false,
                    'setRow' => new \Phalcon\Mvc\Model\Row\General(),
                    'setParamsColumnTypes' => [
                        'year' => Column::BIND_PARAM_INT,
                        'code' => Column::BIND_PARAM_STR,
                        'count' => Column::BIND_PARAM_INT,
                    ],
                ],
            ],
            [
                "
                SELECT
                      t1.name
                    , t2.date
                    , exp = CASE WHEN /*{EXPRESSION(isToday)}*/ THEN 1 ELSE 0 END
                /*{EXPRESSION(insertIntoStmt)}*/
                FROM
                     foo_table t1
                    INNER JOIN bar_table t2 ON t2.id = t1.id
                    /*{JOINS}*/
                WHERE
                    t1.a > t2.b
                    AND /*{WHERE}*/
                GROUP BY
                      t1.name
                    , t2.date
                    , exp
                ORDER BY
                    /*{ORDER}*/
                ",
                "
                SELECT
                      t1.name
                    , t2.date
                    , exp = CASE WHEN t4.date > today THEN 1 ELSE 0 END
                INSERT INTO #tmp_table tmp
                FROM
                     foo_table t1
                    INNER JOIN bar_table t2 ON t2.id = t1.id
                    INNER JOIN third_table t3 ON t3.ext_id = t2.id
                WHERE
                    t1.a > t2.b
                    AND  t5.code IN(:code) 
                GROUP BY
                      t1.name
                    , t2.date
                    , exp
                ORDER BY
                    t4.fourth_id
                UNION ALL
                SELECT
                      t1.name
                    , t2.date
                    , exp = CASE WHEN t4.date > today THEN 1 ELSE 0 END
                FROM
                     foo_table t1
                    INNER JOIN bar_table t2 ON t2.id = t1.id
                    LEFT JOIN fifth_table t5 ON t3.id = t5.ext_id INNER JOIN fourth_table t4 ON t1.id = t4.ext_id
                WHERE
                    t1.a > t2.b
                    AND t3.year > :year AND t4.country = :countryCode
                GROUP BY
                      t1.name
                    , t2.date
                    , exp
                ORDER BY
                    t4.fourth_id
                ",
                [
                    'expression' => [['isToday', 't4.date > today'], ['insertIntoStmt', $builder]],
                    'innerJoin' => ['third_table t3 ON t3.ext_id = t2.id'],
                    'where' => ['t5.code IN(:code)'],
                    'orderBy' => ['t4.fourth_id'],
                ],
                [
                    'expression' => [['isToday', 't4.date > today'], ['insertIntoStmt', '']],
                    'leftJoin' => ['fifth_table t5 ON t3.id = t5.ext_id'],
                    'innerJoin' => ['fourth_table t4 ON t1.id = t4.ext_id'],
                    'where' => ['t3.year > :year', 't4.country = :countryCode'],
                    'orderBy' => ['t4.fourth_id'],
                ],
                [
                    'custom' => ['year' => 2017, 'code' => ['F', 'X'], 'countryCode' => 'GB'],
                ],
                [
                    'year' => 2017,
                    'code' => ['F', 'X'],
                    'countryCode' => 'GB',
                ],
                [],
                true//union all
            ],
        ];

        return $data;
    }

    /**
     * @param boolean $isUnionAll
     *
     * @dataProvider dataProviderTestUnionLogicFailure
     */
    public function testUnionLogicFailure($isUnionAll)
    {
        $builder = new Builder();

        $this->setExpectedException('\LogicException', 'You can UNION [ALL] at least 2 stmt - but 1 was specified');
        $isUnionAll
            ? $builder->unionAll([new Builder()])
            : $builder->union([new Builder()]);
    }

    public function dataProviderTestUnionLogicFailure()
    {
        return [
            [false],
            [true],
        ];
    }

    /**
     * @param $sqlTemplate
     * @param $expectedSql
     * @param array $expression
     * @param string $where
     *
     * @dataProvider dataProviderExpressionFailure
     */
    public function testExpressionFailure(
        $sqlTemplate,
        $expectedSql,
        array $expression,
        string $where
    ) {
        $this->setExpectedException(
            '\LogicException'
        );

        $builder = new Builder();
        $builder->setSqlTemplate($sqlTemplate);

        $builder->expression($expression['key'], $expression['value']);

        if (!empty($where)) {
            $builder->where($where);
        }

        $builder->build();

        $this->assertEquals($expectedSql, $builder->getSql());
    }

    /**
     * @return array
     */
    public function dataProviderExpressionFailure()
    {
        return [
            [
                "SELECT * FROM test WHERE /*{EXPRESSION(wrongExpr)}*/",
                "SELECT * FROM test WHERE 1 = 1",
                [
                    'key' => 'expr',
                    'value' => '1 = 1'
                ],
                ''
            ],
            [
                "SELECT * FROM test WHERE /*{WHERE}*/",
                "SELECT * FROM test WHERE  1 = 1 ",
                [
                    'key' => 'expr',
                    'value' => '1 = 1'
                ],
                '/*{EXPRESSION(wrongExpr)}*/'
            ]
        ];
    }

    /**
     * @param $sqlTemplate
     * @param $expectedSql
     * @param array $expression
     * @param string $where
     *
     * @dataProvider dataProviderComplexExpressionSuccess
     */
    public function testComplexExpressionSuccess(
        $sqlTemplate,
        $expectedSql,
        array $expression,
        string $where
    ) {
        $builder = new Builder();
        $builder->setSqlTemplate($sqlTemplate);

        $builder->expression($expression['key'], $expression['value']);
        $builder->where($where);
        $builder->build();

        $this->assertEquals($expectedSql, $builder->getSql());
    }

    /**
     * @return array
     */
    public function dataProviderComplexExpressionSuccess()
    {
        return [
            [
                "SELECT * FROM test WHERE /*{WHERE}*/",
                "SELECT * FROM test WHERE  1 = 1 ",
                [
                    'key' => 'expr',
                    'value' => '1 = 1'
                ],
                "/*{EXPRESSION(expr)}*/"
            ]
        ];
    }

    /**
     * @param string $sql
     * @param array  $firstParams
     * @param array  $secondParams
     * @param array  $finalResult
     *
     * @dataProvider dataProviderTestSetParam
     */
    public function testSetParam($sql, array $firstParams, array $secondParams, array $finalResult)
    {
        $builder = new Builder();
        $builder->setSqlTemplate($sql);
        $reflectionClass = new \ReflectionClass('Phalcon\Db\Sql\Builder');
        $reflectionProperty = $reflectionClass->getProperty('customParams');
        $reflectionProperty->setAccessible(true);

        $this->setArrayParams($builder, $firstParams);
        $this->assertEquals($firstParams, $reflectionProperty->getValue($builder));

        $this->setArrayParams($builder, $secondParams);
        $this->assertEquals($finalResult, $reflectionProperty->getValue($builder));

        $reflectionProperty->setValue($builder, $secondParams);
        $builder->build();
        $this->assertEquals($secondParams, $builder->getParams());
    }

    /**
     * @return array
     */
    public function dataProviderTestSetParam()
    {
        return [
            [
                '
                    SELECT p1
                    FROM t1
                    WHERE 
                      params IN ((:key2), (:key4))
                    ',
                [
                    'key1' => 'value1',
                    'key2' => 'value2',
                    'key3' => 'value3',
                ],
                [
                    'key4' => 'value4',
                    'key2' => 'newValue2',
                ],
                [
                    'key1' => 'value1',
                    'key2' => 'newValue2',
                    'key3' => 'value3',
                    'key4' => 'value4',
                ],
            ],
        ];
    }

    /**
     * @param array $paramsType
     *
     * @dataProvider dataProviderTestSetParamsColumnType
     */
    public function testSetParamsColumnType(array $paramsType)
    {
        $builder = new Builder();
        $reflectionClass = new \ReflectionClass('Phalcon\Db\Sql\Builder');

        foreach ($paramsType as $key => $value) {
            $builder->setParam($key, $value);
        }
        $reflectionProperty = $reflectionClass->getProperty('customParams');
        $reflectionProperty->setAccessible(true);
        $this->assertEquals($reflectionProperty->getValue($builder), $paramsType);
    }

    /**
     * @return array
     */
    public function dataProviderTestSetParamsColumnType()
    {
        return [
            [
                [
                    'key_int' => Column::BIND_PARAM_INT,
                    'key_blob' => Column::BIND_PARAM_BLOB,
                ],
            ],
        ];
    }

    /**
     * @param Builder $builder
     * @param array   $params
     */
    private function setArrayParams(Builder &$builder, array $params)
    {
        foreach ($params as $key => $value) {
            $builder->setParam($key, $value);
        }
    }

    /**
     * @param string $sql
     * @param array  $sqlParts
     * @param array  $params
     * @param array  $additions
     *
     * @return Builder
     */
    private function createBuilder($sql, array $sqlParts, array $params, array $additions = [])
    {
        $builder = new Builder();
        $builder->setSqlTemplate($sql);

        $this->setSqlPartsOfBuilder($sqlParts, $builder);

        if (!empty($params['request']) || !empty($params['custom'])) {
            $requestMock = $this->buildRequestMock($params);
            $builder->setRequest($requestMock);
        }

        if (!empty($params['custom'])) {
            $this->setArrayParams($builder, $params['custom']);
        }

        if (!empty($additions)) {
            foreach ($additions as $builderMethodName => $value) {
                $builder->{$builderMethodName}($value);
            }
        }

        return $builder;
    }

    /**
     * @param array $sqlParts
     * @param       $builder
     */
    private function setSqlPartsOfBuilder(array $sqlParts, $builder)
    {
        foreach ($sqlParts as $methodName => $sqls) {
            foreach ($sqls as $sql) {
                call_user_func_array([$builder, $methodName], (array)$sql);
            }
        }
    }

    /**
     * @param $params
     *
     * @return \Phalcon\Input\Request
     */
    private function buildRequestMock($params)
    {
        $totalParamsList = [];
        if (isset($params['request'])) {
            $totalParamsList = $params['request'];
            $requestParams = $params['request'];
        } else {
            $requestParams = [];
        }
        if (isset($params['custom'])) {
            $totalParamsList += $params['custom'];
        }
        $requestMethods = array_map(function ($paramName) {
            return 'get' . ucfirst($paramName);
        }, array_keys($totalParamsList));
        $requestMethods[] = 'isParameterSet';
        $requestMethods[] = 'setupParameters';

        $requestMock = $this->getMockBuilder('\Phalcon\Input\Request')
            ->setMethods($requestMethods)
            ->disableOriginalConstructor()
            ->getMock();

        $requestMock->expects($this->any())
            ->method('isParameterSet')
            ->will($this->returnCallback(function ($arg) use ($requestParams) {
                return in_array($arg, array_keys($requestParams));
            }));

        foreach ($requestParams as $paramName => $paramValue) {
            $requestMock->expects($this->any())
                ->method('get' . ucfirst($paramName))
                ->willReturn($paramValue);
        }

        return $requestMock;
    }

    /**
     * @param string $statement
     * @return string
     */
    private function clearExcessCharacters(string $statement): string
    {
        $statement = strtolower(trim(preg_replace("/\s+/", " ", $statement)));
        $statement = preg_replace("/(\:\w+)\d+/", '$1', $statement);

        return $statement;
    }

    /**
     * @param array $params
     * @return array
     */
    private function clearExcessCharactersArray(array $params): array
    {
        foreach ($params as $key => $value) {
            unset($params[$key]);
            $key = preg_replace("/(\w+)\d+/", '$1', $key);
            $params[$key] = $value;
        }

        return $params;
    }
}
