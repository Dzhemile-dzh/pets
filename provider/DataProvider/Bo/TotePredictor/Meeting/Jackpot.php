<?php

namespace Api\DataProvider\Bo\TotePredictor\Meeting;

use Api\DataProvider\Bo\TotePredictor;
use Api\Row\RaceInstance;
use Api\Constants\Horses as Constants;
use Api\Input\Request\Horses\TotePredictor\Meeting\Jackpot as Request;

/**
 * Class Jackpot
 * @package Api\DataProvider\Bo\TotePredictor\Meeting
 */
class Jackpot extends TotePredictor
{
    /**
     * @param Request $request
     *
     * @return array|null
     */
    public function getTotePredictorRaces($request)
    {
        $builder = $this->getTotePredictorRacesBuilder($request);

        $builder->innerJoin('race_attrib_join raj ON raj.race_instance_uid = ri.race_instance_uid');
        $builder->where('raj.race_attrib_uid IN (' . Constants::JACKPOT_RACES_ATTRIBS . ')');

        $builder->where('ri.race_datetime BETWEEN :dateFrom AND :dateTo');
        $builder
            ->setParam('dateFrom', date('Y-m-d', strtotime($request->getDate())) . ' 00:00')
            ->setParam('dateTo', date('Y-m-d', strtotime($request->getDate())) . ' 23:59');

        $builder->build();

        $result = $this->query(
            $builder->getSql(),
            $builder->getParams()
        );

        return $result->toArrayWithRows('race_instance_uid') ?: null;
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function getTotePredictorRunners($request)
    {
        $builder = $this->getTotePredictorRunnersBuilder($request);

        $builder
            ->setParam('dateFrom', date('Y-m-d', strtotime($request->getDate())) . ' 00:00')
            ->setParam('dateTo', date('Y-m-d', strtotime($request->getDate())) . ' 23:59');

        $builder->expression(
            'raceCondition',
            "ri.race_instance_uid IN
            (SELECT ri2.race_instance_uid FROM race_instance ri2, race_attrib_join raj
            WHERE ri2.race_datetime BETWEEN :dateFrom AND :dateTo
                AND ri2.race_instance_uid = raj.race_instance_uid
                AND raj.race_attrib_uid IN (" . Constants::JACKPOT_RACES_ATTRIBS . ")
                AND ri2.race_type_code != " . Constants::RACE_TYPE_P2P . ")"
        );

        $builder->build();

        $result = $this->query(
            $builder->getSql(),
            $builder->getParams(),
            new RaceInstance()
        );

        return $result->getGroupedResult(
            [
                'race_instance_uid',
                'runners(\Phalcon\Mvc\Model\Row\General)' => [
                    'horse_uid',
                    'horse_name',
                    'saddle_cloth_no',
                    'non_runner',
                    'score',
                    'rp_postmark',
                    'form',
                    'conditions_score',
                    'rpr_score',
                    'form_score',
                ]
            ],
            ['race_instance_uid', 'horse_uid']
        );
    }
}
