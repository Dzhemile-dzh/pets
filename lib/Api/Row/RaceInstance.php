<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 11/4/14
 * Time: 11:44 AM
 */

namespace Api\Row;

use Phalcon\Mvc\Model\Row\General;

class RaceInstance extends General
{
    use \Api\Row\Methods\IsFlatRace;
    use \Api\Row\Methods\IsJumpRace;
    use \Api\Row\Methods\GetRaceTypeCodeFmt;
    use \Api\Row\Methods\GetLineType;
    use \Api\Row\Methods\GetDistanceToWinner;
    use \Api\Row\Methods\GetRaceDescriptionForForm;
    use \Api\Row\Methods\GetNoOfRunners;
    use \Api\Row\Methods\GetSurface;
    use \Api\Row\Methods\GetTimeOfDayLetter;
    use \Api\Row\Methods\GetRaceStatusName;
    use \Api\Row\Methods\GetTimeBeforeUpdate;
    use \Api\Row\Methods\SetTimestamp;
    use \Api\Row\Methods\GetAdjustmentDistance;
    use \Api\Row\Methods\GetRaceTypeName;
    use \Api\Row\Methods\IsWorldwideStakeRace;
    use \Api\Row\Methods\IsScoop6Race;
    use \Api\Row\Methods\GetSilkImagePath;
    use \Api\Row\Methods\GetTopSpeed;
    use \Api\Row\Methods\IsFirstTimeHeadgear;
    use \Api\Row\Methods\GetDistanceInFurlong;
    use \Api\Row\Methods\GetCleanQuoteNotes;
    use \Api\Row\Methods\GetEarlyClosingRaceReady;
}
