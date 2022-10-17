<?php
namespace Api\Row\StakesData;

use Phalcon\Mvc\Model\Row\General;
use RP\Util\Math\GetPercent;
use Api\Row\Methods\GetStake;

class Trainer extends General
{
    use GetPercent;
    use GetStake;
}
