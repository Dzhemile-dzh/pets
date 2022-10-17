<?php

namespace Models;

use Phalcon\Mvc\Model;
use Phalcon\Db\Column;
use Phalcon\Mvc\Model\MetaData;

class RaceInstanceGenlkup extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $race_instance_uid;

    /**
     *
     * @var integer
     */
    protected $lookup_uid;

    /**
     *
     * @var integer
     */
    protected $int_1;

    /**
     *
     * @var integer
     */
    protected $int_2;

    /**
     *
     * @var integer
     */
    protected $int_3;

    /**
     *
     * @var string
     */
    protected $varchar_255;

    /**
     *
     * @var string
     */
    protected $varchar_30;

    /**
     *
     * @var string
     */
    protected $char_1;

    /**
     *
     * @var double
     */
    protected $decimal_12_2;

    /**
     * Method to set the value of field race_instance_uid
     *
     * @param integer $race_instance_uid
     *
     * @return $this
     */
    public function setRaceInstanceUid($race_instance_uid)
    {
        $this->race_instance_uid = $race_instance_uid;

        return $this;
    }

    /**
     * Method to set the value of field lookup_uid
     *
     * @param integer $lookup_uid
     *
     * @return $this
     */
    public function setLookupUid($lookup_uid)
    {
        $this->lookup_uid = $lookup_uid;

        return $this;
    }

    /**
     * Method to set the value of field int_1
     *
     * @param integer $int_1
     *
     * @return $this
     */
    public function setInt1($int_1)
    {
        $this->int_1 = $int_1;

        return $this;
    }

    /**
     * Method to set the value of field int_2
     *
     * @param integer $int_2
     *
     * @return $this
     */
    public function setInt2($int_2)
    {
        $this->int_2 = $int_2;

        return $this;
    }

    /**
     * Method to set the value of field int_3
     *
     * @param integer $int_3
     *
     * @return $this
     */
    public function setInt3($int_3)
    {
        $this->int_3 = $int_3;

        return $this;
    }

    /**
     * Method to set the value of field varchar_255
     *
     * @param string $varchar_255
     *
     * @return $this
     */
    public function setVarchar255($varchar_255)
    {
        $this->varchar_255 = $varchar_255;

        return $this;
    }

    /**
     * Method to set the value of field varchar_30
     *
     * @param string $varchar_30
     *
     * @return $this
     */
    public function setVarchar30($varchar_30)
    {
        $this->varchar_30 = $varchar_30;

        return $this;
    }

    /**
     * Method to set the value of field char_1
     *
     * @param string $char_1
     *
     * @return $this
     */
    public function setChar1($char_1)
    {
        $this->char_1 = $char_1;

        return $this;
    }

    /**
     * Method to set the value of field decimal_12_2
     *
     * @param double $decimal_12_2
     *
     * @return $this
     */
    public function setDecimal122($decimal_12_2)
    {
        $this->decimal_12_2 = $decimal_12_2;

        return $this;
    }

    /**
     * Returns the value of field race_instance_uid
     *
     * @return integer
     */
    public function getRaceInstanceUid()
    {
        return $this->race_instance_uid;
    }

    /**
     * Returns the value of field lookup_uid
     *
     * @return integer
     */
    public function getLookupUid()
    {
        return $this->lookup_uid;
    }

    /**
     * Returns the value of field int_1
     *
     * @return integer
     */
    public function getInt1()
    {
        return $this->int_1;
    }

    /**
     * Returns the value of field int_2
     *
     * @return integer
     */
    public function getInt2()
    {
        return $this->int_2;
    }

    /**
     * Returns the value of field int_3
     *
     * @return integer
     */
    public function getInt3()
    {
        return $this->int_3;
    }

    /**
     * Returns the value of field varchar_255
     *
     * @return string
     */
    public function getVarchar255()
    {
        return $this->varchar_255;
    }

    /**
     * Returns the value of field varchar_30
     *
     * @return string
     */
    public function getVarchar30()
    {
        return $this->varchar_30;
    }

    /**
     * Returns the value of field char_1
     *
     * @return string
     */
    public function getChar1()
    {
        return $this->char_1;
    }

    /**
     * Returns the value of field decimal_12_2
     *
     * @return double
     */
    public function getDecimal122()
    {
        return $this->decimal_12_2;
    }

    public function getSource()
    {
        return 'race_instance_genlkup';
    }

    /**
     * @return array
     */
    public function metaData()
    {
        return array(

            //Every column in the mapped table
            MetaData::MODELS_ATTRIBUTES => array(
                'race_instance_uid',
                'lookup_uid',
                'int_1',
                'int_2',
                'int_3',
                'varchar_255',
                'varchar_30',
                'char_1',
                'decimal_12_2',
            ),
            //Every column part of the primary key
            MetaData::MODELS_PRIMARY_KEY => array(
                'race_instance_uid',
                'lookup_uid',
            ),
            //Every column that isn't part of the primary key
            MetaData::MODELS_NON_PRIMARY_KEY => array(
                'int_1',
                'int_2',
                'int_3',
                'varchar_255',
                'varchar_30',
                'char_1',
                'decimal_12_2',
            ),
            //Every column that doesn't allows null values
            MetaData::MODELS_NOT_NULL => array(
                'int_1',
                'int_2',
                'int_3',
                'varchar_255',
                'varchar_30',
                'char_1',
                'decimal_12_2',
            ),
            //Every column and their data types
            MetaData::MODELS_DATA_TYPES => array(
                'race_instance_uid' => Column::TYPE_INTEGER,
                'lookup_uid' => Column::TYPE_INTEGER,
                'int_1' => Column::TYPE_INTEGER,
                'int_2' => Column::TYPE_INTEGER,
                'int_3' => Column::TYPE_INTEGER,
                'varchar_255' => Column::TYPE_VARCHAR,
                'varchar_30' => Column::TYPE_VARCHAR,
                'char_1' => Column::TYPE_CHAR,
                'decimal_12_2' => Column::TYPE_DECIMAL,
            ),
            //The columns that have numeric data types
            MetaData::MODELS_DATA_TYPES_NUMERIC => array(
                'race_instance_uid' => true,
                'lookup_uid' => true,
                'int_1' => true,
                'int_2' => true,
                'int_3' => true,
                'varchar_255' => false,
                'varchar_30' => false,
                'char_1' => false,
                'decimal_12_2' => true,
            ),
            //How every column must be bound/casted
            MetaData::MODELS_DATA_TYPES_BIND => array(
                'race_instance_uid' => Column::BIND_PARAM_INT,
                'lookup_uid' => Column::BIND_PARAM_INT,
                'int_1' => Column::BIND_PARAM_INT,
                'int_2' => Column::BIND_PARAM_INT,
                'int_3' => Column::BIND_PARAM_INT,
                'varchar_255' => Column::BIND_PARAM_STR,
                'varchar_30' => Column::BIND_PARAM_STR,
                'char_1' => Column::BIND_PARAM_STR,
                'decimal_12_2' => Column::BIND_PARAM_DECIMAL,
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
