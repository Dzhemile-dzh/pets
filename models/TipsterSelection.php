<?php

namespace Models;

use Phalcon\Mvc\Model;
use Phalcon\Db\Column;
use Phalcon\Mvc\Model\MetaData;

/**
 * Class TipsterSelection
 */
class TipsterSelection extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $newspaper_uid;

    /**
     *
     * @var integer
     */
    protected $tipster_uid;

    /**
     *
     * @var integer
     */
    protected $race_instance_uid;

    /**
     *
     * @var integer
     */
    protected $horse_uid;

    /**
     *
     * @var integer
     */
    protected $selection_type_uid;

    /**
     *
     * @var string
     */
    protected $subscription_list;

    /**
     * Method to set the value of field newspaper_uid
     *
     * @param integer $newspaper_uid
     * @return $this
     */
    public function setNewspaperUid($newspaper_uid)
    {
        $this->newspaper_uid = $newspaper_uid;

        return $this;
    }

    /**
     * Method to set the value of field tipster_uid
     *
     * @param integer $tipster_uid
     * @return $this
     */
    public function setTipsterUid($tipster_uid)
    {
        $this->tipster_uid = $tipster_uid;

        return $this;
    }

    /**
     * Method to set the value of field race_instance_uid
     *
     * @param integer $race_instance_uid
     * @return $this
     */
    public function setRaceInstanceUid($race_instance_uid)
    {
        $this->race_instance_uid = $race_instance_uid;

        return $this;
    }

    /**
     * Method to set the value of field horse_uid
     *
     * @param integer $horse_uid
     * @return $this
     */
    public function setHorseUid($horse_uid)
    {
        $this->horse_uid = $horse_uid;

        return $this;
    }

    /**
     * Method to set the value of field selection_type_uid
     *
     * @param integer $selection_type_uid
     * @return $this
     */
    public function setSelectionTypeUid($selection_type_uid)
    {
        $this->selection_type_uid = $selection_type_uid;

        return $this;
    }

    /**
     * Method to set the value of field subscription_list
     *
     * @param string $subscription_list
     * @return $this
     */
    public function setSubscriptionList($subscription_list)
    {
        $this->subscription_list = $subscription_list;

        return $this;
    }

    /**
     * Returns the value of field newspaper_uid
     *
     * @return integer
     */
    public function getNewspaperUid()
    {
        return $this->newspaper_uid;
    }

    /**
     * Returns the value of field tipster_uid
     *
     * @return integer
     */
    public function getTipsterUid()
    {
        return $this->tipster_uid;
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
     * Returns the value of field horse_uid
     *
     * @return integer
     */
    public function getHorseUid()
    {
        return $this->horse_uid;
    }

    /**
     * Returns the value of field selection_type_uid
     *
     * @return integer
     */
    public function getSelectionTypeUid()
    {
        return $this->selection_type_uid;
    }

    /**
     * Returns the value of field subscription_list
     *
     * @return string
     */
    public function getSubscriptionList()
    {
        return $this->subscription_list;
    }

    public function getSource()
    {
        return 'tipster_selection';
    }

    /**
     * @return array
     */
    public function metaData()
    {
        return array(
            
            //Every column in the mapped table
            MetaData::MODELS_ATTRIBUTES => array(
                'newspaper_uid',
                'tipster_uid',
                'race_instance_uid',
                'horse_uid',
                'selection_type_uid',
                'subscription_list',
            ),
            
            //Every column part of the primary key
            MetaData::MODELS_PRIMARY_KEY => array(
                'newspaper_uid',
                'tipster_uid',
                'race_instance_uid',
            ),
            
            //Every column that isn't part of the primary key
            MetaData::MODELS_NON_PRIMARY_KEY => array(
                'horse_uid',
                'selection_type_uid',
                'subscription_list',
            ),
            
            //Every column that doesn't allows null values
            MetaData::MODELS_NOT_NULL => array(
                'horse_uid',
                'subscription_list',
            ),
            
            //Every column and their data types
            MetaData::MODELS_DATA_TYPES => array(
                'newspaper_uid' => Column::TYPE_INTEGER,
                'tipster_uid' => Column::TYPE_INTEGER,
                'race_instance_uid' => Column::TYPE_INTEGER,
                'horse_uid' => Column::TYPE_INTEGER,
                'selection_type_uid' => Column::TYPE_INTEGER,
                'subscription_list' => Column::TYPE_VARCHAR,
            ),
            
            //The columns that have numeric data types
            MetaData::MODELS_DATA_TYPES_NUMERIC => array(
                'newspaper_uid' => true,
                'tipster_uid' => true,
                'race_instance_uid' => true,
                'horse_uid' => true,
                'selection_type_uid' => true,
                'subscription_list' => false,
            ),
            
            //How every column must be bound/casted
            MetaData::MODELS_DATA_TYPES_BIND => array(
                'newspaper_uid' => Column::BIND_PARAM_INT,
                'tipster_uid' => Column::BIND_PARAM_INT,
                'race_instance_uid' => Column::BIND_PARAM_INT,
                'horse_uid' => Column::BIND_PARAM_INT,
                'selection_type_uid' => Column::BIND_PARAM_INT,
                'subscription_list' => Column::BIND_PARAM_STR,
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
