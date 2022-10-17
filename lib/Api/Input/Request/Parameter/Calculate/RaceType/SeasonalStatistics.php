<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 1/16/2017
 * Time: 12:44 PM
 */

namespace Api\Input\Request\Parameter\Calculate\RaceType;

use Models\Bo\SeasonalStatistics\Season;
use Bo\SeasonalStatistics as Bo;
use Phalcon\Input\Request\Parameter\Calculate\ByDefault;

/**
 * Class SeasonalStatistics
 * @package Api\Input\Request\Parameter\Calculate\RaceType
 */
class SeasonalStatistics extends ByDefault
{
    /**
     * @var string
     */
    private $raceType;

    /**
     * @return null|string
     */
    public function getValue()
    {
        if ($this->getRequest()->get(Bo::MODEL_DEFAULT_INFO)) {
            if (!$this->raceType) {
                $seasonData = $this->getRequest()->getSeasonData();
                $season = reset($seasonData);
                $this->raceType = $this
                    ->getRequest()
                    ->getSelectors()
                    ->getRaceTypeBySeasonTypeCode($season->season_type_code);
            }
            return $this->raceType;
        }
    }
}
