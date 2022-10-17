<?php

namespace Api;

use Phalcon\Mvc\Model;

/**
 * Class Result
 *
 * @package Api
 */
abstract class Result extends \Phalcon\Output\Result
{
    /**
     * @var \Exception
     */
    protected $emptyResultException = null;

    /**
     * @param int $operationMadeType
     *
     * @return int
     * @throws \LogicException
     */
    public static function getHttpCodeByModelOperationMade($operationMadeType)
    {
        $httpCode = null;
        switch ($operationMadeType) {
            case Model::OP_NONE:
                $httpCode = 400;
                break;
            case Model::OP_CREATE:
                $httpCode = 201;
                break;
            case Model::OP_UPDATE:
            case Model::OP_DELETE:
                $httpCode = 200;
                break;
            default:
                throw new \LogicException('operationMadeType must be a constant of Phalcon\Mvc\Model::OP_*');
        }

        return $httpCode;
    }

    /**
     * If the flag $allowEmpty is set, the response can be an empty array/object
     *
     * @param $data
     * @param bool $allowEmpty
     * @return $this
     * @throws \Exception
     */
    public function setData($data, $allowEmpty = false)
    {
        parent::setData($data);

        if ($this->isResultEmpty($this->data)) {
            if ($allowEmpty) {
                $this->data = [];
            } else {
                throw $this->getEmptyResultException();
            }
        }
        return $this;
    }

    /**
     * @param $data
     *
     * @return bool
     */
    protected function isResultEmpty($data)
    {
        $result = true;

        if (is_array($data) || is_object($data)) {
            foreach ($data as $value) {
                $result = $result && $this->isResultEmpty($value);
            }
        } else {
            $result = $result && is_null($data);
        }

        return $result;
    }

    /**
     * @param \Exception $emptyResultException
     * @return $this
     */
    public function setEmptyResultException(\Exception $emptyResultException)
    {
        $this->emptyResultException = $emptyResultException;

        return $this;
    }

    /**
     * @return \Api\Exception\NotFound|\Exception
     */
    protected function getEmptyResultException()
    {
        return $this->emptyResultException ? : new \Api\Exception\NotFound(5);
    }

    /**
     * @param mixed $result
     * @param string|integer $key
     * @param mixed $section
     */
    private function updateSectionValue(&$result, $key, $section)
    {
        if (is_object($result)) {
            $result->$key = $section;
        } else {
            $result[$key] = $section;
        }
    }

    /**
     * We analyze result and when meet list with all null values then this list collapsed to single null value
     *
     * @param mixed $result
     * @return array|null
     */
    private function recursiveCollapseEmptySection($result)
    {
        if (is_object($result) || is_array($result)) {
            $isEmpty = true;
            foreach ($result as $key => $element) {
                if (!is_null($element)) {
                    $section = $this->recursiveCollapseEmptySection($element);
                    $this->updateSectionValue($result, $key, $section);
                    if (!is_null($section)) {
                        $isEmpty = false;
                    }
                }
            }
            if ($isEmpty) {
                $result = null;
            }
        }
        return $result;
    }

    /**
     * @return $this
     */
    public function collapseEmptySection()
    {
        $this->data = $this->recursiveCollapseEmptySection($this->data);
        return $this;
    }
}
