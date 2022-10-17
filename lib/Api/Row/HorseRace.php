<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 11/4/14
 * Time: 11:44 AM
 */

namespace Api\Row;

use Phalcon\Mvc\Model\Row\General;

class HorseRace extends General
{
    use \Api\Row\Methods\IsFlatRace;
    use \Api\Row\Methods\IsJumpRace;
    use \Api\Row\Methods\GetLifetimeName;
    use \Api\Row\Methods\GetRaceTypeCodeFmt;
    use \Api\Row\Methods\GetLineType;
    use \Api\Row\Methods\GetOutcomePositionForPlacings;
    use \Api\Row\Methods\GetRaceTypeName;
    use \Api\Row\Methods\GetAdjustmentDistance;
}
