<?php
namespace Models;

use Phalcon\Mvc\Model;
use Phalcon\Db\Column;
use Phalcon\Mvc\Model\MetaData;

class Country extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    protected $country_code;

    /**
     *
     * @var string
     */
    protected $country_desc;

    /**
     * Method to set the value of field country_code
     *
     * @param string $country_code
     *
     * @return $this
     */
    public function setCountryCode($country_code)
    {
        $this->country_code = $country_code;

        return $this;
    }

    /**
     * Method to set the value of field country_desc
     *
     * @param string $country_desc
     *
     * @return $this
     */
    public function setCountryDesc($country_desc)
    {
        $this->country_desc = $country_desc;

        return $this;
    }

    /**
     * Returns the value of field country_code
     *
     * @return string
     */
    public function getCountryCode()
    {
        return $this->country_code;
    }

    /**
     * Returns the value of field country_desc
     *
     * @return string
     */
    public function getCountryDesc()
    {
        return $this->country_desc;
    }

    public function getSource()
    {
        return 'country';
    }

    /**
     * @return array
     */
    public function metaData()
    {
        return array(

            //Every column in the mapped table
            MetaData::MODELS_ATTRIBUTES => array(
                'country_code',
                'country_desc',
            ),
            //Every column part of the primary key
            MetaData::MODELS_PRIMARY_KEY => array(
                'country_code',
            ),
            //Every column that isn't part of the primary key
            MetaData::MODELS_NON_PRIMARY_KEY => array(
                'country_desc',
            ),
            //Every column that doesn't allows null values
            MetaData::MODELS_NOT_NULL => false,
            //Every column and their data types
            MetaData::MODELS_DATA_TYPES => array(
                'country_code' => Column::TYPE_CHAR,
                'country_desc' => Column::TYPE_VARCHAR,
            ),
            //The columns that have numeric data types
            MetaData::MODELS_DATA_TYPES_NUMERIC => array(
                'country_code' => false,
                'country_desc' => false,
            ),
            //How every column must be bound/casted
            MetaData::MODELS_DATA_TYPES_BIND => array(
                'country_code' => Column::BIND_PARAM_STR,
                'country_desc' => Column::BIND_PARAM_STR,
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
