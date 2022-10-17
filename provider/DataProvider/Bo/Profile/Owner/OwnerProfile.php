<?php

namespace Api\DataProvider\Bo\Profile\Owner;

use Api\Row\OwnerProfile\RecordByRaceType as Row;

/**
 * Class OwnerProfile
 *
 * @package Api\DataProvider\Bo\Profile\Owner
 */
class OwnerProfile extends \Api\DataProvider\Bo\Profile\RecordByRaceType
{
    /**
     * @return string
     */
    protected function getWhereClause()
    {
        return "hr.owner_uid = :ownerUid:
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
            'ownerUid' => $request->getOwnerId(),
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
