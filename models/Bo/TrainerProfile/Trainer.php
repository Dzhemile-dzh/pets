<?php

namespace Models\Bo\TrainerProfile;

class Trainer extends \Models\Trainer
{

    /**
     * @param \Api\Input\Request\HorsesRequest $request
     *
     * @return \Phalcon\Mvc\ModelInterface
     */
    public function getTrainer(\Api\Input\Request\HorsesRequest $request)
    {
        $sql = "SELECT
                    trainer_name,
                    ptp_type_code,
                    style_name,
                    mirror_name,
                    trainer_location,
                    country_code,
                    rp_x_coord,
                    rp_y_coord,
                    christian_name,
                    primary_trainer_code
                FROM trainer
                WHERE trainer_uid = :trainerUid:
                ";

        $result = $this->getReadConnection()->query(
            $sql,
            array('trainerUid' => $request->getTrainerId())
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $result
        );
        return $result->getFirst();
    }
}
