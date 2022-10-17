<?php

namespace Tests\Mvc\Model\Resultset;

use Pseudo\PDO;
use Pseudo\PdoStatement;
use Pseudo\Result;

/**
 * @package Tests\Mvc\Model\Resultset
 */
class MultiplePdoStatement extends PdoStatement
{
    private $resultSets = [];
    private $currentResultSet;

    public function __construct(PdoStatement $result = null)
    {
        $tmp = $result->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($tmp as $rs) {
            $this->resultSets[] = new PdoStatement(new Result($rs));
        }
        $curr = array_shift($this->resultSets);
        $this->currentResultSet = ($curr) ?
            $curr :
            $result;
    }

    /**
     * @return bool|void
     */
    public function nextRowset()
    {
        $this->currentResultSet = array_shift($this->resultSets);
        return ($this->currentResultSet === null) ? false : true;
    }

    /**
     * @param Result $result
     */
    public function setResult(Result $result)
    {
        $this->currentResultSet->setResult($result);
    }

    /**
     * @param null $input_parameters
     *
     * @return bool
     */
    public function execute($input_parameters = null)
    {
        return $this->currentResultSet->execute($input_parameters);
    }

    /**
     * @param null $fetch_style
     * @param int $cursor_orientation
     * @param int $cursor_offset
     *
     * @return bool|mixed|null
     */
    public function fetch($fetch_style = null, $cursor_orientation = PDO::FETCH_ORI_NEXT, $cursor_offset = 0)
    {
        if ($this->currentResultSet === null) {
            return false;
        }
        return $this->currentResultSet->fetch($fetch_style, $cursor_orientation, $cursor_offset);
    }

    /**
     * @param $parameter
     * @param $variable
     * @param int $data_type
     * @param null $length
     * @param null $driver_options
     *
     * @return bool
     */
    public function bindParam($parameter, &$variable, $data_type = PDO::PARAM_STR, $length = null, $driver_options = null)
    {
        return $this->currentResultSet->bindParam($parameter, $variable, $data_type, $length, $driver_options);
    }

    /**
     * @param $column
     * @param $param
     * @param null $type
     * @param null $maxlen
     * @param null $driverdata
     *
     * @return bool
     */
    public function bindColumn($column, &$param, $type = null, $maxlen = null, $driverdata = null)
    {
        return $this->currentResultSet->bindColumn($column, $param, $type, $maxlen, $driverdata);
    }

    /**
     * @param $parameter
     * @param $value
     * @param int $data_type
     *
     * @return bool
     */
    public function bindValue($parameter, $value, $data_type = PDO::PARAM_STR)
    {
        return $this->currentResultSet->bindValue($parameter, $value, $data_type);
    }

    /**
     * @return int
     */
    public function rowCount()
    {
        return $this->currentResultSet->rowCount();
    }

    public function fetchColumn($column_number = 0)
    {
        return $this->currentResultSet->fetchColumn($column_number);
    }

    /**
     * @param int $fetch_style
     * @param null $fetch_argument
     * @param string $ctor_args
     *
     * @return array
     */
    public function fetchAll($fetch_style = \PDO::FETCH_BOTH, $fetch_argument = null, $ctor_args = 'array()')
    {
        return $this->currentResultSet->fetchAll($fetch_style, $fetch_argument, $ctor_args);
    }

    /**
     * @param string $class_name
     * @param null $ctor_args
     *
     * @return bool|mixed
     */
    public function fetchObject($class_name = "stdClass", $ctor_args = null)
    {
        return $this->currentResultSet->fetchObject($class_name, $ctor_args);
    }

    /**
     * @return string
     */
    public function errorCode()
    {
        return $this->currentResultSet->errorCode();
    }

    /**
     * @return string
     */
    public function errorInfo()
    {
        return $this->currentResultSet->errorInfo();
    }

    /**
     * @return int
     */
    public function columnCount()
    {
        return $this->currentResultSet->columnCount();
    }

    /**
     * @param int $mode
     * @param null $params
     *
     * @return bool|int
     */
    public function setFetchMode($mode, $params = null)
    {
        return $this->currentResultSet->setFetchMode($mode, $params);
    }

    /**
     * @return bool|void
     */
    public function closeCursor()
    {
        $this->currentResultSet->closeCursor();
    }

    /**
     * @return bool|void
     */
    public function debugDumpParams()
    {
        $this->currentResultSet->debugDumpParams();
    }

    /**
     * @param $attribute
     * @param $value
     *
     * @return bool|void
     */
    public function setAttribute($attribute, $value)
    {
        $this->currentResultSet->setAttribute($attribute, $value);
    }

    /**
     * @param $attribute
     *
     * @return mixed|void
     */
    public function getAttribute($attribute)
    {
        $this->currentResultSet->getAttribute($attribute);
    }

    /**
     * @param $column
     *
     * @return array|void
     */
    public function getColumnMeta($column)
    {
        $this->currentResultSet->getColumnMeta($column);
    }

    /**
     * @return array
     */
    public function getBoundParams()
    {
        return $this->currentResultSet->getBoundParams();
    }
}
