<?php

namespace Bo\BetPrompts;

use Bo\Standart;
use Bo\BetPrompts;
use Api\Input\Request\Horses\Signposts as Request;

/**
 * Class Signposts
 * @package Bo\BetPrompts
 */
class Signposts extends Standart
{
    const BEST_BET_HOT_TRAINERS = 6;
    const BEST_BET_AHEAD_OF_HANDICAPPER = 4;
    const BEST_BET_COURSE_JOCKEYS = 7;
    const BEST_BET_COURSE_TRAINERS = 8;
    const BEST_BET_HORSES_FOR_COURSES = 10;
    const BEST_BET_HOT_JOCKEYS = 5;
    const BEST_BET_SEVEN_DAY_WINNERS = 3;
    const BEST_BET_TRAINERS_JOCKEYS = 11;
    const BEST_BET_TRAVELLERS_CHECK = 9;
    const PERCENTAGE_LABEL = 'percentage';
    /**
     * @var \Bo\BetPrompts
     */
    private $betPromts;

    /**
     * @var \Bo\Signposts
     */
    private $boSignposts = null;

    /**
     * @var Request\Index
     */
    private $requestSignposts = null;

    /**
     * @var int raceId
     */
    private $raceId;

    /**
     * @return BetPrompts
     */
    public function getBetPromts()
    {
        return $this->betPromts;
    }

    /**
     * @param BetPrompts $betPromts
     */
    public function setBetPromts(BetPrompts $betPromts)
    {
        $this->betPromts = $betPromts;
    }

    /**
     * @param int $raceId
     */
    public function setRaceId($raceId)
    {
        $this->raceId = $raceId;
    }

    /**
     * @return int
     */
    public function getRaceId()
    {
        return $this->raceId;
    }

    /**
     * @return array|null
     */
    public function getHotTrainers()
    {
        $hotTrainers = $this->getBoSignposts(Request\HotTrainers::init($this->getRequestSignposts()))->getHotTrainers();

        foreach ((array)$hotTrainers as $key => &$hotTrainer) {
            $pointsPercentage = $this->getPoints(
                $hotTrainer->percentage,
                Signposts::$betPromtsRatingHotTrainers[static::PERCENTAGE_LABEL]
            );
            $pointsWins = $this->getPoints($hotTrainer->wins_14, Signposts::$betPromtsRatingHotTrainers['wins']);
            $hotTrainer->bet_prompt_rating = $pointsPercentage + $pointsWins;
            $hotTrainer->bet_prompt_weighting = $this->getBetPromts()->getBestBetWeightings(
                Signposts::BEST_BET_HOT_TRAINERS
            );
            $hotTrainer->bet_prompt_score = ($hotTrainer->bet_prompt_rating / 100) * $hotTrainer->bet_prompt_weighting;
        }
        //We need to remove all records with score < 0.5
        $result = array();
        if (!empty($hotTrainers)) {
            $result = array_filter(
                $hotTrainers,
                function ($row) {
                    return $row->bet_prompt_score >= 0.5;
                }
            );
        }
        return !empty($result) ? $result : null;
    }

    /**
     * @return array|null
     */
    public function getAheadOfHandicapper()
    {
        $aheadOfHandicapper = $this->getBoSignposts(
            Request\AheadOfHandicapper::init($this->getRequestSignposts())
        )->getAheadOfHandicapper();

        foreach ((array)$aheadOfHandicapper as $key => &$handicapper) {
            $rating = 0;
            foreach ($handicapper->entries as $entry) {
                if ((int)$entry->losses_out > $rating) {
                    $rating = $entry->losses_out;
                }
            }
            $handicapper->bet_prompt_rating = $this->getPoints(
                $rating,
                Signposts::$betPromtsRatingAheadOfHandicapper['ahead_of_handicap']
            );
            if (!$handicapper->bet_prompt_rating && $rating) {
                $handicapper->bet_prompt_rating = (int)$rating;
            }
            $handicapper->bet_prompt_weighting = $this->getBetPromts()->getBestBetWeightings(
                self::BEST_BET_AHEAD_OF_HANDICAPPER
            );
            $handicapper->bet_prompt_score =
                ($handicapper->bet_prompt_rating / 100) * $handicapper->bet_prompt_weighting;
        }

        //We need to remove all records with score < 0.5
        if (!empty($aheadOfHandicapper)) {
            $aheadOfHandicapper = array_filter(
                $aheadOfHandicapper,
                function ($row) {
                    return $row->bet_prompt_score >= 0.5;
                }
            );
        }
        return empty($aheadOfHandicapper) ? null : $aheadOfHandicapper;
    }

    /**
     * @return array|null
     */
    public function getCourseJockeys()
    {
        $courseJockeys = $this->getBoSignposts(
            Request\CourseJockeys::init($this->getRequestSignposts())
        )->getCourseJockeys();

        foreach ((array)$courseJockeys as &$course) {
            foreach ($course->jockeys as $key => &$jockey) {
                $pointsPercentage = $this->getPoints(
                    $jockey->d7_perc,
                    Signposts::$betPromtsRatingCourseJockeys[static::PERCENTAGE_LABEL]
                );
                $pointsWins = $this->getPoints($jockey->d7_wins, Signposts::$betPromtsRatingCourseJockeys['wins']);
                $jockey->bet_prompt_rating = $pointsPercentage + $pointsWins;
                $jockey->bet_prompt_weighting = $this->getBetPromts()->getBestBetWeightings(
                    Signposts::BEST_BET_COURSE_JOCKEYS
                );
                $jockey->bet_prompt_score = ($jockey->bet_prompt_rating / 100) * $jockey->bet_prompt_weighting;
            }
        }

        //We need to remove all records with score < 0.5
        if (!empty($courseJockeys->jockeys)) {
            $courseJockeys->jockeys = array_filter(
                $courseJockeys->jockeys,
                function ($row) {
                    return $row->bet_prompt_score >= 0.5;
                }
            );
        }
        return empty($courseJockeys) ? null : $courseJockeys;
    }

    /**
     * @return array|null
     */
    public function getCourseTrainers()
    {
        $courseTrainers = $this->getBoSignposts(
            Request\CourseTrainers::init($this->getRequestSignposts())
        )->getCourseTrainers();

        foreach ((array)$courseTrainers as &$course) {
            foreach ($course->trainers as $key => &$trainer) {
                $pointsPercentage = $this->getPoints(
                    $trainer->d7_perc,
                    Signposts::$betPromtsRatingCourseTrainers[static::PERCENTAGE_LABEL]
                );
                $pointsWins = $this->getPoints($trainer->d7_wins, Signposts::$betPromtsRatingCourseTrainers['wins']);
                $trainer->bet_prompt_rating = $pointsPercentage + $pointsWins;
                $trainer->bet_prompt_weighting = $this->getBetPromts()->getBestBetWeightings(
                    self::BEST_BET_COURSE_TRAINERS
                );
                $trainer->bet_prompt_score = ($trainer->bet_prompt_rating / 100) * $trainer->bet_prompt_weighting;
            }
        }

        //We need to remove all records with score < 0.5
        if (!empty($courseTrainers->trainers)) {
            $courseTrainers->trainers = array_filter(
                $courseTrainers->trainers,
                function ($row) {
                    return $row->bet_prompt_score >= 0.5;
                }
            );
        }
        return empty($courseTrainers) ? null : $courseTrainers;
    }

    /**
     * @return array|null
     */
    public function getHorsesForCourses()
    {
        $horsesForCourses = $this->getBoSignposts(
            Request\HorsesForCourses::init($this->getRequestSignposts())
        )->getHorsesForCourses();

        foreach ((array)$horsesForCourses as $key => &$horse) {
            $horse->bet_prompt_rating = $this->getPoints(
                $horse->course_winner,
                Signposts::$betPromtsRatingHorsesForCourses['course_wins']
            );
            $horse->bet_prompt_weighting = $this->getBetPromts()->getBestBetWeightings(
                static::BEST_BET_HORSES_FOR_COURSES
            );
            $horse->bet_prompt_score = ($horse->bet_prompt_rating / 100) * $horse->bet_prompt_weighting;
        }

        //We need to remove all records with score < 0.5
        $result = array();
        if (!empty($horsesForCourses)) {
            $result = array_filter(
                $horsesForCourses,
                function ($row) {
                    return $row->bet_prompt_score >= 0.5;
                }
            );
        }
        return !empty($result) ? $result : null;
    }

    /**
     * @return array|null
     */
    public function getHotJockeys()
    {
        $hotJockeys = $this->getBoSignposts(Request\HotJockeys::init($this->getRequestSignposts()))->getHotJockeys();

        foreach ((array)$hotJockeys as $key => &$jockey) {
            $pointsPercentage = $this->getPoints(
                $jockey->percentage,
                Signposts::$betPromtsRatingHotJockeys[static::PERCENTAGE_LABEL]
            );
            $pointsWins = $this->getPoints($jockey->wins_14, Signposts::$betPromtsRatingHotJockeys['wins']);
            $jockey->bet_prompt_rating = $pointsPercentage + $pointsWins;
            $jockey->bet_prompt_weighting = $this->getBetPromts()->getBestBetWeightings(static::BEST_BET_HOT_JOCKEYS);
            $jockey->bet_prompt_score = ($jockey->bet_prompt_rating / 100) * $jockey->bet_prompt_weighting;
        }
        //We need to remove all records with score < 0.5
        $result = array();
        if (!empty($hotJockeys)) {
            $result = array_filter(
                $hotJockeys,
                function ($row) {
                    return $row->bet_prompt_score >= 0.5;
                }
            );
        }
        return !empty($result) ? $result : null;
    }

    /**
     * @return array|null
     */
    public function getSevenDayWinners()
    {
        $sevenDayWinners = $this->getBoSignposts(
            Request\SevenDayWinners::init($this->getRequestSignposts())
        )->getSevenDayWinners();

        foreach ((array)$sevenDayWinners as $key => &$winner) {
            $figure = $winner->d8_perc != 0 ? $winner->d7_perc / $winner->d8_perc : 0;
            $winner->bet_prompt_rating = $this->getPoints(
                $figure,
                Signposts::$betPromtsRatingSevenDayWinners[static::PERCENTAGE_LABEL]
            );
            $winner->bet_prompt_weighting = $this->getBetPromts()->getBestBetWeightings(
                static::BEST_BET_SEVEN_DAY_WINNERS
            );
            $winner->bet_prompt_score = ($winner->bet_prompt_rating / 100) * $winner->bet_prompt_weighting;
        }
        //We need to remove all records with score < 0.5
        $result = array();
        if (!empty($sevenDayWinners)) {
            $result = array_filter(
                $sevenDayWinners,
                function ($row) {
                    return $row->bet_prompt_score >= 0.5;
                }
            );
        }
        return !empty($result) ? $result : null;
    }

    /**
     * @return array|null
     */
    public function getTrainersJockeys()
    {
        $trainersJockeys = $this->getBoSignposts(
            Request\TrainersJockeys::init($this->getRequestSignposts())
        )->getTrainersJockeys();

        foreach ((array)$trainersJockeys as $key => &$entity) {
            $highestPercent = max($entity->t_percent, $entity->j_percent);
            $percentDifference = $entity->percent - $highestPercent;
            $entity->bet_prompt_rating = $this->getPoints(
                $percentDifference,
                Signposts::$betPromtsRatingTrainersJockeys[static::PERCENTAGE_LABEL]
            );
            $entity->bet_prompt_weighting = $this->getBetPromts()->getBestBetWeightings(
                static::BEST_BET_TRAINERS_JOCKEYS
            );
            $entity->bet_prompt_score = ($entity->bet_prompt_rating / 100) * $entity->bet_prompt_weighting;
        }

        //We need to remove all records with score < 0.5
        $result = array();
        if (!empty($trainersJockeys)) {
            $result = array_filter(
                $trainersJockeys,
                function ($row) {
                    return $row->bet_prompt_score >= 0.5;
                }
            );
        }
        return !empty($result) ? $result : null;
    }

    /**
     * @return array|null
     */
    public function getTravellersCheck()
    {
        $travellersCheck = $this->getBoSignposts(
            Request\TravellersCheck::init($this->getRequestSignposts())
        )->getTravellersCheck();

        foreach ((array)$travellersCheck as $key => &$item) {
            preg_match('/\s(?<number>\d+)%$/', $item->all_out, $matches);
            $divider = isset($matches['number']) ? (int)$matches['number'] : 0;

            $figure = round($divider != 0 ? $item->trav_perc / $divider : 0, 2);
            $item->bet_prompt_rating = $this->getPoints(
                $figure,
                Signposts::$betPromtsRatingTravellersCheck[static::PERCENTAGE_LABEL]
            );
            $item->bet_prompt_weighting = $this->getBetPromts()->getBestBetWeightings(
                static::BEST_BET_TRAVELLERS_CHECK
            );
            $item->bet_prompt_rating = 5;

            if ($item->trav_perc < 20) {
                $item->bet_prompt_rating = 1;
            } else {
                $diff = $item->trav_perc - 20;
                $item->bet_prompt_rating += $diff <= $item->bet_prompt_rating ? $diff : $item->bet_prompt_rating;
            }

            $item->bet_prompt_score = ($item->bet_prompt_rating / 100) * $item->bet_prompt_weighting;
        }
        //We need to remove all records with score < 0.5
        $result = array();
        if (!empty($travellersCheck)) {
            $result = array_filter(
                $travellersCheck,
                function ($row) {
                    //We need to remove all records with bet_prompt_score less than 0.5
                    return $row->bet_prompt_score >= 0.5;
                }
            );
        }

        return !empty($result) ? $result : null;
    }

    /**
     * @codeCoverageIgnore
     * @param $request
     *
     * @return \Bo\Signposts
     */
    protected function getBoSignposts(Request $request)
    {
        if ($this->boSignposts === null) {
            $this->boSignposts = \Bo\Signposts::init($request);
        } else {
            $this->boSignposts->resetRequest($request);
        }
        return $this->boSignposts;
    }

    /**
     * @return \Api\Input\Request\Horses\Signposts\Index
     */
    private function getRequestSignposts()
    {
        if ($this->requestSignposts === null) {
            $locRaceId = $this->getRequest()->isParameterProvided('raceId')
                ? $this->getRequest()->getRaceId()
                : $this->getRaceId();
            $this->requestSignposts = new Request\Index([], ['raceId' => $locRaceId, 'daily' => 'daily']);
        }
        return $this->requestSignposts;
    }

    /**
     * @param $figure
     * @param $map
     * @return null
     */
    private function getPoints($figure, $map)
    {
        $points = null;
        foreach ($map as $mapper) {
            if (count($mapper['range']) === 1) {
                if (current($mapper['range']) == $figure) {
                    $points = $mapper['points'];
                    break;
                }
            } else {
                list($min, $max) = $mapper['range'];
                if ((!$max && $figure >= $min) || ($figure >= $min && $figure <= $max)) {
                    $points = $mapper['points'];
                    break;
                }
            }
        }
        return $points;
    }

    /**
     * @var array
     */
    private static $betPromtsRatingHotTrainers = [
        Signposts::PERCENTAGE_LABEL => [
            ['points' => 5, 'range' => [50, null]],
            ['points' => 4, 'range' => [41, 49]],
            ['points' => 3, 'range' => [36, 40]],
            ['points' => 2, 'range' => [31, 35]],
            ['points' => 1, 'range' => [25, 30]]],
        'wins' => [
            ['points' => 5, 'range' => [9, null]],
            ['points' => 4, 'range' => [7, 8]],
            ['points' => 3, 'range' => [5, 6]],
            ['points' => 2, 'range' => [3, 4]],
            ['points' => 1, 'range' => [2]],
        ]
    ];

    /**
     * @var array
     */
    private static $betPromtsRatingCourseJockeys = [
        Signposts::PERCENTAGE_LABEL => [
            ['points' => 7, 'range' => [36, null]],
            ['points' => 6, 'range' => [33, 35]],
            ['points' => 5, 'range' => [30, 32]],
            ['points' => 4, 'range' => [25, 29]],
            ['points' => 3, 'range' => [20, 24]]],
        'wins' => [
            ['points' => 3, 'range' => [6, null]],
            ['points' => 2, 'range' => [4, 5]],
            ['points' => 1, 'range' => [3]],
        ]
    ];

    /**
     * @var array
     */
    private static $betPromtsRatingCourseTrainers = [
        Signposts::PERCENTAGE_LABEL => [
            ['points' => 7, 'range' => [36, null]],
            ['points' => 6, 'range' => [33, 35]],
            ['points' => 5, 'range' => [30, 32]],
            ['points' => 4, 'range' => [25, 29]],
            ['points' => 3, 'range' => [20, 24]]],
        'wins' => [
            ['points' => 3, 'range' => [6, null]],
            ['points' => 2, 'range' => [4, 5]],
            ['points' => 1, 'range' => [3]]
        ],
    ];

    /**
     * @var array
     */
    private static $betPromtsRatingHotJockeys = [
        Signposts::PERCENTAGE_LABEL => [
            ['points' => 5, 'range' => [30, null]],
            ['points' => 4, 'range' => [28, 29]],
            ['points' => 3, 'range' => [26, 27]],
            ['points' => 2, 'range' => [23, 25]],
            ['points' => 1, 'range' => [20, 23]]],
        'wins' => [
            ['points' => 5, 'range' => [9, null]],
            ['points' => 4, 'range' => [7, 8]],
            ['points' => 3, 'range' => [5, 6]],
            ['points' => 2, 'range' => [3, 4]],
            ['points' => 1, 'range' => [2]],
        ]
    ];

    /**
     * @var array
     */
    private static $betPromtsRatingSevenDayWinners = [
        Signposts::PERCENTAGE_LABEL => [
            ['points' => 10, 'range' => [2.0, null]],
            ['points' => 9, 'range' => [1.9, 1.99]],
            ['points' => 8, 'range' => [1.8, 1.89]],
            ['points' => 7, 'range' => [1.7, 1.79]],
            ['points' => 6, 'range' => [1.6, 1.69]],
            ['points' => 5, 'range' => [1.5, 1.59]],
            ['points' => 4, 'range' => [1.4, 1.49]],
            ['points' => 3, 'range' => [1.3, 1.39]],
            ['points' => 2, 'range' => [1.2, 1.29]]
        ],
    ];

    /**
     * @var array
     */
    private static $betPromtsRatingTrainersJockeys = [
        Signposts::PERCENTAGE_LABEL => [
            ['points' => 10, 'range' => [20, null]],
            ['points' => 9, 'range' => [18, 19]],
            ['points' => 8, 'range' => [16, 17]],
            ['points' => 7, 'range' => [14, 16]],
            ['points' => 6, 'range' => [12, 13]],
            ['points' => 5, 'range' => [10, 11]],
            ['points' => 4, 'range' => [8, 9]],
            ['points' => 3, 'range' => [6, 7]],
            ['points' => 2, 'range' => [4, 5]],
            ['points' => 1, 'range' => [1, 3]],
        ]
    ];

    /**
     * @var array
     */
    private static $betPromtsRatingTravellersCheck = [
        'percentage' => [
            ['points' => 10, 'range' => [1.5, null]],
            ['points' => 9, 'range' => [1.45, 1.49]],
            ['points' => 8, 'range' => [1.4, 1.44]],
            ['points' => 7, 'range' => [1.35, 1.39]],
            ['points' => 6, 'range' => [1.3, 1.34]],
            ['points' => 5, 'range' => [1.25, 1.29]],
            ['points' => 4, 'range' => [1.2, 1.24]],
            ['points' => 3, 'range' => [1.15, 1.19]],
            ['points' => 2, 'range' => [1.1, 1.14]],
            ['points' => 1, 'range' => [1.01, 1.09]],
        ]
    ];

    /**
     * @var array
     */
    private static $betPromtsRatingAheadOfHandicapper = [
        'ahead_of_handicap' => [
            ['points' => 10, 'range' => [10, null]],
        ]
    ];

    /**
     * @var array
     */
    private static $betPromtsRatingHorsesForCourses = [
        'course_wins' => [
            ['points' => 10, 'range' => [5, null]],
            ['points' => 9, 'range' => [4]],
            ['points' => 8, 'range' => [3]],
        ]
    ];
}
