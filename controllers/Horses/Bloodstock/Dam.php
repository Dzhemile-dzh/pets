<?php

namespace Controllers\Horses\Bloodstock;

use Api\Input\Request\Horses\Bloodstock\Dam as Request;
use Bo\Bloodstock as Bo;
use \Api\Result\Bloodstock\Dam as Result;
use RP\ContentAttributes\Element\Tags;

/**
 * Class Dam
 *
 * @package Controllers\Horses\Bloodstock
 */
class Dam extends \Controllers\Basic
{
    /**
     * @param Request\ProgenyEntries $request
     * @throws \Exception
     */
    public function actionGetProgenyEntries(Request\ProgenyEntries $request)
    {
        $bo = new Bo\Dam($request);

        $result = (new Result\ProgenyEntries())
            ->setData(
                (Object)[
                    'progeny-entries' => $bo->getProgenyEntries()
                ]
            );

        $this->setResult($result);
    }

    /**
     * @param Request\ProgenyResults $request
     * @throws \Exception
     */
    public function actionGetProgenyResults(Request\ProgenyResults $request)
    {
        $bo = new Bo\Dam($request);
        $result = (new Result\ProgenyResults())
            ->setData(
                (Object)[
                    'progeny-results' => $bo->getProgenyResults()
                ]
            );

        $this->setResult($result);
    }

    /**
     * @param Request\ProgenyResultsSalesDefault $request
     * @throws \Exception
     */
    public function actionGetProgenyResultsSalesDefault(Request\ProgenyResultsSalesDefault $request)
    {
        $bo = new Bo\Dam($request);
        $result = (new Result\ProgenyResults())
            ->setData(
                (Object)[
                    'progeny-results' => $bo->getProgenyResultsSalesDefault()
                ]
            );

        $this->setResult($result);
    }

    /**
     * @param Request\ProgenySales $request
     * @throws \Exception
     */
    public function actionGetProgenySales(Request\ProgenySales $request)
    {
        $bo = new Bo\Dam($request);

        $result = (new Result\ProgenySales())
            ->setData(
                (Object)[
                    'progeny-sales' => $bo->getProgenySales()
                ]
            );

        $this->setResult($result);
    }

    /**
     * @param Request\ProgenyResultsSeasons $request
     * @throws \Exception
     */
    public function actionGetProgenyResultsSeasons(Request\ProgenyResultsSeasons $request)
    {
        $bo = new Bo\Dam($request);
        $result = (new Result\ProgenyResultsSeasons())
            ->setData(
                (Object)[
                    'progeny_results_seasons' => $bo->getProgenyResultsSeasons()
                ]
            );

        $this->setResult($result);
    }

    /**
     * @param Request\DamList $request
     * @throws \Exception
     */
    public function actionGetDamList(Request\DamList $request)
    {
        $bo = new Bo\Dam\DamList($request);
        $result = (new Result\DamList())
            ->setData(
                (Object)[
                    'list' => $bo->getDamList()
                ]
            );

        $this->setResult($result);
    }

    public function initialize()
    {
        parent::initialize();
        $ca = $this->getContentAttributes();
        /** @var Tags $tags */
        $tags = $ca->tags();
        $tags->addDamGroup();
    }
}
