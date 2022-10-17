<?php

namespace Controllers\Horses\RaceCards;

use Bo\RaceCards\GlobalComments as Bo;
use Controllers\Horses\RaceCards;
use \Api\Exception\NotFound as NotFoundException;
use Api\Result\RaceCards\GlobalComments as Result;
use Api\Input\Request\Horses\RaceCards\GlobalComments as Request;

/**
 * @package Controllers\Horses\RaceCards
 */
class GlobalComments extends RaceCards
{
    /**
     * @param Request $request
     *
     * @throws \Exception
     */
    public function actionGetData(Request $request)
    {
        $bo = new Bo($request);

        $result = new Result();
        $result->setEmptyResultException(new NotFoundException(7102));

        $result->setData(
            [
                'global_comments' => $bo->getData()
            ]
        );

        $this->setResult($result);
    }
}
