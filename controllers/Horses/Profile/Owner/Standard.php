<?php

namespace Controllers\Horses\Profile\Owner;

use Api\Input\Request\Horses\Profile\Owner as Request;
use Api\Result\OwnerProfile as Result;
use Bo\Profile\Owner as Bo;
use Controllers\Horses\Profile\Owner;

/**
 * Class Standard
 *
 * @package Controllers\Horses\Profile\Owner
 */
class Standard extends Owner
{

    /**
     * @param Request\Standard $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetStandard(Request\Standard $request)
    {
        $result = new Result\Standard();
        $result->setEmptyResultException(new \Api\Exception\NotFound(9108));
        $result->setData(
            (Object)[
                'profile' => Bo::init($request)->getOwner(),
            ]
        );

        $this->setResult($result);
    }
}
