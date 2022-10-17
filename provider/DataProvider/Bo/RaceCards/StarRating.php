<?php

namespace Api\DataProvider\Bo\RaceCards;

use Api\DataProvider\HorsesDataProvider;
use Api\Input\Request;
use Phalcon\Db\Sql\Builder;
use Api\Constants\Horses as Constants;

/**
 * Class StarRating
 *
 * @package Api\DataProvider\Bo\RaceCards
 */
class StarRating extends HorsesDataProvider
{
    /**
     * @param Request\Horses\RaceCards\StartRating $request
     *
     * @return array
     */
    public function getData(Request\Horses\RaceCards\StartRating $request)
    {
        $builder = new Builder($request);

        $builder->setSqlTemplate("
            SELECT
                phr.saddle_cloth_no start_number,
                h.horse_uid,
                h.style_name horse_name,
                phr.non_runner,
                phrg.int_1 star_rating
            FROM 
                race_instance ri
            INNER JOIN 
                pre_horse_race phr ON phr.race_instance_uid = ri.race_instance_uid
            INNER JOIN
                horse h ON h.horse_uid = phr.horse_uid
            LEFT JOIN 
                pre_horse_race_genlkup phrg ON phrg.race_instance_uid = ri.race_instance_uid
                    AND phrg.horse_uid = phr.horse_uid
            WHERE 
                phr.race_status_code = (
                    CASE
                        WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                        THEN " . Constants::RACE_STATUS_OVERNIGHT. "
                        ELSE ri.race_status_code
                    END
                )
                AND ri.race_instance_uid = :raceId:
                /*{WHERE}*/
            ORDER BY ri.race_datetime, phr.saddle_cloth_no, h.style_name
        ");

        if ($request->getHorseId()) {
            $builder->where("h.horse_uid = :horseId:");
        }

        $builder->build();

        return $this->queryBuilder($builder)->toArrayWithRows();
    }
}
