<?php

declare(strict_types=1);

namespace Bo;

use Phalcon\Mvc\Model;
use \Api\Constants\Horses as Constants;
use \Api\DataProvider\Bo\Predictor\RaceInstance as DataProvider;
use \Api\Row\RaceInstance as RiRow;
use \Api\Exception\InternalServerError;
use \Api\Exception\NotFound;
use \Phalcon\Mvc\Model\Resultset\ResultsetException;

/**
 * Class Predictor
 *
 * @package Bo
 */
class Predictor extends Standart
{

    const VALUE_GOING_IS_RACE_GOOD = 'Good';

    const HORSE_PREDICTOR_RUNNERS_QTY = 6;

    private $raceId = null;

    private $race = null;

    private $horses = null;

    private $postData = null;

    private $postDataByHorse = null;

    private $raceValidatorCallbacks = [
        [self::class, 'validateCountryAndStatus']
    ];

    /**
     * @var array Use this variable for a resolve the double pairs 0 => RPR, 1 => top_speed, 2 => form_points
     */
    private $resolveData = [];

    /**
     * It's more easy to control all values in one place. For explanation look at
     * {@link https://docs.google.com/Doc?docid=0ASIlsxr1x3kmZGY0cThrZDlfMTNjNW5wYnFnaw&hl=en document}.
     *
     * @var array
     */
    private static $variablesWeights = [
        'ability' => [
            'aaa' => 3.5,
            'aa' => 3,
            'a' => 0.5
        ],
        'recentForm' => [
            'aa' => 1.25,
            'a' => 0.5
        ],
        'going' => [
            'aa' => 1,
            'a' => 0.5
        ],
        'distance' => ['a' => 0.5],
        'course' => [
            'aa' => 0.75,
            'a' => 0.25
        ],
        'trainerForm' => [
            'aa' => 0.75,
            'a' => 0.5
        ],
        'trainer1stTime' => [
            'aaa' => 4.5,
            'aa' => 4,
            'a' => 2.5
        ],
        'draw' => [
            'aa' => 1,
            'a' => 0.5,
            'X' => 1
        ],
        'firstTimeBlinkers' => ['XJ' => 0.25]
    ];

    /**
     * @var float Increased value for resolver
     */
    private $increasedValue = 0.2;

    /**
     * @var DataProvider|null
     */
    private $dataProvider = null;

    /**
     * Predictor constructor.
     *
     * @param int $raceId
     *
     * @throws \Exception
     */
    public function __construct(int $raceId)
    {
        if (!is_numeric($raceId) || $raceId <= 0) {
            throw new \Exception('Wrong raceId');
        }

        $this->raceId = (int)$raceId;
    }

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
     * Calculate prediction parameters for all horses
     *
     * @return array|null
     * @throws InternalServerError
     * @throws NotFound
     */
    private function calculatePredictorData(): ? array
    {
        $result = [];

        foreach ($this->getHorses() as $horse) {
            if (!isset($this->getPostDataByHorse()[$horse->horse_id])) {
                // if this horse has been eliminated, skipping it
                continue;
            }
            $result[$horse->horse_id] = $this->defineVariablesForSingleHorse($horse);
        }

        return empty($result) ? null : $result;
    }

    /**
     * Get race instance
     *
     * @return RiRow|null
     * @throws ResultsetException
     * @throws NotFound
     */
    public function getRace(): ? RiRow
    {
        $errors = [];
        if (!empty($this->race)) {
            return $this->race;
        }

        $dataProvider = $this->getDataProvider();

        if (!$dataProvider->isRaceExists($this->raceId)) {
            $exception = new NotFound(1114, $this->raceId);
            $exception->setRace($this->race);
            throw $exception;
        } else {
            $this->race = $dataProvider->getRace($this->raceId);
        }

        if (!empty($this->race)) {
            $this->validateRace();
            $this->race->race_timestamp = strtotime($this->race->race_datetime);
        }

        return $this->race;
    }

    private function validateRace(): void
    {
        foreach ($this->raceValidatorCallbacks as $callback) {
            call_user_func($callback, $this->race);
        }
    }

    /**
     * @param RiRow $race
     *
     * @throws NotFound
     */
    public static function validateCountryAndStatus(RiRow $race): void
    {
        if (!in_array(trim($race->country_code), ['GB', 'IRE'])) {
            $errors[] = 1101;
        }
        if ($race->race_status_code != Constants::getConstantValue(Constants::RACE_STATUS_OVERNIGHT)) {
            $errors[] = 1102;
        }

        if (!empty($errors)) {
            $exception = new NotFound($errors, $race->race_instance_uid);
            $exception->setRace($race);
            throw $exception;
        }
    }

    /**
     * @param array $callbacks
     */
    public function setRaceValidators(array $callbacks): void
    {
        foreach ($callbacks as $callback) {
            if (!is_callable($callback)) {
                throw new \LogicException('Bad callback provided: ' . var_export($callback, true));
            }
        }
        $this->raceValidatorCallbacks = $callbacks;
    }


    /**
     * Get horses for given race
     *
     * @return array
     */
    private function getHorses(): array
    {
        if (!empty($this->horses)) {
            return $this->horses;
        }

        $dp = $this->getDataProvider();
        if (!$dp->isRaceExists($this->raceId)) {
            return [];
        }

        $this->horses = $dp->getHorses($this->raceId);

        return $this->horses;
    }

    /**
     * Get horses post data for given race
     *
     * @return array
     * @throws NotFound
     */
    private function getPostData(): array
    {
        if (is_null($this->postData)) {
            $this->postData = $this->getDataProvider()->getPostdata($this->raceId);

            if (empty($this->postData)) {
                throw new NotFound(1105, $this->raceId);
            }
        }

        return $this->postData;
    }

    /**
     * Index post data by horse_uid and remove not used data
     *
     * @return array
     * @throws InternalServerError
     * @throws NotFound
     */
    private function getPostDataByHorse(): array
    {
        if (!empty($this->postDataByHorse)) {
            return $this->postDataByHorse;
        }
        /** eliminating non-runners first, because it is less resource-harmfull operation
         * than eliminating debutants and we have chance to eliminate debutant as non-runner */
        $this->getPostData();
        $this->eliminateNonRunners();
        $this->eliminateDebutants();
        $this->keepResolveData();

        $this->postDataByHorse = [];

        foreach ($this->postData as $postDatum) {
            $this->postDataByHorse[$postDatum->horse_uid] = $postDatum;
        }

        return $this->postDataByHorse;
    }

    /**
     * Keep data for resolve doubles in compatible array
     */
    private function keepResolveData(): void
    {
        foreach ($this->postData as $item) {
            $this->resolveData[$item->horse_uid] = [
                0 => $item->RPR,
                1 => $item->top_speed,
                2 => $item->form_points
            ];
        }
    }

    /**
     * Non-runners shouldn't be shown in predictor
     *
     * @throws InternalServerError
     */
    private function eliminateNonRunners(): void
    {
        $runners = $this->getHorses();

        if (!empty($runners) && !empty($this->postData)) {
            foreach ($this->postData as $key => $postDatum) {
                if (!isset($runners[$postDatum->horse_uid])) {
                    throw new InternalServerError(
                        1109,
                        $postDatum->horse_uid
                    );
                }
                if ($runners[$postDatum->horse_uid]->non_runner == self::VALUE_YES) {
                    unset($this->postData[$key]);
                }
            }
        }
    }

    /**
     * Eliminate debutants.
     *
     * Eliminate debutants if the trainer of the horse has another runner in the race that is not a debutant
     * and that horse is ridden by a jockey whose total of wins since the start of the previous season is greater
     * than the total of wins in the same period for the jockey riding the debutant.
     *
     * {@link https://docs.google.com/Doc?docid=0ASIlsxr1x3kmZGY0cThrZDlfMTNjNW5wYnFnaw&hl=en document}.
     * @internal param array $cardPostData
     *
     * @return    array
     */
    private function eliminateDebutants()
    {

        $trainersHorses = [];
        $eliminationList = [];
        foreach ($this->postData as $postDatum) {
            if ($postDatum->trainer_id) {
                $trainersHorses[$postDatum->trainer_id][] = $postDatum;
            }
        }

        foreach ($trainersHorses as $trainerHorses) {
            if (count($trainerHorses) >= 2) {
                $debutants = $nonDebutants = [];
                foreach ($trainerHorses as $horse) {
                    if ($horse->is_first_time == self::VALUE_YES) {
                        $debutants[$horse->horse_uid] = $horse->jockey_wins
                            + $horse->jockey_stable_wins;
                    } else {
                        $nonDebutants[$horse->horse_uid] = $horse->jockey_wins
                            + $horse->jockey_stable_wins;
                    }
                }
                foreach ($debutants as $horseId => $debutant) {
                    foreach ($nonDebutants as $nonDebutant) {
                        if ($debutant < $nonDebutant) {
                            $eliminationList[] = $horseId;
                        }
                    }
                }
            }
        }

        if (count($eliminationList) > 0) {
            foreach ($this->postData as $key => $postDatum) {
                if (in_array($postDatum->horse_uid, $eliminationList)) {
                    unset($this->postData[$key]);
                }
            }
        }
    }

    /**
     * @see        calculatePredictorData()
     *
     * @param    Model\Row $horse
     *
     * @return    Model\Row\General
     */
    private function defineVariablesForSingleHorse(Model\Row $horse)
    {

        $postDataOfHorse = $this->getPostDataByHorse()[$horse->horse_id];

        $result = new Model\Row\General();

        $result->ability = $this->variableWeight(
            'ability',
            $postDataOfHorse->ability_output
        );
        $result->recentForm = $this->variableWeight(
            'recentForm',
            $postDataOfHorse->recent_form_output
        );
        $result->going = $this->defineGoing($postDataOfHorse->going_output);
        $result->distance = $this->defineDistance(
            $postDataOfHorse->distance_output
        );
        $result->course = $this->variableWeight(
            'course',
            $postDataOfHorse->course_output
        );
        $result->trainerForm = $this->variableWeight(
            'trainerForm',
            $postDataOfHorse->trainer_form_output
        );
        $result->group = $this->defineGroup($postDataOfHorse->group_race);
        $result->draw = $this->variableWeight(
            'draw',
            $postDataOfHorse->draw_output
        );
        $result->trap = $horse->start_number;
        $result->ownerId = $horse->owner_uid;
        $result->ownerChoise = $horse->owner_choice;
        $result->horseId = $horse->horse_id;
        $result->horseName = $horse->style_name;
        $result->countryOriginCode = $horse->country_origin_code;

        /** this value is for both "trainers 1st time" and "trainers NHF", because the can't be both in postdata
         * at the same time */
        $result->trainer1stTime = $this->variableWeight(
            'trainer1stTime',
            $postDataOfHorse->trainer_record_output
        );

        // those points that couldn't be affected by sliders
        $result->sliderlessPoints = 0;

        /** minus 0.25 if jockey has not ridden a winner (any code) within last 12 months
         * (indicated by XJ before horse?s name KS: jockey_no_wins_flag), and because
         * there's only two values - "XJ" and NULL we just checking fot non-emptiness */
        $result->sliderlessPoints += (bool)$postDataOfHorse->jockey_no_wins_flag
            ? (0 - 0.25) : 0;

        // Add 0.25 for b1 (KS: First time blinkers) if horse has at least 2 ticks in ability column
        $result->sliderlessPoints += $this->defineFirstTimeBlinkers(
            $postDataOfHorse->first_time_blinkers,
            $result->ability
        );
        return $result;
    }

    /**
     * Common variable handling routines are here.
     *
     * @param    string $variableName  "ability", "firstTimeBlinker" etc.
     * @param    string $postDataValue db-data
     *
     * @return    float
     */
    private function variableWeight($variableName, $postDataValue)
    {
        $trimmedPostDataValue = trim($postDataValue);
        if (!isset(self::$variablesWeights[$variableName][$trimmedPostDataValue])) {
            $res = 0;
        } else {
            $res = self::$variablesWeights[$variableName][$trimmedPostDataValue];
        }
        return $res;
    }

    /**
     * Ignore going column if good
     *
     * @param string $value
     *
     * @return float
     * @throws NotFound
     * @throws ResultsetException
     */
    private function defineGoing(string $value): float
    {
        $raceInfo = $this->getRace();
        if (isset($raceInfo->going) && strpos($raceInfo->going, self::VALUE_GOING_IS_RACE_GOOD)
            !== false
        ) {
            return 0;
        } else {
            return $this->variableWeight('going', $value);
        }
    }

    /**
     * Ignore distance column for "JUMP" below 2m2.5f; for "FLAT" below 7f only for 2yo races.
     *
     * @param string $value
     *
     * @return float
     * @throws NotFound
     * @throws ResultsetException
     */
    private function defineDistance(string $value): float
    {
        $raceInfo = $this->getRace();
        $furLongDistance = round($raceInfo->distance_yard / 220, 1);

        //(18.5 furlong = 2m2.5f)
        if (($raceInfo->isJumpRace() && $furLongDistance < 18.5)
            || (!$raceInfo->isJumpRace() && $furLongDistance < 7
                && $raceInfo->ages_allowed == '2yo')
        ) {
            return 0;
        } else {
            return self::variableWeight('distance', $value);
        }
    }

    /**
     * If any row has a value other than NULL or "" then we count that as having data.
     *
     * @param    string $value
     *
     * @return    float
     */
    private function defineGroup($value)
    {
        $value = trim($value);
        return !empty($value) ? 0.25 : 0;
    }

    /**
     *  Add 0.25 for b1 (KS: First time blinkers) if horse has at least 2 ticks in ability column
     *
     * @param    string $value
     * @param    float  $ability
     *
     * @return   float
     */
    protected function defineFirstTimeBlinkers($value, $ability)
    {
        if ($ability >= 2) {
            return self::variableWeight('firstTimeBlinkers', $value);
        } else {
            return 0;
        }
    }

    /**
     * @return array
     * @throws InternalServerError
     * @throws NotFound
     * @throws ResultsetException
     */
    public function getPointsData(): array
    {
        $raceInfo = $this->getRace();
        if (empty($raceInfo)) {
            return [];
        }
        $calculatedPredictorData = $this->calculatePredictorData();

        if (is_array($calculatedPredictorData)
            && !empty($calculatedPredictorData)
        ) {
            foreach ($calculatedPredictorData as $horse) {
                $calculatedPredictorData[$horse->horseId]->points =
                    $horse->ability + $horse->recentForm + $horse->going +
                    $horse->distance + $horse->course + $horse->trainerForm
                    + $horse->group +
                    $horse->draw + $horse->trainer1stTime;
            }

            uasort($calculatedPredictorData, [$this, 'sortResults']);

            $calculatedPredictorData = array_slice(
                $calculatedPredictorData,
                0,
                self::HORSE_PREDICTOR_RUNNERS_QTY,
                true
            );

            $this->resolveEqualPoints($calculatedPredictorData);
            uasort($calculatedPredictorData, [$this, 'sortResults']);
            reset($calculatedPredictorData);
            $max = current($calculatedPredictorData)->points;
            /*
             * Normalizing points values.
             */
            foreach ($calculatedPredictorData as $horse) {
                if ($max == 0) {
                    $horse->points = 0;
                } else {
                    $horse->points = $horse->points * 100 / $max;
                }
            }
        }
        // we sort the array to return the value of trap in ascending order.
        uasort($calculatedPredictorData, function ($a, $b) {
            return $a->trap <=> $b->trap;
        });
        return $calculatedPredictorData;
    }

    /**
     * API-83 Removing the possibility of dead-heats in Predictor races
     *
     * @param array $predictorData
     *
     * @internal param array $calculatedPredictorData
     *
     * @throws InternalServerError
     */
    private function resolveEqualPoints(array &$predictorData): void
    {
        $pairs = $this->getEqualPairsByPoints($predictorData);

        foreach ($pairs as $pair) {
            $this->increasedValue = 0.2;
            $this->resolvePair($pair, $predictorData);
        }
    }

    /**
     * Recursive method that adds increased value to points or does nothing if all resolve data equals
     *
     * @param array $pair
     * @param array $predictorData
     *
     * @throws InternalServerError
     */
    private function resolvePair(array $pair, array &$predictorData): void
    {
        $maxDataId = 0;
        $bestFound = false;
        $lastId = null;
        $data = null;

        //depth of comparison
        for ($i = 0; $i < 3; $i++) {
            foreach ($pair as $k => $raceId) {
                $compare = $this->compareResolveData(
                    $this->resolveData[$raceId],
                    $this->resolveData[$pair[$maxDataId]],
                    $i
                );

                if ($compare == 1) {
                    $bestFound = true;
                    $maxDataId = $k;
                } elseif ($compare == -1) {
                    $bestFound = true;
                }
            }

            if ($bestFound) {
                $predictorData[$pair[$maxDataId]]->points += $this->increasedValue;
                $this->increasedValue -= ($this->increasedValue > 0.01) ? 0.01
                    : 0.001;
                $pair = $this->removeValueFromArray($pair, $maxDataId);
                if (sizeof($pair) > 1) {
                    $this->resolvePair($pair, $predictorData);
                }
                break;
            }
        }
    }

    /**
     * Remove array element by value
     *
     * @param array $neededArray
     * @param mixed $key
     *
     * @return array
     */
    private function removeValueFromArray(array $neededArray, $key): array
    {
        unset($neededArray[$key]);
        return array_values($neededArray);
    }

    /**
     * @param array|null $first
     * @param array|null $second
     * @param int        $equalType Must be in range 0,2
     *
     * @return int If equals - 0, If first greater than second 1 else -1.
     * @throws \Api\Exception\InternalServerError
     */
    private function compareResolveData($first, $second, $equalType): int
    {
        if ($first[$equalType] == $second[$equalType]) {
            return ($equalType < 2) ? $this->compareResolveData(
                $first,
                $second,
                $equalType + 1
            ) : 0;
        } else {
            return ($first[$equalType] > $second[$equalType]) ? 1 : -1;
        }
    }

    /**
     * Looking for an equal data by points
     *
     * @param array $predictorData
     *
     * @return array
     */
    private function getEqualPairsByPoints(array &$predictorData): array
    {
        $entries = [];

        foreach ($predictorData as $externalKey => $externalValue) {
            foreach ($predictorData as $internalKey => $internalValue) {
                if ($externalValue->points == $internalValue->points
                    && $externalKey != $internalKey
                ) {
                    $entries[(string)$internalValue->points][] = $internalKey;
                }
            }
        }

        return $entries;
    }

    /**
     * Sorting function for the asort method.
     *
     * @param Model\Row $a current element of array
     * @param Model\Row $b next element of array
     *
     * @return integer
     */
    private function sortResults($a, $b): int
    {
        return [$b->points, $a->trap] <=> [$a->points, $b->trap];
    }
}
