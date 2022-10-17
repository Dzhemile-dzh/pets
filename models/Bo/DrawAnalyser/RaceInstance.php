<?php

namespace Models\Bo\DrawAnalyser;

class RaceInstance extends \Models\RaceInstance
{

    /**
     * @param $raceId
     *
     * @return mixed
     */
    public function getRace($raceId)
    {
        $query = $this->getModelsManager()->createQuery(
            'SELECT
                ri.race_instance_uid
              , ri.race_instance_title
              , ri.race_datetime
              , ri.distance_yard
              , pri.no_of_runners
              , c.course_uid
              , c.course_name
              , ri.going_type_code
              , gt.going_type_desc
              , drs.text_summary as significance_text_summary

            FROM \Models\RaceInstance ri
            JOIN \Models\PreRaceInstance pri
            JOIN \Models\Course c
            JOIN \Models\GoingType gt
            JOIN \Models\DaRaceSignificance drs ON drs.race_instance_uid = ri.race_instance_uid

            WHERE ri.race_instance_uid = :race_instance_uid:'
        );

        $race = $query->execute(array('race_instance_uid' => $raceId))
            ->getFirst();

        return $race ? \Api\Row\RaceInstance::convertFromRow(
            $race
        ) : null;
    }
}
