<?php

namespace Models;

use Phalcon\Mvc\Model;

class RacingHorse extends \Phalcon\Mvc\Model
{
    /**
     *
     * @var integer
     */
    protected $horse_uid;

    /**
     *
     * @var string
     */
    protected $horse_yearling_cur_code;

    /**
     *
     * @var float
     */
    protected $horse_yearling_price;

    /**
     *
     * @var integer
     */
    protected $horse_type_uid;

    /**
     *
     * @var string
     */
    protected $curr_form_rating_chase_chars;

    /**
     *
     * @var string
     */
    protected $curr_form_rating_hurdle_chars;

    /**
     *
     * @var string
     */
    protected $curr_stopwatch_going_aw;

    /**
     *
     * @var string
     */
    protected $curr_stopwatch_going_chase;

    /**
     *
     * @var string
     */
    protected $curr_stopwatch_going_hurdle;

    /**
     *
     * @var string
     */
    protected $curr_stopwatch_going_turf;

    /**
     *
     * @var integer
     */
    protected $curr_stopwatch_rating_aw;

    /**
     *
     * @var integer
     */
    protected $curr_stopwatch_rating_chase;

    /**
     *
     * @var integer
     */
    protected $curr_stopwatch_rating_hurdle;

    /**
     *
     * @var integer
     */
    protected $curr_stopwatch_rating_turf;

    /**
     *
     * @var integer
     */
    protected $current_form_rating;

    /**
     *
     * @var string
     */
    protected $current_form_rating_chars;

    /**
     *
     * @var integer
     */
    protected $current_form_rating_chase;

    /**
     *
     * @var integer
     */
    protected $current_form_rating_hurdle;

    /**
     *
     * @var integer
     */
    protected $current_official_aw_rating;

    /**
     *
     * @var integer
     */
    protected $current_official_rating_chase;

    /**
     *
     * @var integer
     */
    protected $current_official_rating_hurdle;

    /**
     *
     * @var integer
     */
    protected $current_official_turf_rating;

    /**
     *
     * @var integer
     */
    protected $best_form_rating;

    /**
     *
     * @var string
     */
    protected $best_form_rating_chars;

    /**
     *
     * @var integer
     */
    protected $best_form_rating_chase;

    /**
     *
     * @var string
     */
    protected $best_form_rating_chase_chars;

    /**
     *
     * @var integer
     */
    protected $best_form_rating_hurdle;

    /**
     *
     * @var string
     */
    protected $best_form_rating_hurdle_chars;

    /**
     *
     * @var string
     */
    protected $best_stopwatch_going_aw;

    /**
     *
     * @var string
     */
    protected $best_stopwatch_going_chase;

    /**
     *
     * @var string
     */
    protected $best_stopwatch_going_hurdle;

    /**
     *
     * @var string
     */
    protected $best_stopwatch_going_turf;

    /**
     *
     * @var integer
     */
    protected $best_stopwatch_rating_aw;

    /**
     *
     * @var integer
     */
    protected $best_stopwatch_rating_chase;

    /**
     *
     * @var integer
     */
    protected $best_stopwatch_rating_hurdle;

    /**
     *
     * @var integer
     */
    protected $best_stopwatch_rating_turf;

    /**
     *
     * @var integer
     */
    protected $ls_form_rating;

    /**
     *
     * @var string
     */
    protected $ls_form_rating_chars;

    /**
     *
     * @var integer
     */
    protected $ls_form_rating_chase;

    /**
     *
     * @var string
     */
    protected $ls_form_rating_chase_chars;

    /**
     *
     * @var integer
     */
    protected $ls_form_rating_hurdle;

    /**
     *
     * @var string
     */
    protected $ls_form_rating_hurdle_chars;

    /**
     *
     * @var string
     */
    protected $ls_stopwatch_going_aw;

    /**
     *
     * @var string
     */
    protected $ls_stopwatch_going_chase;

    /**
     *
     * @var string
     */
    protected $ls_stopwatch_going_hurdle;

    /**
     *
     * @var string
     */
    protected $ls_stopwatch_going_turf;

    /**
     *
     * @var integer
     */
    protected $ls_stopwatch_rating_aw;

    /**
     *
     * @var integer
     */
    protected $ls_stopwatch_rating_chase;

    /**
     *
     * @var integer
     */
    protected $ls_stopwatch_rating_hurdle;

    /**
     *
     * @var integer
     */
    protected $ls_stopwatch_rating_turf;

    /**
     *
     * @var integer
     */
    protected $ls_official_aw_rating;

    /**
     *
     * @var integer
     */
    protected $ls_official_rating_chase;

    /**
     *
     * @var integer
     */
    protected $ls_official_rating_hurdle;

    /**
     *
     * @var integer
     */
    protected $ls_official_turf_rating;

    /**
     *
     * @var string
     */
    protected $timestamp;

    /**
     *
     * @var integer
     */
    protected $ptp_overall_rating;

    /**
     *
     * @var integer
     */
    protected $mark_your_card;

    /**
     *
     * @var integer
     */
    protected $ahead_of_handicapper;

    /**
     *
     * @var integer
     */
    protected $the_word;

    /**
     *
     * @var integer
     */
    protected $ten_to_follow;

    /**
     *
     * @var integer
     */
    protected $curr_off_aw_rating_ire;

    /**
     *
     * @var integer
     */
    protected $curr_off_rating_chase_ire;

    /**
     *
     * @var integer
     */
    protected $curr_off_rating_hurdle_ire;

    /**
     *
     * @var integer
     */
    protected $curr_off_turf_rating_ire;

    /**
     *
     * @var integer
     */
    protected $ls_off_aw_rating_ire;

    /**
     *
     * @var integer
     */
    protected $ls_off_rating_chase_ire;

    /**
     *
     * @var integer
     */
    protected $ls_off_rating_hurdle_ire;

    /**
     *
     * @var integer
     */
    protected $ls_off_turf_rating_ire;

    /**
     *
     * @var integer
     */
    protected $mirror_flat_rating;

    /**
     *
     * @var string
     */
    protected $mirror_flat_rating_flag;

    /**
     *
     * @var integer
     */
    protected $mirror_jump_rating;

    /**
     *
     * @var string
     */
    protected $mirror_jump_rating_flag;

    /**
     *
     * @var integer
     */
    protected $master_topspeed_flat_turf;

    /**
     *
     * @var integer
     */
    protected $master_topspeed_flat_aw;

    /**
     *
     * @var integer
     */
    protected $master_topspeed_hurdle;

    /**
     *
     * @var integer
     */
    protected $master_topspeed_chase;

    /**
     *
     * @var integer
     */
    protected $master_topspeed_bumper;

    /**
     *
     * @var integer
     */
    protected $master_postmark_flat_turf;

    /**
     *
     * @var integer
     */
    protected $master_postmark_flat_aw;

    /**
     *
     * @var integer
     */
    protected $master_postmark_hurdle;

    /**
     *
     * @var integer
     */
    protected $master_postmark_chase;

    /**
     *
     * @var integer
     */
    protected $master_postmark_bumper;

    /**
     *
     * @var integer
     */
    protected $rf_flat;

    /**
     *
     * @var string
     */
    protected $rf_flat_char;

    /**
     *
     * @var integer
     */
    protected $rf_hurdle;

    /**
     *
     * @var string
     */
    protected $rf_hurdle_char;

    /**
     *
     * @var integer
     */
    protected $rf_chase;

    /**
     *
     * @var string
     */
    protected $rf_chase_char;

    /**
     *
     * @var integer
     */
    protected $rf_awflat;

    /**
     *
     * @var string
     */
    protected $rf_awflat_char;

    /**
     *
     * @var string
     */
    protected $rf_noted_y_n;

    /**
     *
     * @var string
     */
    protected $rf_noted_date;

    /**
     *
     * @var integer
     */
    protected $rf_bumper;

    /**
     *
     * @var string
     */
    protected $rf_bumper_char;
}
