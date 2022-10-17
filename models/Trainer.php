<?php

namespace Models;

use Phalcon\Mvc\Model;
use Phalcon\Db\Column;
use Phalcon\Mvc\Model\MetaData;

class Trainer extends \Phalcon\Mvc\Model
{
    /**
     *
     * @var integer
     */
    protected $trainer_uid;

    /**
     *
     * @var string
     */
    protected $search_name;

    /**
     *
     * @var string
     */
    protected $trainer_name;

    /**
     *
     * @var integer
     */
    protected $source_uid;

    /**
     *
     * @var integer
     */
    protected $address_uid;

    /**
     *
     * @var string
     */
    protected $trainer_location;

    /**
     *
     * @var string
     */
    protected $timestamp;

    /**
     *
     * @var string
     */
    protected $mirror_name;

    /**
     *
     * @var string
     */
    protected $trainer_type_code;

    /**
     *
     * @var integer
     */
    protected $rp_x_coord;

    /**
     *
     * @var integer
     */
    protected $rp_y_coord;

    /**
     *
     * @var string
     */
    protected $country_code;

    /**
     *
     * @var string
     */
    protected $searchname;

    /**
     *
     * @var string
     */
    protected $style_name;

    /**
     *
     * @var string
     */
    protected $surname;

    /**
     *
     * @var string
     */
    protected $christian_name;

    /**
     *
     * @var string
     */
    protected $initials;

    /**
     *
     * @var string
     */
    protected $title;

    /**
     *
     * @var string
     */
    protected $aka_style_name;

    /**
     *
     * @var string
     */
    protected $date_of_birth;

    /**
     *
     * @var string
     */
    protected $telephone_number_1;

    /**
     *
     * @var string
     */
    protected $telephone_number_2;

    /**
     *
     * @var string
     */
    protected $mobile_number;

    /**
     *
     * @var string
     */
    protected $fax_number;

    /**
     *
     * @var string
     */
    protected $email_address;

    /**
     *
     * @var string
     */
    protected $retired_date;

    /**
     *
     * @var string
     */
    protected $ptp_type_code;

    /**
     *
     * @var double
     */
    protected $latitude;

    /**
     *
     * @var double
     */
    protected $longitude;

    /**
     *
     * @var integer
     */
    protected $zoom;

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
     * Method to set the value of field search_name
     *
     * @param string $search_name
     *
     * @return $this
     */
    public function setSearchName($search_name)
    {
        $this->search_name = $search_name;

        return $this;
    }

    /**
     * Method to set the value of field trainer_name
     *
     * @param string $trainer_name
     *
     * @return $this
     */
    public function setTrainerName($trainer_name)
    {
        $this->trainer_name = $trainer_name;

        return $this;
    }

    /**
     * Method to set the value of field source_uid
     *
     * @param integer $source_uid
     *
     * @return $this
     */
    public function setSourceUid($source_uid)
    {
        $this->source_uid = $source_uid;

        return $this;
    }

    /**
     * Method to set the value of field address_uid
     *
     * @param integer $address_uid
     *
     * @return $this
     */
    public function setAddressUid($address_uid)
    {
        $this->address_uid = $address_uid;

        return $this;
    }

    /**
     * Method to set the value of field trainer_location
     *
     * @param string $trainer_location
     *
     * @return $this
     */
    public function setTrainerLocation($trainer_location)
    {
        $this->trainer_location = $trainer_location;

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
     * Method to set the value of field mirror_name
     *
     * @param string $mirror_name
     *
     * @return $this
     */
    public function setMirrorName($mirror_name)
    {
        $this->mirror_name = $mirror_name;

        return $this;
    }

    /**
     * Method to set the value of field trainer_type_code
     *
     * @param string $trainer_type_code
     *
     * @return $this
     */
    public function setTrainerTypeCode($trainer_type_code)
    {
        $this->trainer_type_code = $trainer_type_code;

        return $this;
    }

    /**
     * Method to set the value of field rp_x_coord
     *
     * @param integer $rp_x_coord
     *
     * @return $this
     */
    public function setRpXCoord($rp_x_coord)
    {
        $this->rp_x_coord = $rp_x_coord;

        return $this;
    }

    /**
     * Method to set the value of field rp_y_coord
     *
     * @param integer $rp_y_coord
     *
     * @return $this
     */
    public function setRpYCoord($rp_y_coord)
    {
        $this->rp_y_coord = $rp_y_coord;

        return $this;
    }

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
     * Method to set the value of field searchname
     *
     * @param string $searchname
     *
     * @return $this
     */
    /*
    public function setSearchname($searchname)
    {
        $this->searchname = $searchname;

        return $this;
    }
    */

    /**
     * Method to set the value of field style_name
     *
     * @param string $style_name
     *
     * @return $this
     */
    public function setStyleName($style_name)
    {
        $this->style_name = $style_name;

        return $this;
    }

    /**
     * Method to set the value of field surname
     *
     * @param string $surname
     *
     * @return $this
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Method to set the value of field christian_name
     *
     * @param string $christian_name
     *
     * @return $this
     */
    public function setChristianName($christian_name)
    {
        $this->christian_name = $christian_name;

        return $this;
    }

    /**
     * Method to set the value of field initials
     *
     * @param string $initials
     *
     * @return $this
     */
    public function setInitials($initials)
    {
        $this->initials = $initials;

        return $this;
    }

    /**
     * Method to set the value of field title
     *
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Method to set the value of field aka_style_name
     *
     * @param string $aka_style_name
     *
     * @return $this
     */
    public function setAkaStyleName($aka_style_name)
    {
        $this->aka_style_name = $aka_style_name;

        return $this;
    }

    /**
     * Method to set the value of field date_of_birth
     *
     * @param string $date_of_birth
     *
     * @return $this
     */
    public function setDateOfBirth($date_of_birth)
    {
        $this->date_of_birth = $date_of_birth;

        return $this;
    }

    /**
     * Method to set the value of field telephone_number_1
     *
     * @param string $telephone_number_1
     *
     * @return $this
     */
    public function setTelephoneNumber1($telephone_number_1)
    {
        $this->telephone_number_1 = $telephone_number_1;

        return $this;
    }

    /**
     * Method to set the value of field telephone_number_2
     *
     * @param string $telephone_number_2
     *
     * @return $this
     */
    public function setTelephoneNumber2($telephone_number_2)
    {
        $this->telephone_number_2 = $telephone_number_2;

        return $this;
    }

    /**
     * Method to set the value of field mobile_number
     *
     * @param string $mobile_number
     *
     * @return $this
     */
    public function setMobileNumber($mobile_number)
    {
        $this->mobile_number = $mobile_number;

        return $this;
    }

    /**
     * Method to set the value of field fax_number
     *
     * @param string $fax_number
     *
     * @return $this
     */
    public function setFaxNumber($fax_number)
    {
        $this->fax_number = $fax_number;

        return $this;
    }

    /**
     * Method to set the value of field email_address
     *
     * @param string $email_address
     *
     * @return $this
     */
    public function setEmailAddress($email_address)
    {
        $this->email_address = $email_address;

        return $this;
    }

    /**
     * Method to set the value of field retired_date
     *
     * @param string $retired_date
     *
     * @return $this
     */
    public function setRetiredDate($retired_date)
    {
        $this->retired_date = $retired_date;

        return $this;
    }

    /**
     * Method to set the value of field ptp_type_code
     *
     * @param string $ptp_type_code
     *
     * @return $this
     */
    public function setPtpTypeCode($ptp_type_code)
    {
        $this->ptp_type_code = $ptp_type_code;

        return $this;
    }

    /**
     * Method to set the value of field latitude
     *
     * @param double $latitude
     *
     * @return $this
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Method to set the value of field longitude
     *
     * @param double $longitude
     *
     * @return $this
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Method to set the value of field zoom
     *
     * @param integer $zoom
     *
     * @return $this
     */
    public function setZoom($zoom)
    {
        $this->zoom = $zoom;

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
     * Returns the value of field search_name
     *
     * @return string
     */
    public function getSearchName()
    {
        return $this->search_name;
    }

    /**
     * Returns the value of field trainer_name
     *
     * @return string
     */
    public function getTrainerName()
    {
        return $this->trainer_name;
    }

    /**
     * Returns the value of field source_uid
     *
     * @return integer
     */
    public function getSourceUid()
    {
        return $this->source_uid;
    }

    /**
     * Returns the value of field address_uid
     *
     * @return integer
     */
    public function getAddressUid()
    {
        return $this->address_uid;
    }

    /**
     * Returns the value of field trainer_location
     *
     * @return string
     */
    public function getTrainerLocation()
    {
        return $this->trainer_location;
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
     * Returns the value of field mirror_name
     *
     * @return string
     */
    public function getMirrorName()
    {
        return $this->mirror_name;
    }

    /**
     * Returns the value of field trainer_type_code
     *
     * @return string
     */
    public function getTrainerTypeCode()
    {
        return $this->trainer_type_code;
    }

    /**
     * Returns the value of field rp_x_coord
     *
     * @return integer
     */
    public function getRpXCoord()
    {
        return $this->rp_x_coord;
    }

    /**
     * Returns the value of field rp_y_coord
     *
     * @return integer
     */
    public function getRpYCoord()
    {
        return $this->rp_y_coord;
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
     * Returns the value of field searchname
     *
     * @return string
     */
    /*
    public function getSearchname()
    {
        return $this->searchname;
    }
    */

    /**
     * Returns the value of field style_name
     *
     * @return string
     */
    public function getStyleName()
    {
        return $this->style_name;
    }

    /**
     * Returns the value of field surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Returns the value of field christian_name
     *
     * @return string
     */
    public function getChristianName()
    {
        return $this->christian_name;
    }

    /**
     * Returns the value of field initials
     *
     * @return string
     */
    public function getInitials()
    {
        return $this->initials;
    }

    /**
     * Returns the value of field title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Returns the value of field aka_style_name
     *
     * @return string
     */
    public function getAkaStyleName()
    {
        return $this->aka_style_name;
    }

    /**
     * Returns the value of field date_of_birth
     *
     * @return string
     */
    public function getDateOfBirth()
    {
        return $this->date_of_birth;
    }

    /**
     * Returns the value of field telephone_number_1
     *
     * @return string
     */
    public function getTelephoneNumber1()
    {
        return $this->telephone_number_1;
    }

    /**
     * Returns the value of field telephone_number_2
     *
     * @return string
     */
    public function getTelephoneNumber2()
    {
        return $this->telephone_number_2;
    }

    /**
     * Returns the value of field mobile_number
     *
     * @return string
     */
    public function getMobileNumber()
    {
        return $this->mobile_number;
    }

    /**
     * Returns the value of field fax_number
     *
     * @return string
     */
    public function getFaxNumber()
    {
        return $this->fax_number;
    }

    /**
     * Returns the value of field email_address
     *
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->email_address;
    }

    /**
     * Returns the value of field retired_date
     *
     * @return string
     */
    public function getRetiredDate()
    {
        return $this->retired_date;
    }

    /**
     * Returns the value of field ptp_type_code
     *
     * @return string
     */
    public function getPtpTypeCode()
    {
        return $this->ptp_type_code;
    }

    /**
     * Returns the value of field latitude
     *
     * @return double
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Returns the value of field longitude
     *
     * @return double
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Returns the value of field zoom
     *
     * @return integer
     */
    public function getZoom()
    {
        return $this->zoom;
    }

    public function getSource()
    {
        return 'trainer';
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
                'search_name',
                'trainer_name',
                'source_uid',
                'address_uid',
                'trainer_location',
                'timestamp',
                'mirror_name',
                'trainer_type_code',
                'rp_x_coord',
                'rp_y_coord',
                'country_code',
                'searchname',
                'style_name',
                'surname',
                'christian_name',
                'initials',
                'title',
                'aka_style_name',
                'date_of_birth',
                'telephone_number_1',
                'telephone_number_2',
                'mobile_number',
                'fax_number',
                'email_address',
                'retired_date',
                'ptp_type_code',
                'latitude',
                'longitude',
                'zoom',
            ),
            //Every column part of the primary key
            MetaData::MODELS_PRIMARY_KEY => array(
                'trainer_uid',
            ),
            //Every column that isn't part of the primary key
            MetaData::MODELS_NON_PRIMARY_KEY => array(
                'search_name',
                'trainer_name',
                'source_uid',
                'address_uid',
                'trainer_location',
                'timestamp',
                'mirror_name',
                'trainer_type_code',
                'rp_x_coord',
                'rp_y_coord',
                'country_code',
                'searchname',
                'style_name',
                'surname',
                'christian_name',
                'initials',
                'title',
                'aka_style_name',
                'date_of_birth',
                'telephone_number_1',
                'telephone_number_2',
                'mobile_number',
                'fax_number',
                'email_address',
                'retired_date',
                'ptp_type_code',
                'latitude',
                'longitude',
                'zoom',
            ),
            //Every column that doesn't allows null values
            MetaData::MODELS_NOT_NULL => array(
                'search_name',
                'source_uid',
                'address_uid',
                'trainer_location',
                'mirror_name',
                'trainer_type_code',
                'rp_x_coord',
                'rp_y_coord',
                'country_code',
                'searchname',
                'style_name',
                'surname',
                'christian_name',
                'initials',
                'title',
                'aka_style_name',
                'date_of_birth',
                'telephone_number_1',
                'telephone_number_2',
                'mobile_number',
                'fax_number',
                'email_address',
                'retired_date',
                'ptp_type_code',
                'latitude',
                'longitude',
                'zoom',
            ),
            //Every column and their data types
            MetaData::MODELS_DATA_TYPES => array(
                'trainer_uid' => Column::TYPE_INTEGER,
                'search_name' => Column::TYPE_VARCHAR,
                'trainer_name' => Column::TYPE_VARCHAR,
                'source_uid' => Column::TYPE_INTEGER,
                'address_uid' => Column::TYPE_INTEGER,
                'trainer_location' => Column::TYPE_VARCHAR,
                'timestamp' => Column::TYPE_DATE,
                'mirror_name' => Column::TYPE_VARCHAR,
                'trainer_type_code' => Column::TYPE_CHAR,
                'rp_x_coord' => Column::TYPE_INTEGER,
                'rp_y_coord' => Column::TYPE_INTEGER,
                'country_code' => Column::TYPE_CHAR,
                'searchname' => Column::TYPE_VARCHAR,
                'style_name' => Column::TYPE_VARCHAR,
                'surname' => Column::TYPE_VARCHAR,
                'christian_name' => Column::TYPE_VARCHAR,
                'initials' => Column::TYPE_VARCHAR,
                'title' => Column::TYPE_VARCHAR,
                'aka_style_name' => Column::TYPE_VARCHAR,
                'date_of_birth' => Column::TYPE_DATETIME,
                'telephone_number_1' => Column::TYPE_VARCHAR,
                'telephone_number_2' => Column::TYPE_VARCHAR,
                'mobile_number' => Column::TYPE_VARCHAR,
                'fax_number' => Column::TYPE_VARCHAR,
                'email_address' => Column::TYPE_VARCHAR,
                'retired_date' => Column::TYPE_DATETIME,
                'ptp_type_code' => Column::TYPE_CHAR,
                'latitude' => Column::TYPE_DECIMAL,
                'longitude' => Column::TYPE_DECIMAL,
                'zoom' => Column::TYPE_INTEGER,
            ),
            //The columns that have numeric data types
            MetaData::MODELS_DATA_TYPES_NUMERIC => array(
                'trainer_uid' => true,
                'search_name' => false,
                'trainer_name' => false,
                'source_uid' => true,
                'address_uid' => true,
                'trainer_location' => false,
                'timestamp' => false,
                'mirror_name' => false,
                'trainer_type_code' => false,
                'rp_x_coord' => true,
                'rp_y_coord' => true,
                'country_code' => false,
                'searchname' => false,
                'style_name' => false,
                'surname' => false,
                'christian_name' => false,
                'initials' => false,
                'title' => false,
                'aka_style_name' => false,
                'date_of_birth' => false,
                'telephone_number_1' => false,
                'telephone_number_2' => false,
                'mobile_number' => false,
                'fax_number' => false,
                'email_address' => false,
                'retired_date' => false,
                'ptp_type_code' => false,
                'latitude' => true,
                'longitude' => true,
                'zoom' => true,
            ),
            //How every column must be bound/casted
            MetaData::MODELS_DATA_TYPES_BIND => array(
                'trainer_uid' => Column::BIND_PARAM_INT,
                'search_name' => Column::BIND_PARAM_STR,
                'trainer_name' => Column::BIND_PARAM_STR,
                'source_uid' => Column::BIND_PARAM_INT,
                'address_uid' => Column::BIND_PARAM_INT,
                'trainer_location' => Column::BIND_PARAM_STR,
                'timestamp' => Column::BIND_PARAM_STR,
                'mirror_name' => Column::BIND_PARAM_STR,
                'trainer_type_code' => Column::BIND_PARAM_STR,
                'rp_x_coord' => Column::BIND_PARAM_INT,
                'rp_y_coord' => Column::BIND_PARAM_INT,
                'country_code' => Column::BIND_PARAM_STR,
                'searchname' => Column::BIND_PARAM_STR,
                'style_name' => Column::BIND_PARAM_STR,
                'surname' => Column::BIND_PARAM_STR,
                'christian_name' => Column::BIND_PARAM_STR,
                'initials' => Column::BIND_PARAM_STR,
                'title' => Column::BIND_PARAM_STR,
                'aka_style_name' => Column::BIND_PARAM_STR,
                'date_of_birth' => Column::BIND_PARAM_STR,
                'telephone_number_1' => Column::BIND_PARAM_STR,
                'telephone_number_2' => Column::BIND_PARAM_STR,
                'mobile_number' => Column::BIND_PARAM_STR,
                'fax_number' => Column::BIND_PARAM_STR,
                'email_address' => Column::BIND_PARAM_STR,
                'retired_date' => Column::BIND_PARAM_STR,
                'ptp_type_code' => Column::BIND_PARAM_STR,
                'latitude' => Column::BIND_PARAM_DECIMAL,
                'longitude' => Column::BIND_PARAM_DECIMAL,
                'zoom' => Column::BIND_PARAM_INT,
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
