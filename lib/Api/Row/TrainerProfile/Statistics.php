<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 11/4/14
 * Time: 11:44 AM
 */

namespace Api\Row\TrainerProfile;

use \RP\Util\Math\GetPercent;

class Statistics extends \Phalcon\Mvc\Model\Row\General
{
    use GetPercent;
    use \Api\Row\Methods\GetStake;
}
