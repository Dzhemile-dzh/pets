<?php

namespace Models;

use Phalcon\Mvc\Model;
use Phalcon\Db\Column;
use Phalcon\Mvc\Model\MetaData;

class MeetingColoursLookup extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $meeting_number;

    /**
     *
     * @var integer
     */
    protected $c_colour;

    /**
     *
     * @var integer
     */
    protected $m_colour;

    /**
     *
     * @var integer
     */
    protected $y_colour;

    /**
     *
     * @var integer
     */
    protected $k_colour;

    /**
     *
     * @var string
     */
    protected $colour_description;

    /**
     *
     * @var integer
     */
    protected $r_colour;

    /**
     *
     * @var integer
     */
    protected $g_colour;

    /**
     *
     * @var integer
     */
    protected $b_colour;

    /**
     * Method to set the value of field meeting_number
     *
     * @param integer $meeting_number
     *
     * @return $this
     */
    public function setMeetingNumber($meeting_number)
    {
        $this->meeting_number = $meeting_number;

        return $this;
    }

    /**
     * Method to set the value of field c_colour
     *
     * @param integer $c_colour
     *
     * @return $this
     */
    public function setCColour($c_colour)
    {
        $this->c_colour = $c_colour;

        return $this;
    }

    /**
     * Method to set the value of field m_colour
     *
     * @param integer $m_colour
     *
     * @return $this
     */
    public function setMColour($m_colour)
    {
        $this->m_colour = $m_colour;

        return $this;
    }

    /**
     * Method to set the value of field y_colour
     *
     * @param integer $y_colour
     *
     * @return $this
     */
    public function setYColour($y_colour)
    {
        $this->y_colour = $y_colour;

        return $this;
    }

    /**
     * Method to set the value of field k_colour
     *
     * @param integer $k_colour
     *
     * @return $this
     */
    public function setKColour($k_colour)
    {
        $this->k_colour = $k_colour;

        return $this;
    }

    /**
     * Method to set the value of field colour_description
     *
     * @param string $colour_description
     *
     * @return $this
     */
    public function setColourDescription($colour_description)
    {
        $this->colour_description = $colour_description;

        return $this;
    }

    /**
     * Method to set the value of field r_colour
     *
     * @param integer $r_colour
     *
     * @return $this
     */
    public function setRColour($r_colour)
    {
        $this->r_colour = $r_colour;

        return $this;
    }

    /**
     * Method to set the value of field g_colour
     *
     * @param integer $g_colour
     *
     * @return $this
     */
    public function setGColour($g_colour)
    {
        $this->g_colour = $g_colour;

        return $this;
    }

    /**
     * Method to set the value of field b_colour
     *
     * @param integer $b_colour
     *
     * @return $this
     */
    public function setBColour($b_colour)
    {
        $this->b_colour = $b_colour;

        return $this;
    }

    /**
     * Returns the value of field meeting_number
     *
     * @return integer
     */
    public function getMeetingNumber()
    {
        return $this->meeting_number;
    }

    /**
     * Returns the value of field c_colour
     *
     * @return integer
     */
    public function getCColour()
    {
        return $this->c_colour;
    }

    /**
     * Returns the value of field m_colour
     *
     * @return integer
     */
    public function getMColour()
    {
        return $this->m_colour;
    }

    /**
     * Returns the value of field y_colour
     *
     * @return integer
     */
    public function getYColour()
    {
        return $this->y_colour;
    }

    /**
     * Returns the value of field k_colour
     *
     * @return integer
     */
    public function getKColour()
    {
        return $this->k_colour;
    }

    /**
     * Returns the value of field colour_description
     *
     * @return string
     */
    public function getColourDescription()
    {
        return $this->colour_description;
    }

    /**
     * Returns the value of field r_colour
     *
     * @return integer
     */
    public function getRColour()
    {
        return $this->r_colour;
    }

    /**
     * Returns the value of field g_colour
     *
     * @return integer
     */
    public function getGColour()
    {
        return $this->g_colour;
    }

    /**
     * Returns the value of field b_colour
     *
     * @return integer
     */
    public function getBColour()
    {
        return $this->b_colour;
    }

    public function getSource()
    {
        return 'meeting_colours_lookup';
    }

    /**
     * @return array
     */
    public function metaData()
    {
        return array(

            //Every column in the mapped table
            MetaData::MODELS_ATTRIBUTES => array(
                'meeting_number',
                'c_colour',
                'm_colour',
                'y_colour',
                'k_colour',
                'colour_description',
                'r_colour',
                'g_colour',
                'b_colour',
            ),
            //Every column part of the primary key
            MetaData::MODELS_PRIMARY_KEY => false,
            //Every column that isn't part of the primary key
            MetaData::MODELS_NON_PRIMARY_KEY => array(
                'meeting_number',
                'c_colour',
                'm_colour',
                'y_colour',
                'k_colour',
                'colour_description',
                'r_colour',
                'g_colour',
                'b_colour',
            ),
            //Every column that doesn't allows null values
            MetaData::MODELS_NOT_NULL => array(
                'r_colour',
                'g_colour',
                'b_colour',
            ),
            //Every column and their data types
            MetaData::MODELS_DATA_TYPES => array(
                'meeting_number' => Column::TYPE_INTEGER,
                'c_colour' => Column::TYPE_INTEGER,
                'm_colour' => Column::TYPE_INTEGER,
                'y_colour' => Column::TYPE_INTEGER,
                'k_colour' => Column::TYPE_INTEGER,
                'colour_description' => Column::TYPE_VARCHAR,
                'r_colour' => Column::TYPE_INTEGER,
                'g_colour' => Column::TYPE_INTEGER,
                'b_colour' => Column::TYPE_INTEGER,
            ),
            //The columns that have numeric data types
            MetaData::MODELS_DATA_TYPES_NUMERIC => array(
                'meeting_number' => true,
                'c_colour' => true,
                'm_colour' => true,
                'y_colour' => true,
                'k_colour' => true,
                'colour_description' => false,
                'r_colour' => true,
                'g_colour' => true,
                'b_colour' => true,
            ),
            //How every column must be bound/casted
            MetaData::MODELS_DATA_TYPES_BIND => array(
                'meeting_number' => Column::BIND_PARAM_INT,
                'c_colour' => Column::BIND_PARAM_INT,
                'm_colour' => Column::BIND_PARAM_INT,
                'y_colour' => Column::BIND_PARAM_INT,
                'k_colour' => Column::BIND_PARAM_INT,
                'colour_description' => Column::BIND_PARAM_STR,
                'r_colour' => Column::BIND_PARAM_INT,
                'g_colour' => Column::BIND_PARAM_INT,
                'b_colour' => Column::BIND_PARAM_INT,
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
