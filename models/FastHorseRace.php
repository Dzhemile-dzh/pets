<?php

namespace Models;

class FastHorseRace extends \Phalcon\Mvc\Model
{
    /**
     * @var integer
     */
    protected $fast_race_instance_uid;

    /**
     * @var string
     */
    protected $horse_name;

    /**
     * @var string
     */
    protected $jockey_name;

    /**
     * @var integer
     */
    protected $saddle_cloth_number;


    /**
     * @var integer
     */
    protected $race_outcome_position;


    /**
     * @var string
     */
    protected $starting_price;
}
