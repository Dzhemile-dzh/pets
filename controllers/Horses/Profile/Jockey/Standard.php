<?php

namespace Controllers\Horses\Profile\Jockey;

use Api\Input\Request\Horses\Profile\Jockey as Request;
use Api\Result\JockeyProfile as Result;
use Bo\Profile\Jockey as Bo;
use Controllers\Horses\Profile\Jockey;

/**
 * Class Standard
 *
 * @package Controllers\Horses\Profile\Jockey
 */
class Standard extends Jockey
{

    /**
     * @param Request\Standard $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetStandard(Request\Standard $request)
    {
        $result = new Result\Standard();
        $result->setEmptyResultException(new \Api\Exception\NotFound(6108));
        $result->setData(
            (Object)[
                'profile' => Bo::init($request)->getJockey(),
            ]
        );

        $this->setResult($result);
    }
}
