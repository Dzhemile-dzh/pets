<?php

namespace Api\DataProvider\Bo\Profile\Jockey;

use Api\Row\JockeyProfile\RecordByRaceType as Row;
use Pseudo\Exception;

/**
 * Class JockeyProfile
 *
 * @package Api\DataProvider\Bo\Profile\Jockey
 */
class JockeyProfile extends \Api\DataProvider\Bo\Profile\RecordByRaceType
{

    /**
     * @return string
     */
    protected function getWhereClause()
    {
        return "hr.jockey_uid = :jockeyUid:
                AND ri.race_type_code IN (:raceTypeCode:)
                AND c.country_code = :countryCode:
                AND ri.race_datetime BETWEEN convert(DATETIME, :seasonStartDate) AND convert(DATETIME, :seasonEndDate)";
    }

    /**
     * @return array
     */
    protected function getPlaceHolders()
    {
        $request = $this->getRequest();

        return [
            'jockeyUid' => $request->getJockeyId(),
            'raceTypeCode' => $request->getRaceTypeCodes(),
            'countryCode' => $request->getCountryCode(),
            'seasonStartDate' => $request->getSeasonDateBegin(),
            'seasonEndDate' => $request->getSeasonDateEnd()
        ];
    }

    /**
     * @return Row
     */
    public function getRow()
    {
        return new Row();
    }
}
