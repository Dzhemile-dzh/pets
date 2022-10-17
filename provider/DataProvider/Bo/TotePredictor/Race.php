<?php

namespace Api\DataProvider\Bo\TotePredictor;

use Api\DataProvider\Bo\TotePredictor;
use Api\Row\RaceInstance;
use Api\Input\Request\Horses\TotePredictor\Race as Request;

/**
 * Class Race
 *
 * @package Api\DataProvider\Bo\TotePredictor
 */
class Race extends TotePredictor
{
    /**
     * @param Request $request
     *
     * @return array|null
     */
    public function getTotePredictorRaces($request)
    {
        $builder = $this->getTotePredictorRacesBuilder($request);
        $builder->where('ri.race_instance_uid = :raceId');
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
        $builder->expression('raceCondition', 'ri.race_instance_uid = :raceId');
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
