<?php

namespace Phalcon\Output;

use Phalcon\Exception;
use Phalcon\Http\ResponseInterface;
use Phalcon\Output\Mapper;

/**
 * Class Result
 *
 * @package Api
 */
abstract class Result
{
    protected $errors = null;
    protected $data = null;
    protected $status = 200;

    /**
     * Children should implement this method to provide content to Response. Headers can be set here
     * @param ResponseInterface $response
     */
    abstract public function proceedResponse(ResponseInterface $response): void;

    /**
     * Provides content
     * @return string
     */
    abstract public function getContent(): string;

    /**
     * @param array $errors
     * @return $this
     */
    public function setErrors(array $errors)
    {
        $this->errors = $errors;
        return $this;
    }

    /**
     * @param mixed $data
     * @return $this
     * @throws \Exception
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param int $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Recursively filters string properties of arrays and objects.
     *
     * @param $data
     * @return mixed|string
     */
    public static function filterData(&$data)
    {
        if (is_string($data)) {
            $data = Mapper::filterNonUtfSymbols($data);
        } elseif ($data instanceof \Traversable || is_array($data) || is_object($data)) {
            foreach ($data as &$item) {
                self::filterData($item);
            }
        }
    }

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [];
    }

    /**
     *
     * @return mixed
     */
    protected function getPreparedData()
    {
        $mappers = $this->getMappers();
        if (empty($mappers)) {
            self::filterData($this->data);
        } else {
            foreach ($mappers as $field => $mapper) {
                $fieldPath = empty($field) ? [] : explode('.', $field);
                $this->bindRowToMapper($this->data, [], $fieldPath, $mapper);
            }
        }

        if ($this instanceof ResultClearbleInterface) {
            $this->clearData($this->data);
        }

        return $this->data;
    }

    /**
     * @param Object|array $data
     * @param array $currentFieldPath
     * @param array $fieldPath
     * @param string $mapper
     *
     * @return mixed
     * @throws \Exception
     */
    private function bindRowToMapper(&$data, array $currentFieldPath, array $fieldPath, $mapper)
    {
        if (count($fieldPath) == count($currentFieldPath)) {
            $data = new $mapper($data);
        } else {
            $field = $fieldPath[count($currentFieldPath)];
            $currentFieldPath[] = $field;

            if (is_array($data)) {
                $data = (Object)$data;
            }

            if (is_array($data->{$field})) {
                foreach ($data->{$field} as $key => &$value) {
                    if (is_array($value)) {
                        $newFieldPath = array_merge(
                            array_slice($fieldPath, 0, count($currentFieldPath)),
                            [$key],
                            array_slice($fieldPath, count($currentFieldPath))
                        );
                        $data->{$field} = $this->bindRowToMapper($data->{$field}, $currentFieldPath, $newFieldPath, $mapper);
                    } else {
                        $data->{$field}[$key] = $this->bindRowToMapper($value, $currentFieldPath, $fieldPath, $mapper);
                    }
                }
            } elseif (is_object($data->{$field})) {
                $data->{$field} = $this->bindRowToMapper($data->{$field}, $currentFieldPath, $fieldPath, $mapper);
            } elseif (!is_null($data->{$field})) {
                throw new \Exception("Can't map field '" . implode('.', $fieldPath) . "'");
            }
        }

        return $data;
    }
}
