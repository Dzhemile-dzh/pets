<?php

namespace Controllers\Horses;

use Api\Exception\NotFound;
use Controllers\Basic;
use Bo\Tipping as Bo;
use Api\Result\Tipping as Result;
use Api\Input\Request\Horses\Tipping as Request;

/**
 * Class Tipping
 *
 * @package Controllers\Horses
 */
class Tipping extends Basic
{
    /**
     * @param Request\Success $request
     *
     * @throws \Exception
     */
    public function actionTippingSuccess(Request\Success $request)
    {
        $bo = new Bo\Success($request);
        $result = new Result\Success();
        $result
            ->setEmptyResultException(new NotFound(17000))
            ->setData(
                [
                    'tippings' => $bo->getAllTips()
                ]
            );

        $this->setResult($result);
    }

    /**
     * @param Request\Singles $request
     *
     * @throws \Exception
     */
    public function actionTippingSingles(Request\Singles $request)
    {
        $resultsObject = new Bo\Singles($request);
        $result = new Result\Singles();

        $result->setData(
            (Object)[
                'tipping_singles' => $resultsObject->getRaceDate(),
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\Multiples $request
     *
     * @throws \Exception
     */
    public function actionTippingMultiples(Request\Multiples $request)
    {
        $resultsObject = new Bo\Multiples($request);
        $result = new Result\Multiples();
        $result->setData(
            [
                'tipping_multiples' => $resultsObject->getMultiples()
            ]
        );

        $this->setResult($result);
    }
}
