<?php

namespace Api\DataProvider\Bo\Bloodstock\Dam;

use Api\Constants\Horses as Constants;
use Models\Selectors;
use Phalcon\Db\Sql\Builder;
use Api\Input\Request\HorsesRequest;
use Api\DataProvider\HorsesDataProvider;

/**
 * Class DamList
 *
 * @package Api\DataProvider\Bo\Bloodstock\Dam
 */
class DamList extends HorsesDataProvider
{
    /**
     * @param HorsesRequest $request
     * @param Selectors $selectors
     * @return array
     */
    public function getDamList(HorsesRequest $request, Selectors $selectors)
    {
        $ageSql = $selectors->getHorseAgeSQL('h.horse_date_of_birth', 'h.country_origin_code', 'getdate()');

        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT
                horse_uid,
                style_name,
                country_origin_code,
                horse_date_of_birth,
                horse_date_of_death
            FROM (
                SELECT
                    h.horse_uid,
                    h.style_name,
                    h.horse_name,
                    h.country_origin_code,
                    h.horse_date_of_birth,
                    h.horse_date_of_death,
                    {$ageSql} as age
                FROM
                    horse h
                WHERE
                    horse_sex_code = '" . Constants::HORSE_SEX_CODE_MARE . "'
                AND (
                    EXISTS (
                        SELECT 1
                        FROM horse_race hr2
                            JOIN horse h2 ON hr2.horse_uid = h2.horse_uid
                        WHERE
                            h2.dam_uid = h.horse_uid
                        AND hr2.race_outcome_uid NOT IN (:nonRunnersOutcomes)
                    )
                    OR (
                        EXISTS (
                            SELECT 1
                            FROM bloodstock_sale bs
                            WHERE
                                bs.dam_uid = h.horse_uid
                            AND bs.sale_date > DATEADD(year, -3, getdate())
                        )
                    )
                )
                PLAN '(use optgoal allrows_dss)'
            ) main
            WHERE
                /*{WHERE}*/
        ");

        $builder->setParam('nonRunnersOutcomes', Constants::NON_RUNNER_IDS_ARRAY);

        $country = $request->getCountry();
        if (!is_null($country)) {
            $builder->where('country_origin_code = :countryCode');
            $builder->setParam('countryCode', $country);
        } else {
            $builder->where('country_origin_code IN (:countryCodes)');
            $builder->setParam('countryCodes', Constants::COUNTRY_CODES_FOR_PARAMS);
        }

        $ages = $request->getAge();
        if (!is_null($ages)) {
            $builder->where('age IN (' . $ages . ')');
        } else {
            $builder->where('age BETWEEN '. Constants::MIN_AGE_DAM .' AND '. Constants::MAX_AGE_DAM);
        }

        $name = $request->getName();
        if (!is_null($name)) {
            $name = strtoupper($name);
            $builder->where('horse_name like :horseName');
            $builder->setParam('horseName', $name . '%');
        }

        $deceased = $request->getDeceased();
        if (!is_null($deceased)) {
            $deceased = $deceased ? 'IS NOT NULL' : 'IS NULL';
            $builder->where("horse_date_of_death {$deceased}");
        }

        $data = $this->queryBuilder($builder);

        return $data->toArrayWithRows();
    }
}
