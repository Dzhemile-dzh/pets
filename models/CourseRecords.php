<?php

namespace Models;

class CourseRecords extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $course_uid;

    /**
     *
     * @var string
     */
    protected $race_type_code;

    /**
     *
     * @var string
     */
    protected $straight_round_jubilee_code;

    /**
     *
     * @var integer
     */
    protected $distance_yards;

    /**
     *
     * @var integer
     */
    protected $ages_allowed_uid;

    /**
     *
     * @var string
     */
    protected $joint_yn;

    /**
     *
     * @var string
     */
    protected $horse_name;

    /**
     *
     * @var integer
     */
    protected $weight_carried_lbs;

    /**
     *
     * @var string
     */
    protected $race_date;

    /**
     *
     * @var integer
     */
    protected $time_secs;
}
