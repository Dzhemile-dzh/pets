<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 6/7/2016
 * Time: 4:58 PM
 */

namespace Api\Row\CourseProfile;

use Api\Row\Methods\GetStake;
use RP\Util\Math\GetPercent;

class TopTrainers extends \Phalcon\Mvc\Model\Row\General
{
    use GetPercent;
    use GetStake;
}
