<?php

namespace Controllers\Horses\Profile\Course;

use Api\Input\Request\Horses\Profile\Course as Request;
use Api\Result\CourseProfile as Result;
use Bo\Profile\Course as Bo;
use \Controllers\Horses\Profile\Course;

/**
 * Class Standard
 *
 * @package Controllers\Horses\Profile\Course
 */
class Standard extends Course
{
    /**
     * @param Request\Standard $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetStandard(Request\Standard $request)
    {
        $result = (new Result\Standard())
            ->setEmptyResultException(new \Api\Exception\NotFound(5101))
            ->setData(
                (Object)[
                    'profile' => Bo::init($request)->getProfile(),
                ]
            );

        $this->setResult($result);
    }
}
