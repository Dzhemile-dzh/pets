<?php

namespace Api\DataProvider\Bo\TotePredictor;

use Api\DataProvider\Bo\TotePredictor;
use Api\Row\RaceInstance;
use Api\Input\Request\Horses\TotePredictor\Meeting as Request;

/**
 * Class Meeting
 * @package Api\DataProvider\Bo\TotePredictor\Meeting
 */
class Meeting extends TotePredictor
{
    /**
     * @param Request $request
     *
     * @return array|null
     */
    public function getTotePredictorRaces($request)
    {
        $builder = $this->getTotePredictorRacesBuilder($request);

        $builder->where('ri.course_uid = :courseId');
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
