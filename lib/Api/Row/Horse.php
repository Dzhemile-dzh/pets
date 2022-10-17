<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 11/4/14
 * Time: 11:44 AM
 */

namespace Api\Row;

use Phalcon\Mvc\Model\Row\General;

class Horse extends General
{
    use \Api\Row\Methods\GetHorseAge;
    use \Api\Row\Methods\GetSilkImagePath;
    use \Api\Row\Methods\GetStake;
}
