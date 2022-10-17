<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 1/13/2016
 * Time: 12:15 PM
 */

namespace Api\Row\Bloodstock\Stallion;

class ProgenyResults extends \Phalcon\Mvc\Model\Row\General
{
    use \Api\Row\Methods\GetRaceDescriptionForForm;
    use \Api\Row\Methods\GetDistanceInFurlong;
    use \Api\Row\Methods\GetTopSpeed;
    use \Api\Row\Methods\GetRaceTypeCodeFmt;
    use \Api\Row\Methods\GetNoOfRunners;
}
