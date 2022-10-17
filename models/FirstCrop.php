<?php
namespace Models;

use Phalcon\Mvc\Model;
use Phalcon\Db\Column;
use Phalcon\Mvc\Model\MetaData;

class FirstCrop extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $horse_uid;

    /**
     *
     * @var integer
     */
    protected $season;

    /**
     *
     * @var string
     */
    protected $category;

    /**
     *
     * @var integer
     */
    protected $no_of_wins;

    /**
     *
     * @var integer
     */
    protected $no_of_runs;

    /**
     *
     * @var integer
     */
    protected $no_of_2nds;

    /**
     *
     * @var integer
     */
    protected $no_of_3rds;

    /**
     *
     * @var integer
     */
    protected $no_of_4ths;

    /**
     *
     * @var double
     */
    protected $win_prize_money;

    /**
     *
     * @var double
     */
    protected $total_prize_money;

    /**
     *
     * @var integer
     */
    protected $no_of_runners;

    /**
     *
     * @var integer
     */
    protected $no_of_winners;

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
     * Method to set the value of field season
     *
     * @param integer $season
     *
     * @return $this
     */
    public function setSeason($season)
    {
        $this->season = $season;

        return $this;
    }

    /**
     * Method to set the value of field category
     *
     * @param string $category
     *
     * @return $this
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Method to set the value of field no_of_wins
     *
     * @param integer $no_of_wins
     *
     * @return $this
     */
    public function setNoOfWins($no_of_wins)
    {
        $this->no_of_wins = $no_of_wins;

        return $this;
    }

    /**
     * Method to set the value of field no_of_runs
     *
     * @param integer $no_of_runs
     *
     * @return $this
     */
    public function setNoOfRuns($no_of_runs)
    {
        $this->no_of_runs = $no_of_runs;

        return $this;
    }

    /**
     * Method to set the value of field no_of_2nds
     *
     * @param integer $no_of_2nds
     *
     * @return $this
     */
    public function setNoOf2nds($no_of_2nds)
    {
        $this->no_of_2nds = $no_of_2nds;

        return $this;
    }

    /**
     * Method to set the value of field no_of_3rds
     *
     * @param integer $no_of_3rds
     *
     * @return $this
     */
    public function setNoOf3rds($no_of_3rds)
    {
        $this->no_of_3rds = $no_of_3rds;

        return $this;
    }

    /**
     * Method to set the value of field no_of_4ths
     *
     * @param integer $no_of_4ths
     *
     * @return $this
     */
    public function setNoOf4ths($no_of_4ths)
    {
        $this->no_of_4ths = $no_of_4ths;

        return $this;
    }

    /**
     * Method to set the value of field win_prize_money
     *
     * @param double $win_prize_money
     *
     * @return $this
     */
    public function setWinPrizeMoney($win_prize_money)
    {
        $this->win_prize_money = $win_prize_money;

        return $this;
    }

    /**
     * Method to set the value of field total_prize_money
     *
     * @param double $total_prize_money
     *
     * @return $this
     */
    public function setTotalPrizeMoney($total_prize_money)
    {
        $this->total_prize_money = $total_prize_money;

        return $this;
    }

    /**
     * Method to set the value of field no_of_runners
     *
     * @param integer $no_of_runners
     *
     * @return $this
     */
    public function setNoOfRunners($no_of_runners)
    {
        $this->no_of_runners = $no_of_runners;

        return $this;
    }

    /**
     * Method to set the value of field no_of_winners
     *
     * @param integer $no_of_winners
     *
     * @return $this
     */
    public function setNoOfWinners($no_of_winners)
    {
        $this->no_of_winners = $no_of_winners;

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
     * Returns the value of field season
     *
     * @return integer
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * Returns the value of field category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Returns the value of field no_of_wins
     *
     * @return integer
     */
    public function getNoOfWins()
    {
        return $this->no_of_wins;
    }

    /**
     * Returns the value of field no_of_runs
     *
     * @return integer
     */
    public function getNoOfRuns()
    {
        return $this->no_of_runs;
    }

    /**
     * Returns the value of field no_of_2nds
     *
     * @return integer
     */
    public function getNoOf2nds()
    {
        return $this->no_of_2nds;
    }

    /**
     * Returns the value of field no_of_3rds
     *
     * @return integer
     */
    public function getNoOf3rds()
    {
        return $this->no_of_3rds;
    }

    /**
     * Returns the value of field no_of_4ths
     *
     * @return integer
     */
    public function getNoOf4ths()
    {
        return $this->no_of_4ths;
    }

    /**
     * Returns the value of field win_prize_money
     *
     * @return double
     */
    public function getWinPrizeMoney()
    {
        return $this->win_prize_money;
    }

    /**
     * Returns the value of field total_prize_money
     *
     * @return double
     */
    public function getTotalPrizeMoney()
    {
        return $this->total_prize_money;
    }

    /**
     * Returns the value of field no_of_runners
     *
     * @return integer
     */
    public function getNoOfRunners()
    {
        return $this->no_of_runners;
    }

    /**
     * Returns the value of field no_of_winners
     *
     * @return integer
     */
    public function getNoOfWinners()
    {
        return $this->no_of_winners;
    }

    public function getSource()
    {
        return 'firstCrop';
    }

    /**
     * @return array
     */
    public function metaData()
    {
        return array(

            //Every column in the mapped table
            MetaData::MODELS_ATTRIBUTES => array(
                'horse_uid',
                'season',
                'category',
                'no_of_wins',
                'no_of_runs',
                'no_of_2nds',
                'no_of_3rds',
                'no_of_4ths',
                'win_prize_money',
                'total_prize_money',
                'no_of_runners',
                'no_of_winners',
            ),
            //Every column part of the primary key
            MetaData::MODELS_PRIMARY_KEY => array(
                'horse_uid',
                'season',
                'category',
            ),
            //Every column that isn't part of the primary key
            MetaData::MODELS_NON_PRIMARY_KEY => array(
                'no_of_wins',
                'no_of_runs',
                'no_of_2nds',
                'no_of_3rds',
                'no_of_4ths',
                'win_prize_money',
                'total_prize_money',
                'no_of_runners',
                'no_of_winners',
            ),
            //Every column that doesn't allows null values
            MetaData::MODELS_NOT_NULL => array(
                'no_of_wins',
                'no_of_runs',
                'no_of_2nds',
                'no_of_3rds',
                'no_of_4ths',
                'win_prize_money',
                'total_prize_money',
                'no_of_runners',
                'no_of_winners',
            ),
            //Every column and their data types
            MetaData::MODELS_DATA_TYPES => array(
                'horse_uid' => Column::TYPE_INTEGER,
                'season' => Column::TYPE_INTEGER,
                'category' => Column::TYPE_VARCHAR,
                'no_of_wins' => Column::TYPE_INTEGER,
                'no_of_runs' => Column::TYPE_INTEGER,
                'no_of_2nds' => Column::TYPE_INTEGER,
                'no_of_3rds' => Column::TYPE_INTEGER,
                'no_of_4ths' => Column::TYPE_INTEGER,
                'win_prize_money' => Column::TYPE_DECIMAL,
                'total_prize_money' => Column::TYPE_DECIMAL,
                'no_of_runners' => Column::TYPE_INTEGER,
                'no_of_winners' => Column::TYPE_INTEGER,
            ),
            //The columns that have numeric data types
            MetaData::MODELS_DATA_TYPES_NUMERIC => array(
                'horse_uid' => true,
                'season' => true,
                'category' => false,
                'no_of_wins' => true,
                'no_of_runs' => true,
                'no_of_2nds' => true,
                'no_of_3rds' => true,
                'no_of_4ths' => true,
                'win_prize_money' => true,
                'total_prize_money' => true,
                'no_of_runners' => true,
                'no_of_winners' => true,
            ),
            //How every column must be bound/casted
            MetaData::MODELS_DATA_TYPES_BIND => array(
                'horse_uid' => Column::BIND_PARAM_INT,
                'season' => Column::BIND_PARAM_INT,
                'category' => Column::BIND_PARAM_STR,
                'no_of_wins' => Column::BIND_PARAM_INT,
                'no_of_runs' => Column::BIND_PARAM_INT,
                'no_of_2nds' => Column::BIND_PARAM_INT,
                'no_of_3rds' => Column::BIND_PARAM_INT,
                'no_of_4ths' => Column::BIND_PARAM_INT,
                'win_prize_money' => Column::BIND_PARAM_DECIMAL,
                'total_prize_money' => Column::BIND_PARAM_DECIMAL,
                'no_of_runners' => Column::BIND_PARAM_INT,
                'no_of_winners' => Column::BIND_PARAM_INT,
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
