<?php
namespace Api\Row;

use Phalcon\Mvc\Model\Row\General;

class Meeting extends General
{
    use \Api\Row\Methods\IsPdfAvailable;
    /**
     * @var string
     */
    public $meeting_type;
}
