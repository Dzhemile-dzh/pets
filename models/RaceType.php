<?php

namespace Models;

use Phalcon\Mvc\Model;
use Phalcon\Db\Column;
use Phalcon\Mvc\Model\MetaData;

class RaceType extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    protected $race_type_code;

    /**
     *
     * @var string
     */
    protected $race_type_desc;

    /**
     * Method to set the value of field race_type_code
     *
     * @param string $race_type_code
     *
     * @return $this
     */
    public function setRaceTypeCode($race_type_code)
    {
        $this->race_type_code = $race_type_code;

        return $this;
    }

    /**
     * Method to set the value of field race_type_desc
     *
     * @param string $race_type_desc
     *
     * @return $this
     */
    public function setRaceTypeDesc($race_type_desc)
    {
        $this->race_type_desc = $race_type_desc;

        return $this;
    }

    /**
     * Returns the value of field race_type_code
     *
     * @return string
     */
    public function getRaceTypeCode()
    {
        return $this->race_type_code;
    }

    /**
     * Returns the value of field race_type_desc
     *
     * @return string
     */
    public function getRaceTypeDesc()
    {
        return $this->race_type_desc;
    }

    public function getSource()
    {
        return 'race_type';
    }

    /**
     * @return array
     */
    public function metaData()
    {
        return array(

            //Every column in the mapped table
            MetaData::MODELS_ATTRIBUTES => array(
                'race_type_code',
                'race_type_desc',
            ),
            //Every column part of the primary key
            MetaData::MODELS_PRIMARY_KEY => array(
                'race_type_code',
            ),
            //Every column that isn't part of the primary key
            MetaData::MODELS_NON_PRIMARY_KEY => array(
                'race_type_desc',
            ),
            //Every column that doesn't allows null values
            MetaData::MODELS_NOT_NULL => false,
            //Every column and their data types
            MetaData::MODELS_DATA_TYPES => array(
                'race_type_code' => Column::TYPE_CHAR,
                'race_type_desc' => Column::TYPE_VARCHAR,
            ),
            //The columns that have numeric data types
            MetaData::MODELS_DATA_TYPES_NUMERIC => array(
                'race_type_code' => false,
                'race_type_desc' => false,
            ),
            //How every column must be bound/casted
            MetaData::MODELS_DATA_TYPES_BIND => array(
                'race_type_code' => Column::BIND_PARAM_STR,
                'race_type_desc' => Column::BIND_PARAM_STR,
            ),
            //Fields that must be ignored from INSERT SQL statements
            MetaData::MODELS_AUTOMATIC_DEFAULT_INSERT => false,
            //Fields that must be ignored from UPDATE SQL statements
            MetaData::MODELS_AUTOMATIC_DEFAULT_UPDATE => false,
            //The identity column, use boolean false if the model doesn't have an identity column
            MetaData::MODELS_IDENTITY_COLUMN => false
        );
    }
}
