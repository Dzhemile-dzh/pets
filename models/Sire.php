<?php

namespace Models;

use Phalcon\Mvc\Model;
use Phalcon\Db\Column;
use Phalcon\Mvc\Model\MetaData;

class Sire extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $sire_uid;

    /**
     *
     * @var double
     */
    protected $avg_flat_win_dist_of_progeny;

    /**
     *
     * @var double
     */
    protected $avg_jump_win_dist_of_progeny;

    /**
     *
     * @var string
     */
    protected $first_season_yn;

    /**
     *
     * @var integer
     */
    protected $no_of_2yo_offspring_runs;

    /**
     *
     * @var integer
     */
    protected $no_of_2yo_offspring_wins;

    /**
     *
     * @var integer
     */
    protected $no_of_offspring_flat_runs;

    /**
     *
     * @var integer
     */
    protected $no_of_offspring_flat_wins;

    /**
     *
     * @var integer
     */
    protected $no_of_offspring_jump_runs;

    /**
     *
     * @var integer
     */
    protected $no_of_offspring_jump_wins;

    /**
     *
     * @var integer
     */
    protected $no_of_flat_offsprings;

    /**
     *
     * @var integer
     */
    protected $no_of_jump_offsprings;

    /**
     *
     * @var string
     */
    protected $timestamp;

    /**
     *
     * @var double
     */
    protected $avg_hurdle_win_dist_of_progeny;

    /**
     *
     * @var double
     */
    protected $avg_chase_win_dist_of_progeny;

    /**
     *
     * @var double
     */
    protected $flat_avg_earnings_index;

    /**
     *
     * @var double
     */
    protected $jump_avg_earnings_index;

    /**
     * Method to set the value of field sire_uid
     *
     * @param integer $sire_uid
     * @return $this
     */
    public function setSireUid($sire_uid)
    {
        $this->sire_uid = $sire_uid;

        return $this;
    }

    /**
     * Method to set the value of field avg_flat_win_dist_of_progeny
     *
     * @param double $avg_flat_win_dist_of_progeny
     * @return $this
     */
    public function setAvgFlatWinDistOfProgeny($avg_flat_win_dist_of_progeny)
    {
        $this->avg_flat_win_dist_of_progeny = $avg_flat_win_dist_of_progeny;

        return $this;
    }

    /**
     * Method to set the value of field avg_jump_win_dist_of_progeny
     *
     * @param double $avg_jump_win_dist_of_progeny
     * @return $this
     */
    public function setAvgJumpWinDistOfProgeny($avg_jump_win_dist_of_progeny)
    {
        $this->avg_jump_win_dist_of_progeny = $avg_jump_win_dist_of_progeny;

        return $this;
    }

    /**
     * Method to set the value of field first_season_yn
     *
     * @param string $first_season_yn
     * @return $this
     */
    public function setFirstSeasonYn($first_season_yn)
    {
        $this->first_season_yn = $first_season_yn;

        return $this;
    }

    /**
     * Method to set the value of field no_of_2yo_offspring_runs
     *
     * @param integer $no_of_2yo_offspring_runs
     * @return $this
     */
    public function setNoOf2yoOffspringRuns($no_of_2yo_offspring_runs)
    {
        $this->no_of_2yo_offspring_runs = $no_of_2yo_offspring_runs;

        return $this;
    }

    /**
     * Method to set the value of field no_of_2yo_offspring_wins
     *
     * @param integer $no_of_2yo_offspring_wins
     * @return $this
     */
    public function setNoOf2yoOffspringWins($no_of_2yo_offspring_wins)
    {
        $this->no_of_2yo_offspring_wins = $no_of_2yo_offspring_wins;

        return $this;
    }

    /**
     * Method to set the value of field no_of_offspring_flat_runs
     *
     * @param integer $no_of_offspring_flat_runs
     * @return $this
     */
    public function setNoOfOffspringFlatRuns($no_of_offspring_flat_runs)
    {
        $this->no_of_offspring_flat_runs = $no_of_offspring_flat_runs;

        return $this;
    }

    /**
     * Method to set the value of field no_of_offspring_flat_wins
     *
     * @param integer $no_of_offspring_flat_wins
     * @return $this
     */
    public function setNoOfOffspringFlatWins($no_of_offspring_flat_wins)
    {
        $this->no_of_offspring_flat_wins = $no_of_offspring_flat_wins;

        return $this;
    }

    /**
     * Method to set the value of field no_of_offspring_jump_runs
     *
     * @param integer $no_of_offspring_jump_runs
     * @return $this
     */
    public function setNoOfOffspringJumpRuns($no_of_offspring_jump_runs)
    {
        $this->no_of_offspring_jump_runs = $no_of_offspring_jump_runs;

        return $this;
    }

    /**
     * Method to set the value of field no_of_offspring_jump_wins
     *
     * @param integer $no_of_offspring_jump_wins
     * @return $this
     */
    public function setNoOfOffspringJumpWins($no_of_offspring_jump_wins)
    {
        $this->no_of_offspring_jump_wins = $no_of_offspring_jump_wins;

        return $this;
    }

    /**
     * Method to set the value of field no_of_flat_offsprings
     *
     * @param integer $no_of_flat_offsprings
     * @return $this
     */
    public function setNoOfFlatOffsprings($no_of_flat_offsprings)
    {
        $this->no_of_flat_offsprings = $no_of_flat_offsprings;

        return $this;
    }

    /**
     * Method to set the value of field no_of_jump_offsprings
     *
     * @param integer $no_of_jump_offsprings
     * @return $this
     */
    public function setNoOfJumpOffsprings($no_of_jump_offsprings)
    {
        $this->no_of_jump_offsprings = $no_of_jump_offsprings;

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
     * Method to set the value of field avg_hurdle_win_dist_of_progeny
     *
     * @param double $avg_hurdle_win_dist_of_progeny
     * @return $this
     */
    public function setAvgHurdleWinDistOfProgeny($avg_hurdle_win_dist_of_progeny)
    {
        $this->avg_hurdle_win_dist_of_progeny = $avg_hurdle_win_dist_of_progeny;

        return $this;
    }

    /**
     * Method to set the value of field avg_chase_win_dist_of_progeny
     *
     * @param double $avg_chase_win_dist_of_progeny
     * @return $this
     */
    public function setAvgChaseWinDistOfProgeny($avg_chase_win_dist_of_progeny)
    {
        $this->avg_chase_win_dist_of_progeny = $avg_chase_win_dist_of_progeny;

        return $this;
    }

    /**
     * Method to set the value of field flat_avg_earnings_index
     *
     * @param double $flat_avg_earnings_index
     * @return $this
     */
    public function setFlatAvgEarningsIndex($flat_avg_earnings_index)
    {
        $this->flat_avg_earnings_index = $flat_avg_earnings_index;

        return $this;
    }

    /**
     * Method to set the value of field jump_avg_earnings_index
     *
     * @param double $jump_avg_earnings_index
     * @return $this
     */
    public function setJumpAvgEarningsIndex($jump_avg_earnings_index)
    {
        $this->jump_avg_earnings_index = $jump_avg_earnings_index;

        return $this;
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
     * Returns the value of field avg_flat_win_dist_of_progeny
     *
     * @return double
     */
    public function getAvgFlatWinDistOfProgeny()
    {
        return $this->avg_flat_win_dist_of_progeny;
    }

    /**
     * Returns the value of field avg_jump_win_dist_of_progeny
     *
     * @return double
     */
    public function getAvgJumpWinDistOfProgeny()
    {
        return $this->avg_jump_win_dist_of_progeny;
    }

    /**
     * Returns the value of field first_season_yn
     *
     * @return string
     */
    public function getFirstSeasonYn()
    {
        return $this->first_season_yn;
    }

    /**
     * Returns the value of field no_of_2yo_offspring_runs
     *
     * @return integer
     */
    public function getNoOf2yoOffspringRuns()
    {
        return $this->no_of_2yo_offspring_runs;
    }

    /**
     * Returns the value of field no_of_2yo_offspring_wins
     *
     * @return integer
     */
    public function getNoOf2yoOffspringWins()
    {
        return $this->no_of_2yo_offspring_wins;
    }

    /**
     * Returns the value of field no_of_offspring_flat_runs
     *
     * @return integer
     */
    public function getNoOfOffspringFlatRuns()
    {
        return $this->no_of_offspring_flat_runs;
    }

    /**
     * Returns the value of field no_of_offspring_flat_wins
     *
     * @return integer
     */
    public function getNoOfOffspringFlatWins()
    {
        return $this->no_of_offspring_flat_wins;
    }

    /**
     * Returns the value of field no_of_offspring_jump_runs
     *
     * @return integer
     */
    public function getNoOfOffspringJumpRuns()
    {
        return $this->no_of_offspring_jump_runs;
    }

    /**
     * Returns the value of field no_of_offspring_jump_wins
     *
     * @return integer
     */
    public function getNoOfOffspringJumpWins()
    {
        return $this->no_of_offspring_jump_wins;
    }

    /**
     * Returns the value of field no_of_flat_offsprings
     *
     * @return integer
     */
    public function getNoOfFlatOffsprings()
    {
        return $this->no_of_flat_offsprings;
    }

    /**
     * Returns the value of field no_of_jump_offsprings
     *
     * @return integer
     */
    public function getNoOfJumpOffsprings()
    {
        return $this->no_of_jump_offsprings;
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
     * Returns the value of field avg_hurdle_win_dist_of_progeny
     *
     * @return double
     */
    public function getAvgHurdleWinDistOfProgeny()
    {
        return $this->avg_hurdle_win_dist_of_progeny;
    }

    /**
     * Returns the value of field avg_chase_win_dist_of_progeny
     *
     * @return double
     */
    public function getAvgChaseWinDistOfProgeny()
    {
        return $this->avg_chase_win_dist_of_progeny;
    }

    /**
     * Returns the value of field flat_avg_earnings_index
     *
     * @return double
     */
    public function getFlatAvgEarningsIndex()
    {
        return $this->flat_avg_earnings_index;
    }

    /**
     * Returns the value of field jump_avg_earnings_index
     *
     * @return double
     */
    public function getJumpAvgEarningsIndex()
    {
        return $this->jump_avg_earnings_index;
    }

    /**
     * @return array
     */
    public function metaData()
    {
        return array(

            //Every column in the mapped table
            MetaData::MODELS_ATTRIBUTES => array(
                'sire_uid',
                'avg_flat_win_dist_of_progeny',
                'avg_jump_win_dist_of_progeny',
                'first_season_yn',
                'no_of_2yo_offspring_runs',
                'no_of_2yo_offspring_wins',
                'no_of_offspring_flat_runs',
                'no_of_offspring_flat_wins',
                'no_of_offspring_jump_runs',
                'no_of_offspring_jump_wins',
                'no_of_flat_offsprings',
                'no_of_jump_offsprings',
                'timestamp',
                'avg_hurdle_win_dist_of_progeny',
                'avg_chase_win_dist_of_progeny',
                'flat_avg_earnings_index',
                'jump_avg_earnings_index',
            ),

            //Every column part of the primary key
            MetaData::MODELS_PRIMARY_KEY => array(
                'sire_uid',
            ),

            //Every column that isn't part of the primary key
            MetaData::MODELS_NON_PRIMARY_KEY => array(
                'avg_flat_win_dist_of_progeny',
                'avg_jump_win_dist_of_progeny',
                'first_season_yn',
                'no_of_2yo_offspring_runs',
                'no_of_2yo_offspring_wins',
                'no_of_offspring_flat_runs',
                'no_of_offspring_flat_wins',
                'no_of_offspring_jump_runs',
                'no_of_offspring_jump_wins',
                'no_of_flat_offsprings',
                'no_of_jump_offsprings',
                'timestamp',
                'avg_hurdle_win_dist_of_progeny',
                'avg_chase_win_dist_of_progeny',
                'flat_avg_earnings_index',
                'jump_avg_earnings_index',
            ),

            //Every column that doesn't allows null values
            MetaData::MODELS_NOT_NULL => array(
                'avg_flat_win_dist_of_progeny',
                'avg_jump_win_dist_of_progeny',
                'no_of_2yo_offspring_runs',
                'no_of_2yo_offspring_wins',
                'no_of_offspring_flat_runs',
                'no_of_offspring_flat_wins',
                'no_of_offspring_jump_runs',
                'no_of_offspring_jump_wins',
                'no_of_flat_offsprings',
                'no_of_jump_offsprings',
                'avg_hurdle_win_dist_of_progeny',
                'avg_chase_win_dist_of_progeny',
                'flat_avg_earnings_index',
                'jump_avg_earnings_index',
            ),

            //Every column and their data types
            MetaData::MODELS_DATA_TYPES => array(
                'sire_uid' => Column::TYPE_INTEGER,
                'avg_flat_win_dist_of_progeny' => Column::TYPE_DECIMAL,
                'avg_jump_win_dist_of_progeny' => Column::TYPE_DECIMAL,
                'first_season_yn' => Column::TYPE_CHAR,
                'no_of_2yo_offspring_runs' => Column::TYPE_INTEGER,
                'no_of_2yo_offspring_wins' => Column::TYPE_INTEGER,
                'no_of_offspring_flat_runs' => Column::TYPE_INTEGER,
                'no_of_offspring_flat_wins' => Column::TYPE_INTEGER,
                'no_of_offspring_jump_runs' => Column::TYPE_INTEGER,
                'no_of_offspring_jump_wins' => Column::TYPE_INTEGER,
                'no_of_flat_offsprings' => Column::TYPE_INTEGER,
                'no_of_jump_offsprings' => Column::TYPE_INTEGER,
                'timestamp' => Column::TYPE_DATE,
                'avg_hurdle_win_dist_of_progeny' => Column::TYPE_DECIMAL,
                'avg_chase_win_dist_of_progeny' => Column::TYPE_DECIMAL,
                'flat_avg_earnings_index' => Column::TYPE_DECIMAL,
                'jump_avg_earnings_index' => Column::TYPE_DECIMAL,
            ),

            //The columns that have numeric data types
            MetaData::MODELS_DATA_TYPES_NUMERIC => array(
                'sire_uid' => true,
                'avg_flat_win_dist_of_progeny' => true,
                'avg_jump_win_dist_of_progeny' => true,
                'first_season_yn' => false,
                'no_of_2yo_offspring_runs' => true,
                'no_of_2yo_offspring_wins' => true,
                'no_of_offspring_flat_runs' => true,
                'no_of_offspring_flat_wins' => true,
                'no_of_offspring_jump_runs' => true,
                'no_of_offspring_jump_wins' => true,
                'no_of_flat_offsprings' => true,
                'no_of_jump_offsprings' => true,
                'timestamp' => false,
                'avg_hurdle_win_dist_of_progeny' => true,
                'avg_chase_win_dist_of_progeny' => true,
                'flat_avg_earnings_index' => true,
                'jump_avg_earnings_index' => true,
            ),

            //How every column must be bound/casted
            MetaData::MODELS_DATA_TYPES_BIND => array(
                'sire_uid' => Column::BIND_PARAM_INT,
                'avg_flat_win_dist_of_progeny' => Column::BIND_PARAM_DECIMAL,
                'avg_jump_win_dist_of_progeny' => Column::BIND_PARAM_DECIMAL,
                'first_season_yn' => Column::BIND_PARAM_STR,
                'no_of_2yo_offspring_runs' => Column::BIND_PARAM_INT,
                'no_of_2yo_offspring_wins' => Column::BIND_PARAM_INT,
                'no_of_offspring_flat_runs' => Column::BIND_PARAM_INT,
                'no_of_offspring_flat_wins' => Column::BIND_PARAM_INT,
                'no_of_offspring_jump_runs' => Column::BIND_PARAM_INT,
                'no_of_offspring_jump_wins' => Column::BIND_PARAM_INT,
                'no_of_flat_offsprings' => Column::BIND_PARAM_INT,
                'no_of_jump_offsprings' => Column::BIND_PARAM_INT,
                'timestamp' => Column::BIND_PARAM_STR,
                'avg_hurdle_win_dist_of_progeny' => Column::BIND_PARAM_DECIMAL,
                'avg_chase_win_dist_of_progeny' => Column::BIND_PARAM_DECIMAL,
                'flat_avg_earnings_index' => Column::BIND_PARAM_DECIMAL,
                'jump_avg_earnings_index' => Column::BIND_PARAM_DECIMAL,
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
