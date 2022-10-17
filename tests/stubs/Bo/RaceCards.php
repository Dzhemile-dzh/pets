<?php

namespace Tests\Stubs\Bo;

use Tests\Stubs\DataProvider\Bo\RaceCards\StarRating;

class RaceCards extends \Bo\RaceCards
{
    /**
     * @return \Tests\Stubs\Models\Bo\RaceCards\RaceInstance
     */
    protected function getModelRaceInstance()
    {
        return new \Tests\Stubs\Models\Bo\RaceCards\RaceInstance();
    }

    /**
     * @return \RaceInstancePrize|\Tests\Stubs\Models\RaceInstancePrize
     */
    protected function getModelRaceInstancePrize()
    {
        return new \Tests\Stubs\Models\RaceInstancePrize();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\RaceCards\PostdataResultsNew
     */
    protected function getModelPostdataResultsNew()
    {
        return new \Tests\Stubs\Models\Bo\RaceCards\PostdataResultsNew();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\RaceCards\TipsterSelection
     */
    protected function getModelTipsterSelection()
    {
        return new \Tests\Stubs\Models\Bo\RaceCards\TipsterSelection();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\RaceCards\Trainer
     */
    protected function getModelTrainer()
    {
        return new \Tests\Stubs\Models\Bo\RaceCards\Trainer();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\RaceCards\Jockey
     */
    protected function getModelJockey()
    {
        return new \Tests\Stubs\Models\Bo\RaceCards\Jockey();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\RaceCards\Horse
     */
    protected function getModelHorse()
    {
        return new \Tests\Stubs\Models\Bo\RaceCards\Horse();
    }

    /**
     * @return \Tests\Stubs\Models\Season
     */
    public function getModelSeason()
    {
        return new \Tests\Stubs\Models\Season();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\RaceCards\HorseNotes
     */
    protected function getModelHorseNotes()
    {
        return new \Tests\Stubs\Models\Bo\RaceCards\HorseNotes();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\RaceCards\PreHorseRace
     */
    protected function getModelPreHorseRace()
    {
        return new \Tests\Stubs\Models\Bo\RaceCards\PreHorseRace();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\RaceCards\SsNatPress
     */
    protected function getModelSsNatPress()
    {
        return new \Tests\Stubs\Models\Bo\RaceCards\SsNatPress();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\RaceCards\HorseRace
     */
    protected function getModelHorseRace()
    {
        return new \Tests\Stubs\Models\Bo\RaceCards\HorseRace();
    }

    /**
     * @return \Tests\Stubs\Bo\TrainerProfile
     */
    protected function getBoTrainerProfile()
    {
        return new \Tests\Stubs\Bo\TrainerProfile($this->request);
    }

    /**
     * @return \Tests\Stubs\Models\Bo\RaceCards\TodaysTrainers
     */
    protected function getDataProviderTodaysTrainers()
    {
        return new \Tests\Stubs\Models\Bo\RaceCards\TodaysTrainers();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\RaceCards\TodaysJockeys
     */
    protected function getDataProviderTodaysJockeys()
    {
        return new \Tests\Stubs\Models\Bo\RaceCards\TodaysJockeys();
    }

    /**
     * @return StarRating
     */
    protected function getDataProviderStarRating()
    {
        return new StarRating();
    }

    /**
     * @return \Bo\RaceCards\RaceWFA|RaceCards\RaceWFA
     * @throws \Api\Exception\InternalServerError
     */
    protected function getRaceWFAInstance()
    {
        $raceId = $this->request->getRaceId();
        $bo = new \Tests\Stubs\Bo\RaceCards\RaceWFA($raceId);
        $dataProvider = new \Tests\Stubs\DataProvider\Bo\RaceCards\RaceWFA();
        $dataProvider->setKey($raceId);
        $bo->setDataProvider($dataProvider);

        return $bo;
    }

    /**
     * @param array $raceIDs
     *
     * @return VideoProviders
     */
    protected function getVideoProviders($raceIDs)
    {
        return new \Tests\Stubs\Bo\VideoProviders($raceIDs);
    }
}
