<?php

namespace Controllers\Horses;

use Api\Constants\Horses;
use Api\Exception\NotFound;
use Api\Exception\ValidationError;
use Api\Input\Request\HorsesRequest;
use Api\Result\Json;
use Api\Result\RaceCards\BettingForecast;
use Api\Result\RaceCards\BigRaces;
use Api\Result\RaceCards\Comments;
use Api\Result\RaceCards\NapsTable;
use Api\Result\RaceCards\NextRace;
use Api\Result\RaceCards\OfficialRating;
use Api\Result\RaceCards\PastWinners;
use Api\Result\RaceCards\Postdata;
use Api\Result\RaceCards\PressChallenge;
use Api\Result\RaceCards\Quotes;
use Api\Result\RaceCards\RaceCard as IndexResponse;
use Api\Result\RaceCards\RaceCardDate;
use Api\Result\RaceCards\RaceCardRpr;
use Api\Result\RaceCards\RaceCardUpcoming;
use Api\Result\RaceCards\RunnersIndex;
use Api\Result\RaceCards\SalesData;
use Api\Result\RaceCards\StableToursDatabase;
use Api\Result\RaceCards\StandardForm;
use Api\Result\RaceCards\StarRating;
use Api\Result\RaceCards\Stats;
use Api\Result\RaceCards\TodaysJockeys;
use Api\Result\RaceCards\TodaysTrainers;
use Api\Result\RaceCards\TopDraw;
use Api\Result\RaceCards\TopNaps;
use Api\Result\RaceCards\TopSelections;
use Api\Result\RaceCards\Topspeed;
use Api\Result\RaceCards\Verdict;
use Controllers\Basic;
use Exception;
use Phalcon\Mvc\Model\Resultset\ResultsetException;
use RP\ContentAttributes\Element\Tags;

use Bo\RaceCards\Runners as RunnersBo;
use Api\Result\RaceCards\StandardRunners as StandardRunnersResult;
use Api\Input\Request\Horses\RaceCards as Request;

/**
 * Class RaceCards
 *
 * @package Controllers\Horses
 */
class RaceCards extends Basic
{
    /**
     * @param Request\Index $request
     *
     * @throws Exception
     */
    public function actionGetIndex(Request\Index $request)
    {
        $result = (new IndexResponse())
            ->setEmptyResultException(new NotFound(7101))
            ->setData([
                'race_card' => (new \Bo\RaceCards($request))->getRaceCard(),
            ]);

        $this->setResult($result);
    }

    /**
     * @param Request\TodaysTrainers $request
     *
     * @throws Exception
     */
    public function actionGetTodaysTrainers(Request\TodaysTrainers $request)
    {
        $raceCards = new \Bo\RaceCards($request);

        $result = new TodaysTrainers();

        $result->setData(
            (Object)[
                'todays_trainers' => $raceCards->getTodaysTrainers(),
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\TodaysJockeys $request
     *
     * @throws Exception
     */
    public function actionGetTodaysJockeys(Request\TodaysJockeys $request)
    {
        $raceCards = new \Bo\RaceCards($request);

        $result = new TodaysJockeys();

        $result->setData(
            (Object)[
                'todays_jockeys' => $raceCards->getTodaysJockeys(),
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\PressChallenge $request
     *
     * @throws Exception
     */
    public function actionGetPressChallenge(Request\PressChallenge $request)
    {
        $raceCards = new \Bo\RaceCards($request);

        $result = new PressChallenge();

        $result->setData(
            (Object)[
                'press_challenge' => $raceCards->getPressChallenge(),
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\StandardRunners $request
     *
     * @throws ValidationError
     * @throws Exception
     */
    public function actionGetStandardRunners(Request\StandardRunners $request)
    {
        $raceCards = new RunnersBo($request);

        $runners = $raceCards->getRunners($request, false, null, $request->getReturnP2P());

        $result = new StandardRunnersResult();
        $result->setData(['runners' => $runners]);

        $this->setResult($result);
    }

    /**
     * @param Request\Stats $request
     *
     * @throws Exception
     */
    public function actionGetStats(Request\Stats $request)
    {
        $raceCards = new \Bo\RaceCards($request);

        $result = new Stats();
        $result->setData(
            (Object)[
                'stats' => $raceCards->getStats(),
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\Verdict $request
     *
     * @throws Exception
     */
    public function actionGetVerdict(Request\Verdict $request)
    {
        $raceCards = new \Bo\RaceCards($request);

        $result = new Verdict();
        $tipster_verdicts = $raceCards->getTipsterVerdicts();
        $spotlightVerdictSelection = $raceCards->getSpotlightVerdictSelection($request->getRaceId());

        $result->setData(
            (Object)[
                'verdict' => $raceCards->retrieveVerdict(),
                'spotlight_verdict_selection' => empty($spotlightVerdictSelection) ? null : $spotlightVerdictSelection,
                'tipster_verdicts' => empty($tipster_verdicts) ? null : $tipster_verdicts,
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\Comments $request
     *
     * @throws NotFound
     * @throws Exception
     */
    public function actionGetComments(Request\Comments $request)
    {
        $raceCards = new \Bo\RaceCards($request);

        $result = new Comments();
        $results = $raceCards->getComments();

        if (empty($results->comments) && !$results->isCommentsAvailable) {
            throw new NotFound(26);
        } else {
            $result->setEmptyResultException(new NotFound(5));
        }

        $result->setData(
            (Object)[
                'comments' => $results->comments,
            ]
        );


        $this->setResult($result);
    }

    /**
     * @param Request\PastWinners $request
     *
     * @throws ValidationError
     * @throws Exception
     */
    public function actionGetPastWinners(Request\PastWinners $request)
    {
        $raceCards = new \Bo\RaceCards($request);

        $result = new PastWinners();

        $result->setData(
            (Object)[
                'past_winners' => $raceCards->getPastWinners(),
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\TopSelections $request
     *
     * @throws Exception
     */
    public function actionGetTopSelections(Request\TopSelections $request)
    {
        $raceCards = new \Bo\RaceCards($request);

        $result = new TopSelections();
        $result->setEmptyResultException(new NotFound(5));

        $result->setData(
            (Object)[
                'top_selections' => $raceCards->getTopSelections($request),
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\OfficialRating $request
     *
     * @throws NotFound
     * @throws Exception
     */
    public function actionGetOfficialRating(Request\OfficialRating $request)
    {
        $raceCards = new \Bo\RaceCards($request);

        $result = new OfficialRating();

        $result->setData(
            (Object)[
                'official_rating' => $raceCards->getOfficialRating(),
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\Postdata $request
     *
     * @throws Exception
     */
    public function actionGetPostdata(Request\Postdata $request)
    {
        $raceCards = new \Bo\RaceCards($request);

        $postdata = $raceCards->getPostData();

        $result = new Postdata();
        $result->setEmptyResultException(new NotFound(7102));
        $result->setData(
            (Object)[
                'postdata' => $postdata,
            ]
        );
        $this->setResult($result);
    }

    /**
     * @param Request\DateRequest $request
     *
     * @throws Exception
     */
    public function actionGetDate(Request\DateRequest $request)
    {
        $raceCards = new \Bo\RaceCards($request);

        $result = new RaceCardDate();
        $result->setEmptyResultException(new NotFound(7102));

        $result->setData(
            (Object)[
                'list' => $raceCards->getList(
                    $request->getRaceDate(),
                    false,
                    [],
                    true
                ),
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param HorsesRequest $request
     *
     * @throws Exception
     */
    public function actionGetUpcoming(HorsesRequest $request)
    {
        $raceCards = new \Bo\RaceCards($request);

        $result = new RaceCardUpcoming();
        $result->setEmptyResultException(new NotFound(7102));

        $result->setData(
            (Object)[
                'list' => $raceCards->getUpcomingRaces($request),
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\BigRaces $request
     * @throws NotFound
     */
    public function actionGetBigRaces(Request\BigRaces $request)
    {

        $raceCards = new \Bo\RaceCards($request);

        $result = new BigRaces();

        $result->setEmptyResultException(new NotFound(7102));

        $result->setData(
            (Object)[
                'big_races' => $raceCards->getBigRaces(),
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\RunnersIndex $request
     *
     * @throws Exception
     */
    public function actionGetRunnersIndex(Request\RunnersIndex $request)
    {
        $raceCards = new \Bo\RaceCards($request);

        $result = new RunnersIndex();

        $result->setData(
            (Object)[
                'runners_index' => $raceCards->getRunnersIndex($request->getRaceDate()),
            ]
        );

        $this->setResult($result);
    }


    /**
     * @param Request\Rpr $request
     *
     * @throws Exception
     */
    public function actionGetRpr(Request\Rpr $request)
    {
        $raceCards = new \Bo\RaceCards($request);
        $raceId = $request->getRaceId();

        $result = new RaceCardRpr();

        $result->setData(
            (Object)[
                'rpr' => $raceCards->getRPR($raceId),
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\StableToursDatabase $request
     *
     * @throws Exception
     */
    public function actionGetStableToursDatabase(Request\StableToursDatabase $request)
    {
        $raceCards = new \Bo\RaceCards($request);

        $result = new StableToursDatabase();

        $result->setEmptyResultException(new NotFound(5));

        $result->setData(
            (Object)[
                'stable_tours_database' => $raceCards->getStableToursDatabase(
                    $request->getSearchBy(),
                    $request->getSearchTerm()
                ),
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\Topspeed $request
     *
     * @throws NotFound
     * @throws Exception
     */
    public function actionGetTopspeed(Request\Topspeed $request)
    {
        $raceCards = new \Bo\RaceCards($request);

        $result = new Topspeed();

        $result->setEmptyResultException(new NotFound(5));

        $result->setData(
            (Object)[
                'topspeed' => $raceCards->getTopspeed($request->getRaceDate()),
                'topspeed_selection' => $raceCards->getTopspeedSelection(),
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\Form $request
     *
     * @throws NotFound
     * @throws Exception
     */
    public function actionGetForm(Request\Form $request)
    {
        $limit = $request->getLimit();

        if ($limit > Horses::PARAMETER_LIMIT_MAX_UPPER) {
            throw new ValidationError(30, array('limit', (Horses::PARAMETER_LIMIT_MAX_UPPER + 1)));
        } else {
            $raceCards = new \Bo\RaceCards($request);

            $form = $raceCards->getForm($limit, $request->getReturnP2P() ?? false);

            $result = new \Api\Result\RaceCards\Form();

            $result->setData(
                (Object)[
                    'form' => $form,
                ]
            );

            $this->setResult($result);
        }
    }

    /**
     * @param Request\StandardForm $request
     *
     * @throws NotFound
     * @throws Exception
     */
    public function actionGetStandardForm(Request\StandardForm $request)
    {
        $raceCards = new \Bo\RaceCards($request);

        $form = $raceCards->getForm($request->getLimit(), $request->getReturnP2P() ?? false);

        $result = new StandardForm();
        $result->setData(
            (Object)[
                'form' => $form,
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param mixed $data
     *
     * @throws Exception
     */
    private function setActionResult($data, $emptyResultException = null)
    {
        $result = new Json();
        if ($emptyResultException instanceof Exception) {
            $result->setEmptyResultException($emptyResultException);
        }
        $result->setData($data);

        $this->setResult($result);
    }

    /**
     * @param Request\Quotes $request
     *
     * @throws Exception
     */
    public function actionGetQuotes(Request\Quotes $request)
    {
        $raceCards = new \Bo\RaceCards($request);

        $quotes = $raceCards->getQuotes();

        $result = new Quotes();
        $result->setData(
            (Object)[
                'quotes' => $quotes,
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\NextRace $request
     *
     * @throws Exception
     */
    public function actionGetNextRace(Request\NextRace $request)
    {
        $raceCards = new \Bo\RaceCards($request);
        $result = new NextRace();
        $result->setEmptyResultException(new NotFound(1113))->setData(
            (Object)[
                'next_race' => $raceCards->getNextRace($request),
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\TopDraw $request
     *
     * @throws Exception
     */
    public function actionGetTopDraw(Request\TopDraw $request)
    {
        $raceCards = new \Bo\RaceCards\TopDraw($request->getRaceId());

        $result = new TopDraw();

        $result->setEmptyResultException(new NotFound(25))->setData(
            (Object)[
                'top_draw' => $raceCards->getTopDraw(),
            ]
        );

        $this->setResult($result);
    }

    public function actionGetBettingForecast(Request\BettingForecast $request)
    {
        $raceCards = new \Bo\RaceCards($request);
        $forecast = $raceCards->getBettingForecast();

        $result = new BettingForecast();
        $result->setData(
            (Object)[
                'betting_forecast' => $forecast,
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\NapsTable $request
     *
     * @throws Exception
     */
    public function actionGetNapsTable(Request\NapsTable $request)
    {
        $raceCard = new \Bo\RaceCards($request);
        $raceCard->resetRequest($request);

        $result = (new NapsTable())
            ->setData(
                (Object)[
                    'naps_table' => $raceCard->getNapsTable()
                ]
            );
        $this->setResult($result);
    }

    /**
     * @param Request\TopNaps $request
     *
     * @throws Exception|Exception
     */
    public function actionGetTopNaps(Request\TopNaps $request)
    {
        $raceCard = new \Bo\RaceCards($request);

        $result = (new TopNaps())
            ->setData(
                (Object)[
                    'top_naps' => $raceCard->getTopNaps($request),
                ]
            );
        $this->setResult($result);
    }

    /**
     * @param Request\StartRating $request
     *
     * @throws Exception
     */
    public function actionGetStartRating(Request\StartRating $request)
    {
        $raceCard = new \Bo\RaceCards($request);

        $result = (new StarRating())
            ->setData(
                (Object)[
                    'star_rating' => $raceCard->getStartRating($request),
                ]
            );
        $this->setResult($result);
    }

    /**
     * @param Request\HeadToHead $request
     *
     * @throws Exception
     */
    public function actionGetHeadToHead(Request\HeadToHead $request)
    {
        $raceCards  = new RunnersBo($request);

        $runnersIds = $raceCards->getRunnerIds($request);


        $bo = new \Bo\HeadToHead(array_keys($runnersIds));
        $headToHead = $bo->getHeadToHead();

        $result = (new \Api\Result\RaceCards\HeadToHead())
            ->setData(
                (Object)[
                    'head_to_head' => $headToHead,
                    'statistics'   => $bo->getRaceCardsStats($headToHead, $runnersIds),
                ]
            );
        $this->setResult($result);
    }

    public function actionGetSalesData(Request\SalesData $request)
    {
        $raceCards = new \Bo\RaceCards($request);

        $result = new SalesData();

        $result->setData(
            [
                'sales' => $raceCards->getSalesData($request),
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
        $tags->addCardGroup();
    }
}
