<?php

declare(strict_types=1);

namespace Bo\Native\Competitor;

use \Api\DataProvider\Bo\Native\Competitor\CompetitorDetails as DataProvider;
use Api\Output\Mapper\Methods\LegacyDecorators;
use \Api\Row\RaceInstance as RiRow;
use \Api\Exception\NotFound;
use Phalcon\DI;
use \Phalcon\Mvc\Model\Row;
use \Bo\Standart;
use Api\DataProvider\Bo\Rpr;
use \Api\Constants\Horses as Constants;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Url;

/**
 * @package Bo\Native\Competitor
 */
class CompetitorDetails extends Standart
{
    use LegacyDecorators;
    /**
     * @var DataProvider|null
     */
    private $dataProvider = null;
    const MAX_WEIGHT_FLAT = 140;
    const MAX_WEIGHT_JUMPS = 168;


    /**
     * @return DataProvider
     */
    protected function getDataProvider(): DataProvider
    {
        if (is_null($this->dataProvider)) {
            $this->dataProvider = new DataProvider();
        }
        return $this->dataProvider;
    }


    /**
     * @param int $raceId
     * @return RiRow
     * @throws NotFound
     */
    public function getCourseData(int $raceId): ?RiRow
    {
        $dataProvider = $this->getDataProvider();

        if (!$dataProvider->isRaceExists($raceId)) {
            $exception = new NotFound(15011, $raceId);
            throw $exception;
        }

        return $dataProvider->getCourseDetails($raceId);
    }


    /**
     * @param int $horseId
     * @param int $raceId
     * @return Row
     * @throws NotFound
     */
    public function getCompetitorData(int $horseId, int $raceId): Row
    {
        $dataProvider = $this->getDataProvider();

        if (!$dataProvider->isHorseExists($horseId)) {
            $exception = new NotFound(15010, $horseId);
            throw $exception;
        }
        if (!$dataProvider->isHorseExistsInRace($horseId, $raceId)) {
            $exception = new NotFound(15000, [$horseId, $raceId]);
            throw $exception;
        }

        $db = new \Models\Bo\Selectors\Database();
        $competitorDetails = $dataProvider->getCompetitorDetails($horseId, $raceId);

        $tipsQ = $db->getTipsQuantity(
            $raceId,
            $competitorDetails->course_country,
            [$horseId]
        );

        foreach ($tipsQ as $tip) {
            if ($tip->horse_uid == $horseId) {
                $competitorDetails->tips_qty = $tip->c;
            }
        }

        $fullCardDataProvider = $this->getFullCardDataProvider();

        $daysSinceRun = $fullCardDataProvider->getDaysSinceLastRun(array($horseId), $competitorDetails->race_datetime, $this->getRaceTypeGroup($competitorDetails->race_type_code));

        if (count($daysSinceRun)) {
            $competitorDetails->days_since_run = $this->formatDaysSinceRun($daysSinceRun, $competitorDetails->race_type_code);
        }

        if ($competitorDetails === null) {
            $exception = new NotFound(15000, [$horseId, $raceId]);
            throw $exception;
        }
        if (!$competitorDetails->race_datetime) {
            $competitorDetails->race_datetime = date('Y-m-d');
        }

        $winningRaces = $dataProvider->getWinningRaces($horseId, $competitorDetails->race_datetime);

        if ($winningRaces) {
            foreach ($winningRaces as $race) {
                if ($race->course_uid == $competitorDetails->course_uid) {
                    $competitorDetails->course_wins = 1;
                }

                $adjDistance = strpos(Constants::RACE_TYPE_FLAT, $competitorDetails->race_type_code) !== false
                    ? ($competitorDetails->distance_yard < 1761) ? 55 : 110
                    : 219;

                if (($competitorDetails->distance_yard >= ($race->distance_yard - $adjDistance))
                    && ($competitorDetails->distance_yard <= ($race->distance_yard + $adjDistance))) {
                    $competitorDetails->distance_wins = 1;
                }
            }
        }

        $beatenFavourites = $this->getModelRunners()->getBeatenFavourites(
            [$competitorDetails->competitor_id],
            $competitorDetails->race_type_code,
            $competitorDetails->race_datetime
        );

        $competitorDetails->beaten_favourite = isset($beatenFavourites[$competitorDetails->competitor_id]) ? 'Y' : 'N';


        if ($competitorDetails->distance_wins && $competitorDetails->course_wins) {
            $competitorDetails->course_and_distance_wins = 1;
        }

        $competitorDetails->pedigree = $this->getPedigree($competitorDetails);

        // We need to take information from horse_race with priority
        // if it is missing we need to set the one from pre_horse_race for jockey uid nad name
        $competitorDetails->jockey_uid = $competitorDetails->j_jockey_uid ?? $competitorDetails->jp_jockey_uid;
        $competitorDetails->jockey_name = $competitorDetails->j_style_name ?? $competitorDetails->jp_style_name;

        $competitorDetails->jockey_data = new \stdClass();
        $competitorDetails->jockey_data->last_14_days = new \stdClass();
        $competitorDetails->jockey_data->name = $competitorDetails->jockey_name;


        $competitorDetails->jockey_last_14_days = $this->getJockeyLast14Days($competitorDetails->jockey_uid);
        if (is_null($competitorDetails->jockey_last_14_days) === false) {
            $competitorDetails->jockey_data->last_14_days->wins = $competitorDetails->jockey_last_14_days->wins;
            $competitorDetails->jockey_data->last_14_days->runs = $competitorDetails->jockey_last_14_days->runs;
            $competitorDetails->jockey_data->last_14_days->percent = ($competitorDetails->jockey_last_14_days->runs > 0) ? round((100 * $competitorDetails->jockey_last_14_days->wins) / $competitorDetails->jockey_last_14_days->runs) : null;
            $competitorDetails->jockey_data->last_14_days->empty = false;
        } else {
            $competitorDetails->jockey_data->last_14_days->empty = true;
        }

        $competitorDetails->trainer_data = new \stdClass();
        $competitorDetails->trainer_data->last_14_days = new \stdClass();
        $competitorDetails->trainer_data->name = $competitorDetails->trainer_name;


        $competitorDetails->trainer_last_14_days = $this->getTrainerLast14Days($competitorDetails->trainer_uid);
        if (is_null($competitorDetails->trainer_last_14_days) === false) {
            $competitorDetails->trainer_data->last_14_days->wins = $competitorDetails->trainer_last_14_days->wins;
            $competitorDetails->trainer_data->last_14_days->runs = $competitorDetails->trainer_last_14_days->runs;
            $competitorDetails->trainer_data->last_14_days->percent = ($competitorDetails->trainer_last_14_days->runs > 0) ? round((100 * $competitorDetails->trainer_last_14_days->wins) / $competitorDetails->trainer_last_14_days->runs) : null;
            $competitorDetails->trainer_data->last_14_days->empty = false;
        } else {
            $competitorDetails->trainer_data->last_14_days->empty = true;
        }

        $runnersBO = new \Bo\RaceCards\Runners($raceId);
        $horseDetails = [$horseId => $competitorDetails];
        $runnersBO->addRatings($horseDetails, [$raceId], true);

        return $horseDetails[$horseId];
    }

    private function formatDaysSinceRun($daysSinceRun, $raceType) : string
    {
        $result = '';
        $raceTypeGroup = $this->getRaceTypeGroup($raceType);
        foreach ($daysSinceRun as $lastRaceInfo) {
            // Check if previous race_type is not the same as current race_type,
            // then present the value with brackets and race_type added at the end.
            $currentRaceType = $this->getRaceTypeGroup($lastRaceInfo->race_type_code);
            if ($currentRaceType != $raceTypeGroup) {
                $daysSinceRun = ' (' . $lastRaceInfo->days_since_run . $currentRaceType . ')';
            } else {
                $daysSinceRun = (string)$lastRaceInfo->days_since_run;
            }
            $result .= $daysSinceRun;
        }
        return $result;
    }

    /**
     * @param    array $races
     * @return  array
     */
    public function getRaceRecords(?array $races): ?array
    {
        if (!$races) {
            return null;
        }
        $model = new \Models\Horse();
        return $model->getRaceRecords($races);
    }

    /**
     * Return list with all races for horse before certain date
     *
     * @param int $horseId
     * @param string $raceDate
     * @return array
     */
    public function getCompetitorResults(int $horseId, string $raceDate): array
    {
        $dataProvider = $this->getDataProvider();

        $competitorResults = $dataProvider->getCompetitorResults($horseId, $raceDate);

        return $competitorResults;
    }


    /**
     * @param   int $jockey_uid
     * @param   string $race_type_code
     * @return  \Api\Row\RaceCards\Stats
     */
    private function getJockeyLast14Days(?int $jockey_uid): ?\Phalcon\Mvc\Model\Row
    {
        if (!$jockey_uid) {
            return null;
        }

        return $this->dataProvider->getJockeyInfo($jockey_uid);
    }


    /**
     * @param   int $trainer_uid
     * @param   string $race_type_code
     * @return  \Api\Row\RaceCards\Stats
     */
    private function getTrainerLast14Days(?int $trainer_uid): ?\Phalcon\Mvc\Model\Row
    {
        if (!$trainer_uid) {
            return null;
        }

        return $this->dataProvider->getTrainerInfo($trainer_uid);
    }


    /**
     * Returns "pedigree" field falue
     * @param   Row|null $competitorDetails
     * @return  string
     */
    private function getPedigree(?Row $competitorDetails): string
    {
        $pedigree = '';

        $pedigree .= $this->prepareHorseName(
            $competitorDetails->sire_name,
            $competitorDetails->sire_country_origin_code,
            $competitorDetails->sire_avg_flat_win_dist_of_progeny
        );

        $pedigree .= '&mdash; ';

        $pedigree .= $this->prepareHorseName($competitorDetails->dam_name, $competitorDetails->dam_country_origin_code);

        $pedigree .= $this->prepareHorseName(
            $competitorDetails->dam_sire_name,
            $competitorDetails->dam_sire_country_origin_code,
            $competitorDetails->dam_sire_avg_flat_win_dist_of_progeny,
            true
        );

        return $pedigree;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\RaceCards\Runners
     */
    protected function getModelRunners()
    {
        return new \Models\Bo\RaceCards\Runners();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Horse
     */
    protected function getModelHorse()
    {
        return new \Models\Horse();
    }

    protected function getFullCardDataProvider()
    {
        return new \Api\DataProvider\Bo\Native\Cards\FullCard\Data();
    }
}
