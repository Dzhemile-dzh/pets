<?php

declare(strict_types=1);

namespace Controllers\Horses\Predictor;

use \Api\Exception\NotFound;
use \Phalcon\Mvc\Model\Resultset\ResultsetException;
use \Api\Input\Request\Horses\Predictor\Index as Request;
use \Api\Result\Predictor as Result;

/**
 * Class Race
 *
 * @package Controllers\Horses\Predictor
 */
class Race extends \Controllers\Basic
{

    /**
     * @param Request $request
     *
     * @throws NotFound
     * @throws ResultsetException
     * @throws \Exception
     */
    public function actionGetIndex(Request $request): void
    {
        $predictor = new \Bo\Predictor($request->getRaceId());

        if (empty($predictor->getRace())) {
            throw new NotFound(1103, $request->getRaceId());
        }

        $result = (new Result())->setData(
            (Object)[
                'race' => $predictor->getRace(),
                'runners' => $predictor->getPointsData()
            ]
        );

        $this->setResult($result);
    }
}
