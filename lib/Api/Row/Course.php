<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 11/24/2015
 * Time: 3:11 PM
 */

namespace Api\Row;

use Phalcon\Mvc\Model\Row\General;
use RP\Util\Math\GetPercent;

class Course extends General
{
    use \Api\Row\Methods\IsPdfAvailable;
    use \Api\Row\Methods\GetStake;
    use GetPercent;
}
