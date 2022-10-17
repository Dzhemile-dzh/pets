<?php

namespace Phalcon\Db\Result {

    use Phalcon\Db\Exception;
    use Phalcon\Db\ResultInterface;

    /**
     * Phalcon\Db\Result\Sybase
     *
     * Encapsulates the resultset internals
     *
     * <code>
     * $result = $connection->query("SELECT * FROM robots ORDER BY name");
     * $result->setFetchMode(Phalcon\Db::FETCH_NUM);
     * while ($robot = $result->fetchArray()) {
     *  print_r($robot);
     * }
     * </code>
     */
    class Sybase implements ResultInterface
    {

        /**
         * @var \Phalcon\Db\Adapter\Sybase
         */
        protected $_adapter;

        protected $_result;

        /**
         * @var int
         */
        protected $_fetchMode = \Phalcon\Db::FETCH_ASSOC;

        /**
         * @var \PDOStatement
         */
        protected $_statement;

        /**
         * @var string \PDOStatement
         */
        protected $_sqlStatement;

        /**
         * \Phalcon\Db\Result\Sybase constructor
         *
         * @param               $adapter
         * @param \PDOStatement $result
         * @param string $sqlStatement
         */
        public function __construct($adapter, \PDOStatement $result, $sqlStatement)
        {
            $this->_adapter = $adapter;
            $this->_statement = $result;
            $this->_sqlStatement = $sqlStatement;
        }

        public function __destruct()
        {
            if (is_resource($this->_statement)) {
                sybase_free_result($this->_statement);
            }
        }


        /**
         * @return bool|false|ResultInterface
         */
        public function execute()
        {
            return $this->_adapter->query($this->_sqlStatement);
        }


        /**
         * Fetches an array/object of strings that corresponds to the fetched row, or FALSE if there are no more rows.
         * This method is affected by the active fetch flag set using \Phalcon\Db\Result\Pdo::setFetchMode
         *
         *<code>
         *    $result = $connection->query("SELECT * FROM robots ORDER BY name");
         *    $result->setFetchMode(Phalcon\Db::FETCH_OBJ);
         *    while ($robot = $result->fetch()) {
         *        echo $robot->name;
         *    }
         *</code>
         *
         * @return mixed
         */
        public function fetch()
        {
            return $this->_statement->fetch($this->_fetchMode);
        }


        /**
         * @deprecated
         * What is this for? Maybe it will be deprecated and removed it future Phalcon releases. Do not use in app code.
         *
         * Returns an array of strings that corresponds to the fetched row, or FALSE if there are no more rows.
         * This method is affected by the active fetch flag set using \Phalcon\Db\Result\Pdo::setFetchMode
         *
         *<code>
         *    $result = $connection->query("SELECT * FROM robots ORDER BY name");
         *    $result->setFetchMode(Phalcon\Db::FETCH_NUM);
         *    while ($robot = $result->fetchArray()) {
         *        print_r($robot);
         *    }
         *</code>
         *
         * @return mixed
         */
        public function fetchArray()
        {
            return $this->fetch();
        }


        /**
         * Returns an array of arrays containing all the records in the result
         * This method is affected by the active fetch flag set using \Phalcon\Db\Result\Pdo::setFetchMode
         *
         *<code>
         *    $result = $connection->query("SELECT * FROM robots ORDER BY name");
         *    $robots = $result->fetchAll();
         *</code>
         *
         * @return array
         */
        public function fetchAll()
        {
            $res = array();

            while ($row = $this->fetch()) {
                $res[] = $row;
            }
            $this->_count = count($res);
            return $res;
        }


        /**
         * Gets number of rows returned by a resulset
         *
         *<code>
         *    $result = $connection->query("SELECT * FROM robots ORDER BY name");
         *    echo 'There are ', $result->numRows(), ' rows in the resulset';
         *</code>
         *
         * @return int
         */
        public function numRows()
        {
            /*
             * https://github.com/phalcon/cphalcon/blob/f0732e9c2ac4c234afa30fcd4dff1b94d24fe24a/phalcon/mvc/model/query.zep#L2796
             *
             * We can work only with ResultInterface. That`s why we need return not 0 value.
             * When amount of rows really equal 0 then $this->_statement->rowCount() returns 0 otherwise returns -1.
             * To fix behavior from link above we need to return -1 (not false value)
             */
            return -1;//$this->_statement->rowCount();
        }

        /**
         * @param int $number
         *
         * @throws Exception
         */
        public function dataSeek($number)
        {
            throw new Exception("Can ot be implemented using PDO::CURSOR_FWDONLY");
        }

        /**
         * Changes the fetching mode affecting \Phalcon\Db\Result\Pdo::fetch()
         *
         *<code>
         *    //Return array with integer indexes
         *    $result->setFetchMode(Phalcon\Db::FETCH_NUM);
         *
         *    //Return associative array without integer indexes
         *    $result->setFetchMode(Phalcon\Db::FETCH_ASSOC);
         *
         *    //Return associative array together with integer indexes
         *    $result->setFetchMode(Phalcon\Db::FETCH_BOTH);
         *
         *    //Return an object
         *    $result->setFetchMode(Phalcon\Db::FETCH_OBJ);
         *</code>
         *
         * @param int $fetchMode
         * @return $this
         * @throws \Phalcon\Db\Exception
         */
        public function setFetchMode($fetchMode, $fetchArg1 = null, $fetchArg2 = null)
        {
            if (!in_array($fetchMode, array(
                \Phalcon\Db::FETCH_BOTH,
                \Phalcon\Db::FETCH_ASSOC,
                \Phalcon\Db::FETCH_NUM,
                \Phalcon\Db::FETCH_OBJ))
            ) {
                throw new Exception('Fetch mode ' . $fetchMode . ' is not supported');
            }
            $this->_fetchMode = (int)$fetchMode;

            return $this;
        }


        /**
         * Gets the internal result resource
         *
         * @return \PDOStatement
         */
        public function getInternalResult()
        {
            return $this->_statement;
        }

        /**
         * @return bool
         */
        public function hasNextRowset(): bool
        {
            return (bool)$this->_statement->nextRowset();
        }
    }
}
