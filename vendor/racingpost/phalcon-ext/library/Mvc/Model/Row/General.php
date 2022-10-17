<?php

namespace Phalcon\Mvc\Model\Row;

class General extends \Phalcon\Mvc\Model\Row
{
    /**
     * @param array $data
     * @return static
     */
    public static function createFromArray(array $data)
    {
        $row = new static();

        foreach ($data as $key => $value) {
            $row->{$key} = $value;
        }

        return $row;
    }

    /**
     * @param \Phalcon\Mvc\Model\Row
     * @return \Phalcon\Mvc\Model\Row\General
     */
    public static function convertFromRow(\Phalcon\Mvc\Model\Row $row)
    {

        $result = new static();

        foreach ($row as $key => $value) {
            $result->{$key} = $value;
        }

        return $result;
    }
}
