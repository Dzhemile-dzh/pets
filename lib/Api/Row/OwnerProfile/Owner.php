<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 12/7/2015
 * Time: 5:38 PM
 */

namespace Api\Row\OwnerProfile;

use Phalcon\Mvc\Model\Row\General;
use Api\Row\Methods\GetSilkImagePath;

class Owner extends General
{
    use GetSilkImagePath;
}
