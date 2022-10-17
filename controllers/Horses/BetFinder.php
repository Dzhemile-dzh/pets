<?php

namespace Controllers\Horses;

class BetFinder extends \Controllers\Basic
{

    /**
     * @param \Api\Input\Request\Horses\BetFinder\Index $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetIndex(\Api\Input\Request\Horses\BetFinder\Index $request)
    {
        $bo = new \Bo\BetFinder($request);

        $result = (new \Api\Result\BetFinder())->setData(
            (Object) $bo->getBetFinderFullData()
        );

        $this->setResult($result);
    }

    /**
     * @param \Api\Input\Request\Horses\BetFinder\Diff $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetDiff(\Api\Input\Request\Horses\BetFinder\Diff $request)
    {
        $bo = new \Bo\BetFinder($request);

        $result = (new \Api\Result\BetFinder())->setData(
            (Object) $bo->getBetFinderDiffData()
        );

        $this->setResult($result);
    }

    /**
     * @param \Api\Input\Request\Horses\BetFinder\Today $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetToday(\Api\Input\Request\Horses\BetFinder\Today $request)
    {
        $bo = new \Bo\BetFinder($request);

        $result = (new \Api\Result\BetFinder())->setData(
            (Object) $bo->getBetFinderFullData(true)
        );

        $this->setResult($result);
    }
}
