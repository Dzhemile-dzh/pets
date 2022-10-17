<?php

namespace Models;

use Phalcon\Mvc\Model;

class HorseSex extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    protected $horse_sex_code;

    /**
     *
     * @var string
     */
    protected $horse_sex_desc;

    /**
     *
     * @var string
     */
    protected $horse_sex_flag;

    /**
     * Method to set the value of field horse_sex_code
     *
     * @param string $horse_sex_code
     *
     * @return $this
     */
    public function setHorseSexCode($horse_sex_code)
    {
        $this->horse_sex_code = $horse_sex_code;

        return $this;
    }

    /**
     * Method to set the value of field horse_sex_desc
     *
     * @param string $horse_sex_desc
     *
     * @return $this
     */
    public function setHorseSexDesc($horse_sex_desc)
    {
        $this->horse_sex_desc = $horse_sex_desc;

        return $this;
    }

    /**
     * Method to set the value of field horse_sex_flag
     *
     * @param string $horse_sex_flag
     *
     * @return $this
     */
    public function setHorseSexFlag($horse_sex_flag)
    {
        $this->horse_sex_flag = $horse_sex_flag;

        return $this;
    }

    /**
     * Returns the value of field horse_sex_code
     *
     * @return string
     */
    public function getHorseSexCode()
    {
        return $this->horse_sex_code;
    }

    /**
     * Returns the value of field horse_sex_desc
     *
     * @return string
     */
    public function getHorseSexDesc()
    {
        return $this->horse_sex_desc;
    }

    /**
     * Returns the value of field horse_sex_flag
     *
     * @return string
     */
    public function getHorseSexFlag()
    {
        return $this->horse_sex_flag;
    }

    public function getSource()
    {
        return 'horse_sex';
    }

    /**
     * @return array
     */
    public function metaData()
    {
        return array(

            //Every column in the mapped table
            MetaData::MODELS_ATTRIBUTES => array(
                'horse_sex_code',
                'horse_sex_desc',
                'horse_sex_flag',
            ),
            //Every column part of the primary key
            MetaData::MODELS_PRIMARY_KEY => array(
                'horse_sex_code',
            ),
            //Every column that isn't part of the primary key
            MetaData::MODELS_NON_PRIMARY_KEY => array(
                'horse_sex_desc',
                'horse_sex_flag',
            ),
            //Every column that doesn't allows null values
            MetaData::MODELS_NOT_NULL => false,
            //Every column and their data types
            MetaData::MODELS_DATA_TYPES => array(
                'horse_sex_code' => Column::TYPE_CHAR,
                'horse_sex_desc' => Column::TYPE_VARCHAR,
                'horse_sex_flag' => Column::TYPE_CHAR,
            ),
            //The columns that have numeric data types
            MetaData::MODELS_DATA_TYPES_NUMERIC => array(
                'horse_sex_code' => false,
                'horse_sex_desc' => false,
                'horse_sex_flag' => false,
            ),
            //How every column must be bound/casted
            MetaData::MODELS_DATA_TYPES_BIND => array(
                'horse_sex_code' => Column::BIND_PARAM_STR,
                'horse_sex_desc' => Column::BIND_PARAM_STR,
                'horse_sex_flag' => Column::BIND_PARAM_STR,
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
