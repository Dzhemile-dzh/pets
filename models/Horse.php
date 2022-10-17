<?php

namespace Models;

use Phalcon\Mvc\Model;
use Phalcon\Db\Column;
use Phalcon\Mvc\Model\MetaData;
use \Api\Constants\Horses as Constants;
use Api\DataProvider\Bo\Rpr;
use Phalcon\DI;

/**
 * Class Horse
 *
 * @package Models
 */
class Horse extends Model
{

    const MAX_WEIGHT_FLAT = 140;
    const MAX_WEIGHT_JUMPS = 168;

    /**
     *
     * @var integer
     */
    protected $horse_uid;

    /**
     *
     * @var string
     */
    protected $horse_name;

    /**
     *
     * @var string
     */
    protected $horse_sex_code;

    /**
     *
     * @var string
     */
    protected $horse_date_of_birth;

    /**
     *
     * @var string
     */
    protected $horse_date_of_death;

    /**
     *
     * @var string
     */
    protected $country_origin_code;

    /**
     *
     * @var integer
     */
    protected $sire_uid;

    /**
     *
     * @var integer
     */
    protected $dam_uid;

    /**
     *
     * @var integer
     */
    protected $breeder_uid;

    /**
     *
     * @var string
     */
    protected $horse_colour_code;

    /**
     *
     * @var string
     */
    protected $date_gelded;

    /**
     *
     * @var integer
     */
    protected $source_uid;

    /**
     *
     * @var string
     */
    protected $timestamp;

    /**
     *
     * @var string
     */
    protected $searchname;

    /**
     *
     * @var string
     */
    protected $breeding_comment;

    /**
     *
     * @var string
     */
    protected $darley;

    /**
     *
     * @var string
     */
    protected $sire_comment;

    /**
     *
     * @var string
     */
    protected $style_name;

    /**
     * @return array
     */
    public function metaData()
    {
        return [

            //Every column in the mapped table
            MetaData::MODELS_ATTRIBUTES => [
                'horse_uid',
                'horse_name',
                'horse_sex_code',
                'horse_date_of_birth',
                'horse_date_of_death',
                'country_origin_code',
                'sire_uid',
                'dam_uid',
                'breeder_uid',
                'horse_colour_code',
                'date_gelded',
                'source_uid',
                'timestamp',
                'searchname',
                'breeding_comment',
                'darley',
                'sire_comment',
                'style_name'
            ],

            //Every column part of the primary key
            MetaData::MODELS_PRIMARY_KEY => [
                'horse_uid'
            ],

            //Every column that isn't part of the primary key
            MetaData::MODELS_NON_PRIMARY_KEY => [
                'horse_name',
                'horse_sex_code',
                'horse_date_of_birth',
                'horse_date_of_death',
                'country_origin_code',
                'sire_uid',
                'dam_uid',
                'breeder_uid',
                'horse_colour_code',
                'date_gelded',
                'source_uid',
                'timestamp',
                'searchname',
                'breeding_comment',
                'darley',
                'sire_comment',
                'style_name'
            ],

            //Every column that doesn't allows null values
            MetaData::MODELS_NOT_NULL => [
                'horse_uid',
                'horse_name'
            ],

            //Every column and their data types
            MetaData::MODELS_DATA_TYPES => [
                'horse_uid' => Column::TYPE_INTEGER,
                'horse_name' => Column::TYPE_VARCHAR,
                'horse_sex_code' => Column::TYPE_VARCHAR,
                'horse_date_of_birth' => Column::TYPE_DATETIME,
                'horse_date_of_death' => Column::TYPE_DATETIME,
                'country_origin_code' => Column::TYPE_VARCHAR,
                'sire_uid' => Column::TYPE_INTEGER,
                'dam_uid' => Column::TYPE_INTEGER,
                'breeder_uid' => Column::TYPE_INTEGER,
                'horse_colour_code' => Column::TYPE_VARCHAR,
                'date_gelded' => Column::TYPE_DATETIME,
                'source_uid' => Column::TYPE_INTEGER,
                'timestamp' => Column::TYPE_DATETIME,
                'searchname' => Column::TYPE_VARCHAR,
                'breeding_comment' => Column::TYPE_TEXT,
                'darley' => Column::TYPE_VARCHAR,
                'sire_comment' => Column::TYPE_VARCHAR,
                'style_name' => Column::TYPE_VARCHAR
            ],

            //The columns that have numeric data types
            MetaData::MODELS_DATA_TYPES_NUMERIC => [
                'horse_uid' => true,
                'sire_uid' => true,
                'dam_uid' => true,
                'breeder_uid' => true,
                'source_uid' => true,
            ],

            //The identity column, use boolean false if the model doesn't have
            //an identity column
            MetaData::MODELS_IDENTITY_COLUMN => 'horse_uid',

            //How every column must be bound/casted
            MetaData::MODELS_DATA_TYPES_BIND => [
                'horse_uid' => Column::BIND_PARAM_INT,
                'horse_name' => Column::BIND_PARAM_STR,
                'horse_sex_code' => Column::BIND_PARAM_STR,
                'horse_date_of_birth' => Column::BIND_PARAM_STR,
                'horse_date_of_death' => Column::BIND_PARAM_STR,
                'country_origin_code' => Column::BIND_PARAM_STR,
                'sire_uid' => Column::BIND_PARAM_INT,
                'dam_uid' => Column::BIND_PARAM_INT,
                'breeder_uid' => Column::BIND_PARAM_INT,
                'horse_colour_code' => Column::BIND_PARAM_STR,
                'date_gelded' => Column::BIND_PARAM_STR,
                'source_uid' => Column::BIND_PARAM_INT,
                'timestamp' => Column::BIND_PARAM_STR,
                'searchname' => Column::BIND_PARAM_STR,
                'breeding_comment' => Column::BIND_PARAM_STR,
                'darley' => Column::BIND_PARAM_STR,
                'sire_comment' => Column::BIND_PARAM_STR,
                'style_name' => Column::BIND_PARAM_STR
            ],

            //Fields that must be ignored from INSERT SQL statements
            MetaData::MODELS_AUTOMATIC_DEFAULT_INSERT => [
                'timestamp' => true
            ],

            //Fields that must be ignored from UPDATE SQL statements
            MetaData::MODELS_AUTOMATIC_DEFAULT_UPDATE => [
                'timestamp' => true
            ]

        ];
    }

    /**
     *  Defines relationships between models
     */
    public function initialize()
    {
        $this->hasMany('horse_uid', 'Models\PreHorseRace', 'horse_uid');
        $this->hasMany('horse_uid', 'Models\HorseOwner', 'horse_uid');
        $this->hasMany('horse_uid', 'Models\PostdataResultsNew', 'horse_uid');
    }

    /**
     * Method to set the value of field horse_uid
     *
     * @param integer $horse_uid
     *
     * @return $this
     */
    public function setHorseUid($horse_uid)
    {
        $this->horse_uid = $horse_uid;

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
     * Method to set the value of field horse_date_of_birth
     *
     * @param string $horse_date_of_birth
     *
     * @return $this
     */
    public function setHorseDateOfBirth($horse_date_of_birth)
    {
        $this->horse_date_of_birth = $horse_date_of_birth;

        return $this;
    }

    /**
     * Method to set the value of field horse_date_of_death
     *
     * @param string $horse_date_of_death
     *
     * @return $this
     */
    public function setHorseDateOfDeath($horse_date_of_death)
    {
        $this->horse_date_of_death = $horse_date_of_death;

        return $this;
    }

    /**
     * Method to set the value of field country_origin_code
     *
     * @param string $country_origin_code
     *
     * @return $this
     */
    public function setCountryOriginCode($country_origin_code)
    {
        $this->country_origin_code = $country_origin_code;

        return $this;
    }

    /**
     * Method to set the value of field sire_uid
     *
     * @param integer $sire_uid
     *
     * @return $this
     */
    public function setSireUid($sire_uid)
    {
        $this->sire_uid = $sire_uid;

        return $this;
    }

    /**
     * Method to set the value of field dam_uid
     *
     * @param integer $dam_uid
     *
     * @return $this
     */
    public function setDamUid($dam_uid)
    {
        $this->dam_uid = $dam_uid;

        return $this;
    }

    /**
     * Method to set the value of field breeder_uid
     *
     * @param integer $breeder_uid
     *
     * @return $this
     */
    public function setBreederUid($breeder_uid)
    {
        $this->breeder_uid = $breeder_uid;

        return $this;
    }

    /**
     * Method to set the value of field horse_colour_code
     *
     * @param string $horse_colour_code
     *
     * @return $this
     */
    public function setHorseColourCode($horse_colour_code)
    {
        $this->horse_colour_code = $horse_colour_code;

        return $this;
    }

    /**
     * Method to set the value of field date_gelded
     *
     * @param string $date_gelded
     *
     * @return $this
     */
    public function setDateGelded($date_gelded)
    {
        $this->date_gelded = $date_gelded;

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
     * Method to set the value of field searchname
     *
     * @param string $searchname
     *
     * @return $this
     */
    public function setSearchname($searchname)
    {
        $this->searchname = $searchname;

        return $this;
    }

    /**
     * Method to set the value of field breeding_comment
     *
     * @param string $breeding_comment
     *
     * @return $this
     */
    public function setBreedingComment($breeding_comment)
    {
        $this->breeding_comment = $breeding_comment;

        return $this;
    }

    /**
     * Method to set the value of field darley
     *
     * @param string $darley
     *
     * @return $this
     */
    public function setDarley($darley)
    {
        $this->darley = $darley;

        return $this;
    }

    /**
     * Method to set the value of field sire_comment
     *
     * @param string $sire_comment
     *
     * @return $this
     */
    public function setSireComment($sire_comment)
    {
        $this->sire_comment = $sire_comment;

        return $this;
    }

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
     * Returns the value of field horse_uid
     *
     * @return integer
     */
    public function getHorseUid()
    {
        return $this->horse_uid;
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
     * Returns the value of field horse_sex_code
     *
     * @return string
     */
    public function getHorseSexCode()
    {
        return $this->horse_sex_code;
    }

    /**
     * Returns the value of field horse_date_of_birth
     *
     * @return string
     */
    public function getHorseDateOfBirth()
    {
        return $this->horse_date_of_birth;
    }

    /**
     * Returns the value of field horse_date_of_death
     *
     * @return string
     */
    public function getHorseDateOfDeath()
    {
        return $this->horse_date_of_death;
    }

    /**
     * Returns the value of field country_origin_code
     *
     * @return string
     */
    public function getCountryOriginCode()
    {
        return $this->country_origin_code;
    }

    /**
     * Returns the value of field sire_uid
     *
     * @return integer
     */
    public function getSireUid()
    {
        return $this->sire_uid;
    }

    /**
     * Returns the value of field dam_uid
     *
     * @return integer
     */
    public function getDamUid()
    {
        return $this->dam_uid;
    }

    /**
     * Returns the value of field breeder_uid
     *
     * @return integer
     */
    public function getBreederUid()
    {
        return $this->breeder_uid;
    }

    /**
     * Returns the value of field horse_colour_code
     *
     * @return string
     */
    public function getHorseColourCode()
    {
        return $this->horse_colour_code;
    }

    /**
     * Returns the value of field date_gelded
     *
     * @return string
     */
    public function getDateGelded()
    {
        return $this->date_gelded;
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
     * Returns the value of field timestamp
     *
     * @return string
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Returns the value of field searchname
     *
     * @return string
     */
    public function getSearchname()
    {
        return $this->searchname;
    }

    /**
     * Returns the value of field breeding_comment
     *
     * @return string
     */
    public function getBreedingComment()
    {
        return $this->breeding_comment;
    }

    /**
     * Returns the value of field darley
     *
     * @return string
     */
    public function getDarley()
    {
        return $this->darley;
    }

    /**
     * Returns the value of field sire_comment
     *
     * @return string
     */
    public function getSireComment()
    {
        return $this->sire_comment;
    }

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
     * @param    array $races
     * @return  array
     */
    public function getRaceRecords(?array $races): ? array
    {
        if (!$races) {
            return null;
        }
        $result = array();
        foreach ($races as $race) {
            if (!$race->raceOR) {
                $race->raceOR = $race->official_rating_ran_off;
            }

            if (!in_array($race->race_type_code, Constants::RACE_GROUP_NHF_ARRAY)) {
                $this->prepareRaceArray($result[$race->race_type_code], $race, $race->race_type_code, true);
            }
            if (in_array($race->race_group_uid, Constants::$bigRaceWinsGroups) && in_array($race->race_type_code, Constants::RACE_TYPE_FLAT_ARRAY)) {
                $this->prepareRaceArray($result['S'], $race, 'S', false);
            }
            if ($race->race_type_code != Constants::RACE_TYPE_P2P_STR) {
                $this->prepareRaceArray($result['A'], $race, 'A', false);
            }
            if (in_array($race->race_type_code, Constants::RACE_GROUP_NHF_ARRAY)) {
                $this->prepareRaceArray($result['N'], $race, 'N', true);
            }
        }

        //We need this change to place NHF race as first element from the array (we need to match legacy)
        if (isset($result['N'])) {
            $nhfRace = $result['N'];
            unset($result['N']);
            array_unshift($result, $nhfRace);
        }

        return $result;
    }

    /**
     * @param   array $raceInfo summarized information for race
     * @param   array $currentRace information for current race
     * @param   string $raceType race type
     * @param   bool $includeCalc should we calculate rpr, ts and or for current race
     * @return  array
     */
    private function prepareRaceArray(&$raceInfo, $currentRace, $raceType, $includeCalc)
    {
        if (!$raceInfo) {
            $raceInfo = (object) array(
                'race_count' => 0,
                'rpr' => 0,
                'ts' => 0,
                'best_or' => 0,
                'win' => 0,
                'second_places' => 0,
                'earnings' => 0,
            );
        }

        $raceInfo->race_type_code = $raceType;
        $raceInfo->race_count++;
        if ($includeCalc) {
            $raceInfo->rpr = max($raceInfo->rpr, $currentRace->rp_postmark);
            $raceInfo->ts = max($raceInfo->ts, $currentRace->rp_topspeed);
            $raceInfo->best_or = max($raceInfo->best_or, $currentRace->raceOR);
        }
        $raceInfo->win += $currentRace->final_race_outcome_uid == 1 ? 1 : 0;
        $raceInfo->second_places += $currentRace->final_race_outcome_uid == 2 ? 1 : 0;
        $raceInfo->earnings += $currentRace->earnings;
    }
}
