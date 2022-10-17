<?php

namespace Models;

use Phalcon\Mvc\Model;
use Phalcon\Db\Column;
use Phalcon\Mvc\Model\MetaData;

class CourseType extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    protected $course_type_code;

    /**
     *
     * @var string
     */
    protected $course_type_desc;

    /**
     * Method to set the value of field course_type_code
     *
     * @param string $course_type_code
     *
     * @return $this
     */
    public function setCourseTypeCode($course_type_code)
    {
        $this->course_type_code = $course_type_code;

        return $this;
    }

    /**
     * Method to set the value of field course_type_desc
     *
     * @param string $course_type_desc
     *
     * @return $this
     */
    public function setCourseTypeDesc($course_type_desc)
    {
        $this->course_type_desc = $course_type_desc;

        return $this;
    }

    /**
     * Returns the value of field course_type_code
     *
     * @return string
     */
    public function getCourseTypeCode()
    {
        return $this->course_type_code;
    }

    /**
     * Returns the value of field course_type_desc
     *
     * @return string
     */
    public function getCourseTypeDesc()
    {
        return $this->course_type_desc;
    }

    public function getSource()
    {
        return 'course_type';
    }

    /**
     * @return array
     */
    public function metaData()
    {
        return array(

            //Every column in the mapped table
            MetaData::MODELS_ATTRIBUTES => array(
                'course_type_code',
                'course_type_desc',
            ),
            //Every column part of the primary key
            MetaData::MODELS_PRIMARY_KEY => array(
                'course_type_code',
            ),
            //Every column that isn't part of the primary key
            MetaData::MODELS_NON_PRIMARY_KEY => array(
                'course_type_desc',
            ),
            //Every column that doesn't allows null values
            MetaData::MODELS_NOT_NULL => false,
            //Every column and their data types
            MetaData::MODELS_DATA_TYPES => array(
                'course_type_code' => Column::TYPE_CHAR,
                'course_type_desc' => Column::TYPE_VARCHAR,
            ),
            //The columns that have numeric data types
            MetaData::MODELS_DATA_TYPES_NUMERIC => array(
                'course_type_code' => false,
                'course_type_desc' => false,
            ),
            //How every column must be bound/casted
            MetaData::MODELS_DATA_TYPES_BIND => array(
                'course_type_code' => Column::BIND_PARAM_STR,
                'course_type_desc' => Column::BIND_PARAM_STR,
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
