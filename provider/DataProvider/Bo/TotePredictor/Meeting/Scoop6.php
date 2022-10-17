<?php

namespace Api\DataProvider\Bo\TotePredictor\Meeting;

use Api\Row\RaceInstance;
use Api\Constants\Horses as Constants;
use Api\DataProvider\Bo\TotePredictor;
use Api\Input\Request\Horses\TotePredictor\Meeting\Scoop6 as Request;

/**
 * Class Scoop6
 *
 * @package Api\DataProvider\Bo\TotePredictor
 */
class Scoop6 extends TotePredictor
{
    /**
     * @param Request $request
     *
     * @return array|null
     */
    public function getTotePredictorRaces($request)
    {
        $builder = $this->getTotePredictorRacesBuilder($request);

        $builder->innerJoin('race_selection rs ON rs.race_instance_uid = ri.race_instance_uid');

        $builder->where('rs.race_selection_type = ' . Constants::RACE_SELECTION_TYPE_SCOOP6);
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
            'ri.race_instance_uid IN
            (SELECT race_instance_uid FROM race_instance
            WHERE race_datetime BETWEEN :dateFrom AND :dateTo
                AND race_type_code != \'P\')'
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
