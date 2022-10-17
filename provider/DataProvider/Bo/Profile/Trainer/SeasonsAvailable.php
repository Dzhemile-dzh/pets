<?php

namespace Api\DataProvider\Bo\Profile\Trainer;

use Api\Constants\Horses as Constants;
use Api\DataProvider\Bo\Profile\SeasonsAvailable as ProfileSeasonsAvailable;

/**
 * Class SeasonsAvailable
 * @package Api\DataProvider\Bo\Profile\Trainer
 */
class SeasonsAvailable extends ProfileSeasonsAvailable
{
    /**
     *  Name of tmp table
     */
    const TMP_TABLE_NAME = 'tmp_seasons_available_trainer';
    /**
     * @inheritdoc
     */
    protected function createTmpTable()
    {
        $this->execute(
            "SELECT
                c.country_code
                , ri.race_type_code
                , ri.race_datetime
                , ri.course_uid
            INTO
                #{$this->getTmpTableName()}
            FROM
                horse_race hr
            JOIN
                race_instance ri ON ri.race_instance_uid = hr.race_instance_uid
            JOIN course c ON c.course_uid = ri.course_uid
            WHERE
                hr.trainer_uid = :trainerId:
                AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
            ",
            [
                'trainerId' => $this->getRequest()->getTrainerId(),
            ],
            false
        );
    }
}
