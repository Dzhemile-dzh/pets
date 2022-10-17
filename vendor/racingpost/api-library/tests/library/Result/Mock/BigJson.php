<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 12/14/2016
 * Time: 2:01 PM
 */

namespace Tests\Result\Mock;

/**
 * @package Tests\Result\Mock
 */
class BigJson extends \Api\Result\BigJson
{
    const ROOT_FIELD_NAME = 'rootFieldName';
    const MAX_BATCH_COUNT = 5;

    private $mappers;

    /**
     * @param mixed $mappers
     */
    public function setMappers($mappers)
    {
        $this->mappers = $mappers;
    }

    /**
     * @return array
     */
    protected function getMappers()
    {
        return $this->mappers ?: [
            self::ROOT_FIELD_NAME => 'MapperClassName',
        ];
    }

    /**
     * @return $this
     */
    protected function getResponse()
    {
        return $this;
    }

    /**
     * @return $this
     */
    protected function sendHeaders()
    {
        return $this;
    }

    /**
     * @param $row
     *
     * @return object
     */
    protected function getMapper($row)
    {
        return (Object)$row;
    }
}
