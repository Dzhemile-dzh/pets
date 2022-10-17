<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 9/21/2016
 * Time: 2:12 PM
 */

namespace Api\Row\OwnerProfile;

use RP\Util\Math\GetPercent;
use Api\Row\Methods\GetStake;
use Phalcon\Mvc\Model\Row\General;

class RecordByRaceType extends General
{
    use GetPercent;
    use GetStake;
}
