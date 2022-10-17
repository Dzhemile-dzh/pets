<?php

declare(strict_types=1);

namespace Phalcon\Db\Adapter;

use Phalcon\Db\Adapter\Strategy\EmulateStrategyInterface;
use Phalcon\Db\Adapter\Strategy\EmulationQuery;
use Phalcon\Db\Adapter\Strategy\EmulationStrategyInterface;
use Phalcon\Db\Column;
use Phalcon\Db\Exception;
use Phalcon\Db\Result\Sybase as Result;

/**
 * @package Phalcon\Db\Adapter
 */
class Sybase extends \Phalcon\Db\Adapter implements \Phalcon\Db\AdapterInterface
{

    /** @var $customPdoClass \PDO */
    private static $customPdoClass = null;

    protected $_type = 'sybase';

    protected $_dialectType = 'Sybase';

    /**
     * @var \PDO
     */
    protected $_connection = null;

    protected $_affectedRows;

    protected $_transactionLevel = 0;

    /**
     * @var \Phalcon\Events\Manager
     */
    protected $_eventsManager;

    protected $_descriptor;

    /**
     * @var \Phalcon\Db\Dialect\Sybase
     */
    protected $_dialect;

    protected $_connectionId;

    protected $_sqlStatement;

    protected $_sqlBindedStatement;

    protected $_sqlVariables;

    protected $_sqlBindTypes;

    protected $_transactionsWithSavepoints = true;

    protected static $_connectionConsecutive;

    protected $_isUsePreparedStatements = false;

    /**
     * @var SybaseAccessor
     */
    protected static $_access;

    /**
     * @var array Messages collected from database
     */
    private $messages = [];

    /**
     * Minimal error severity level to display if no configuration found
     */
    const MIN_SEVERITY_DEFAULT = 17;

    /**
     * String conversion parameters used in escape function.
     *
     *  JSON_HEX_TAG ^ JSON_HEX_AMP ^ JSON_HEX_APOS ^ JSON_HEX_QUOT
     */
    const STR_ESCAPE_CONV_PARAMS = 15;

    /** @var EmulationStrategyInterface */
    private $emulationStrategy;

    /**
     * Sybase constructor.
     *
     * @param array $descriptor
     *
     * @throws Exception
     */
    public function __construct(array $descriptor)
    {
        if (!is_array($descriptor)) {
            throw new Exception("The descriptor must be an array");
        } elseif (!is_null(static::$_access) && !static::$_access->open()) {
            throw new Exception("Connections exceeded allowed threshold");
        }

        $this->connect($descriptor);

        // Dialect class can override the default dialect
        if (empty($descriptor['dialectClass'])) {
            $dialectClass = 'Phalcon\Db\Dialect\\' . $this->_dialectType;
        } else {
            $dialectClass = $descriptor['dialectClass'];
        }
        // Create the instance only if the dialect is a string
        if (is_string($dialectClass)) {
            $this->_dialect = new $dialectClass();
        }

        $this->_descriptor = $descriptor;
    }

    /**
     * This method is automatically called in constructor.
     * Call it when you need to restore a database connection
     *
     *<code>
     * //Make a connection
     * $connection = new \Phalcon\Db\Adapter\Sybase(array(
     *  'servername' => 'SHARK',
     *  'username' => 'sigma',
     *  'password' => 'secret',
     *  'dbname' => 'blog',
     * ));
     *
     * //Reconnect
     * $connection->connect();
     * </code>
     *
     * @param    array $descriptor
     *
     * @return bool
     * @throws Exception
     */
    public function connect(array $descriptor = null)
    {
        if (is_null($descriptor)) {
            $descriptor = $this->_descriptor;
        }

        if (!isset($descriptor['username'])
            || !isset($descriptor['password'])
            || !isset($descriptor['servername'])
            || !isset($descriptor['dbname'])
        ) {
            throw new Exception('Empty connection parameters');
        }

        $connectionOptions = "";

        if (defined('PRODUCT_KEY') || defined('PRODUCT_VERSION')) {
            $appname = implode('_', [
                defined('PRODUCT_KEY') ? PRODUCT_KEY : '',
                defined('PRODUCT_VERSION') ? PRODUCT_VERSION : ''
            ]);
            $connectionOptions .= ";appname={$appname}";
        }

        if (array_key_exists('charset', $descriptor) && !empty($descriptor['charset'])) {
            $connectionOptions .= ";charset={$descriptor['charset']}";
        }

        $persistent = (isset($descriptor['persistent']) && $descriptor['persistent']) ?
            [\PDO::ATTR_PERSISTENT => true] :
            null;

        $this->_connection = $this->getPdoConnection(
            $connectionOptions,
            $descriptor,
            $persistent
        );

        $this->_isUsePreparedStatements =
            isset($descriptor['usePreparedStatements'])
            && $descriptor['usePreparedStatements'];

        return ($this->_connection->errorCode() === '00000');
    }

    /**
     * @param string $connectionOptions
     * @param array $descriptor
     * @param array|null $persistent
     *
     * @return \PDO
     * @throws Exception
     */
    protected function getPdoConnection(
        string $connectionOptions,
        array $descriptor,
        ?array $persistent
    ) {
        $servers = explode(";", $descriptor['servername']);

        $failMessages = [];

        foreach ($servers as $server) {
            $connectionString = "dblib:host=" . trim($server) . ";dbname={$descriptor['dbname']}" . $connectionOptions;

            $connection = null;
            try {
                $connection = (Sybase::$customPdoClass === null) ?
                    new \PDO($connectionString, $descriptor['username'], $descriptor['password'], $persistent) :
                    Sybase::$customPdoClass;
            } catch (\Exception $e) {
                $failMessages[] = $e->getMessage();
            }

            if (!$this->isErrors(null, $connection)) {
                return $connection;
            } else {
                $failMessages[] = $this->messages;
            }
        }

        throw new Exception(
            "Could not initialize any connection using servers: {$descriptor['servername']}\n
            Fail messages: " . var_export($failMessages, true)
        );
    }

    /**
     * @return string
     */
    public function getSQLBindedStatement()
    {
        return $this->_sqlBindedStatement;
    }

    /**
     * Escapes a column/table/schema name
     *
     *<code>
     *    $escapedTable = $connection->escapeIdentifier('robots');
     *    $escapedTable = $connection->escapeIdentifier(array('store', 'robots'));
     *</code>
     *
     * @param string $identifier
     *
     * @return string
     */
    public function escapeIdentifier($identifier)
    {
        return $identifier;//Quotation is turned off
    }

    /**
     * Escapes a value to avoid SQL injections
     *
     *<code>
     *    $escapedStr = $connection->escapeString('some dangerous value');
     *</code>
     *
     * @param string $str
     *
     * @throws \Phalcon\Db\Exception
     * @return string
     */
    public function escapeString($str)
    {
        return $this->getEmulationStrategy()->escapeString($str);
    }

    /**
     * @param SybaseAccessor $access
     */
    public static function setAccess(SybaseAccessor $access)
    {
        static::$_access = $access;
    }

    /**
     * @param string $sqlStatement
     * @param array|null $bindParams
     * @param array|null $bindTypes
     *
     * @return string
     * @throws \Phalcon\Db\Exception
     */
    private function getEmulatedBindQuery($sqlStatement, $bindParams = null, $bindTypes = null)
    {
        return $this->getEmulationStrategy()->emulateQuery($sqlStatement, $bindParams, $bindTypes);
    }


    /**
     * @param string $sqlStatement
     * @param array $bindParams
     *
     * @param array $bindTypes
     *
     * @return \PDOStatement
     * @throws Exception
     */
    public function executePrepared(string $sqlStatement, array $bindParams, array $bindTypes)
    {
        try {
            $sybaseBindParam = [];
            $bindTypes = array_values($bindTypes);

            $numericParamName = [];
            $stringParamName = [];
            foreach ($bindParams as $paramName => $paramVal) {
                if (is_string($paramName)) {
                    $val = (strpos($paramName, ':') !== false) ? str_replace(":", '', $paramName) : $paramName;
                    $stringParamName[] = preg_quote($val);
                } elseif (is_int($paramName)) {
                    $numericParamName[] = $paramName;
                } elseif (is_numeric($paramName)) {
                    $numericParamName[] = preg_quote($paramName);
                } else {
                    throw new Exception("Invalid bind parameter");
                }
            }

            $pattern =
                '/\?(' . implode('|', $numericParamName) . ')\b|\?(?!\d+)|:\b('
                . implode('|', $stringParamName) . ')\b:?/';
            $keyNumberDefault = 0;
            $sqlStatement = preg_replace_callback(
                $pattern,
                function ($matches) use (
                    $bindParams,
                    &$keyNumberDefault,
                    &$sybaseBindParam
                ) {

                    $result = null;

                    $key = (!array_key_exists($matches[0], $bindParams)) ?
                        trim($matches[0], ':?') :
                        $matches[0];

                    $param = $key ? $bindParams[$key]
                        : $bindParams[$keyNumberDefault++];

                    if (is_array($param)) {
                        $result = [];

                        foreach ($param as $value) {
                            $sybaseBindParam[] = $value;
                            $result[] = '?';
                        }

                        $result = implode(',', $result);
                    } else {
                        $result = '?';
                        $sybaseBindParam[] = $param;
                    }

                    return $result;
                },
                $sqlStatement
            );

            $pdoStatement = $this->_connection->prepare($sqlStatement);
            foreach ($sybaseBindParam as $i => $param) {
                $bindType = isset($bindTypes[$i]) ? $bindTypes[$i] : $this->getBindType($param);
                $pdoStatement->bindValue($i + 1, $param, $bindType);
            }

            $pdoStatement->execute();

            return $pdoStatement;
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param $param
     *
     * @return int
     */
    public function getBindType($param)
    {
        $paramType = \PDO::PARAM_STMT;
        if (is_int($param)) {
            $paramType = \PDO::PARAM_INT;
        } elseif (is_string($param) || is_float($param)) {
            $paramType = \PDO::PARAM_STR;
        } elseif (is_bool($param)) {
            $paramType = \PDO::PARAM_BOOL;
        } elseif (is_null($param)) {
            $paramType = \PDO::PARAM_NULL;
        }
        return $paramType;
    }

    /**
     * Sends SQL statements to the database server returning the success state.
     * Use this method only when the SQL statement sent to the server is returning rows
     *
     *<code>
     *    //Querying data
     *    $resultset = $connection->query("SELECT * FROM robots WHERE type='mechanical'");
     *    $resultset = $connection->query("SELECT * FROM robots WHERE type=?", array("mechanical"));
     *</code>
     *
     * Set $usePreparedStatement to FALSE when you wouldn't like to use prepared statements to execute query
     * It is possible when using prepared statement is not allowed for you query
     * As example we had problem with creating temporary table. It was not exists after executing query.
     * That Example.
     * <code>
     * $sql = "
     *     SELECT
     *     ri.race_instance_uid
     *     , ri.race_datetime
     *     , ri.course_uid
     *     , ri.race_instance_title
     *     , ri.race_type_code
     *     , ri.no_of_runners
     *     , ri.distance_yard
     *     , ri.race_group_uid
     *     , ri.going_type_code
     *     , ri.ages_allowed_uid
     *     , hr.horse_uid
     *     , hr.weight_carried_lbs
     *     , hr.rp_postmark
     *     , hr.rp_pre_postmark
     *     , hr.trainer_uid
     *     , hr.final_race_outcome_uid
     *     , hr.horse_head_gear_uid
     *     , hr.starting_price_odds_uid
     *     , hr.dist_to_horse_in_front_uid
     *     , hr.distance_to_winner_uid
     *     INTO #active_horses
     *     FROM horse_race hr
     *     , #races_14 ri
     *     WHERE
     *     hr.race_instance_uid = ri.race_instance_uid
     *     AND hr.jockey_uid = ?
     *     AND ri.race_datetime > DATEADD(DAY, - 14, GETDATE())
     *     ";
     *
     *     $jockeyUid = 87600;
     *     $this->getReadConnection()->query(
     *         $sql,
     *         array('jockeyUid' => $jockeyUid),
     *         null,
     *         false
     *     );
     * </code>
     *
     * @param  string $sqlStatement
     * @param  array $bindParams
     * @param  array $bindTypes
     * @param  bool $usePreparedStatement
     *
     * @return \Phalcon\Db\ResultInterface | false
     * @throws Exception
     */
    public function query(
        $sqlStatement,
        $bindParams = null,
        $bindTypes = null,
        $usePreparedStatement = true
    ) {
        if (Sybase::$customPdoClass !== null) {
            $usePreparedStatement = false;
        }
        $this->parseUnsupportedBinding($sqlStatement, $bindParams, $bindTypes);

        $usePreparedStatement = $this->_isUsePreparedStatements
            && $usePreparedStatement;

        /**
         * Execute the beforeQuery event if a EventsManager is available
         */
        if (is_object($this->_eventsManager)) {
            $this->_sqlStatement = $sqlStatement;
            $this->_sqlBindedStatement = $this->getEmulatedBindQuery(
                $sqlStatement,
                $bindParams,
                $bindTypes
            );
            $this->_sqlVariables = $bindParams;
            $this->_sqlBindTypes = $bindTypes;
            if ($this->_eventsManager->fire("db:beforeQuery", $this, $bindParams) === false) {
                $this->_eventsManager->fire(
                    "db:afterQuery",
                    $this,
                    $bindParams
                );
                return false;
            }
        }

        if (class_exists('\OpenTracing\GlobalTracer')) {
            $dbResourceName = substr($sqlStatement, 0, 100);  // dd limits length of resource names
            $dbProfile = \OpenTracing\GlobalTracer::get()->startActiveSpan('db_query');
            $profileSpan = $dbProfile->getSpan();

            // assume that DDTrace is installed if \OpenTracking\GlobalTracer is installed
            $dbServerNameKey = '';
            if (defined('PRODUCT_KEY')) {
                $dbServerNameKey = 'AUTH_DB_SERVERNAME_API_' . str_replace('_API', '', PRODUCT_KEY);
            }
            $profileSpan->setTag(\DDTrace\Tags\SERVICE_NAME, isset($_SERVER[$dbServerNameKey]) ? $_SERVER[$dbServerNameKey] : 'sybase_ase');
            $profileSpan->setTag(\DDTrace\Tags\SPAN_TYPE, 'sql');
            $profileSpan->setTag(\DDTrace\Tags\DB_STATEMENT, $sqlStatement);
            $profileSpan->setTag(\DDTrace\Tags\RESOURCE_NAME, $dbResourceName);
        }

        if ($usePreparedStatement && $bindParams) {
            $statement = $this->executePrepared($sqlStatement, $bindParams, $bindTypes ?? []);
        } else {
            $sqlBindedStatement = $bindParams ?
                $this->getEmulatedBindQuery(
                    $sqlStatement,
                    $bindParams,
                    $bindTypes
                ) :
                $sqlStatement;
            $statement = $this->_connection->query($sqlBindedStatement);
        }

        //Code for generation stubs for usit test. do not remove this comment
        //\UnitTestsComponents\Tools\DataCollector::getInstance()->addHash($sqlStatement, $bindParams, $bindTypes);

        if ($this->isErrors($statement)) {
            $this->throwErrorException($sqlStatement);
        }

        /**
         * Execute the afterQuery event if a EventsManager is available
         */
        if (is_object($this->_eventsManager)) {
            $this->_eventsManager->fire(
                "db:afterQuery",
                $this,
                $bindParams
            );
        }

        if (class_exists('\OpenTracing\GlobalTracer')) {
            $dbProfile->close();
        }

        return new Result(
            $this,
            $statement,
            $sqlStatement
        );
    }

    /**
     * Sends SQL statements to the database server returning the success state.
     * Use this method only when the SQL statement sent to the server doesn't return any row
     *
     *<code>
     *    //Inserting data
     *    $success = $connection->execute("INSERT INTO robots VALUES (1, 'Astro Boy')");
     *    $success = $connection->execute("INSERT INTO robots VALUES (?, ?)", array(1, 'Astro Boy'));
     *</code>
     *
     * Set $usePreparedStatement to FALSE when you wouldn't like to use prepared statements to execute query
     * It is possible when using prepared statement is not allowed for you query
     * As example we had problem with creating temporary table. It was not exists after executing query.
     * That Example.
     * <code>
     * $sql = "
     *     SELECT
     *     ri.race_instance_uid
     *     , ri.race_datetime
     *     , ri.course_uid
     *     , ri.race_instance_title
     *     , ri.race_type_code
     *     , ri.no_of_runners
     *     , ri.distance_yard
     *     , ri.race_group_uid
     *     , ri.going_type_code
     *     , ri.ages_allowed_uid
     *     , hr.horse_uid
     *     , hr.weight_carried_lbs
     *     , hr.rp_postmark
     *     , hr.rp_pre_postmark
     *     , hr.trainer_uid
     *     , hr.final_race_outcome_uid
     *     , hr.horse_head_gear_uid
     *     , hr.starting_price_odds_uid
     *     , hr.dist_to_horse_in_front_uid
     *     , hr.distance_to_winner_uid
     *     INTO #active_horses
     *     FROM horse_race hr
     *     , #races_14 ri
     *     WHERE
     *     hr.race_instance_uid = ri.race_instance_uid
     *     AND hr.jockey_uid = ?
     *     AND ri.race_datetime > DATEADD(DAY, - 14, GETDATE())
     *     ";
     *
     *     $jockeyUid = 87600;
     *     $this->getReadConnection()->execute(
     *         $sql,
     *         array('jockeyUid' => $jockeyUid),
     *         null,
     *         false
     *     );
     * </code>
     *
     * @param  string $sqlStatement
     * @param  array $bindParams
     * @param  array $bindTypes
     * @param  bool $usePreparedStatement
     *
     * @throws \Phalcon\Db\Exception
     * @return boolean
     */
    public function execute(
        $sqlStatement,
        $bindParams = null,
        $bindTypes = null,
        $usePreparedStatement = true
    ) {
        $usePreparedStatement = $this->_isUsePreparedStatements
            && $usePreparedStatement;

        /**
         * Execute the beforeQuery event if a EventsManager is available
         */
        if (is_object($this->_eventsManager)) {
            $this->_sqlStatement = $sqlStatement;
            $this->_sqlBindedStatement = $this->getEmulatedBindQuery(
                $sqlStatement,
                $bindParams,
                $bindTypes
            );
            $this->_sqlVariables = $bindParams;
            $this->_sqlBindTypes = $bindTypes;
            if ($this->_eventsManager->fire("db:beforeQuery", $this, $bindParams) === false) {
                return false;
            }
        }

        if ($usePreparedStatement && $bindParams) {
            $statement = $this->executePrepared($sqlStatement, $bindParams, $bindTypes ?? []);
        } else {
            $sqlBindedStatement = $bindParams ? $this->getEmulatedBindQuery(
                $sqlStatement,
                $bindParams,
                $bindTypes
            ) : $sqlStatement;
            $statement = $this->_connection->query($sqlBindedStatement);
        }

        //Code for generation stubs for usit test. do not remove this comment
        //\UnitTestsComponents\Tools\DataCollector::getInstance()->addHash($sqlStatement, $bindParams, $bindTypes);

        if ($this->isErrors($statement)) {
            $this->throwErrorException($sqlStatement);
        } else {
            /**
             * Execute the afterQuery event if a EventsManager is available
             */
            if (is_object($this->_eventsManager)) {
                $this->_eventsManager->fire(
                    "db:afterQuery",
                    $this,
                    $bindParams
                );
            }

            $this->_affectedRows = $statement->rowCount();
        }

        return true;
    }

    /**
     * Returns the number of affected rows by the lastest INSERT/UPDATE/DELETE executed in the database system
     *
     *<code>
     *    $connection->execute("DELETE FROM robots");
     *    echo $connection->affectedRows(), ' were deleted';
     *</code>
     *
     * @return int
     */
    public function affectedRows()
    {
        return $this->_affectedRows;
    }


    /**
     * Closes the active connection returning success. \Phalcon automatically closes and destroys
     * active connections when the request ends
     *
     * @return boolean
     */
    public function close()
    {
        return true;
    }

    /**
     * Converts bound parameters such as :name: or ?1 into PDO bind params ?
     *
     *<code>
     * print_r($connection->convertBoundParams('SELECT * FROM robots WHERE name = :name:', array('Bender')));
     *</code>
     *
     * @param string $sql
     * @param array $params
     *
     * @throws \Phalcon\Db\Exception
     * @return array
     */
    public function convertBoundParams($sql, $params)
    {
        $bindPattern = '/\?([0-9]+)|:([a-zA-Z0-9_]+):/';
        $placeholders = [];
        $status = preg_match_all($bindPattern, $sql, $matches, PREG_SET_ORDER);
        if ($status) {
            foreach ($matches as $match) {
                $key = array_pop($match);
                if (!array_key_exists($key, $params)) {
                    throw new Exception(
                        'Matched parameter wasn\'t found in parameters list'
                    );
                }
                $placeholders[] = $params[$key];
            }
            $sql = preg_replace($bindPattern, '?', $sql);
        }

        return [
            'sql' => $sql,
            'params' => $placeholders,
        ];
    }

    /**
     * Returns the insert id for the auto_increment/serial column inserted in the lastest executed SQL statement
     *
     *<code>
     * //Inserting a new robot
     * $success = $connection->insert(
     *     "robots",
     *     array("Astro Boy", 1952),
     *     array("name", "year")
     * );
     *
     * //Getting the generated id
     * $id = $connection->lastInsertId();
     *</code>
     *
     * @param string $sequenceName
     *
     * @return int
     */
    public function lastInsertId($sequenceName = null)
    {
        $res = $this->query('SELECT @@identity')->fetch();

        if (!is_array($res)) {
            return 0;
        }

        return (int)reset($res);
    }


    /**
     * Starts a transaction in the connection
     *
     * @param boolean $nesting
     *
     * @return boolean
     * @throws Exception
     */
    public function begin($nesting = null)
    {
        /**
         * Check the transaction nesting level
         */
        $ret = false;

        if ($this->_transactionLevel == 0) {
            /**
             * Notify the events manager about the started transaction
             */
            if (is_object($this->_eventsManager)) {
                $this->_eventsManager->fire("db:beginTransaction", $this);
            }

            $ret = $this->execute('begin transaction');

            if ($ret) {
                $this->_transactionLevel++;
            }
        } elseif ($this->_transactionLevel > 0) {
            if ($nesting && $this->isNestedTransactionsWithSavepoints()) {
                $this->_transactionLevel++;
                $savepointName = $this->getNestedTransactionSavepointName();

                /**
                 * Notify the events manager about the created savepoint
                 */
                if (is_object($this->_eventsManager)) {
                    $this->_eventsManager->fire(
                        "db:createSavepoint",
                        $this,
                        $savepointName
                    );
                }

                $ret = $this->createSavepoint($savepointName);
                if (!$ret) {
                    $this->_transactionLevel--;
                }
            }
        }
        return $ret;
    }


    /**
     * Rollbacks the active transaction in the connection
     *
     * @param boolean $nesting
     *
     * @return boolean
     * @throws Exception
     */
    public function rollback($nesting = null)
    {
        /**
         * Check the transaction nesting level
         */
        $ret = false;

        if ($this->_transactionLevel == 1) {
            /**
             * Notify the events manager about the started transaction
             */
            if (is_object($this->_eventsManager)) {
                $this->_eventsManager->fire("db:rollbackTransaction", $this);
            }

            $ret = $this->execute('rollback transaction');
        } elseif ($this->_transactionLevel > 0) {
            if ($nesting && $this->isNestedTransactionsWithSavepoints()) {
                $savepointName = $this->getNestedTransactionSavepointName();

                /**
                 * Notify the events manager about the created savepoint
                 */
                if (is_object($this->_eventsManager)) {
                    $this->_eventsManager->fire(
                        "db:rollbackSavepoint",
                        $this,
                        $savepointName
                    );
                }

                $ret = $this->rollbackSavepoint($savepointName);
            }
        }

        if ($ret) {
            $this->_transactionLevel--;
        }

        return $ret;
    }


    /**
     * Commits the active transaction in the connection
     *
     * @param boolean $nesting
     *
     * @return boolean
     * @throws Exception
     */
    public function commit($nesting = null)
    {
        /**
         * Check the transaction nesting level
         */
        $ret = false;

        if ($this->_transactionLevel == 1) {
            /**
             * Notify the events manager about the started transaction
             */
            if (is_object($this->_eventsManager)) {
                $this->_eventsManager->fire("db:commitTransaction", $this);
            }

            $ret = $this->execute('commit transaction');
        } elseif ($this->_transactionLevel > 0) {
            if ($nesting && $this->isNestedTransactionsWithSavepoints()) {
                $savepointName = $this->getNestedTransactionSavepointName();

                /**
                 * Notify the events manager about the created savepoint
                 */
                if (is_object($this->_eventsManager)) {
                    $this->_eventsManager->fire(
                        "db:releaseSavepoint",
                        $this,
                        $savepointName
                    );
                }

                $ret = true;
            }
        }

        if ($ret) {
            $this->_transactionLevel--;
        }

        return $ret;
    }


    /**
     * Returns the current transaction nesting level
     *
     * @return int
     */
    public function getTransactionLevel()
    {
        return $this->_transactionLevel;
    }


    /**
     * Checks whether the connection is under a transaction
     *
     *<code>
     *    $connection->begin();
     *    var_dump($connection->isUnderTransaction()); //true
     *</code>
     *
     * @return boolean
     * @throws Exception
     */
    public function isUnderTransaction()
    {
        $res = $this->query('SELECT @@trancount')->fetch();

        if (!is_array($res)) {
            return false;
        }

        return (boolean)reset($res);
    }


    /**
     * Return internal DB connection resource
     *
     * @return \PDO
     */
    public function getInternalHandler()
    {
        return $this->_connection;
    }


    /**
     * @codeCoverageIgnore
     *
     * Returns an array of \Phalcon\Db\Column objects describing a table
     *
     * <code>
     * print_r($connection->describeColumns("posts")); ?>
     * </code>
     *
     * @param string $table
     * @param string $schema
     *
     * @return Column[]
     */
    public function describeColumns($table, $schema = null)
    {
        $oldColumn = null;
        $sizePattern = "#\\(([0-9]+)(?:,\\s*([0-9]+))*\\)#";

        $columns = [];

        foreach ($this->fetchAll($this->_dialect->describeColumns($table, $schema), \Phalcon\Db::FETCH_NUM) as $field) {
            $definition = ["bindType" => Column::BIND_PARAM_STR];

            $columnType = $field[1];

            if ($this->checkField($columnType, "enum") ||
                $this->checkField($columnType, "char")
            ) {
                $definition["type"] = Column::TYPE_CHAR;
            } elseif ($this->checkField($columnType, "int")) {
                $definition["type"] = Column::TYPE_INTEGER;
                $definition["isNumeric"] = true;
                $definition["bindType"] = Column::BIND_PARAM_INT;
            } elseif ($this->checkField($columnType, "varchar")) {
                $definition["type"] = Column::TYPE_VARCHAR;
            } elseif ($this->checkField($columnType, "date")) {
                $definition["type"] = Column::TYPE_DATETIME;
            } elseif ($this->checkField($columnType, "decimal") ||
                $this->checkField($columnType, "numeric")
            ) {
                $definition["type"] = Column::TYPE_DECIMAL;
                $definition["isNumeric"] = true;
                $definition["bindType"] = Column::BIND_PARAM_DECIMAL;
            } elseif ($this->checkField($columnType, "date") || $this->checkField($columnType, "time")) {
                $definition["type"] = Column::TYPE_DATE;
            } elseif ($this->checkField($columnType, "text")) {
                $definition["type"] = Column::TYPE_TEXT;
            } elseif ($this->checkField($columnType, "float") ||
                $this->checkField($columnType, "real") ||
                $this->checkField($columnType, "double")
            ) {
                $definition["type"] = Column::TYPE_FLOAT;
                $definition["isNumeric"] = true;
                $definition["bindType"] = Column::TYPE_DECIMAL;
            } else {
                $definition["type"] = Column::TYPE_VARCHAR;
            }

            /**
             * Positions
             */
            if ($oldColumn == null) {
                $definition["first"] = true;
            } else {
                $definition["after"] = $oldColumn;
            }

            /**
             * Check if the field is primary key
             */
            if ($field[6] == "PRI") {
                $definition["primary"] = true;
            }

            /**
             * Check if the column allows null values
             */
            if ($field[5] == "N") {
                $definition["notNull"] = true;
            }

            /**
             * Check if the column is auto increment
             */
            if ($field[7] == "A") {
                $definition["autoIncrement"] = true;
            }

            /**
             * Check if the column is default values
             */
            if ($field[9] !== null) {
                $definition["default"] = str_ireplace('DEFAULT', '', trim($field[9]));
            }

            /**
             * Every route is stored as a Phalcon\Db\Column
             */
            $columnName = $field[0];
            $columns[] = new Column($columnName, $definition);
            $oldColumn = $columnName;
        }

        return $columns;
    }

    /**
     * @param $haystack
     * @param $needle
     *
     * @return bool
     */
    private function checkField($haystack, $needle)
    {
        return (strpos(strtolower($haystack), strtolower($needle)) !== false);
    }

    /**
     * We need to do this, because there are places where binding is not supported for Sybase(for example TOP
     * :bindParam)
     *
     * @param $sqlStatement
     * @param $bindParams
     */
    private function parseUnsupportedBinding(&$sqlStatement, &$bindParams, &$bindTypes)
    {
        $sqlStatement = preg_replace_callback(
            "|\[\[:{0,1}?(.*)\]\]|sU",
            function ($matches) use (&$bindParams, &$bindTypes) {
                if (isset($matches[1]) && isset($bindParams[$matches[1]])) {
                    $value = (is_numeric($bindParams[$matches[1]])) ?
                        $bindParams[$matches[1]] :
                        $this->escapeString($bindParams[$matches[1]]);

                    unset($bindParams[$matches[1]]);
                    if (empty($bindParams)) {
                        $bindParams = null;
                    }
                    if (isset($bindTypes[$matches[1]])) {
                        unset($bindTypes[$matches[1]]);
                    }
                    return $value;
                } else {
                    return $matches[0];
                }
            },
            $sqlStatement
        );

        $sqlStatement = preg_replace('/AS rowcount/', "AS 'rowcount'", $sqlStatement);
    }

    /**
     * @param \PDOStatement|null|false $statement
     * @param \PDO|null $connection
     *
     * @return bool
     */
    private function isErrors($statement = null, ?\PDO $connection = null)
    {
        $this->messages = [];

        if ($connection === null) {
            $connection = $this->_connection;
        }

        if (!($connection instanceof \PDO)) {
            $this->messages[] = "Connection is invalid.";
        } else {
            $err = $connection->errorInfo();

            if (isset($err[0]) && !in_array($err[0], ['00000', ''])) {
                $this->messages[] = $err[2];
            }
        }

        if ($statement instanceof \PDOStatement) {
            $err = $statement->errorInfo();
            if (isset($err[0]) && !in_array($err[0], ['00000', ''])) {
                $this->messages[] = $err[2];
            }
        }

        $isError = !empty($this->messages);
        return $isError;
    }

    /**
     * @param string $sqlStatement
     *
     * @throws Exception
     */
    private function throwErrorException(string $sqlStatement)
    {
        throw new Exception(
            "Cannot perform current query due to following errors:\n" .
            implode("\n", $this->messages) .
            "\n\n\nQuery:\n" . $sqlStatement
        );
    }

    /**
     * Method was created for Unit tests.
     * It allows to set custom or fake PDO instance instead of create new PDO
     * @param null|\PDO $customPdo
     */
    public static function setCustomPdoObject(?\PDO $customPdo): void
    {
        if ($customPdo === null) {
            Sybase::$customPdoClass = null;
            return;
        }
        Sybase::$customPdoClass = $customPdo;
    }

    /**
     * @return null|\PDO
     */
    public static function getCustomPdoObject(): ?\PDO
    {
        return Sybase::$customPdoClass;
    }

    /**
     * @return EmulationStrategyInterface
     */
    public function getEmulationStrategy(): EmulationStrategyInterface
    {
        if ($this->emulationStrategy === null) {
            $this->emulationStrategy = new EmulationQuery();
        }
        return $this->emulationStrategy;
    }

    /**
     * @param EmulationStrategyInterface $emulationStrategy
     */
    public function setEmulationStrategy(EmulationStrategyInterface $emulationStrategy): void
    {
        $this->emulationStrategy = $emulationStrategy;
    }

    /**
     * @param string $sqlQuery
     * @param int|mixed $fetchMode
     * @param null $bindParams
     * @param null $bindTypes
     *
     * @return array
     */
    public function fetchOne($sqlQuery, $fetchMode = \Phalcon\Db::FETCH_ASSOC, $bindParams = null, $bindTypes = null)
    {
        $rtn = parent::fetchOne($sqlQuery, $fetchMode, $bindParams, $bindTypes);
        //\UnitTestsComponents\Tools\DataCollector::getInstance()->addDataByArray([$rtn]);
        return $rtn;
    }
}
