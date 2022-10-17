<?php

namespace Models;

use Phalcon\Db\Column;
use Phalcon\Mvc\Model\MetaData;
use \Api\Constants\Horses as Constants;

/**
 * Class RaceInstancePrize
 *
 * @package Models
 */
class RaceInstancePrize extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $race_instance_uid;

    /**
     *
     * @var integer
     */
    protected $position_no;

    /**
     *
     * @var double
     */
    protected $prize_sterling;

    /**
     *
     * @var string
     */
    protected $subscription_list;

    /**
     *
     * @var double
     */
    protected $prize_euro;

    /**
     *
     * @var double
     */
    protected $prize_euro_gross;

    /**
     * Method to set the value of field race_instance_uid
     *
     * @param integer $race_instance_uid
     *
     * @return $this
     */
    public function setRaceInstanceUid($race_instance_uid)
    {
        $this->race_instance_uid = $race_instance_uid;

        return $this;
    }

    /**
     * Method to set the value of field position_no
     *
     * @param integer $position_no
     *
     * @return $this
     */
    public function setPositionNo($position_no)
    {
        $this->position_no = $position_no;

        return $this;
    }

    /**
     * Method to set the value of field prize_sterling
     *
     * @param double $prize_sterling
     *
     * @return $this
     */
    public function setPrizeSterling($prize_sterling)
    {
        $this->prize_sterling = $prize_sterling;

        return $this;
    }

    /**
     * Method to set the value of field subscription_list
     *
     * @param string $subscription_list
     *
     * @return $this
     */
    public function setSubscriptionList($subscription_list)
    {
        $this->subscription_list = $subscription_list;

        return $this;
    }

    /**
     * Method to set the value of field prize_euro
     *
     * @param double $prize_euro
     *
     * @return $this
     */
    public function setPrizeEuro($prize_euro)
    {
        $this->prize_euro = $prize_euro;

        return $this;
    }

    /**
     * Method to set the value of field prize_euro_gross
     *
     * @param double $prize_euro_gross
     *
     * @return $this
     */
    public function setPrizeEuroGross($prize_euro_gross)
    {
        $this->prize_euro_gross = $prize_euro_gross;

        return $this;
    }

    /**
     * Returns the value of field race_instance_uid
     *
     * @return integer
     */
    public function getRaceInstanceUid()
    {
        return $this->race_instance_uid;
    }

    /**
     * Returns the value of field position_no
     *
     * @return integer
     */
    public function getPositionNo()
    {
        return $this->position_no;
    }

    /**
     * Returns the value of field prize_sterling
     *
     * @return double
     */
    public function getPrizeSterling()
    {
        return $this->prize_sterling;
    }

    /**
     * Returns the value of field subscription_list
     *
     * @return string
     */
    public function getSubscriptionList()
    {
        return $this->subscription_list;
    }

    /**
     * Returns the value of field prize_euro
     *
     * @return double
     */
    public function getPrizeEuro()
    {
        return $this->prize_euro;
    }

    /**
     * Returns the value of field prize_euro_gross
     *
     * @return double
     */
    public function getPrizeEuroGross()
    {
        return $this->prize_euro_gross;
    }

    /**
     * @param int    $raceId
     * @param string $raceDateTime
     *
     * @return array
     */
    public function getForRaceInstanceId($raceId, $raceDateTime)
    {
        $sql = "
            SELECT
                position_no
                , prize_sterling = ROUND(prize_sterling, 2)
                , prize_euro = ROUND(prize_euro, 2)
                , prize_usd = ROUND(prize_sterling * (
                    SELECT
                        MIN(cc.exchange_rate)
                    FROM country_currencies cc
                    WHERE
                        cc.year = YEAR(:raceDate)
                        AND cc.cur_uid = " . Constants::CURRENCY_USD_ID . "
                    ), 2)
            FROM
                race_instance_prize
            WHERE
                race_instance_uid = :raceId
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'raceId' => $raceId,
                'raceDate' => $raceDateTime
            ]
        );

        $prizes = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );

        return $prizes->toArrayWithRows();
    }
}
