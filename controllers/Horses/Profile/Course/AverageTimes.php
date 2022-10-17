<?php

namespace Controllers\Horses\Profile\Course;

use Api\Input\Request\Horses\Profile\Course as Request;
use Api\Result\CourseProfile as Result;
use Bo\Profile\Course as Bo;

/**
 * Class AverageTimes
 * @package Bo\Profile\Course
 */
class AverageTimes extends \Controllers\Basic
{
    /**
     * @param Request\AverageTimes $request
     */
    public function actionGetAverageTimes(Request\AverageTimes $request)
    {
        $result = (new Result\AverageTimes())
            ->setEmptyResultException(new \Api\Exception\NotFound(5101))
            ->setData(
                [
                    'average_times' => Bo::init($request)->getAverageTimes(),
                ]
            );

        $this->setResult($result);
    }
}
