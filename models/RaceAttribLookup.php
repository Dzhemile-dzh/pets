<?php

namespace Models;

use Phalcon\Mvc\Model;
use Phalcon\Db\Column;
use Phalcon\Mvc\Model\MetaData;

class RaceAttribLookup extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $race_attrib_uid;

    /**
     *
     * @var string
     */
    protected $race_attrib_code;

    /**
     *
     * @var string
     */
    protected $race_attrib_wby;

    /**
     *
     * @var string
     */
    protected $race_attrib_desc;

    /**
     * Method to set the value of field race_attrib_uid
     *
     * @param integer $race_attrib_uid
     *
     * @return $this
     */
    public function setRaceAttribUid($race_attrib_uid)
    {
        $this->race_attrib_uid = $race_attrib_uid;

        return $this;
    }

    /**
     * Method to set the value of field race_attrib_code
     *
     * @param string $race_attrib_code
     *
     * @return $this
     */
    public function setRaceAttribCode($race_attrib_code)
    {
        $this->race_attrib_code = $race_attrib_code;

        return $this;
    }

    /**
     * Method to set the value of field race_attrib_wby
     *
     * @param string $race_attrib_wby
     *
     * @return $this
     */
    public function setRaceAttribWby($race_attrib_wby)
    {
        $this->race_attrib_wby = $race_attrib_wby;

        return $this;
    }

    /**
     * Method to set the value of field race_attrib_desc
     *
     * @param string $race_attrib_desc
     *
     * @return $this
     */
    public function setRaceAttribDesc($race_attrib_desc)
    {
        $this->race_attrib_desc = $race_attrib_desc;

        return $this;
    }

    /**
     * Returns the value of field race_attrib_uid
     *
     * @return integer
     */
    public function getRaceAttribUid()
    {
        return $this->race_attrib_uid;
    }

    /**
     * Returns the value of field race_attrib_code
     *
     * @return string
     */
    public function getRaceAttribCode()
    {
        return $this->race_attrib_code;
    }

    /**
     * Returns the value of field race_attrib_wby
     *
     * @return string
     */
    public function getRaceAttribWby()
    {
        return $this->race_attrib_wby;
    }

    /**
     * Returns the value of field race_attrib_desc
     *
     * @return string
     */
    public function getRaceAttribDesc()
    {
        return $this->race_attrib_desc;
    }

    public function getSource()
    {
        return 'race_attrib_lookup';
    }

    /**
     * @return array
     */
    public function metaData()
    {
        return array(

            //Every column in the mapped table
            MetaData::MODELS_ATTRIBUTES => array(
                'race_attrib_uid',
                'race_attrib_code',
                'race_attrib_wby',
                'race_attrib_desc',
            ),
            //Every column part of the primary key
            MetaData::MODELS_PRIMARY_KEY => array(
                'race_attrib_uid',
            ),
            //Every column that isn't part of the primary key
            MetaData::MODELS_NON_PRIMARY_KEY => array(
                'race_attrib_code',
                'race_attrib_wby',
                'race_attrib_desc',
            ),
            //Every column that doesn't allows null values
            MetaData::MODELS_NOT_NULL => array(
                'race_attrib_wby',
            ),
            //Every column and their data types
            MetaData::MODELS_DATA_TYPES => array(
                'race_attrib_uid' => Column::TYPE_INTEGER,
                'race_attrib_code' => Column::TYPE_CHAR,
                'race_attrib_wby' => Column::TYPE_CHAR,
                'race_attrib_desc' => Column::TYPE_VARCHAR,
            ),
            //The columns that have numeric data types
            MetaData::MODELS_DATA_TYPES_NUMERIC => array(
                'race_attrib_uid' => true,
                'race_attrib_code' => false,
                'race_attrib_wby' => false,
                'race_attrib_desc' => false,
            ),
            //How every column must be bound/casted
            MetaData::MODELS_DATA_TYPES_BIND => array(
                'race_attrib_uid' => Column::BIND_PARAM_INT,
                'race_attrib_code' => Column::BIND_PARAM_STR,
                'race_attrib_wby' => Column::BIND_PARAM_STR,
                'race_attrib_desc' => Column::BIND_PARAM_STR,
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
