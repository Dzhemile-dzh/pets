<?php

namespace Controllers\Horses\Profile\Trainer;

use Api\Input\Request\Horses\Profile\Trainer as Request;
use Api\Result\TrainerProfile as Result;
use Bo\Profile\Trainer as Bo;
use \Controllers\Horses\Profile\Trainer;

/**
 * Class Standard
 *
 * @package Controllers\Horses\Profile\Trainer
 */
class Standard extends Trainer
{
    /**
     * @param Request\Standard $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetStandard(Request\Standard $request)
    {
        $result = new Result\Standard();
        $result->setEmptyResultException(new \Api\Exception\NotFound(8108));

        $result->setData(
            (Object)[
                'profile' => Bo::init($request)->getTrainer(),
            ]
        );

        $this->setResult($result);
    }
}
