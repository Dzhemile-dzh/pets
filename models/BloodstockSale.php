<?php

namespace Models;

use Phalcon\Mvc\Model;
use Phalcon\Db\Column;
use Phalcon\Mvc\Model\MetaData;

class BloodstockSale extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $lot_no;

    /**
     *
     * @var string
     */
    protected $lot_letter;

    /**
     *
     * @var string
     */
    protected $sale_date;

    /**
     *
     * @var integer
     */
    protected $venue_uid;

    /**
     *
     * @var string
     */
    protected $private_resubmitted_flag;

    /**
     *
     * @var string
     */
    protected $seller_name;

    /**
     *
     * @var string
     */
    protected $horse_name;

    /**
     *
     * @var string
     */
    protected $horse_country_origin_code;

    /**
     *
     * @var integer
     */
    protected $horse_age;

    /**
     *
     * @var string
     */
    protected $horse_first_colour_code;

    /**
     *
     * @var string
     */
    protected $horse_second_colour_code;

    /**
     *
     * @var string
     */
    protected $horse_sex;

    /**
     *
     * @var string
     */
    protected $sire_name;

    /**
     *
     * @var string
     */
    protected $sire_country_origin_code;

    /**
     *
     * @var string
     */
    protected $dam_name;

    /**
     *
     * @var string
     */
    protected $dam_country_origin_code;

    /**
     *
     * @var string
     */
    protected $sire_of_dam_name;

    /**
     *
     * @var string
     */
    protected $sire_of_dam_ctry_org_code;

    /**
     *
     * @var string
     */
    protected $bloodstock_comment;

    /**
     *
     * @var string
     */
    protected $buyer_detail;

    /**
     *
     * @var double
     */
    protected $price;

    /**
     *
     * @var integer
     */
    protected $ruffs_guide_block_no;

    /**
     *
     * @var string
     */
    protected $weatherbys_code;

    /**
     *
     * @var string
     */
    protected $catalogue_pedigree_pdf_url;

    /**
     *
     * @var string
     */
    protected $idx_seller_name;

    /**
     *
     * @var string
     */
    protected $idx_buyer_detail;

    /**
     *
     * @var string
     */
    protected $search_seller_name;

    /**
     *
     * @var string
     */
    protected $search_buyer_detail;

    /**
     *
     * @var string
     */
    protected $sirecam_video_html;

    /**
     * Method to set the value of field lot_no
     *
     * @param integer $lot_no
     *
     * @return $this
     */
    public function setLotNo($lot_no)
    {
        $this->lot_no = $lot_no;

        return $this;
    }

    /**
     * Method to set the value of field lot_letter
     *
     * @param string $lot_letter
     *
     * @return $this
     */
    public function setLotLetter($lot_letter)
    {
        $this->lot_letter = $lot_letter;

        return $this;
    }

    /**
     * Method to set the value of field sale_date
     *
     * @param string $sale_date
     *
     * @return $this
     */
    public function setSaleDate($sale_date)
    {
        $this->sale_date = $sale_date;

        return $this;
    }

    /**
     * Method to set the value of field venue_uid
     *
     * @param integer $venue_uid
     *
     * @return $this
     */
    public function setVenueUid($venue_uid)
    {
        $this->venue_uid = $venue_uid;

        return $this;
    }

    /**
     * Method to set the value of field private_resubmitted_flag
     *
     * @param string $private_resubmitted_flag
     *
     * @return $this
     */
    public function setPrivateResubmittedFlag($private_resubmitted_flag)
    {
        $this->private_resubmitted_flag = $private_resubmitted_flag;

        return $this;
    }

    /**
     * Method to set the value of field seller_name
     *
     * @param string $seller_name
     *
     * @return $this
     */
    public function setSellerName($seller_name)
    {
        $this->seller_name = $seller_name;

        return $this;
    }

    /**
     * Method to set the value of field horse_name
     *
     * @param string $horse_name
     *
     * @return $this
     */
    public function setHorseName($horse_name)
    {
        $this->horse_name = $horse_name;

        return $this;
    }

    /**
     * Method to set the value of field horse_country_origin_code
     *
     * @param string $horse_country_origin_code
     *
     * @return $this
     */
    public function setHorseCountryOriginCode($horse_country_origin_code)
    {
        $this->horse_country_origin_code = $horse_country_origin_code;

        return $this;
    }

    /**
     * Method to set the value of field horse_age
     *
     * @param integer $horse_age
     *
     * @return $this
     */
    public function setHorseAge($horse_age)
    {
        $this->horse_age = $horse_age;

        return $this;
    }

    /**
     * Method to set the value of field horse_first_colour_code
     *
     * @param string $horse_first_colour_code
     *
     * @return $this
     */
    public function setHorseFirstColourCode($horse_first_colour_code)
    {
        $this->horse_first_colour_code = $horse_first_colour_code;

        return $this;
    }

    /**
     * Method to set the value of field horse_second_colour_code
     *
     * @param string $horse_second_colour_code
     *
     * @return $this
     */
    public function setHorseSecondColourCode($horse_second_colour_code)
    {
        $this->horse_second_colour_code = $horse_second_colour_code;

        return $this;
    }

    /**
     * Method to set the value of field horse_sex
     *
     * @param string $horse_sex
     *
     * @return $this
     */
    public function setHorseSex($horse_sex)
    {
        $this->horse_sex = $horse_sex;

        return $this;
    }

    /**
     * Method to set the value of field sire_name
     *
     * @param string $sire_name
     *
     * @return $this
     */
    public function setSireName($sire_name)
    {
        $this->sire_name = $sire_name;

        return $this;
    }

    /**
     * Method to set the value of field sire_country_origin_code
     *
     * @param string $sire_country_origin_code
     *
     * @return $this
     */
    public function setSireCountryOriginCode($sire_country_origin_code)
    {
        $this->sire_country_origin_code = $sire_country_origin_code;

        return $this;
    }

    /**
     * Method to set the value of field dam_name
     *
     * @param string $dam_name
     *
     * @return $this
     */
    public function setDamName($dam_name)
    {
        $this->dam_name = $dam_name;

        return $this;
    }

    /**
     * Method to set the value of field dam_country_origin_code
     *
     * @param string $dam_country_origin_code
     *
     * @return $this
     */
    public function setDamCountryOriginCode($dam_country_origin_code)
    {
        $this->dam_country_origin_code = $dam_country_origin_code;

        return $this;
    }

    /**
     * Method to set the value of field sire_of_dam_name
     *
     * @param string $sire_of_dam_name
     *
     * @return $this
     */
    public function setSireOfDamName($sire_of_dam_name)
    {
        $this->sire_of_dam_name = $sire_of_dam_name;

        return $this;
    }

    /**
     * Method to set the value of field sire_of_dam_ctry_org_code
     *
     * @param string $sire_of_dam_ctry_org_code
     *
     * @return $this
     */
    public function setSireOfDamCtryOrgCode($sire_of_dam_ctry_org_code)
    {
        $this->sire_of_dam_ctry_org_code = $sire_of_dam_ctry_org_code;

        return $this;
    }

    /**
     * Method to set the value of field bloodstock_comment
     *
     * @param string $bloodstock_comment
     *
     * @return $this
     */
    public function setBloodstockComment($bloodstock_comment)
    {
        $this->bloodstock_comment = $bloodstock_comment;

        return $this;
    }

    /**
     * Method to set the value of field buyer_detail
     *
     * @param string $buyer_detail
     *
     * @return $this
     */
    public function setBuyerDetail($buyer_detail)
    {
        $this->buyer_detail = $buyer_detail;

        return $this;
    }

    /**
     * Method to set the value of field price
     *
     * @param double $price
     *
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Method to set the value of field ruffs_guide_block_no
     *
     * @param integer $ruffs_guide_block_no
     *
     * @return $this
     */
    public function setRuffsGuideBlockNo($ruffs_guide_block_no)
    {
        $this->ruffs_guide_block_no = $ruffs_guide_block_no;

        return $this;
    }

    /**
     * Method to set the value of field weatherbys_code
     *
     * @param string $weatherbys_code
     *
     * @return $this
     */
    public function setWeatherbysCode($weatherbys_code)
    {
        $this->weatherbys_code = $weatherbys_code;

        return $this;
    }

    /**
     * Method to set the value of field catalogue_pedigree_pdf_url
     *
     * @param string $catalogue_pedigree_pdf_url
     *
     * @return $this
     */
    public function setCataloguePedigreePdfUrl($catalogue_pedigree_pdf_url)
    {
        $this->catalogue_pedigree_pdf_url = $catalogue_pedigree_pdf_url;

        return $this;
    }

    /**
     * Method to set the value of field idx_seller_name
     *
     * @param string $idx_seller_name
     *
     * @return $this
     */
    public function setIdxSellerName($idx_seller_name)
    {
        $this->idx_seller_name = $idx_seller_name;

        return $this;
    }

    /**
     * Method to set the value of field idx_buyer_detail
     *
     * @param string $idx_buyer_detail
     *
     * @return $this
     */
    public function setIdxBuyerDetail($idx_buyer_detail)
    {
        $this->idx_buyer_detail = $idx_buyer_detail;

        return $this;
    }

    /**
     * Method to set the value of field search_seller_name
     *
     * @param string $search_seller_name
     *
     * @return $this
     */
    public function setSearchSellerName($search_seller_name)
    {
        $this->search_seller_name = $search_seller_name;

        return $this;
    }

    /**
     * Method to set the value of field search_buyer_detail
     *
     * @param string $search_buyer_detail
     *
     * @return $this
     */
    public function setSearchBuyerDetail($search_buyer_detail)
    {
        $this->search_buyer_detail = $search_buyer_detail;

        return $this;
    }

    /**
     * Method to set the value of field sirecam_video_html
     *
     * @param string $sirecam_video_html
     *
     * @return $this
     */
    public function setSirecamVideoHtml($sirecam_video_html)
    {
        $this->sirecam_video_html = $sirecam_video_html;

        return $this;
    }

    /**
     * Returns the value of field lot_no
     *
     * @return integer
     */
    public function getLotNo()
    {
        return $this->lot_no;
    }

    /**
     * Returns the value of field lot_letter
     *
     * @return string
     */
    public function getLotLetter()
    {
        return $this->lot_letter;
    }

    /**
     * Returns the value of field sale_date
     *
     * @return string
     */
    public function getSaleDate()
    {
        return $this->sale_date;
    }

    /**
     * Returns the value of field venue_uid
     *
     * @return integer
     */
    public function getVenueUid()
    {
        return $this->venue_uid;
    }

    /**
     * Returns the value of field private_resubmitted_flag
     *
     * @return string
     */
    public function getPrivateResubmittedFlag()
    {
        return $this->private_resubmitted_flag;
    }

    /**
     * Returns the value of field seller_name
     *
     * @return string
     */
    public function getSellerName()
    {
        return $this->seller_name;
    }

    /**
     * Returns the value of field horse_name
     *
     * @return string
     */
    public function getHorseName()
    {
        return $this->horse_name;
    }

    /**
     * Returns the value of field horse_country_origin_code
     *
     * @return string
     */
    public function getHorseCountryOriginCode()
    {
        return $this->horse_country_origin_code;
    }

    /**
     * Returns the value of field horse_age
     *
     * @return integer
     */
    public function getHorseAge()
    {
        return $this->horse_age;
    }

    /**
     * Returns the value of field horse_first_colour_code
     *
     * @return string
     */
    public function getHorseFirstColourCode()
    {
        return $this->horse_first_colour_code;
    }

    /**
     * Returns the value of field horse_second_colour_code
     *
     * @return string
     */
    public function getHorseSecondColourCode()
    {
        return $this->horse_second_colour_code;
    }

    /**
     * Returns the value of field horse_sex
     *
     * @return string
     */
    public function getHorseSex()
    {
        return $this->horse_sex;
    }

    /**
     * Returns the value of field sire_name
     *
     * @return string
     */
    public function getSireName()
    {
        return $this->sire_name;
    }

    /**
     * Returns the value of field sire_country_origin_code
     *
     * @return string
     */
    public function getSireCountryOriginCode()
    {
        return $this->sire_country_origin_code;
    }

    /**
     * Returns the value of field dam_name
     *
     * @return string
     */
    public function getDamName()
    {
        return $this->dam_name;
    }

    /**
     * Returns the value of field dam_country_origin_code
     *
     * @return string
     */
    public function getDamCountryOriginCode()
    {
        return $this->dam_country_origin_code;
    }

    /**
     * Returns the value of field sire_of_dam_name
     *
     * @return string
     */
    public function getSireOfDamName()
    {
        return $this->sire_of_dam_name;
    }

    /**
     * Returns the value of field sire_of_dam_ctry_org_code
     *
     * @return string
     */
    public function getSireOfDamCtryOrgCode()
    {
        return $this->sire_of_dam_ctry_org_code;
    }

    /**
     * Returns the value of field bloodstock_comment
     *
     * @return string
     */
    public function getBloodstockComment()
    {
        return $this->bloodstock_comment;
    }

    /**
     * Returns the value of field buyer_detail
     *
     * @return string
     */
    public function getBuyerDetail()
    {
        return $this->buyer_detail;
    }

    /**
     * Returns the value of field price
     *
     * @return double
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Returns the value of field ruffs_guide_block_no
     *
     * @return integer
     */
    public function getRuffsGuideBlockNo()
    {
        return $this->ruffs_guide_block_no;
    }

    /**
     * Returns the value of field weatherbys_code
     *
     * @return string
     */
    public function getWeatherbysCode()
    {
        return $this->weatherbys_code;
    }

    /**
     * Returns the value of field catalogue_pedigree_pdf_url
     *
     * @return string
     */
    public function getCataloguePedigreePdfUrl()
    {
        return $this->catalogue_pedigree_pdf_url;
    }

    /**
     * Returns the value of field idx_seller_name
     *
     * @return string
     */
    public function getIdxSellerName()
    {
        return $this->idx_seller_name;
    }

    /**
     * Returns the value of field idx_buyer_detail
     *
     * @return string
     */
    public function getIdxBuyerDetail()
    {
        return $this->idx_buyer_detail;
    }

    /**
     * Returns the value of field search_seller_name
     *
     * @return string
     */
    public function getSearchSellerName()
    {
        return $this->search_seller_name;
    }

    /**
     * Returns the value of field search_buyer_detail
     *
     * @return string
     */
    public function getSearchBuyerDetail()
    {
        return $this->search_buyer_detail;
    }

    /**
     * Returns the value of field sirecam_video_html
     *
     * @return string
     */
    public function getSirecamVideoHtml()
    {
        return $this->sirecam_video_html;
    }

    public function getSource()
    {
        return 'bloodstock_sale';
    }

    /**
     * @return array
     */
    public function metaData()
    {
        return array(

            //Every column in the mapped table
            MetaData::MODELS_ATTRIBUTES => array(
                'lot_no',
                'lot_letter',
                'sale_date',
                'venue_uid',
                'private_resubmitted_flag',
                'seller_name',
                'horse_name',
                'horse_country_origin_code',
                'horse_age',
                'horse_first_colour_code',
                'horse_second_colour_code',
                'horse_sex',
                'sire_name',
                'sire_country_origin_code',
                'dam_name',
                'dam_country_origin_code',
                'sire_of_dam_name',
                'sire_of_dam_ctry_org_code',
                'bloodstock_comment',
                'buyer_detail',
                'price',
                'ruffs_guide_block_no',
                'weatherbys_code',
                'catalogue_pedigree_pdf_url',
                'idx_seller_name',
                'idx_buyer_detail',
                'search_seller_name',
                'search_buyer_detail',
                'sirecam_video_html',
            ),
            //Every column part of the primary key
            MetaData::MODELS_PRIMARY_KEY => array(
                'lot_no',
                'lot_letter',
                'sale_date',
                'venue_uid',
                'private_resubmitted_flag',
            ),
            //Every column that isn't part of the primary key
            MetaData::MODELS_NON_PRIMARY_KEY => array(
                'seller_name',
                'horse_name',
                'horse_country_origin_code',
                'horse_age',
                'horse_first_colour_code',
                'horse_second_colour_code',
                'horse_sex',
                'sire_name',
                'sire_country_origin_code',
                'dam_name',
                'dam_country_origin_code',
                'sire_of_dam_name',
                'sire_of_dam_ctry_org_code',
                'bloodstock_comment',
                'buyer_detail',
                'price',
                'ruffs_guide_block_no',
                'weatherbys_code',
                'catalogue_pedigree_pdf_url',
                'idx_seller_name',
                'idx_buyer_detail',
                'search_seller_name',
                'search_buyer_detail',
                'sirecam_video_html',
            ),
            //Every column that doesn't allows null values
            MetaData::MODELS_NOT_NULL => array(
                'horse_name',
                'horse_country_origin_code',
                'horse_age',
                'horse_first_colour_code',
                'horse_second_colour_code',
                'horse_sex',
                'sire_name',
                'sire_country_origin_code',
                'dam_name',
                'dam_country_origin_code',
                'sire_of_dam_name',
                'sire_of_dam_ctry_org_code',
                'bloodstock_comment',
                'buyer_detail',
                'price',
                'ruffs_guide_block_no',
                'weatherbys_code',
                'catalogue_pedigree_pdf_url',
                'idx_seller_name',
                'idx_buyer_detail',
                'search_seller_name',
                'search_buyer_detail',
                'sirecam_video_html',
            ),
            //Every column and their data types
            MetaData::MODELS_DATA_TYPES => array(
                'lot_no' => Column::TYPE_INTEGER,
                'lot_letter' => Column::TYPE_CHAR,
                'sale_date' => Column::TYPE_DATETIME,
                'venue_uid' => Column::TYPE_INTEGER,
                'private_resubmitted_flag' => Column::TYPE_CHAR,
                'seller_name' => Column::TYPE_VARCHAR,
                'horse_name' => Column::TYPE_VARCHAR,
                'horse_country_origin_code' => Column::TYPE_CHAR,
                'horse_age' => Column::TYPE_INTEGER,
                'horse_first_colour_code' => Column::TYPE_CHAR,
                'horse_second_colour_code' => Column::TYPE_CHAR,
                'horse_sex' => Column::TYPE_CHAR,
                'sire_name' => Column::TYPE_VARCHAR,
                'sire_country_origin_code' => Column::TYPE_CHAR,
                'dam_name' => Column::TYPE_VARCHAR,
                'dam_country_origin_code' => Column::TYPE_CHAR,
                'sire_of_dam_name' => Column::TYPE_VARCHAR,
                'sire_of_dam_ctry_org_code' => Column::TYPE_CHAR,
                'bloodstock_comment' => Column::TYPE_VARCHAR,
                'buyer_detail' => Column::TYPE_VARCHAR,
                'price' => Column::TYPE_DECIMAL,
                'ruffs_guide_block_no' => Column::TYPE_INTEGER,
                'weatherbys_code' => Column::TYPE_CHAR,
                'catalogue_pedigree_pdf_url' => Column::TYPE_VARCHAR,
                'idx_seller_name' => Column::TYPE_CHAR,
                'idx_buyer_detail' => Column::TYPE_CHAR,
                'search_seller_name' => Column::TYPE_VARCHAR,
                'search_buyer_detail' => Column::TYPE_VARCHAR,
                'sirecam_video_html' => Column::TYPE_VARCHAR,
            ),
            //The columns that have numeric data types
            MetaData::MODELS_DATA_TYPES_NUMERIC => array(
                'lot_no' => true,
                'lot_letter' => false,
                'sale_date' => false,
                'venue_uid' => true,
                'private_resubmitted_flag' => false,
                'seller_name' => false,
                'horse_name' => false,
                'horse_country_origin_code' => false,
                'horse_age' => true,
                'horse_first_colour_code' => false,
                'horse_second_colour_code' => false,
                'horse_sex' => false,
                'sire_name' => false,
                'sire_country_origin_code' => false,
                'dam_name' => false,
                'dam_country_origin_code' => false,
                'sire_of_dam_name' => false,
                'sire_of_dam_ctry_org_code' => false,
                'bloodstock_comment' => false,
                'buyer_detail' => false,
                'price' => true,
                'ruffs_guide_block_no' => true,
                'weatherbys_code' => false,
                'catalogue_pedigree_pdf_url' => false,
                'idx_seller_name' => false,
                'idx_buyer_detail' => false,
                'search_seller_name' => false,
                'search_buyer_detail' => false,
                'sirecam_video_html' => false,
            ),
            //How every column must be bound/casted
            MetaData::MODELS_DATA_TYPES_BIND => array(
                'lot_no' => Column::BIND_PARAM_INT,
                'lot_letter' => Column::BIND_PARAM_STR,
                'sale_date' => Column::BIND_PARAM_STR,
                'venue_uid' => Column::BIND_PARAM_INT,
                'private_resubmitted_flag' => Column::BIND_PARAM_STR,
                'seller_name' => Column::BIND_PARAM_STR,
                'horse_name' => Column::BIND_PARAM_STR,
                'horse_country_origin_code' => Column::BIND_PARAM_STR,
                'horse_age' => Column::BIND_PARAM_INT,
                'horse_first_colour_code' => Column::BIND_PARAM_STR,
                'horse_second_colour_code' => Column::BIND_PARAM_STR,
                'horse_sex' => Column::BIND_PARAM_STR,
                'sire_name' => Column::BIND_PARAM_STR,
                'sire_country_origin_code' => Column::BIND_PARAM_STR,
                'dam_name' => Column::BIND_PARAM_STR,
                'dam_country_origin_code' => Column::BIND_PARAM_STR,
                'sire_of_dam_name' => Column::BIND_PARAM_STR,
                'sire_of_dam_ctry_org_code' => Column::BIND_PARAM_STR,
                'bloodstock_comment' => Column::BIND_PARAM_STR,
                'buyer_detail' => Column::BIND_PARAM_STR,
                'price' => Column::BIND_PARAM_DECIMAL,
                'ruffs_guide_block_no' => Column::BIND_PARAM_INT,
                'weatherbys_code' => Column::BIND_PARAM_STR,
                'catalogue_pedigree_pdf_url' => Column::BIND_PARAM_STR,
                'idx_seller_name' => Column::BIND_PARAM_STR,
                'idx_buyer_detail' => Column::BIND_PARAM_STR,
                'search_seller_name' => Column::BIND_PARAM_STR,
                'search_buyer_detail' => Column::BIND_PARAM_STR,
                'sirecam_video_html' => Column::BIND_PARAM_STR,
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
