<?php

namespace Bo;

/**
 * Class SeasonalStatistics
 * @package Bo
 */
class SeasonalStatistics extends Profile
{
    /**
     * @return \Models\Bo\SeasonalStatistics\Trainer
     *
     * @codeCoverageIgnore
     */
    protected function getModelTrainer()
    {
        return new \Models\Bo\SeasonalStatistics\Trainer();
    }

    /**
     * @return array
     * @throws \Api\Exception\InternalServerError
     * @throws \Api\Exception\ValidationError
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getTrainerStatistics()
    {
        return $this->getModelTrainer()->getSeasonalStatistics($this->request);
    }

    /**
     * @return \Models\Bo\SeasonalStatistics\Jockey
     *
     * @codeCoverageIgnore
     */
    protected function getModelJockey()
    {
        return new \Models\Bo\SeasonalStatistics\Jockey();
    }

    /**
     * @return array
     * @throws \Api\Exception\InternalServerError
     * @throws \Api\Exception\ValidationError
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getJockeyStatistics()
    {
        return $this->getModelJockey()->getSeasonalStatistics($this->request);
    }

    /**
     * @return \Models\Bo\SeasonalStatistics\Horse
     *
     * @codeCoverageIgnore
     */
    protected function getModelHorse()
    {
        return new \Models\Bo\SeasonalStatistics\Horse();
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getHorseStatistics()
    {
        return $this->getModelHorse()->getSeasonalStatistics($this->request);
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getChampionshipsAvailable()
    {
        return $this->getModelSeason()->getChampionshipsAvailable(
            $this->request->getChampionship(),
            $this->getModelSelectors()
        );
    }

    /**
     * @return array
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getSeasonsAvailable()
    {
        $seasonsAvailable = $this->getModelSeason()->getSeasonsAvailable($this->request);
        $selectors = $this->getModelSelectors();

        foreach ($seasonsAvailable as $season) {
            $season->country_code = $selectors->getCountryCodesBySeasonType($season->season_type_code);
        }

        return $seasonsAvailable;
    }

    /**
     * @return \Models\Bo\SeasonalStatistics\Season
     *
     * @codeCoverageIgnore
     */
    public function getModelSeason()
    {
        return new \Models\Bo\SeasonalStatistics\Season();
    }

    /**
     * @return \Models\Bo\SeasonalStatistics\Owner
     *
     * @codeCoverageIgnore
     */
    protected function getModelOwner()
    {
        return new \Models\Bo\SeasonalStatistics\Owner();
    }

    /**
     * @return array
     * @throws \Api\Exception\InternalServerError
     * @throws \Api\Exception\ValidationError
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getOwnerStatistics()
    {
        return $this->getModelOwner()->getSeasonalStatistics($this->request);
    }

    /**
     * @return \Models\Bo\SeasonalStatistics\FirstCrop
     *
     * @codeCoverageIgnore
     */
    protected function getModelFirstCrop()
    {
        return new \Models\Bo\SeasonalStatistics\FirstCrop();
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getFirstCropStatistics()
    {
         return $this->getStatistics($this->getModelFirstCrop(), 'sire_uid');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getSireStatistics()
    {
        return $this->getStatistics($this->getModelSire(), 'sire_uid');
    }

    /**
     * @return \Models\Bo\SeasonalStatistics\Sire
     *
     * @codeCoverageIgnore
     */
    protected function getModelSire()
    {
        return new \Models\Bo\SeasonalStatistics\Sire();
    }

    /**
     * @return \Models\Bo\SeasonalStatistics\BroodmareSire
     *
     * @codeCoverageIgnore
     */
    protected function getModelBroodmareSire()
    {
        return new \Models\Bo\SeasonalStatistics\BroodmareSire();
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getBroodmareSireStatistics()
    {
        return $this->getStatistics($this->getModelBroodmareSire(), 'dam_sire_uid');
    }

    /**
     * @param \Models\Bo\SeasonalStatistics\Sire $model
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    private function getStatistics($model, $fieldName)
    {
        $sires = $model->getSeasonalStatistics($this->request);
        $progenyPerformersLimit = $this->request->getProgenyPerformersLimit();
        $progenyPerformers = $model->getProgenyPerformers($progenyPerformersLimit);

        foreach ($sires as $id => $sire) {
            $sires[$id]->progeny_performers = (array_key_exists($sire->{$fieldName}, $progenyPerformers))
                ? array_slice(
                    array_values($progenyPerformers[$sire->{$fieldName}]),
                    0,
                    $progenyPerformersLimit
                )
                : null;
        }

        return $sires;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\SeasonalStatistics\Season
     */
    protected function getDataProviderDefaultInfo()
    {
        return $this->getModelSeason();
    }
}
