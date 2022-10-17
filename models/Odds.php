<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 11/9/2015
 * Time: 6:24 PM
 */

namespace Models;

use Phalcon\Mvc\Model;

class Odds extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $odds_uid;

    /**
     *
     * @var string
     */
    protected $odds_desc;

    /**
     *
     * @var double
     */
    protected $odds_value;

    /**
     *
     * @var string
     */
    protected $favourite_flag;

    /**
     *
     * @var integer
     */
    protected $odds_fraction_numerator;

    /**
     *
     * @var integer
     */
    protected $odds_fraction_denominator;

    /**
     *
     * @var string
     */
    protected $timestamp;

    /**
     *
     * @var string
     */
    protected $british_odds_flag;

    /**
     * Method to set the value of field odds_uid
     *
     * @param integer $odds_uid
     * @return $this
     */
    public function setOddsUid($odds_uid)
    {
        $this->odds_uid = $odds_uid;

        return $this;
    }

    /**
     * Method to set the value of field odds_desc
     *
     * @param string $odds_desc
     * @return $this
     */
    public function setOddsDesc($odds_desc)
    {
        $this->odds_desc = $odds_desc;

        return $this;
    }

    /**
     * Method to set the value of field odds_value
     *
     * @param double $odds_value
     * @return $this
     */
    public function setOddsValue($odds_value)
    {
        $this->odds_value = $odds_value;

        return $this;
    }

    /**
     * Method to set the value of field favourite_flag
     *
     * @param string $favourite_flag
     * @return $this
     */
    public function setFavouriteFlag($favourite_flag)
    {
        $this->favourite_flag = $favourite_flag;

        return $this;
    }

    /**
     * Method to set the value of field odds_fraction_numerator
     *
     * @param integer $odds_fraction_numerator
     * @return $this
     */
    public function setOddsFractionNumerator($odds_fraction_numerator)
    {
        $this->odds_fraction_numerator = $odds_fraction_numerator;

        return $this;
    }

    /**
     * Method to set the value of field odds_fraction_denominator
     *
     * @param integer $odds_fraction_denominator
     * @return $this
     */
    public function setOddsFractionDenominator($odds_fraction_denominator)
    {
        $this->odds_fraction_denominator = $odds_fraction_denominator;

        return $this;
    }

    /**
     * Method to set the value of field timestamp
     *
     * @param string $timestamp
     * @return $this
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Method to set the value of field british_odds_flag
     *
     * @param string $british_odds_flag
     * @return $this
     */
    public function setBritishOddsFlag($british_odds_flag)
    {
        $this->british_odds_flag = $british_odds_flag;

        return $this;
    }

    /**
     * Returns the value of field odds_uid
     *
     * @return integer
     */
    public function getOddsUid()
    {
        return $this->odds_uid;
    }

    /**
     * Returns the value of field odds_desc
     *
     * @return string
     */
    public function getOddsDesc()
    {
        return $this->odds_desc;
    }

    /**
     * Returns the value of field odds_value
     *
     * @return double
     */
    public function getOddsValue()
    {
        return $this->odds_value;
    }

    /**
     * Returns the value of field favourite_flag
     *
     * @return string
     */
    public function getFavouriteFlag()
    {
        return $this->favourite_flag;
    }

    /**
     * Returns the value of field odds_fraction_numerator
     *
     * @return integer
     */
    public function getOddsFractionNumerator()
    {
        return $this->odds_fraction_numerator;
    }

    /**
     * Returns the value of field odds_fraction_denominator
     *
     * @return integer
     */
    public function getOddsFractionDenominator()
    {
        return $this->odds_fraction_denominator;
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

    /**
     * Returns the value of field british_odds_flag
     *
     * @return string
     */
    public function getBritishOddsFlag()
    {
        return $this->british_odds_flag;
    }

    public function getSource()
    {
        return 'odds';
    }

    /**
     * @return array
     */
    public function metaData()
    {
        return array(

            //Every column in the mapped table
            MetaData::MODELS_ATTRIBUTES => array(
                'odds_uid',
                'odds_desc',
                'odds_value',
                'favourite_flag',
                'odds_fraction_numerator',
                'odds_fraction_denominator',
                'timestamp',
                'british_odds_flag',
            ),

            //Every column part of the primary key
            MetaData::MODELS_PRIMARY_KEY => array(
                'odds_uid',
            ),

            //Every column that isn't part of the primary key
            MetaData::MODELS_NON_PRIMARY_KEY => array(
                'odds_desc',
                'odds_value',
                'favourite_flag',
                'odds_fraction_numerator',
                'odds_fraction_denominator',
                'timestamp',
                'british_odds_flag',
            ),

            //Every column that doesn't allows null values
            MetaData::MODELS_NOT_NULL => array(
                'favourite_flag',
                'odds_fraction_numerator',
                'odds_fraction_denominator',
                'british_odds_flag',
            ),

            //Every column and their data types
            MetaData::MODELS_DATA_TYPES => array(
                'odds_uid' => Column::TYPE_INTEGER,
                'odds_desc' => Column::TYPE_VARCHAR,
                'odds_value' => Column::TYPE_DECIMAL,
                'favourite_flag' => Column::TYPE_CHAR,
                'odds_fraction_numerator' => Column::TYPE_INTEGER,
                'odds_fraction_denominator' => Column::TYPE_INTEGER,
                'timestamp' => Column::TYPE_DATE,
                'british_odds_flag' => Column::TYPE_CHAR,
            ),

            //The columns that have numeric data types
            MetaData::MODELS_DATA_TYPES_NUMERIC => array(
                'odds_uid' => true,
                'odds_desc' => false,
                'odds_value' => true,
                'favourite_flag' => false,
                'odds_fraction_numerator' => true,
                'odds_fraction_denominator' => true,
                'timestamp' => false,
                'british_odds_flag' => false,
            ),

            //How every column must be bound/casted
            MetaData::MODELS_DATA_TYPES_BIND => array(
                'odds_uid' => Column::BIND_PARAM_INT,
                'odds_desc' => Column::BIND_PARAM_STR,
                'odds_value' => Column::BIND_PARAM_DECIMAL,
                'favourite_flag' => Column::BIND_PARAM_STR,
                'odds_fraction_numerator' => Column::BIND_PARAM_INT,
                'odds_fraction_denominator' => Column::BIND_PARAM_INT,
                'timestamp' => Column::BIND_PARAM_STR,
                'british_odds_flag' => Column::BIND_PARAM_STR,
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
