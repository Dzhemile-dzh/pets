<?php

namespace Models;

use Phalcon\Mvc\Model;

class RaceOutcome extends \Phalcon\Mvc\Model
{
    /**
     * @var integer
     */
    protected $race_outcome_uid;

    /**
     * @var string
     */
    protected $race_outcome_desc;

    /**
     * @var string
     */
    protected $race_outcome_code;

    /**
     * @var integer
     */
    protected $race_outcome_position;

    /**
     * @var string
     */
    protected $race_outcome_joint_yn;

    /**
     * @var string
     */
    protected $race_outcome_form_char;

    /**
     * @var integer
     */
    protected $race_output_order;

    /**
     * @var string
     */
    protected $rp_race_outcome_desc;

    /**
     * @var string
     */
    protected $selby_code;
}
