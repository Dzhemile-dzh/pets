<?php

/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 2/26/2016
 * Time: 3:20 PM
 */

namespace Models;

use Phalcon\Mvc\Model;
use Phalcon\Db\Column;
use Phalcon\Mvc\Model\MetaData;

class AdditionalCourseInfo extends \Phalcon\Mvc\Model
{
    /**
     * @var string
     */
    protected $straight_round_jubilee_code;

    /**
     * @var string
     */
    protected $straight_round_jubilee_desc;

    /**
     * @var string
     */
    protected $rp_straight_round_jubilee_desc;


    /**
     * @return string
     */
    public function getStraightRoundJubileeCode()
    {
        return $this->straight_round_jubilee_code;
    }

    /**
     * @param string $straight_round_jubilee_code
     */
    public function setStraightRoundJubileeCode($straight_round_jubilee_code)
    {
        $this->straight_round_jubilee_code = $straight_round_jubilee_code;
    }

    /**
     * @return string
     */
    public function getStraightRoundJubileeDesc()
    {
        return $this->straight_round_jubilee_desc;
    }

    /**
     * @param string $straight_round_jubilee_desc
     */
    public function setStraightRoundJubileeDesc($straight_round_jubilee_desc)
    {
        $this->straight_round_jubilee_desc = $straight_round_jubilee_desc;
    }

    /**
     * @return string
     */
    public function getRpStraightRoundJubileeDesc()
    {
        return $this->rp_straight_round_jubilee_desc;
    }

    /**
     * @param string $rp_straight_round_jubilee_desc
     */
    public function setRpStraightRoundJubileeDesc($rp_straight_round_jubilee_desc)
    {
        $this->rp_straight_round_jubilee_desc = $rp_straight_round_jubilee_desc;
    }

    /**
     * @return array
     */
    public function metaData()
    {
        return array(

            //Every column in the mapped table
            MetaData::MODELS_ATTRIBUTES => array(
                'straight_round_jubilee_code',
                'straight_round_jubilee_desc',
                'rp_straight_round_jubilee_desc',
            ),
            //Every column part of the primary key
            MetaData::MODELS_PRIMARY_KEY => array(
                'straight_round_jubilee_code',
            ),
            //Every column that isn't part of the primary key
            MetaData::MODELS_NON_PRIMARY_KEY => array(
                'straight_round_jubilee_desc',
                'rp_straight_round_jubilee_desc',
            ),
            //Every column that doesn't allows null values
            MetaData::MODELS_NOT_NULL => false,
            //Every column and their data types
            MetaData::MODELS_DATA_TYPES => array(
                'straight_round_jubilee_code' => Column::TYPE_CHAR,
                'straight_round_jubilee_desc' => Column::TYPE_VARCHAR,
                'rp_straight_round_jubilee_desc' => Column::TYPE_VARCHAR,
            ),
            //The columns that have numeric data types
            MetaData::MODELS_DATA_TYPES_NUMERIC => array(
                'straight_round_jubilee_code' => false,
                'straight_round_jubilee_desc' => false,
                'rp_straight_round_jubilee_desc' => false,
            ),
            //How every column must be bound/casted
            MetaData::MODELS_DATA_TYPES_BIND => array(
                'straight_round_jubilee_code' => Column::BIND_PARAM_STR,
                'straight_round_jubilee_desc' => Column::BIND_PARAM_STR,
                'rp_straight_round_jubilee_desc' => Column::BIND_PARAM_STR,
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
