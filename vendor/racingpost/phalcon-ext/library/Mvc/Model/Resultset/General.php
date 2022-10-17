<?php

declare(strict_types=1);

namespace Phalcon\Mvc\Model\Resultset;

use Phalcon\Cache\BackendInterface;
use Phalcon\Db;
use Phalcon\Db\ResultInterface;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\ResultsetInterface;
use Phalcon\Mvc\Model\Row\General as Row;
use Phalcon\Mvc\ModelInterface;

/**
 * Class General
 * @package Phalcon\Mvc\Model\Resultset
 */
class General implements
    ResultsetInterface,
    \Iterator,
    \SeekableIterator,
    \Countable,
    \ArrayAccess,
    \Serializable,
    \JsonSerializable
{
    /**
     * @var $valid bool
     */
    private $valid;
    /**
     * @var $pointer int
     */
    private $pointer;
    /**
     * @var $row array|null
     */
    private $row;
    /**
     * @var $rows array
     */
    private $rows;
    /**
     * @var ResultInterface $result
     */
    private $result;
    /**
     * @var $activeRow ResultInterface|null
     */
    private $activeRow;
    /**
     * @var $model ModelInterface|Model\Row
     */
    private $model;
    /**
     * @var int
     */
    private $count;
    private $cache;
    private $keepSnapshots;
    private $columnMap;
    private $isFresh;

    /**
     * General constructor.
     *
     * @param $columnMap
     * @param ModelInterface|Model\Row $model
     * @param $result
     * @param BackendInterface|null $cache
     * @param $keepSnapshots
     *
     * @throws ResultsetException
     */
    public function __construct(
        $columnMap,
        $model,
        ResultInterface $result,
        BackendInterface $cache = null,
        $keepSnapshots = null
    ) {
        if (!($model instanceof Model\Row) && !($model instanceof ModelInterface)) {
            throw new ResultsetException(
                '$model must be an instance of Phalcon\Mvc\Model or Phalcon\Mvc\ModelInterface;'
            );
        }
        $this->model = $model;
        $this->columnMap = $columnMap;

        $this->keepSnapshots = $keepSnapshots;

        $this->result = $result;

        if ($cache !== null) {
            $this->cache = $cache;
        }

        $result->setFetchMode(Db::FETCH_ASSOC);

        /**
         * init resultset
         */
        $this->count = -1;
        $this->pointer = -1;
        $this->valid = true;
        $this->row = $this->fetchRow();
        //Code for generation stubs fro usit test. do not remove this comment
        //\UnitTestsComponents\Tools\DataCollector::getInstance()->addData($this);
    }

    /**
     * @param string $key
     * @param Row $classConvertTo
     * @param bool $groupBy
     *
     * @return array
     */
    public function toArrayWithRows(string $key = null, Row $classConvertTo = null, bool $groupBy = false)
    {
        if ($groupBy === true) {
            return static::convertToArrayWithGroupByRows(
                $this,
                $key,
                $classConvertTo
            );
        } else {
            return static::convertToArrayWithRows($this, $key, $classConvertTo);
        }
    }

    /**
     * @param General $resultSet
     * @param string $key
     * @param Row $classConvertTo
     *
     * @return array
     */
    public static function convertToArrayWithRows(General $resultSet, string $key = null, Row $classConvertTo = null)
    {
        $result = [];

        foreach ($resultSet as $row) {
            if (!is_null($classConvertTo)) {
                $row = call_user_func_array(
                    [$classConvertTo, 'convertFromRow'],
                    [$row]
                );
            }

            if ($key) {
                if ($row->{$key}) {
                    $result[$row->{$key}] = $row;
                }
            } else {
                $result[] = $row;
            }
        }

        return $result;
    }

    /**
     * @param General $resultSet
     * @param string $key
     * @param Row $classConvertTo
     *
     * @return array
     */
    public static function convertToArrayWithGroupByRows(General $resultSet, string $key, Row $classConvertTo = null)
    {
        $result = [];

        foreach ($resultSet as $row) {
            if (!is_null($classConvertTo)) {
                $row = call_user_func_array(
                    [$classConvertTo, 'convertFromRow'],
                    [$row]
                );
            }

            if ($key) {
                $keyName = $row->{$key};
                if (isset($keyName)) {
                    $result[$keyName][] = $row;
                }
            }
        }

        return $result;
    }


    /**
     * @param string $fieldName
     *
     * @return array
     * @throws \Exception
     */
    public function getField(string $fieldName)
    {
        $res = [];

        foreach ($this as $row) {
            if (!property_exists($row, $fieldName)) {
                throw new ResultsetException("Field {$fieldName} doesn't exist");
            }

            $res[] = $row->{$fieldName};
        }

        return $res;
    }

    /**
     * @param array $structure
     * @param array $keys
     *
     * @return array
     */
    public function getGroupedResult(array $structure, array $keys = [])
    {
        $groupResult = new Utility\GroupResult($keys);
        return $groupResult->getGroupedResult($this->toArrayWithRows(), $structure);
    }

    /**
     * Changes internal pointer to a specific position in the resultset
     * Set new position if required and set this->_row
     *
     * @param int $position
     *
     * @throws ResultsetException
     */
    final public function seek($position): void
    {
        if ($this->pointer != $position || $this->row === null) {
            $this->activeRow = null;

            if (isset($this->rows[$position])) {
                $this->row = $this->rows[$position];
                $this->pointer = $position;
                return;
            }

            /**
             * Fetch from PDO one-by-one.
             */
            while ($this->pointer < $position) {
                $currRow = $this->fetchRow();
                if ($currRow === false) {
                    throw new ResultsetException(
                        "Index out of bounds. Seek position: {$position}. Current pointer: {$this->pointer}"
                    );
                }
            }
        }
    }

    /**
     * Gets pointer number of active row in the resultset
     */
    public function key(): int
    {
        return $this->pointer;
    }

    /**
     * Check whether internal resource has rows to fetch
     */
    public function valid(): bool
    {
        return $this->valid;
    }

    /**
     * @return mixed
     */
    private function fetchRow()
    {
        /**
         * Trying to get stored rowdata
         */
        $this->pointer++;
        if (isset($this->rows[$this->pointer])) {
            return $this->rows[$this->pointer];
        }

        /**
         * There is not stered data, trying to get from resultset
         */
        $currRow = $this->result->fetch();
        if (!$currRow) {
            $this->valid = false;
            $this->row = null;
            $this->activeRow = null;
        } else {
            $this->rows[] = $currRow;
            $this->row = $currRow;
        }

        $this->count = !is_null($this->rows) ? count($this->rows) : 0;

        return $currRow;
    }

    /**
     * Return the current element
     * @return mixed
     */
    public function current()
    {
        if ($this->activeRow !== null) {
            return $this->activeRow;
        }

        /**
         * Valid records are arrays
         */
        if (!is_array($this->row)) {
            $this->activeRow = false;
            return false;
        }

        if ($this->model instanceof Model) {
            $modelName = get_class($this->model);
        } else {
            $modelName = "Phalcon\\Mvc\\Model";
        }

        $aRow = call_user_func_array(
            "{$modelName}::cloneResultMap",
            [
                $this->model,
                $this->row,
                $this->columnMap,
                Model::DIRTY_STATE_PERSISTENT,
                $this->keepSnapshots,
            ]
        );

        $this->activeRow = $aRow;
        return $aRow;
    }


    /**
     * Move forward to next element
     */
    public function next(): void
    {
        try {
            $this->seek($this->pointer + 1);
        } catch (ResultsetException $e) {
            /**
             * Do nothing, this is expected thing
             */
        }
    }

    /**
     * Rewind the Iterator to the first element
     */
    public function rewind(): void
    {
        $this->valid = true;
        $this->count = -1;
        $this->pointer = -1;
        try {
            $this->seek(0);
        } catch (ResultsetException $e) {
            //Do nothing. Expected situation when result set is empty.
        }
    }

    /**
     * Whether a offset exists
     * @note Can return incorrect state if all rows were not fetched
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return $offset < $this->count;
    }

    /**
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     *
     * @param mixed $offset
     *
     * @return mixed Can return all value types.
     * @throws \Exception
     */
    public function offsetGet($offset)
    {
        try {
            $this->seek($offset);
            return $this->current();
        } catch (\Exception $e) {
            throw new ResultsetException("The index does not exist in the cursor");
        }
    }

    /**
     * Offset to set
     *
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     *
     * @return void
     * @throws \Exception
     */
    public function offsetSet($offset, $value)
    {
        throw new ResultsetException("Cursor is an immutable ArrayAccess object");
    }

    /**
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     *
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     *
     * @return void
     * @throws \Exception
     */
    public function offsetUnset($offset)
    {
        throw new ResultsetException("Cursor is an immutable ArrayAccess object");
    }

    /**
     * String representation of object
     * @return string the string representation of the object or null
     */
    public function serialize()
    {
        return serialize([
            "model" => $this->model,
            "cache" => $this->cache,
            "rows" => $this->toArray(false),
            "columnMap" => $this->columnMap,
            "keepSnapshots" => $this->keepSnapshots,
        ]);
    }

    /**
     * Constructs the object
     *
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     *
     * @return void
     * @throws ResultsetException
     */
    public function unserialize($serialized)
    {
        $resultset = unserialize($serialized);
        if (!is_array($resultset)) {
            throw new ResultsetException("Invalid serialization data");
        }

        $this->model = $resultset["model"];
        $this->rows = $resultset["rows"];
        $this->count = count($resultset["rows"]);
        $this->cache = $resultset["cache"];
        $this->columnMap = $resultset["columnMap"];

        if (isset($resultset["keepSnapshots"])) {
            $this->keepSnapshots = $resultset["keepSnapshots"];
        }

        $this->rewind();
    }

    /**
     * Count elements of an object
     * Can contain incorrect value when whole recordset is not fetched
     */
    public function count()
    {
        return $this->count;
    }

    /**
     * Specify data which should be serialized to JSON
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    public function jsonSerialize(): array
    {
        $records = [];

        $this->rewind();

        while ($this->valid()) {
            $current = $this->current();

            if (is_object($current) && method_exists($current, "jsonSerialize")) {
                $records[] = $current->jsonSerialize();
            } else {
                $records[] = $current;
            }

            $this->next();
        }

        return $records;
    }

    /**
     * Returns the internal type of data retrieval that the resultset is using
     *
     * @return int
     */
    public function getType(): int
    {
        return 0;
    }

    /**
     * Get first row in the resultset
     *
     * @return ModelInterface
     * @throws ResultsetException
     */
    public function getFirst()
    {
        $this->seek(0);
        return $this->current();
    }

    /**
     * Get last row in the resultset
     *
     * @return ModelInterface | bool
     * @throws ResultsetException
     */
    public function getLast()
    {
        $savedPosition = $this->pointer;
        $this->fetchAll();

        if ($this->count() === 0) {
            return false;
        }

        $this->seek($this->count() - 1);
        $output = $this->current();
        $this->seek($savedPosition);

        return $output;
    }

    /**
     * Set if the resultset is fresh or an old one cached
     *
     * @param bool $isFresh
     *
     * @return General
     */
    public function setIsFresh($isFresh): General
    {
        $this->isFresh = $isFresh;
        return $this;
    }

    /**
     * Tell if the resultset if fresh or an old one cached
     *
     * @return bool
     */
    public function isFresh()
    {
        return $this->isFresh;
    }

    /**
     * Returns the associated cache for the resultset
     *
     * @return \Phalcon\Cache\BackendInterface
     */
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * Returns a complete resultset as an array, if the resultset has a big number of rows
     * it could consume more memory than currently it does. Export the resultset to an array
     * couldn't be faster with a large number of records
     *
     * @param bool $renameColumns
     *
     * @return array
     * @throws \Exception
     */
    public function toArray(bool $renameColumns = true): array
    {
        $savedPosition = $this->pointer;
        $this->fetchAll();
        $this->seek($savedPosition);

        /**
         * We need to rename the whole set here, this could be slow
         */
        if ($renameColumns && $this->rows) {
            /**
             * Get the resultset column map
             */
            if (!is_array($this->columnMap)) {
                return (array)$this->rows;
            }

            $renamedRecords = [];
            foreach ($this->rows as $record) {
                $renamed = [];
                foreach ($record as $key => $value) {
                    /**
                     * Check if the key is part of the column map
                     */
                    if (isset($this->columnMap[$key])) {
                        $renamedKey = $this->columnMap[$key];
                    } else {
                        throw new ResultsetException("Column '" . $key . "' is not part of the column map");
                    }

                    if (is_array($renamedKey)) {
                        if (isset($renamedKey[0])) {
                            $renamedKey = $renamedKey[0];
                        } else {
                            throw new ResultsetException("Column '" . $key . "' is not part of the column map");
                        }
                    }

                    $renamed[$renamedKey] = $value;
                }

                /**
                 * Append the renamed records to the main array
                 */
                $renamedRecords[] = $renamed;
            }

            return $renamedRecords;
        }

        return $this->rows ? $this->rows : [];
    }

    /**
     * Fetch and store all records in memory
     * @return void
     */
    public function fetchAll(): void
    {
        $this->rewind();
        while ($this->valid()) {
            $this->next();
        }
    }
}
