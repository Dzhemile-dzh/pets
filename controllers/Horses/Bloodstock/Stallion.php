<?php

namespace Controllers\Horses\Bloodstock;

use Controllers\Basic;
use Phalcon\Mvc\Model\Row\General;
use Api\Input\Request\Horses\Bloodstock\Stallion as Request;
use Bo\Bloodstock\Stallion as Bo;
use Api\Result\Bloodstock\Stallion as Result;
use RP\ContentAttributes\Element\Tags;

/**
 * Class Stallion
 *
 * @package Controllers\Horses\Bloodstock
 */
class Stallion extends Basic
{
    /**
     * @param \Api\Input\Request\Horses\Bloodstock\Stallion\Index $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetIndex(Request\Index $request)
    {
        // We need to make a check if the horse exists
        // If not throw a not found exception
        Bo\Horse::init(Request\Horse::init($request))->isHorseExisting();

        $boProgenyHorses = Bo\ProgenyHorses::initByModel(Request\ProgenyHorses::init($request));
        $boProgenyResults = Bo\ProgenyResults::initByModel(Request\ProgenyResults::init($request));
        $boProgenyEntries = Bo\ProgenyEntries::initByModel(Request\ProgenyEntries::init($request));
        $boProgenyStatistics = Bo\ProgenyStatistics::init(Request\ProgenyStatistics::init($request));
        $boNick = Bo\Nick::init(Request\Nick::init($request));
        $boSaleStatistic = Bo\SaleStatistics::init(Request\SaleStatistics::init($request));

        $result = (new Result\Index())
            ->setData(
                (Object)[
                    'progeny_horses' => $boProgenyHorses->getProgenyHorses(),
                    'progeny_results' => $boProgenyResults->getProgenyResults(),
                    'progeny_entries' => $boProgenyEntries->getProgenyEntries(),
                    'seasons_available' => Bo\SeasonsAvailable::init(Request\SeasonsAvailable::init($request))
                        ->getSeasonsAvailable(),
                    'progeny_statistics' => $boProgenyStatistics->prepareRows($boProgenyStatistics->getRows()),
                    'nick' => $boNick->prepareRows($boNick->getRows()),
                    'fee_history' => Bo\FeeHistory::init(Request\FeeHistory::init($request))->getFeeHistory(),
                    'sale_statistics' => (Object)$boSaleStatistic->prepareRows($boSaleStatistic->getRows()),
                    'season_info' => General::createFromArray(
                        [
                            'progeny_horses' => (Object)[
                                'raceType' => $boProgenyHorses->getRequest()->getRaceType(),
                                'seasonYearBegin' => $boProgenyHorses->getRequest()->getSeasonYearBegin(),
                                'seasonYearEnd' => $boProgenyHorses->getRequest()->getSeasonYearEnd(),
                                'more_progeny_available' => $boProgenyHorses->isMoreProgenyAvailable(),
                                'number' => $boProgenyHorses->getRequest()->getNumber(),
                            ],
                            'progeny_results' => (Object)[
                                'seasonYearBegin' => $boProgenyResults->getRequest()->getSeasonYearBegin(),
                                'seasonYearEnd' => $boProgenyResults->getRequest()->getSeasonYearEnd(),
                                'seasonDateBegin' => $boProgenyResults->getRequest()->getSeasonDateBegin(),
                                'seasonDateEnd' => $boProgenyResults->getRequest()->getSeasonDateEnd(),
                                'raceType' => $boProgenyResults->getRequest()->getRaceType(),
                                'countryCode' => $boProgenyResults->getRequest()->getCountryCode(),
                                'surface' => $boProgenyResults->getRequest()->getSurface(),
                                'month' => $boProgenyResults->getRequest()->getMonth(),
                            ],
                            'progeny_entries' => (Object)[
                                'raceType' => $boProgenyEntries->getRequest()->getRaceType(),
                            ],
                        ]
                    ),
                ]
            );

        $this->setResult($result);
    }

    /**
     * @param \Api\Input\Request\Horses\Bloodstock\Stallion\ProgenyHorses $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetProgenyHorses(Request\ProgenyHorses $request)
    {
        $bo = Bo\ProgenyHorses::initByModel($request);

        $result = (new Result\ProgenyHorses())
            ->setData(
                (Object)[
                    'progeny_horses' => $bo->getProgenyHorses(true),
                    'season_info' => (Object)[
                        'raceType' => $request->getRaceType(),
                        'seasonYearBegin' => $request->getSeasonYearBegin(),
                        'seasonYearEnd' => $request->getSeasonYearEnd(),
                        'more_progeny_available' => $bo->isMoreProgenyAvailable(),
                        'number' => $request->getNumber(),
                    ],
                ]
            );

        $this->setResult($result);
    }

    /**
     * @param \Api\Input\Request\Horses\Bloodstock\Stallion\ProgenyResults $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetProgenyResults(Request\ProgenyResults $request)
    {
        $result = (new Result\ProgenyResults())
            ->setData(
                (Object)[
                    'progeny_results' => Bo\ProgenyResults::initByModel($request)->getProgenyResults(),
                    'season_info' => (Object)[
                        'seasonYearBegin' => $request->getSeasonYearBegin(),
                        'seasonYearEnd' => $request->getSeasonYearEnd(),
                        'seasonDateBegin' => $request->getSeasonDateBegin(),
                        'seasonDateEnd' => $request->getSeasonDateEnd(),
                        'raceType' => $request->getRaceType(),
                        'countryCode' => $request->getCountryCode(),
                        'surface' => $request->getSurface(),
                        'month' => $request->getMonth(),
                    ],
                ]
            );

        $this->setResult($result);
    }

    /**
     * @param \Api\Input\Request\Horses\Bloodstock\Stallion\ProgenyEntries $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetProgenyEntries(Request\ProgenyEntries $request)
    {
        $result = (new Result\ProgenyEntries())
            ->setData(
                (Object)[
                    'progeny_entries' => Bo\ProgenyEntries::initByModel($request)->getProgenyEntries(),
                    'season_info' => (Object)[
                        'raceType' => $request->getRaceType(),
                    ],
                ]
            );

        $this->setResult($result);
    }

    /**
     * @param \Api\Input\Request\Horses\Bloodstock\Stallion\SeasonsAvailable $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetSeasonsAvailable(Request\SeasonsAvailable $request)
    {
        $result = (new Result\SeasonsAvailable())
            ->setData(
                (Object)[
                    'seasons_available' => Bo\SeasonsAvailable::init($request)->getSeasonsAvailable(),
                ]
            );

        $this->setResult($result);
    }

    /**
     * @param Request\ProgenyStatisticsTop $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetProgenyStatisticsTop(Request\ProgenyStatisticsTop $request)
    {
        $result = (new Result\ProgenyStatisticsTop())
            ->setData(
                (Object)[
                    'progeny_statistics_top' => Bo\ProgenyStatisticsTop::init($request)->getRows(),
                ]
            );

        $this->setResult($result);
    }

    /**
     * @param Request\ProgenyBroodmareSiresStatisticsTop $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetProgenyBroodmareSiresStatisticsTop(Request\ProgenyBroodmareSiresStatisticsTop $request)
    {
        $result = (new Result\ProgenyBroodmareSiresStatisticsTop())
            ->setData(
                (Object)[
                    'progeny_broodmare_sires_statistics_top' => Bo\ProgenyStatisticsTop::init($request)
                        ->getProgenyBroodmareSires(),
                ]
            );

        $this->setResult($result);
    }

    public function actionGetProgenyStatistics(Request\ProgenyStatistics $request)
    {
        $bo = Bo\ProgenyStatistics::init($request);

        $result = (new Result\ProgenyStatistics())
            ->setData(
                (Object)[
                    'progeny_statistics' => $bo->prepareRows($bo->getRows()),
                ]
            );

        $this->setResult($result);
    }

    public function actionGetNick(Request\Nick $request)
    {
        $bo = Bo\Nick::init($request);

        $result = (new Result\Nick())
            ->setData(
                (Object)[
                    'nick' => $bo->prepareRows($bo->getRows()),
                ]
            );

        $this->setResult($result);
    }

    public function actionGetNickDescendants(Request\NickDescendants $request)
    {
        $result = (new Result\NickDescendants())
            ->setData(
                (Object)[
                    'nick_descendants' => Bo\NickDescendants::init($request)->getNickDescendants(),
                ]
            );

        $this->setResult($result);
    }

    public function actionGetFeeHistory(Request\FeeHistory $request)
    {
        $result = (new Result\FeeHistory())
            ->setData(
                (Object)[
                    'fee_history' => Bo\FeeHistory::init($request)->getFeeHistory(),
                ]
            );

        $this->setResult($result);
    }

    public function actionGetSaleStatistics(Request\SaleStatistics $request)
    {
        $bo = Bo\SaleStatistics::init($request);

        $result = (new Result\SaleStatistics())
            ->setData((Object)(
                $bo->prepareRows($bo->getRows()) +
                ['season_info' => (Object)['countryFlag' => $request->getCountryFlag()]]
            ));

        $this->setResult($result);
    }

    public function actionGetProgenyStatisticsGoingForm(Request\ProgenyStatisticsGoingForm $request)
    {
        $result = (new Result\ProgenyResultsGoingForm())
            ->setData(
                (Object)[
                    'going_form' => Bo\ProgenyStatisticsGoingForm::init($request)->getGoingForm(),
                ]
            );

        $this->setResult($result);
    }

    public function actionGetDamSireSeasons(Request\DamSireSeasons $request)
    {
        $result = (new Result\SeasonsAvailable())
            ->setData(
                (Object)[
                    'seasons_available' => Bo\SeasonsAvailable::init($request)->getSeasonsAvailable(),
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
        $tags->addStallionGroup();
    }
}
