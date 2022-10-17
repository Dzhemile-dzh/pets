<?php

namespace Models;

class HorseNotes extends \Phalcon\Mvc\Model
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
    protected $notes_type_code;

    /**
     *
     * @var string
     */
    protected $notes;
}
