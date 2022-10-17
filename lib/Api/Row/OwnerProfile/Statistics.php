<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 2/10/2015
 * Time: 4:32 PM
 */

namespace Api\Row\OwnerProfile;

use \RP\Util\Math\GetPercent;

class Statistics extends \Phalcon\Mvc\Model\Row\General
{
    use GetPercent;
    use \Api\Row\Methods\GetStake;

    public $place_2nd_number;
    public $place_3rd_number;
    public $place_4th_number;
    public $placed;
}
