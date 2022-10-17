<?php

namespace Models;

use Phalcon\Mvc\Model;
use Phalcon\Db\Column;
use Phalcon\Mvc\Model\MetaData;

class RaceSelection extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $race_instance_uid;

    /**
     *
     * @var string
     */
    protected $race_datetime;

    /**
     *
     * @var string
     */
    protected $race_selection_type;

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
     * Method to set the value of field race_datetime
     *
     * @param string $race_datetime
     *
     * @return $this
     */
    public function setRaceDatetime($race_datetime)
    {
        $this->race_datetime = $race_datetime;

        return $this;
    }

    /**
     * Method to set the value of field race_selection_type
     *
     * @param string $race_selection_type
     *
     * @return $this
     */
    public function setRaceSelectionType($race_selection_type)
    {
        $this->race_selection_type = $race_selection_type;

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
     * Returns the value of field race_datetime
     *
     * @return string
     */
    public function getRaceDatetime()
    {
        return $this->race_datetime;
    }

    /**
     * Returns the value of field race_selection_type
     *
     * @return string
     */
    public function getRaceSelectionType()
    {
        return $this->race_selection_type;
    }

    public function getSource()
    {
        return 'race_selection';
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
                'race_datetime',
                'race_selection_type',
            ),
            //Every column part of the primary key
            MetaData::MODELS_PRIMARY_KEY => array(
                'race_instance_uid',
                'race_selection_type',
            ),
            //Every column that isn't part of the primary key
            MetaData::MODELS_NON_PRIMARY_KEY => array(
                'race_datetime',
            ),
            //Every column that doesn't allows null values
            MetaData::MODELS_NOT_NULL => false,
            //Every column and their data types
            MetaData::MODELS_DATA_TYPES => array(
                'race_instance_uid' => Column::TYPE_INTEGER,
                'race_datetime' => Column::TYPE_DATETIME,
                'race_selection_type' => Column::TYPE_CHAR,
            ),
            //The columns that have numeric data types
            MetaData::MODELS_DATA_TYPES_NUMERIC => array(
                'race_instance_uid' => true,
                'race_datetime' => false,
                'race_selection_type' => false,
            ),
            //How every column must be bound/casted
            MetaData::MODELS_DATA_TYPES_BIND => array(
                'race_instance_uid' => Column::BIND_PARAM_INT,
                'race_datetime' => Column::BIND_PARAM_STR,
                'race_selection_type' => Column::BIND_PARAM_STR,
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
