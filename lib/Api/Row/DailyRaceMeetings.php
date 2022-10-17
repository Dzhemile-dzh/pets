<?php
namespace Api\Row;

use Phalcon\Mvc\Model\Row\General;

class DailyRaceMeetings extends General
{
    use \Api\Row\Methods\IsPdfAvailable;
    /**
     * @var array
     */
    public $races;
}
