<?php

namespace Models;

use Phalcon\Mvc\Model;
use Phalcon\Db\Column;
use Phalcon\Mvc\Model\MetaData;

class HorseTrainer extends \Phalcon\Mvc\Model
{
    /**
     *
     * @var integer
     */
    protected $trainer_uid;

    /**
     *
     * @var integer
     */
    protected $horse_uid;

    /**
     *
     * @var string
     */
    protected $trainer_change_date;

    /**
     *
     * @var string
     */
    protected $timestamp;

    /**
     * Method to set the value of field trainer_uid
     *
     * @param integer $trainer_uid
     *
     * @return $this
     */
    public function setTrainerUid($trainer_uid)
    {
        $this->trainer_uid = $trainer_uid;

        return $this;
    }

    /**
     * Method to set the value of field horse_uid
     *
     * @param integer $horse_uid
     *
     * @return $this
     */
    public function setHorseUid($horse_uid)
    {
        $this->horse_uid = $horse_uid;

        return $this;
    }

    /**
     * Method to set the value of field trainer_change_date
     *
     * @param string $trainer_change_date
     *
     * @return $this
     */
    public function setTrainerChangeDate($trainer_change_date)
    {
        $this->trainer_change_date = $trainer_change_date;

        return $this;
    }

    /**
     * Method to set the value of field timestamp
     *
     * @param string $timestamp
     *
     * @return $this
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Returns the value of field trainer_uid
     *
     * @return integer
     */
    public function getTrainerUid()
    {
        return $this->trainer_uid;
    }

    /**
     * Returns the value of field horse_uid
     *
     * @return integer
     */
    public function getHorseUid()
    {
        return $this->horse_uid;
    }

    /**
     * Returns the value of field trainer_change_date
     *
     * @return string
     */
    public function getTrainerChangeDate()
    {
        return $this->trainer_change_date;
    }

    /**
     * Returns the value of field timestamp
     *
     * @return string
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function getSource()
    {
        return 'horse_trainer';
    }

    /**
     * @return array
     */
    public function metaData()
    {
        return array(

            //Every column in the mapped table
            MetaData::MODELS_ATTRIBUTES => array(
                'trainer_uid',
                'horse_uid',
                'trainer_change_date',
                'timestamp',
            ),
            //Every column part of the primary key
            MetaData::MODELS_PRIMARY_KEY => array(
                'horse_uid',
                'trainer_change_date',
            ),
            //Every column that isn't part of the primary key
            MetaData::MODELS_NON_PRIMARY_KEY => array(
                'trainer_uid',
                'timestamp',
            ),
            //Every column that doesn't allows null values
            MetaData::MODELS_NOT_NULL => false,
            //Every column and their data types
            MetaData::MODELS_DATA_TYPES => array(
                'trainer_uid' => Column::TYPE_INTEGER,
                'horse_uid' => Column::TYPE_INTEGER,
                'trainer_change_date' => Column::TYPE_DATETIME,
                'timestamp' => Column::TYPE_DATE,
            ),
            //The columns that have numeric data types
            MetaData::MODELS_DATA_TYPES_NUMERIC => array(
                'trainer_uid' => true,
                'horse_uid' => true,
                'trainer_change_date' => false,
                'timestamp' => false,
            ),
            //How every column must be bound/casted
            MetaData::MODELS_DATA_TYPES_BIND => array(
                'trainer_uid' => Column::BIND_PARAM_INT,
                'horse_uid' => Column::BIND_PARAM_INT,
                'trainer_change_date' => Column::BIND_PARAM_STR,
                'timestamp' => Column::BIND_PARAM_STR,
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
