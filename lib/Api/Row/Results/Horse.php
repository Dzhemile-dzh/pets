<?php

namespace Api\Row\Results;

/**
 * Class Horse
 *
 * @package \Api\Row\Results
 */
class Horse extends \Phalcon\Mvc\Model\Row\General
{
    use \Api\Row\Methods\GetTopSpeed;
    use \Api\Row\Methods\IsFirstTimeHeadgear;
    use \Api\Row\Methods\GetPngSilkImage;
    use \Api\Row\Methods\IsFlatRace;
    use \Api\Row\Methods\IsJumpRace;
    use \Api\Row\Methods\GetRaceTypeName;
    use \Api\Row\Methods\GetHorseSex;
    use \Api\Row\Methods\GetSilkImagePath;
    use \RP\Util\Math\GetPercent;

    public function forecastOddsStyle($odds_desc)
    {
        if (substr($odds_desc, -2) == '/1') {
            $out_odds = substr($odds_desc, 0, strlen($odds_desc)-2);
        } else {
            $out_odds = str_replace('/', '-', $odds_desc);
        }
        return ($out_odds != '') ? $out_odds : null;
    }
}
