<?php

namespace Models;

use Phalcon\Mvc\Model;

class DaRaceSignificance extends \Phalcon\Mvc\Model
{
    /**
     * @var integer
     */
    protected $race_instance_uid;

    /**
     * @var string
     */
    protected $bias_strength_yn;

    /**
     * @var string
     */
    protected $rsquare_yn;

    /**
     * @var string
     */
    protected $num_races_yn;

    /**
     * @var string
     */
    protected $field_size_yn;

    /**
     * @var string
     */
    protected $straight_slope_yn;

    /**
     * @var string
     */
    protected $text_summary;
}
