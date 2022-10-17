<?php

namespace Controllers\Horses\Profile;

use RP\ContentAttributes\Element\Tags;
use Api\Input\Request\Horses\Profile\Horse as Request;
use Api\Constants\Horses as Constants;

/**
 * Class Horse
 *
 * @package Controllers\Horses\Profile
 */
class Horse extends \Controllers\Basic
{
    /**
     * @param Request\Index $request
     *
     * @throws \Api\Exception\NotFound
     * @throws \Exception
     */
    public function actionGetIndex(Request\Index $request)
    {
        $horseProfileObject = new \Bo\Profile\Horse($request->getHorseId());

        $this->setResult(
            (new \Api\Result\HorseProfile\Index())->setData(['profile' => $horseProfileObject->getHorseData()])
        );
    }

    /**
     * @param Request\Overview $request
     *
     * @throws \Api\Exception\NotFound
     * @throws \Exception
     */
    public function actionGetOverview(Request\Overview $request)
    {
        $horseProfileObject = new \Bo\Profile\Horse($request->getHorseId());

        $result = new \Api\Result\HorseProfile\Overview();
        $result->setData(
            [
                'profile' => $horseProfileObject->getProfile(),
                'entries' => $horseProfileObject->getEntries($request),
                'quotes' => $horseProfileObject->getNotes(Constants::NOTES_TYPE_CODE_QUOTES_STR),
                'stable_tour_quotes' => $horseProfileObject->getStableTourQuotes(),
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\Record $request
     *
     * @throws \Exception
     * @throws \Phalcon\Mvc\Model\Exception
     */
    public function actionGetRecord(Request\Record $request)
    {
        $horseProfileObject = new \Bo\Profile\Horse($request->getHorseId());

        $result = new \Api\Result\Json();
        $result->setData($horseProfileObject->getRaceRecord($request->getReturnP2P()));

        $this->setResult($result);
    }

    /**
     * @param Request\Pedigree $request
     *
     * @throws \Api\Exception\NotFound
     * @throws \Exception
     */
    public function actionGetPedigree(Request\Pedigree $request)
    {
        $horseProfileObject = new \Bo\Profile\Horse($request->getHorseId());

        $this->setResult(
            (new \Api\Result\HorseProfile\Pedigree())->setData(
                (Object)['pedigree' => $horseProfileObject->getPedigree()]
            )
        );
    }

    /**
     * @param \Api\Input\Request\Horses\Profile\Horse\Form $request
     *
     * @throws \Exception
     */
    public function actionGetForm(\Api\Input\Request\Horses\Profile\Horse\Form $request)
    {
        $horseProfileObject = new \Bo\Profile\Horse($request->getHorseId());

        $this->setResult(
            (new \Api\Result\HorseProfile\Form())
                ->setData(
                    (Object)['form' => $horseProfileObject->getForm($request->getReturnP2P())]
                )
        );
    }

    /**
     * @param \Api\Input\Request\Horses\Profile\Horse\Wins $request
     *
     * @throws \Exception
     */
    public function actionGetWins(\Api\Input\Request\Horses\Profile\Horse\Wins $request)
    {
        $horseProfileObject = new \Bo\Profile\Horse($request->getHorseId());

        $this->setResult(
            (new \Api\Result\HorseProfile\Wins())->setData(
                (Object)['wins' => $horseProfileObject->getWins()]
            )
        );
    }

    /**
     * @param \Api\Input\Request\Horses\Profile\Horse\MyRatings $request
     *
     * @throws \Exception
     */
    public function actionGetMyRatings(\Api\Input\Request\Horses\Profile\Horse\MyRatings $request)
    {
        $horseProfileObject = new \Bo\Profile\Horse($request->getHorseId());

        $this->setResult(
            (new \Api\Result\HorseProfile\MyRatings())->setData(
                (Object)['my_ratings' => $horseProfileObject->getMyRatings()]
            )
        );
    }

    /**
     * @param \Api\Input\Request\Horses\Profile\Horse\Statistics $request
     *
     * @throws \Exception
     */
    public function actionGetStatistics(\Api\Input\Request\Horses\Profile\Horse\Statistics $request)
    {
        $horseProfileObject = new \Bo\Profile\Horse($request->getHorseId());

        $this->setResult(
            (new \Api\Result\HorseProfile\Statistics())->setData(
                (Object)[
                    'statistics' => $horseProfileObject->getStatistics(
                        $request->getRaceTypeCodes()
                    ),
                ]
            )
        );
    }

    /**
     * @param \Api\Input\Request\Horses\Profile\Horse\Entries $request
     *
     * @throws \Exception
     */
    public function actionGetEntries(\Api\Input\Request\Horses\Profile\Horse\Entries $request)
    {
        $horseProfileObject = new \Bo\Profile\Horse($request->getHorseId());

        $this->setResult(
            (new \Api\Result\HorseProfile\Entries())->setData(
                (Object)['entries' => $horseProfileObject->getEntries($request, $request->getReturnP2P())]
            )
        );
    }

    /**
     * @param \Api\Input\Request\Horses\Profile\Horse\Relatives $request
     *
     * @throws \Api\Exception\NotFound
     * @throws \Exception
     */
    public function actionGetRelatives(\Api\Input\Request\Horses\Profile\Horse\Relatives $request)
    {
        $horseProfileObject = new \Bo\Profile\Horse($request->getHorseId());

        $this->setResult(
            (new \Api\Result\HorseProfile\Relatives())
                ->setData(
                    (Object)['relatives' => $horseProfileObject->getRelatives()]
                )
        );
    }

    /**
     * @param \Api\Input\Request\Horses\Profile\Horse\Sales $request
     *
     * @throws \Api\Exception\NotFound
     * @throws \Exception
     */
    public function actionGetSales(\Api\Input\Request\Horses\Profile\Horse\Sales $request)
    {
        $horseProfileObject = new \Bo\Profile\Horse($request->getHorseId());

        $this->setResult(
            (new \Api\Result\HorseProfile\Sales())->setData(
                (Object)['sales' => $horseProfileObject->getSales()]
            )
        );
    }

    /**
     * @param \Api\Input\Request\Horses\Profile\Horse\Quotes $request
     *
     * @throws \Exception
     */
    public function actionGetQuotes(\Api\Input\Request\Horses\Profile\Horse\Quotes $request)
    {
        $horseProfileObject = new \Bo\Profile\Horse($request->getHorseId());

        $this->setResult(
            (new \Api\Result\HorseProfile\Quotes())->setData(
                (Object)[
                    'quotes' => $horseProfileObject->getNotes(Constants::NOTES_TYPE_CODE_QUOTES_STR),
                    'stable_tour_quotes' => $horseProfileObject->getStableTourQuotes(),
                ]
            )
        );
    }

    /**
     * @param \Api\Input\Request\Horses\Profile\Horse\Notes $request
     *
     * @throws \Exception
     */
    public function actionGetNotes(\Api\Input\Request\Horses\Profile\Horse\Notes $request)
    {
        $horseProfileObject = new \Bo\Profile\Horse($request->getHorseId());

        $this->setResult(
            (new \Api\Result\HorseProfile\Notes())->setData(
                (Object)[
                    'notes' => $horseProfileObject->getNotes(Constants::NOTES_TYPE_CODE_NOTES_STR, true),
                    'eyecatcher' => $horseProfileObject->getNotes(Constants::NOTES_TYPE_CODE_EYECATCHER_STR, true, true),
                    'star_performer' => $horseProfileObject->getNotes(Constants::NOTES_TYPE_CODE_STAR_PERFORMER_STR, true, true)
                ]
            )
        );
    }


    /**
     * @param \Api\Input\Request\Horses\Profile\Horse\MyNotes $request
     *
     * @throws \Exception
     */
    public function actionGetMyNotes(\Api\Input\Request\Horses\Profile\Horse\MyNotes $request)
    {
        $horseProfileObject = new \Bo\Profile\Horse($request->getHorseId());

        $this->setResult(
            (new \Api\Result\HorseProfile\MyNotes())->setData(
                (Object)['my_notes' => $horseProfileObject->getMyNotes()]
            )
        );
    }

    /**
     * @param Request\GoingForm $request
     *
     * @throws \Exception
     */
    public function actionGetGoingForm(\Api\Input\Request\Horses\Profile\Horse\GoingForm $request)
    {
        $bo = new \Bo\Profile\Horse\GoingForm((array)$request->getHorseId());

        $this->setResult(
            (new \Api\Result\HorseProfile\GoingForm())->setData(
                (Object)['going_form' => $bo->prepareRows($bo->getRows())]
            )
        );
    }

    /**
     * @param \Api\Input\Request\Horses\Profile\Horse\AllEntries $request
     * @throws \Exception
     */
    public function actionGetAllEntries(\Api\Input\Request\Horses\Profile\Horse\AllEntries $request)
    {
        $horseProfileObject = new \Bo\Profile\Horse($request->getHorseId());

        $this->setResult(
            (new \Api\Result\HorseProfile\AllEntries())->setData(
                (Object)['all_entries' => $horseProfileObject->getEntries($request, $request->getReturnP2P())]
            )
        );
    }

    public function initialize()
    {
        parent::initialize();
        $ca = $this->getContentAttributes();
        /** @var Tags $tags */
        $tags = $ca->tags();
        $tags->addHorseGroup();
    }
}
