<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 1/13/2016
 * Time: 12:15 PM
 */

namespace Api\Row\Bloodstock\Dam;

use \RP\Util\Math\GetPercent;

class ProgenyResults extends \Phalcon\Mvc\Model\Row\General
{
    use \Api\Row\Methods\GetDistanceInFurlong;
    use GetPercent;
}
