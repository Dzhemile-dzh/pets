<?php

namespace Models;

use Phalcon\Mvc\Model;
use Phalcon\Db\Column;
use Phalcon\Mvc\Model\MetaData;

class RaceAttribJoin extends \Phalcon\Mvc\Model
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
    protected $race_attrib_uid;

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
     * Returns the value of field race_instance_uid
     *
     * @return integer
     */
    public function getRaceInstanceUid()
    {
        return $this->race_instance_uid;
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

    public function getSource()
    {
        return 'race_attrib_join';
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
                'race_attrib_uid',
            ),
            //Every column part of the primary key
            MetaData::MODELS_PRIMARY_KEY => array(
                'race_instance_uid',
                'race_attrib_uid',
            ),
            //Every column that isn't part of the primary key
            MetaData::MODELS_NON_PRIMARY_KEY => false,
            //Every column that doesn't allows null values
            MetaData::MODELS_NOT_NULL => false,
            //Every column and their data types
            MetaData::MODELS_DATA_TYPES => array(
                'race_instance_uid' => Column::TYPE_INTEGER,
                'race_attrib_uid' => Column::TYPE_INTEGER,
            ),
            //The columns that have numeric data types
            MetaData::MODELS_DATA_TYPES_NUMERIC => array(
                'race_instance_uid' => true,
                'race_attrib_uid' => true,
            ),
            //How every column must be bound/casted
            MetaData::MODELS_DATA_TYPES_BIND => array(
                'race_instance_uid' => Column::BIND_PARAM_INT,
                'race_attrib_uid' => Column::BIND_PARAM_INT,
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
