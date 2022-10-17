<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 1/12/2017
 * Time: 11:31 AM
 */

namespace Api\Row\StakesData;

use Api\Row\Methods\GetStake;
use Phalcon\Mvc\Model\Row\General;
use RP\Util\Math\GetPercent;

class Horse extends General
{
    use GetPercent;
    use GetStake;
}
