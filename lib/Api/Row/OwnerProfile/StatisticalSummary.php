<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 2/12/2015
 * Time: 6:50 PM
 */

namespace Api\Row\OwnerProfile;

use \RP\Util\Math\GetPercent;

class StatisticalSummary extends \Phalcon\Mvc\Model\Row\General
{
    use GetPercent;
    use \Api\Row\Methods\GetStake;
}
