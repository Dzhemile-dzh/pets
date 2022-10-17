<?php

declare(strict_types=1);

namespace Phalcon\Mvc\Model\Resultset;

use Phalcon\Db\Result\Sybase as Result;
use Phalcon\Mvc\Model\ResultsetInterface;

/**
 * @package Phalcon\Mvc\Model\Resultset
 */
class Multiple implements
    ResultsetInterface,
    \Iterator,
    \SeekableIterator,
    \Countable,
    \ArrayAccess,
    \Serializable,
    \JsonSerializable
{
    /**
     * @var MultipleEntry[]
     */
    private $entries;
    /**
     * @var General[]
     */
    private $rows;
    /**
     * @var Result
     */
    private $result;
    /**
     * @var int
     */
    private $pointer;
    /**
     * @var General
     */
    private $row;
    /**
     * @var bool
     */
    private $valid;
    /**
     * @var int
     */
    private $count;
    /**
     * @var bool
     */
    private $isFirstResultset = true;

    /**
     * General constructor.
     *
     * @param Result $result
     * @param MultipleEntry[] $entries
     *
     */
    public function __construct(
        Result $result,
        MultipleEntry ...$entries
    ) {
        $this->entries = $entries;
        $this->result = $result;

        $this->count = -1;
        $this->pointer = -1;
        $this->valid = true;
        $this->row = $this->fetchRow();
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
     * @return General|false
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

        if ($this->isFirstResultset) {
            $hasNextResultset = true;
            $this->isFirstResultset = false;
        } else {
            $this->result->fetchAll();
            $hasNextResultset = $this->result->hasNextRowset();
        }

        /**
         * There is not stored data, trying to get from resultset
         */
        if (!$hasNextResultset) {
            $this->valid = false;
            $this->row = null;
            return $hasNextResultset;
        } else {
            $entry = (isset($this->entries[$this->pointer])) ?
                $this->entries[$this->pointer]:
                $this->entries[count($this->entries) - 1];

            $currRow = $this->createResultset($entry);
            $this->rows[] = $currRow;
            $this->row = $currRow;
            $this->count = $this->count();

            return $currRow;
        }
    }

    /**
     * Return the current element
     * @return mixed
     */
    public function current()
    {
        /**
         * Valid records are arrays
         */
        if (!($this->row instanceof General)) {
            $this->row = false;
            return false;
        }
        return $this->row;
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
        return $offset < $this->count();
    }

    /**
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     *
     * @param mixed $offset
     *
     * @return mixed Can return all value types.
     * @throws ResultsetException
     */
    public function offsetGet($offset)
    {
        try {
            $this->seek($offset);
            return $this->current();
        } catch (ResultsetException $e) {
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
     * @throws ResultsetException
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
     * @throws ResultsetException
     */
    public function offsetUnset($offset)
    {
        throw new ResultsetException("Cursor is an immutable ArrayAccess object");
    }

    /**
     * String representation of object
     * @return string the string representation of the object or null
     * @throws ResultsetException
     */
    public function serialize()
    {
        $rtn = [];
        $this->rewind();

        foreach ($this as $resultset) {
            $rtn[] = $resultset->serialize();
        }
        return serialize($rtn);
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
        $resultsets = unserialize($serialized);
        if (!is_array($resultsets)) {
            throw new ResultsetException("Invalid serialization data");
        }

        foreach ($resultsets as $resultset) {
            $this->rows[] = unserialize($resultset);
        }
        $this->rewind();
    }

    /**
     * Count elements of an object
     * Can contain incorrect value when whole recordset is not fetched
     */
    public function count()
    {
        return count($this->rows);
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
     * @return \Phalcon\Mvc\ModelInterface
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
     * @return \Phalcon\Mvc\ModelInterface | bool
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
     * @param $isFresh
     * @throws ResultsetException
     */
    public function setIsFresh($isFresh): void
    {
        throw new ResultsetException('It is not supported');
    }

    /**
     * Tell if the resultset if fresh or an old one cached
     * @throws ResultsetException
     */
    public function isFresh()
    {
        throw new ResultsetException('It is not supported');
    }

    /**
     * Returns the associated cache for the resultset
     * @throws ResultsetException
     */
    public function getCache()
    {
        throw new ResultsetException('It is not supported');
    }

    /**
     * Returns a complete resultset as an array, if the resultset has a big number of rows
     * it could consume more memory than currently it does. Export the resultset to an array
     * couldn't be faster with a large number of records
     *
     * @param bool $renameColumns
     *
     * @return array
     */
    public function toArray(bool $renameColumns = true): array
    {
        $rtn = [];
        $this->rewind();

        foreach ($this as $resultset) {
            $rtn[] = $resultset->toArray($renameColumns);
        }
        return $rtn;
    }

    /**
     * Fetch and store all records in memory
     * @return void
     */
    public function fetchAll(): void
    {
        $this->rewind();

        while ($this->valid()) {
            $this->fetchRow();
            $this->next();
        }
    }

    /**
     * @param MultipleEntry $entry
     *
     * @return General
     */
    private function createResultset(MultipleEntry $entry)
    {
        $rs = new General(
            $entry->getColumnMap(),
            $entry->getModel(),
            $this->result,
            $entry->getCache(),
            $entry->getKeepSnapshots()
        );
        $rs->fetchAll();
        return $rs;
    }
}
