<?php

declare(strict_types=1);

namespace Api\DataProvider\Bo\Native\Cards\CardsList;

use Api\DataProvider\HorsesDataProvider;
use Api\Input\Request\Horses\Native\Cards\CardsList as Request;
use Api\Constants\Horses as Constants;
use Phalcon\Db\Sql\Builder;

/**
 * @package Api\DataProvider\Bo\Native\Cards
 */
class BetOffers extends HorsesDataProvider
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function getData(array $ids): array
    {
        if (empty($ids)) {
            return [];
        }

        $builder = new Builder();
        $conditionalSql = 'CASE';

        foreach (Constants::BET_OFFERS_ARRAY as $bookmakerBetOffer => $bookmakerAlias) {
            $conditionalSql  .= ' WHEN raj.race_attrib_uid = ' . $bookmakerBetOffer . ' THEN ' . $bookmakerAlias;
        }

        $conditionalSql .= " END";

        $builder->setSqlTemplate("
                SELECT
                  raj.race_attrib_uid,
                  raj.race_instance_uid,
                  bet_offer_flag = {$conditionalSql}
                FROM
                  race_attrib_join raj
                JOIN
                  race_attrib_lookup ral ON raj.race_attrib_uid = ral.race_attrib_uid
                WHERE
                  raj.race_attrib_uid IN (:betOffersArray)
                  AND
                  raj.race_instance_uid IN (:raceIds)
        ");

        $builder
            ->setParam('raceIds', $ids)
            ->setParam('betOffersArray', array_keys(Constants::BET_OFFERS_ARRAY));

        $data = $this->queryBuilder($builder);

        return $data->getGroupedResult(
            [
                'race_instance_uid',
                'bet_offers' => [
                    'race_attrib_uid',
                    'bet_offer_flag'
                ]
            ],
            ['race_instance_uid']
        );
    }
}
