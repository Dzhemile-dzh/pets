<?php

/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 5/13/2016
 * Time: 3:33 PM
 */

namespace Bo\Bloodstock;

/**
 * Class Statistics
 * @package Bo\Bloodstock
 */
abstract class Statistics extends \Bo\Standart
{

    const ROW_CLASS = '\Phalcon\Mvc\Model\Row\General';

    /**
     * @var \Phalcon\Mvc\Model\Row\General
     */
    private static $element;

    /**
     * @var array
     */
    private static $namesOfPropertiesWithObjects = [];

    /**
     * @return array
     */
    abstract public function getRows();

    /**
     * @param array $rows
     *
     * @return mixed
     */
    abstract public function prepareRows(array $rows);

    /**
     * @param $element
     * @param $row
     * @param $nextRow
     * @param $cnt
     */
    abstract protected function fillElement($element, $row, $nextRow, $cnt);
    /**
     * @param $row
     * @param $nextRow
     * @param $cnt
     *
     * @return bool
     */
    abstract protected function isNeedSwitchToNextElement($row, $nextRow, $cnt);


    /**
     * @return array
     */
    protected static function getElementStructure()
    {
        return [];
    }

    /**
     * @param array $rows
     * @return array
     */
    protected function generatorElement(array $rows)
    {
        static::buildElementsStructure();

        for ($i = 0, $cnt = count($rows), $lastIndex = $cnt - 1; $i < $cnt; $i++) {
            $row = $rows[$i];
            $nextRow = $i === $lastIndex ? null : $rows[$i + 1];

            if (!isset($element)) {
                $element = $this->getElementObject();
            }
            $this->fillElement($element, $row, $nextRow, $cnt);

            if ($this->isNeedSwitchToNextElement($row, $nextRow, $cnt)) {
                yield $element;
                unset($element);
            }
        }
    }

    /**
     * buildElementsStructure
     */
    private static function buildElementsStructure()
    {
        $rowClass = static::ROW_CLASS;
        $structure = static::getElementStructure();
        self::$namesOfPropertiesWithObjects = [];
        $namesOfPropertiesWithObjects =& self::$namesOfPropertiesWithObjects;

        array_walk($structure, function ($element, $key) use (&$namesOfPropertiesWithObjects) {
            if (is_object($element)) {
                $namesOfPropertiesWithObjects[] = $key;
            }
        });
        self::$element = $rowClass::createFromArray($structure);
    }

    /**
     * @return object
     */
    protected function getElementObject()
    {
        $clone = clone self::$element;

        foreach (self::$namesOfPropertiesWithObjects as $propertyName) {
            $clone->{$propertyName} = clone $clone->{$propertyName};
        }

        return $clone;
    }
}
