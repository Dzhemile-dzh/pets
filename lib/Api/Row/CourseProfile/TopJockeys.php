<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 6/3/2016
 * Time: 4:55 PM
 */

namespace Api\Row\CourseProfile;

use Api\Row\Methods\GetStake;
use RP\Util\Math\GetPercent;

class TopJockeys extends \Phalcon\Mvc\Model\Row\General
{
    use GetPercent;
    use GetStake;
}
