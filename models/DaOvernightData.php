<?php

namespace Models;

use Phalcon\Mvc\Model;
use Phalcon\Db\Column;
use Phalcon\Mvc\Model\MetaData;
use Phalcon\Mvc\Model\Resultset;
use \Api\Constants\Horses as Constants;

/**
 * Class DaOvernightData
 *
 * @package Models
 */
class DaOvernightData extends \Phalcon\Mvc\Model
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
    protected $sequence;

    /**
     *
     * @var integer
     */
    protected $draw;

    /**
     *
     * @var double
     */
    protected $y_temp;

    /**
     *
     * @var double
     */
    protected $y_norm_length;

    /**
     *
     * @var double
     */
    protected $y_norm_pound;

    /**
     *
     * @var double
     */
    protected $y_norm_going;

    /**
     *  Defines relationships between models
     */
    public function initialize()
    {
        $this->belongsTo('race_instance_uid', 'Models\RaceInstance', 'race_instance_uid');
    }

    /**
     * @return array
     */
    public function metaData()
    {
        return [

            //Every column in the mapped table
            MetaData::MODELS_ATTRIBUTES => [
                'race_instance_uid',
                'sequence',
                'draw',
                'y_temp',
                'y_norm_length',
                'y_norm_pound',
                'y_norm_going'
            ],

            //Every column part of the primary key
            MetaData::MODELS_PRIMARY_KEY => [
                'race_instance_uid',
                'sequence',
                'draw'
            ],

            //Every column that isn't part of the primary key
            MetaData::MODELS_NON_PRIMARY_KEY => [
                'y_temp',
                'y_norm_length',
                'y_norm_pound',
                'y_norm_going'
            ],

            //Every column that doesn't allows null values
            MetaData::MODELS_NOT_NULL => [
                'race_instance_uid',
                'sequence',
                'draw',
                'y_temp',
                'y_norm_length',
                'y_norm_pound',
                'y_norm_going'
            ],

            //Every column and their data types
            MetaData::MODELS_DATA_TYPES => [
                'race_instance_uid' => Column::TYPE_INTEGER,
                'sequence' => Column::TYPE_INTEGER,
                'draw' => Column::TYPE_INTEGER,
                'y_temp' => Column::TYPE_DECIMAL,
                'y_norm_length' => Column::TYPE_DECIMAL,
                'y_norm_pound' => Column::TYPE_DECIMAL,
                'y_norm_going' => Column::TYPE_DECIMAL
            ],

            //The columns that have numeric data types
            MetaData::MODELS_DATA_TYPES_NUMERIC => [
                'race_instance_uid' => true,
                'sequence' => true,
                'draw' => true,
                'y_temp' => true,
                'y_norm_length' => true,
                'y_norm_pound' => true,
                'y_norm_going' => true
            ],

            //The identity column, use boolean false if the model doesn't have
            //an identity column
            MetaData::MODELS_IDENTITY_COLUMN => false,

            //How every column must be bound/casted
            MetaData::MODELS_DATA_TYPES_BIND => [
                'race_instance_uid' => Column::BIND_PARAM_INT,
                'sequence' => Column::BIND_PARAM_INT,
                'draw' => Column::BIND_PARAM_INT,
                'y_temp' => Column::BIND_PARAM_DECIMAL,
                'y_norm_length' => Column::BIND_PARAM_DECIMAL,
                'y_norm_pound' => Column::BIND_PARAM_DECIMAL,
                'y_norm_going' => Column::BIND_PARAM_DECIMAL
            ],

            //Fields that must be ignored from INSERT SQL statements
            MetaData::MODELS_AUTOMATIC_DEFAULT_INSERT => false,

            //Fields that must be ignored from UPDATE SQL statements
            MetaData::MODELS_AUTOMATIC_DEFAULT_UPDATE => false

        ];
    }

    /**
     * Get all Draw Analyser data related to specific race
     *
     * @param int $raceId
     *
     * @return array
     * @throws \Exception
     */
    public function getRaceData($raceId)
    {
        if (empty($raceId)) {
            throw new \Exception('Invalid raceId provided');
        }

        $sql = "
            SELECT
              h.horse_uid
            , h.style_name  horse_name
            , h.country_origin_code
            , da_od.sequence
            , da_od.draw
            , da_od.y_norm_length
            , da_od.y_norm_pound
            , da_od.y_norm_going
            FROM da_overnight_data da_od
            INNER JOIN pre_horse_race phr ON (
                phr.race_instance_uid = da_od.race_instance_uid
                AND phr.draw = da_od.draw
            )
            INNER JOIN horse h ON h.horse_uid = phr.horse_uid
            WHERE da_od.race_instance_uid = :race_instance_uid:
            AND phr.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
            order by draw";

        $result = $this->getReadConnection()->query(
            $sql,
            [
                'race_instance_uid' => $raceId
            ]
        );

        $result = new Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $result
        );

        return $result->toArrayWithRows();
    }

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
     * Method to set the value of field sequence
     *
     * @param integer $sequence
     *
     * @return $this
     */
    public function setSequence($sequence)
    {
        $this->sequence = $sequence;

        return $this;
    }

    /**
     * Method to set the value of field draw
     *
     * @param integer $draw
     *
     * @return $this
     */
    public function setDraw($draw)
    {
        $this->draw = $draw;

        return $this;
    }

    /**
     * Method to set the value of field y_temp
     *
     * @param double $y_temp
     *
     * @return $this
     */
    public function setYTemp($y_temp)
    {
        $this->y_temp = $y_temp;

        return $this;
    }

    /**
     * Method to set the value of field y_norm_length
     *
     * @param double $y_norm_length
     *
     * @return $this
     */
    public function setYNormLength($y_norm_length)
    {
        $this->y_norm_length = $y_norm_length;

        return $this;
    }

    /**
     * Method to set the value of field y_norm_pound
     *
     * @param double $y_norm_pound
     *
     * @return $this
     */
    public function setYNormPound($y_norm_pound)
    {
        $this->y_norm_pound = $y_norm_pound;

        return $this;
    }

    /**
     * Method to set the value of field y_norm_going
     *
     * @param double $y_norm_going
     *
     * @return $this
     */
    public function setYNormGoing($y_norm_going)
    {
        $this->y_norm_going = $y_norm_going;

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
     * Returns the value of field sequence
     *
     * @return integer
     */
    public function getSequence()
    {
        return $this->sequence;
    }

    /**
     * Returns the value of field draw
     *
     * @return integer
     */
    public function getDraw()
    {
        return $this->draw;
    }

    /**
     * Returns the value of field y_temp
     *
     * @return double
     */
    public function getYTemp()
    {
        return $this->y_temp;
    }

    /**
     * Returns the value of field y_norm_length
     *
     * @return double
     */
    public function getYNormLength()
    {
        return $this->y_norm_length;
    }

    /**
     * Returns the value of field y_norm_pound
     *
     * @return double
     */
    public function getYNormPound()
    {
        return $this->y_norm_pound;
    }

    /**
     * Returns the value of field y_norm_going
     *
     * @return double
     */
    public function getYNormGoing()
    {
        return $this->y_norm_going;
    }
}
