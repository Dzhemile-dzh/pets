<?php

namespace Tests\Stubs\Models\Bo\TrainerProfile;

use Phalcon\Mvc\Model as Model;
use Phalcon\Mvc\Model\Exception as Exception;

class Trainer extends \Tests\Stubs\Models\Trainer
{
    /**
     * @param \Api\Input\Request\HorsesRequest $request
     *
     * @return static
     */
    public function getTrainer(\Api\Input\Request\HorsesRequest $request)
    {
        return \Phalcon\Mvc\Model\Row\General::createFromArray(
            [
                'trainer_name' => 'EDUARDO ABARCA',
                'style_name' => 'Eduardo Abarca',
                'ptp_type_code' => 'N',
                'mirror_name' => 'E ABARCA',
                'trainer_location' => 'Chile',
                'country_code' => 'CHI',
                'rp_x_coord' => null,
                'rp_y_coord' => null,
                'christian_name' => 'Eduardo',
                'primary_trainer_code' => 'flat'
            ]
        );
    }
}
