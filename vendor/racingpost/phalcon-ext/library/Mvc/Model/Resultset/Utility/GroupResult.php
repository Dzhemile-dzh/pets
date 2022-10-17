<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 11/4/14
 * Time: 4:23 PM
 */

namespace Phalcon\Mvc\Model\Resultset\Utility;

class GroupResult
{
    /**
     * @var array
     */
    private $cache = [];
    private $keys;
    private $indexLevel = -1;

    /**
     * @param array $keys
     */
    public function __construct(array $keys = [])
    {
        $this->keys = $keys;
    }

    /**
     * @param array $plain
     * @param array $structure
     *
     * @return array
     */
    public function getGroupedResult(array $plain, array $structure)
    {
        $result = [];

        foreach ($plain as $row) {
            if (!is_array($row)) {
                $row = (array)$row;
            }
            $result = $this->groupField($result, $row, $structure);
        }
        $this->cache = [];

        $this->reindexGroupedResult($result);
        $this->cache = [];

        return $result;
    }

    /**
     * @param mixed       $item
     * @param string|null $itemKey
     */
    private function reindexGroupedResult(&$item, $itemKey = null)
    {
        $this->indexLevel++;
        $classToApply = $this->getClassToApply($itemKey);//Pre-cache all keys, to preserve correct object names, when object is null
        if (is_array($item)) {
            $newItem = [];
            $item = array_values($item);
            foreach ($item as $key => $childItem) {
                if (is_array($childItem) || is_object($childItem)) {
                    array_walk($childItem, [$this, 'reindexGroupedResult']);
                    if (array_key_exists($this->indexLevel, $this->keys) &&
                        !empty($childItem[$this->keys[$this->indexLevel]])
                    ) {
                        $key = $childItem[$this->keys[$this->indexLevel]];
                    }
                    $newItem[$key] = $this->convertToRow($childItem, $classToApply);
                } else {
                    $newItem[$key] = $childItem;
                }
            }
            $item = $newItem;
        }
        $this->indexLevel--;
    }

    /**
     * @param $itemKey
     * @return mixed
     */
    private function getClassToApply($itemKey)
    {
        if (is_null($itemKey)) {
            return '\Phalcon\Mvc\Model\Row\General';
        }
        if (!array_key_exists($itemKey, $this->cache)) {
            if (preg_match('/^(.+)\((.+)\)$/', $itemKey, $matches)) {
                $this->cache[$itemKey]['key'] = $matches[1];
                $this->cache[$itemKey]['class'] = $matches[2];
            } else {
                $this->cache[$itemKey]['key'] = $itemKey;
                $this->cache[$itemKey]['class'] = '\Phalcon\Mvc\Model\Row\General';
            }
        }

        return $this->cache[$itemKey]['class'];
    }

    /**
     * @param array|\Phalcon\Mvc\Model\Row $item
     * @param string                       $row
     *
     * @return \Phalcon\Mvc\Model\Row
     * @throws \Phalcon\Mvc\Model\Exception
     */
    private function convertToRow($item, $rowClass)
    {
        if ($item instanceof \Phalcon\Mvc\Model\Row) {
            $ret = $rowClass::convertFromRow($item);
        } elseif (is_array($item)) {
            $keys = array_keys($item);
            array_walk($keys, [$this, 'stripClassMap']);
            $item = array_combine($keys, array_values($item));
            $ret = $rowClass::createFromArray($item);
        } else {
            throw new \Phalcon\Mvc\Model\Exception('childItem should be an array or Row instance');
        }

        return $ret;
    }

    /**
     * @param $item
     */
    private function stripClassMap(&$item)
    {
        if (isset($this->cache[$item])) {
            $item = $this->cache[$item]['key'];
        }
    }

    /**
     * @param array $result
     * @param array $row
     * @param array $structure
     *
     * @return array
     */
    private function groupField(array $result, array $row, array $structure)
    {
        $fieldToGroup = [];
        $arrayStructure =[];
        $structureHash = md5(serialize($structure));
        if (!isset($this->cache[$structureHash])) {
            foreach ($structure as $fromField => $toField) {
                if (is_array($toField)) {
                    $arrayStructure[$fromField] = $toField;
                } else {
                    if (is_int($fromField)) {
                        $fromField = $toField;
                    }
                    $fieldToGroup[$fromField] = $toField;
                }
            }
            $this->cache[$structureHash]['group'] = $fieldToGroup;
            $this->cache[$structureHash]['array'] = $arrayStructure;
        } else {
            $fieldToGroup = $this->cache[$structureHash]['group'];
            $arrayStructure = $this->cache[$structureHash]['array'];
        }

        $groupKey = $this->getGroupKey($row, $fieldToGroup);

        if (!isset($result[$groupKey])) {
            $result[$groupKey] = [];
            foreach ($fieldToGroup as $fromField => $toField) {
                $result[$groupKey][$toField] = $row[$fromField];
            }
        }

        foreach ($arrayStructure as $toField => $toFieldStructure) {
            if (!isset($result[$groupKey][$toField])) {
                $result[$groupKey][$toField] = [];
            }

            $result[$groupKey][$toField] = $this->groupField($result[$groupKey][$toField], $row, $toFieldStructure);
        }

        return $result;
    }

    /**
     * @param array $row
     * @param array $fields
     *
     * @return string
     */
    private function getGroupKey(array $row, array $fields)
    {
        ksort($row);

        return md5(serialize(array_intersect_key($row, $fields)));
    }
}
