<?php

namespace Models;

class Jockey extends \Phalcon\Mvc\Model
{
    /**
     *
     * @var integer
     */
    protected $jockey_uid;

    /**
     *
     * @var string
     */
    protected $flat_jockey_type_code;

    /**
     *
     * @var string
     */
    protected $jump_jockey_type_code;

    /**
     *
     * @var string
     */
    protected $search_name;

    /**
     *
     * @var string
     */
    protected $ptp_type_code;

    /**
     *
     * @var string
     */
    protected $jockey_name;

    /**
     *
     * @var string
     */
    protected $jockey_start_career_date;

    /**
     *
     * @var float
     */
    protected $jockey_weight;

    /**
     *
     * @var float
     */
    protected $jockey_height;

    /**
     *
     * @var integer
     */
    protected $no_of_winners;

    /**
     *
     * @var integer
     */
    protected $no_of_best_wins;

    /**
     *
     * @var integer
     */
    protected $no_of_jump_champion;

    /**
     *
     * @var integer
     */
    protected $no_of_flat_champion;

    /**
     *
     * @var integer
     */
    protected $jockey_allowance_lbs;

    /**
     *
     * @var string
     */
    protected $jockey_sex;

    /**
     *
     * @var integer
     */
    protected $source_uid;

    /**
     *
     * @var integer
     */
    protected $longest_flat_losing_seq;

    /**
     *
     * @var integer
     */
    protected $longest_flat_winning_seq;

    /**
     *
     * @var integer
     */
    protected $present_flat_losing_seq;

    /**
     *
     * @var integer
     */
    protected $present_flat_winning_seq;

    /**
     *
     * @var integer
     */
    protected $longest_jump_losing_seq;

    /**
     *
     * @var integer
     */
    protected $longest_jump_winning_seq;

    /**
     *
     * @var integer
     */
    protected $present_jump_losing_seq;

    /**
     *
     * @var integer
     */
    protected $present_jump_winning_seq;

    /**
     *
     * @var integer
     */
    protected $address_uid;

    /**
     *
     * @var string
     */
    protected $timestamp;

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
}
