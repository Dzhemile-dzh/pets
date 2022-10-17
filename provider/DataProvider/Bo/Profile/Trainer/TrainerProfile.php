<?php

namespace Api\DataProvider\Bo\Profile\Trainer;

use Api\Constants\Horses as Constants;
use Api\Row\TrainerProfile\RecordByRaceType as Row;

/**
 * Class TrainerProfile
 *
 * @package Api\DataProvider\Bo\Profile\Trainer
 */
class TrainerProfile extends \Api\DataProvider\Bo\Profile\RecordByRaceType
{

    /**
     * @return string
     */
    protected function getWhereClause()
    {
        return "hr.trainer_uid = :trainerUid:
                AND ri.race_type_code IN (:raceTypeCode:)
                AND c.country_code = :countryCode:
                AND ri.race_datetime BETWEEN convert(DATETIME, :seasonStartDate) AND convert(DATETIME, :seasonEndDate)
                AND NOT EXISTS (
                    SELECT 1 
                    FROM race_attrib_join 
                    WHERE race_instance_uid = ri.race_instance_uid 
                    AND race_attrib_uid = " . Constants::RACE_ATTRIB_RACING_LEAGUE . ")";
    }

    /**
     * @return array
     */
    protected function getPlaceHolders()
    {
        $request = $this->getRequest();
        return [
            'trainerUid' => $request->getTrainerId(),
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
