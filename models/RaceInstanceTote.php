<?php

namespace Models;

use Phalcon\Mvc\Model;
use Phalcon\Db\Column;
use Phalcon\Mvc\Model\MetaData;

class RaceInstanceTote extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $race_instance_uid;

    /**
     *
     * @var string
     */
    protected $tote_currency_code;

    /**
     *
     * @var double
     */
    protected $computer_strght_frcst_money;

    /**
     *
     * @var double
     */
    protected $tricast_money;

    /**
     *
     * @var double
     */
    protected $tote_win_money;

    /**
     *
     * @var double
     */
    protected $tote_dual_forecast_money;

    /**
     *
     * @var double
     */
    protected $tote_place_1_money;

    /**
     *
     * @var double
     */
    protected $tote_place_2_money;

    /**
     *
     * @var double
     */
    protected $tote_place_3_money;

    /**
     *
     * @var double
     */
    protected $tote_place_4_money;

    /**
     *
     * @var double
     */
    protected $tote_trio_money;

    /**
     *
     * @var string
     */
    protected $trio_text;

    /**
     *
     * @var string
     */
    protected $tote_deadheat_text;

    /**
     *
     * @var string
     */
    protected $rule4_text;

    /**
     *
     * @var string
     */
    protected $selling_details_text;

    /**
     *
     * @var double
     */
    protected $rule4_value;

    /**
     *
     * @var string
     */
    protected $subscription_list;

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
     * Method to set the value of field tote_currency_code
     *
     * @param string $tote_currency_code
     *
     * @return $this
     */
    public function setToteCurrencyCode($tote_currency_code)
    {
        $this->tote_currency_code = $tote_currency_code;

        return $this;
    }

    /**
     * Method to set the value of field computer_strght_frcst_money
     *
     * @param double $computer_strght_frcst_money
     *
     * @return $this
     */
    public function setComputerStrghtFrcstMoney($computer_strght_frcst_money)
    {
        $this->computer_strght_frcst_money = $computer_strght_frcst_money;

        return $this;
    }

    /**
     * Method to set the value of field tricast_money
     *
     * @param double $tricast_money
     *
     * @return $this
     */
    public function setTricastMoney($tricast_money)
    {
        $this->tricast_money = $tricast_money;

        return $this;
    }

    /**
     * Method to set the value of field tote_win_money
     *
     * @param double $tote_win_money
     *
     * @return $this
     */
    public function setToteWinMoney($tote_win_money)
    {
        $this->tote_win_money = $tote_win_money;

        return $this;
    }

    /**
     * Method to set the value of field tote_dual_forecast_money
     *
     * @param double $tote_dual_forecast_money
     *
     * @return $this
     */
    public function setToteDualForecastMoney($tote_dual_forecast_money)
    {
        $this->tote_dual_forecast_money = $tote_dual_forecast_money;

        return $this;
    }

    /**
     * Method to set the value of field tote_place_1_money
     *
     * @param double $tote_place_1_money
     *
     * @return $this
     */
    public function setTotePlace1Money($tote_place_1_money)
    {
        $this->tote_place_1_money = $tote_place_1_money;

        return $this;
    }

    /**
     * Method to set the value of field tote_place_2_money
     *
     * @param double $tote_place_2_money
     *
     * @return $this
     */
    public function setTotePlace2Money($tote_place_2_money)
    {
        $this->tote_place_2_money = $tote_place_2_money;

        return $this;
    }

    /**
     * Method to set the value of field tote_place_3_money
     *
     * @param double $tote_place_3_money
     *
     * @return $this
     */
    public function setTotePlace3Money($tote_place_3_money)
    {
        $this->tote_place_3_money = $tote_place_3_money;

        return $this;
    }

    /**
     * Method to set the value of field tote_place_4_money
     *
     * @param double $tote_place_4_money
     *
     * @return $this
     */
    public function setTotePlace4Money($tote_place_4_money)
    {
        $this->tote_place_4_money = $tote_place_4_money;

        return $this;
    }

    /**
     * Method to set the value of field tote_trio_money
     *
     * @param double $tote_trio_money
     *
     * @return $this
     */
    public function setToteTrioMoney($tote_trio_money)
    {
        $this->tote_trio_money = $tote_trio_money;

        return $this;
    }

    /**
     * Method to set the value of field trio_text
     *
     * @param string $trio_text
     *
     * @return $this
     */
    public function setTrioText($trio_text)
    {
        $this->trio_text = $trio_text;

        return $this;
    }

    /**
     * Method to set the value of field tote_deadheat_text
     *
     * @param string $tote_deadheat_text
     *
     * @return $this
     */
    public function setToteDeadheatText($tote_deadheat_text)
    {
        $this->tote_deadheat_text = $tote_deadheat_text;

        return $this;
    }

    /**
     * Method to set the value of field rule4_text
     *
     * @param string $rule4_text
     *
     * @return $this
     */
    public function setRule4Text($rule4_text)
    {
        $this->rule4_text = $rule4_text;

        return $this;
    }

    /**
     * Method to set the value of field selling_details_text
     *
     * @param string $selling_details_text
     *
     * @return $this
     */
    public function setSellingDetailsText($selling_details_text)
    {
        $this->selling_details_text = $selling_details_text;

        return $this;
    }

    /**
     * Method to set the value of field rule4_value
     *
     * @param double $rule4_value
     *
     * @return $this
     */
    public function setRule4Value($rule4_value)
    {
        $this->rule4_value = $rule4_value;

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
     * Returns the value of field race_instance_uid
     *
     * @return integer
     */
    public function getRaceInstanceUid()
    {
        return $this->race_instance_uid;
    }

    /**
     * Returns the value of field tote_currency_code
     *
     * @return string
     */
    public function getToteCurrencyCode()
    {
        return $this->tote_currency_code;
    }

    /**
     * Returns the value of field computer_strght_frcst_money
     *
     * @return double
     */
    public function getComputerStrghtFrcstMoney()
    {
        return $this->computer_strght_frcst_money;
    }

    /**
     * Returns the value of field tricast_money
     *
     * @return double
     */
    public function getTricastMoney()
    {
        return $this->tricast_money;
    }

    /**
     * Returns the value of field tote_win_money
     *
     * @return double
     */
    public function getToteWinMoney()
    {
        return $this->tote_win_money;
    }

    /**
     * Returns the value of field tote_dual_forecast_money
     *
     * @return double
     */
    public function getToteDualForecastMoney()
    {
        return $this->tote_dual_forecast_money;
    }

    /**
     * Returns the value of field tote_place_1_money
     *
     * @return double
     */
    public function getTotePlace1Money()
    {
        return $this->tote_place_1_money;
    }

    /**
     * Returns the value of field tote_place_2_money
     *
     * @return double
     */
    public function getTotePlace2Money()
    {
        return $this->tote_place_2_money;
    }

    /**
     * Returns the value of field tote_place_3_money
     *
     * @return double
     */
    public function getTotePlace3Money()
    {
        return $this->tote_place_3_money;
    }

    /**
     * Returns the value of field tote_place_4_money
     *
     * @return double
     */
    public function getTotePlace4Money()
    {
        return $this->tote_place_4_money;
    }

    /**
     * Returns the value of field tote_trio_money
     *
     * @return double
     */
    public function getToteTrioMoney()
    {
        return $this->tote_trio_money;
    }

    /**
     * Returns the value of field trio_text
     *
     * @return string
     */
    public function getTrioText()
    {
        return $this->trio_text;
    }

    /**
     * Returns the value of field tote_deadheat_text
     *
     * @return string
     */
    public function getToteDeadheatText()
    {
        return $this->tote_deadheat_text;
    }

    /**
     * Returns the value of field rule4_text
     *
     * @return string
     */
    public function getRule4Text()
    {
        return $this->rule4_text;
    }

    /**
     * Returns the value of field selling_details_text
     *
     * @return string
     */
    public function getSellingDetailsText()
    {
        return $this->selling_details_text;
    }

    /**
     * Returns the value of field rule4_value
     *
     * @return double
     */
    public function getRule4Value()
    {
        return $this->rule4_value;
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

    public function getSource()
    {
        return 'race_instance_tote';
    }

    /**
     * @return array
     */
    public function metaData()
    {
        return array(

            //Every column in the mapped table
            MetaData::MODELS_ATTRIBUTES => array(
                'race_instance_uid',
                'tote_currency_code',
                'computer_strght_frcst_money',
                'tricast_money',
                'tote_win_money',
                'tote_dual_forecast_money',
                'tote_place_1_money',
                'tote_place_2_money',
                'tote_place_3_money',
                'tote_place_4_money',
                'tote_trio_money',
                'trio_text',
                'tote_deadheat_text',
                'rule4_text',
                'selling_details_text',
                'rule4_value',
                'subscription_list',
            ),
            //Every column part of the primary key
            MetaData::MODELS_PRIMARY_KEY => array(
                'race_instance_uid',
            ),
            //Every column that isn't part of the primary key
            MetaData::MODELS_NON_PRIMARY_KEY => array(
                'tote_currency_code',
                'computer_strght_frcst_money',
                'tricast_money',
                'tote_win_money',
                'tote_dual_forecast_money',
                'tote_place_1_money',
                'tote_place_2_money',
                'tote_place_3_money',
                'tote_place_4_money',
                'tote_trio_money',
                'trio_text',
                'tote_deadheat_text',
                'rule4_text',
                'selling_details_text',
                'rule4_value',
                'subscription_list',
            ),
            //Every column that doesn't allows null values
            MetaData::MODELS_NOT_NULL => array(
                'tote_currency_code',
                'computer_strght_frcst_money',
                'tricast_money',
                'tote_win_money',
                'tote_dual_forecast_money',
                'tote_place_1_money',
                'tote_place_2_money',
                'tote_place_3_money',
                'tote_place_4_money',
                'tote_trio_money',
                'trio_text',
                'tote_deadheat_text',
                'rule4_text',
                'selling_details_text',
                'rule4_value',
                'subscription_list',
            ),
            //Every column and their data types
            MetaData::MODELS_DATA_TYPES => array(
                'race_instance_uid' => Column::TYPE_INTEGER,
                'tote_currency_code' => Column::TYPE_CHAR,
                'computer_strght_frcst_money' => Column::TYPE_DECIMAL,
                'tricast_money' => Column::TYPE_DECIMAL,
                'tote_win_money' => Column::TYPE_DECIMAL,
                'tote_dual_forecast_money' => Column::TYPE_DECIMAL,
                'tote_place_1_money' => Column::TYPE_DECIMAL,
                'tote_place_2_money' => Column::TYPE_DECIMAL,
                'tote_place_3_money' => Column::TYPE_DECIMAL,
                'tote_place_4_money' => Column::TYPE_DECIMAL,
                'tote_trio_money' => Column::TYPE_DECIMAL,
                'trio_text' => Column::TYPE_VARCHAR,
                'tote_deadheat_text' => Column::TYPE_VARCHAR,
                'rule4_text' => Column::TYPE_VARCHAR,
                'selling_details_text' => Column::TYPE_VARCHAR,
                'rule4_value' => Column::TYPE_FLOAT,
                'subscription_list' => Column::TYPE_VARCHAR,
            ),
            //The columns that have numeric data types
            MetaData::MODELS_DATA_TYPES_NUMERIC => array(
                'race_instance_uid' => true,
                'tote_currency_code' => false,
                'computer_strght_frcst_money' => true,
                'tricast_money' => true,
                'tote_win_money' => true,
                'tote_dual_forecast_money' => true,
                'tote_place_1_money' => true,
                'tote_place_2_money' => true,
                'tote_place_3_money' => true,
                'tote_place_4_money' => true,
                'tote_trio_money' => true,
                'trio_text' => false,
                'tote_deadheat_text' => false,
                'rule4_text' => false,
                'selling_details_text' => false,
                'rule4_value' => true,
                'subscription_list' => false,
            ),
            //How every column must be bound/casted
            MetaData::MODELS_DATA_TYPES_BIND => array(
                'race_instance_uid' => Column::BIND_PARAM_INT,
                'tote_currency_code' => Column::BIND_PARAM_STR,
                'computer_strght_frcst_money' => Column::BIND_PARAM_DECIMAL,
                'tricast_money' => Column::BIND_PARAM_DECIMAL,
                'tote_win_money' => Column::BIND_PARAM_DECIMAL,
                'tote_dual_forecast_money' => Column::BIND_PARAM_DECIMAL,
                'tote_place_1_money' => Column::BIND_PARAM_DECIMAL,
                'tote_place_2_money' => Column::BIND_PARAM_DECIMAL,
                'tote_place_3_money' => Column::BIND_PARAM_DECIMAL,
                'tote_place_4_money' => Column::BIND_PARAM_DECIMAL,
                'tote_trio_money' => Column::BIND_PARAM_DECIMAL,
                'trio_text' => Column::BIND_PARAM_STR,
                'tote_deadheat_text' => Column::BIND_PARAM_STR,
                'rule4_text' => Column::BIND_PARAM_STR,
                'selling_details_text' => Column::BIND_PARAM_STR,
                'rule4_value' => Column::BIND_PARAM_DECIMAL,
                'subscription_list' => Column::BIND_PARAM_STR,
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
