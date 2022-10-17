<?php
namespace Controllers\Horses;

use Controllers\Basic;
use Bo\StakesData\Horse;
use Bo\StakesData\Jockey;
use Bo\StakesData\Trainer;
use Api\Result\StakesData as Result;
use Api\Input\Request\Horses\StakesData as Request;
use Api\Exception\NotFound;

class StakesData extends Basic
{
    /**
     * @param Request\Horse $request
     *
     * @throws NotFound
     */
    public function actionGetHorse(Request\Horse $request)
    {
        $bo = new Horse($request);
        $data = $bo->getData();

        $result = (new Result\Horse())->setData(
            (Object) ($data + ['current_season' => (Object) $bo->getCurrentSeason()])
        );

        $this->setResult($result);
    }

    /**
     * @param Request\Jockey $request
     *
     * @throws NotFound
     */
    public function actionGetJockey(Request\Jockey $request)
    {
        $bo = new Jockey($request);
        $data = $bo->getData();

        $result = (new Result\Jockey())->setData(
            (Object) ($data + ['current_season' => (Object) $bo->getCurrentSeason()])
        );

        $this->setResult($result);
    }

    /**
     * @param Request\Trainer $request
     *
     * @throws NotFound
     */
    public function actionGetTrainer(Request\Trainer $request)
    {
        $bo = new Trainer($request);
        $data = $bo->getData();

        $result = (new Result\Trainer())->setData(
            (Object) ($data + ['current_season' => (Object) $bo->getCurrentSeason()])
        );

        $this->setResult($result);
    }
}
