<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 11/4/14
 * Time: 11:44 AM
 */

namespace Api\Row\SeasonalStatistics;

class Trainer extends \Phalcon\Mvc\Model\Row\General
{
    use \Api\Row\Methods\GetStake;
    use \RP\Util\Math\GetPercent;
}
