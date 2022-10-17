<?php

namespace Models;

use Phalcon\Mvc\Model;
use Phalcon\Db\Column;
use Phalcon\Mvc\Model\MetaData;

class RaceGroup extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $race_group_uid;

    /**
     *
     * @var string
     */
    protected $race_group_desc;

    /**
     *
     * @var string
     */
    protected $race_group_code;

    /**
     * Method to set the value of field race_group_uid
     *
     * @param integer $race_group_uid
     * @return $this
     */
    public function setRaceGroupUid($race_group_uid)
    {
        $this->race_group_uid = $race_group_uid;

        return $this;
    }

    /**
     * Method to set the value of field race_group_desc
     *
     * @param string $race_group_desc
     * @return $this
     */
    public function setRaceGroupDesc($race_group_desc)
    {
        $this->race_group_desc = $race_group_desc;

        return $this;
    }

    /**
     * Method to set the value of field race_group_code
     *
     * @param string $race_group_code
     * @return $this
     */
    public function setRaceGroupCode($race_group_code)
    {
        $this->race_group_code = $race_group_code;

        return $this;
    }

    /**
     * Returns the value of field race_group_uid
     *
     * @return integer
     */
    public function getRaceGroupUid()
    {
        return $this->race_group_uid;
    }

    /**
     * Returns the value of field race_group_desc
     *
     * @return string
     */
    public function getRaceGroupDesc()
    {
        return $this->race_group_desc;
    }

    /**
     * Returns the value of field race_group_code
     *
     * @return string
     */
    public function getRaceGroupCode()
    {
        return $this->race_group_code;
    }

    public function getSource()
    {
        return 'race_group';
    }

    /**
     * @return array
     */
    public function metaData()
    {
        return array(
            
            //Every column in the mapped table
            MetaData::MODELS_ATTRIBUTES => array(
                'race_group_uid',
                'race_group_desc',
                'race_group_code',
            ),
            
            //Every column part of the primary key
            MetaData::MODELS_PRIMARY_KEY => false,
            
            //Every column that isn't part of the primary key
            MetaData::MODELS_NON_PRIMARY_KEY => array(
                'race_group_uid',
                'race_group_desc',
                'race_group_code',
            ),
            
            //Every column that doesn't allows null values
            MetaData::MODELS_NOT_NULL => array(
                'race_group_uid',
                'race_group_desc',
                'race_group_code',
            ),
            
            //Every column and their data types
            MetaData::MODELS_DATA_TYPES => array(
                'race_group_uid' => Column::TYPE_INTEGER,
                'race_group_desc' => Column::TYPE_VARCHAR,
                'race_group_code' => Column::TYPE_CHAR,
            ),
            
            //The columns that have numeric data types
            MetaData::MODELS_DATA_TYPES_NUMERIC => array(
                'race_group_uid' => true,
                'race_group_desc' => false,
                'race_group_code' => false,
            ),
            
            //How every column must be bound/casted
            MetaData::MODELS_DATA_TYPES_BIND => array(
                'race_group_uid' => Column::BIND_PARAM_INT,
                'race_group_desc' => Column::BIND_PARAM_STR,
                'race_group_code' => Column::BIND_PARAM_STR,
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
