<?php

namespace Bo;

use Api\Bo\Traits as Traits;
use Api\Constants\Horses as Constants;
use Api\DataProvider\Bo\RaceCards\PastWinners as DataProviderPastWinners;
use Api\DataProvider\Bo\Rpr;
use Api\Input\Request\Horses\RaceCards\StartRating;
use Api\Input\Request\Horses\RaceCards\SalesData;
use Models\Course as Course;
use Phalcon\DI;
use Phalcon\Mvc\Model;

/**
 * Class RaceCards
 *
 * @package Bo
 */
class RaceCards extends BoWithFigures
{
    use Traits\EveningMeetingCheck;
    use Traits\FinalRaceCheck;

    const DATE_TIME_TOMORROW = '+1 day';
    const DATE_TIME_TODAY_READINESS = '6:00PM';
    const DATE_TIME_BOXING_DATE_START = 'Dec 23  6:00PM';
    const DATE_TIME_BOXING_DATE_END = 'Dec 25 6:00PM';
    const DATE_TIME_FOR_BOXING_INTERVAL = 'Dec 26';
    // 10 past races plus 1 current race
    const PAST_RACES_LIMIT = 11;
    const MAX_WEIGHT_FLAT = 140;
    const MAX_WEIGHT_JUMPS = 168;

    const TRACK_CODE_G = 'G';
    const JUMPS_GROUP_CODE = ['H', 'C', 'U', 'B'];
    const RACE_TYPE_CHASE_CODES = ['C', 'U'];

    /**
     * Avoid setting weight_for_age for certain race types
     */
    const RACE_TYPE_WFA_AVOID = [
        Constants::RACE_TYPE_CHASE_TURF_STR,
        Constants::RACE_TYPE_HURDLE_TURF_STR,
        Constants::RACE_TYPE_P2P_STR,
        Constants::RACE_TYPE_HUNTER_CHASE_STR ,
        Constants::RACE_TYPE_HURDLE_AW_STR,
        Constants::RACE_TYPE_CHASE_AW_STR
    ];

    /**
     * Straight Round Jubilee Codes for replacement
     */
    const SRJ_CODES_REPLACEMENT = [null, 'A', 'B', 'I'];

    /**
     * Straight Round Jubilee Code for Grand National races
     */
    const SRJ_GRAND_NATIONAL_CODE = 'G';

    private $dataProviderPastWinners = null;

    /**
     * Stable tours database notes limit in years
     */
    const STABLE_TOURS_NOTES_LIMIT = 2;

    /**
     * @var array
     */
    protected $courseDistanceWinnerRules = [
        'E' => 'G',
        'H' => 'N',
        'Q' => 'L',
        'V' => 'F',
        '[' => 'Y',
        ']' => 'W',
        '<' => 'R',
        '>' => 'S',
        'A' => '*',
        'B' => '*',
        'I' => '*',
        'Z' => '*',
        null => '*',
    ];

    /**
     * RaceCards constructor.
     *
     * @param $request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\RaceCards\RaceInstance
     */
    protected function getModelRaceInstance()
    {
        return new \Models\Bo\RaceCards\RaceInstance();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\RaceCards\HorseRace
     */
    protected function getModelHorseRace()
    {
        return new \Models\Bo\RaceCards\HorseRace();
    }

    /**
     * @codeCoverageIgnore
     *
     * @param int    $raceId
     * @param object $request
     *
     * @return RaceCards\RaceWFA
     */
    protected function getRaceWFAInstance()
    {
        return new \Bo\RaceCards\RaceWFA($this->request->getRaceId());
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\RaceCards\PostdataResultsNew
     */
    protected function getModelPostdataResultsNew()
    {
        return new \Models\Bo\RaceCards\PostdataResultsNew();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\RaceCards\TipsterSelection
     */
    protected function getModelTipsterSelection()
    {
        return new \Models\Bo\RaceCards\TipsterSelection();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\RaceCards\Jockey
     */
    protected function getModelJockey()
    {
        return new \Models\Bo\RaceCards\Jockey();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\RaceCards\Horse
     */
    protected function getModelHorse()
    {
        return new \Models\Bo\RaceCards\Horse();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\RaceCards\PreHorseRace
     */
    protected function getModelPreHorseRace()
    {
        return new \Models\Bo\RaceCards\PreHorseRace();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\RaceCards\HorseNotes
     */
    protected function getModelHorseNotes()
    {
        return new \Models\Bo\RaceCards\HorseNotes();
    }

    /**
     * @codeCoverageIgnore
     *
     * @param $request
     *
     * @return \Bo\Profile\Trainer
     */
    protected function getBoTrainerProfile()
    {
        return new \Bo\Profile\Trainer($this->request);
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Api\DataProvider\Bo\RaceCards\SsNatPress
     */
    protected function getModelSsNatPress()
    {
        return new \Api\DataProvider\Bo\RaceCards\SsNatPress();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Api\DataProvider\Bo\RaceCards\TodaysTrainers
     */
    protected function getDataProviderTodaysTrainers()
    {
        return new \Api\DataProvider\Bo\RaceCards\TodaysTrainers();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Api\DataProvider\Bo\RaceCards\TodaysJockeys
     */
    protected function getDataProviderTodaysJockeys()
    {
        return new \Api\DataProvider\Bo\RaceCards\TodaysJockeys();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Api\DataProvider\Bo\RaceCards\StarRating
     */
    protected function getDataProviderStarRating()
    {
        return new \Api\DataProvider\Bo\RaceCards\StarRating();
    }

    /**
     * @return mixed
     */
    public function getTodaysTrainers()
    {
        return $this->getDataProviderTodaysTrainers()->getTodaysTrainers();
    }

    /**
     * @return mixed
     */
    public function getTodaysJockeys()
    {
        return $this->getDataProviderTodaysJockeys()->getTodaysJockeys();
    }

    /**
     * @return array
     * @throws \Api\Exception\ValidationError
     */
    public function getBettingForecast()
    {
        $raceAbandoned = $this->getModelRaceInstance()->checkRaceAbandoned($this->request->getRaceId());

        if ($raceAbandoned) {
            throw new \Api\Exception\ValidationError(7115);
        }

        $selectors = $this->getModelSelectors();

        return $this->getModelRaceInstance()->getBettingForecast($this->request->getRaceId(), $selectors);
    }

    /**
     * @return array
     */
    public function getPressChallenge()
    {
        return $this->getModelSsNatPress()->getPressChallenge();
    }

    /**
     * @return \stdClass
     * @throws \Exception
     */
    public function getStats()
    {
        $raceInstance = $this->getModelRaceInstance()->getRaceInstance(
            $this->request->getRaceId()
        );

        if (empty($raceInstance)) {
            return null;
        }

        $raceTypeCode = $this->getModelSelectors()->getRaceTypeCode($raceInstance->getRaceTypeName());
        $raceSeasonCode = $this->getModelSelectors()->getSeasonTypeCode(null, $raceInstance->getRaceTypeName());
        $statsIDs = $this->getModelRaceInstance()->getStatsData($this->request->getRaceId());
        $horseIds = array_keys($statsIDs['horses']);
        $trainerIds = array_keys($statsIDs['trainers']);
        $jockeyIds = array_keys($statsIDs['jockeys']);

        $lastFifthSeasonStartDate = $this->getModelSeason()
            ->getLastFifthSeasonStartDate($raceSeasonCode);

        $statistics = new \stdClass();
        $statistics->trainer = new \stdClass();
        $statistics->jockey = new \stdClass();
        $statistics->horse = new \stdClass();

        $selectors = $this->getModelSelectors();

        $statistics->trainer->overall = (empty($trainerIds))
        ? null
        : $this->getModelRaceInstance()
            ->getTrainerStatisticsOverall(
                $trainerIds,
                $lastFifthSeasonStartDate,
                $raceTypeCode,
                $raceInstance->course_uid,
                $raceInstance->rp_abbrev_3,
                $raceInstance->isFlatRace(),
                $selectors
            );

        $statistics->trainer->last_14_days = (empty($trainerIds))
        ? null
        : $this->getModelRaceInstance()
            ->getTrainerStatisticsLast14Days(
                $trainerIds,
                date('Y-m-d H:i:s', strtotime('-14 days')),
                $raceTypeCode
            );

        $statistics->jockey->overall = (empty($jockeyIds))
        ? null
        : $this->getModelRaceInstance()
            ->getJockeyStatisticsOverall(
                $jockeyIds,
                $lastFifthSeasonStartDate,
                $raceTypeCode,
                $raceInstance->course_uid,
                $raceInstance->rp_abbrev_3,
                $raceInstance->isFlatRace(),
                $selectors
            );

        $statistics->jockey->last_14_days = (empty($jockeyIds))
        ? null
        : $this->getModelRaceInstance()
            ->getJockeyStatisticsLast14Days(
                $jockeyIds,
                date('Y-m-d H:i:s', strtotime('-14 days')),
                $raceTypeCode
            );

        $statistics->horse->going = (empty($horseIds))
        ? null
        : $this->getModelRaceInstance()
            ->getHorseStatisticsByGoingType(
                $horseIds,
                $lastFifthSeasonStartDate,
                $raceTypeCode,
                $raceInstance->going_type_code
            );

        $statistics->horse->distance = (empty($horseIds))
        ? null
        : $this->getModelRaceInstance()
            ->getHorseStatisticsByDistance(
                $horseIds,
                $lastFifthSeasonStartDate,
                $raceTypeCode,
                $raceInstance->distance_yard - $raceInstance->getAdjustmentDistance(),
                $raceInstance->distance_yard + $raceInstance->getAdjustmentDistance()
            );

        $statistics->horse->course = (empty($horseIds))
        ? null
        : $this->getModelRaceInstance()
            ->getHorseStatisticsByCourse(
                $horseIds,
                $lastFifthSeasonStartDate,
                $raceTypeCode,
                $raceInstance->course_uid
            );

        $emptyStatsObj = new \Api\Row\RaceCards\Stats();
        $emptyStatsObj->wins = 0;
        $emptyStatsObj->runs = 0;
        $emptyStatsObj->profit = 0;

        $horses = new \stdClass();
        foreach ($statsIDs['horses'] as $id => $horse) {
            $horses->{$id} = new \Api\Row\RaceCards\Stats();
            $horses->{$id}->horse_uid = $horse->horse_uid;
            $horses->{$id}->horse_name = $horse->horse_name;
            $horses->{$id}->country_origin_code = $horse->country_origin_code;
            $horses->{$id}->going = (empty($statistics->horse->going[$id])) ? $emptyStatsObj
            : $statistics->horse->going[$id];
            $horses->{$id}->distance = (empty($statistics->horse->distance[$id])) ? $emptyStatsObj
            : $statistics->horse->distance[$id];
            $horses->{$id}->course = (empty($statistics->horse->course[$id])) ? $emptyStatsObj
            : $statistics->horse->course[$id];
        }
        $statistics->horse = $horses;

        $statsGroups = $selectors->getRaceCardStatsGroups($raceInstance->isFlatRace());

        $trainers = new \stdClass();
        foreach ($statsIDs['trainers'] as $id => $trainer) {
            $trainers->{$id} = new \Api\Row\RaceCards\Stats();
            $trainers->{$id}->trainer_uid = $trainer->trainer_uid;
            $trainers->{$id}->trainer_name = $trainer->trainer_name;
            $trainers->{$id}->overall = (empty($statistics->trainer->overall[$id])) ? $emptyStatsObj
            : $statistics->trainer->overall[$id];
            $trainers->{$id}->last_14_days = (empty($statistics->trainer->last_14_days[$id])) ? $emptyStatsObj
            : $statistics->trainer->last_14_days[$id];

            foreach ($statsGroups as $group) {
                $trainers->{$id}->{$group} = new \Api\Row\RaceCards\Stats();
                $trainers->{$id}->{$group}->wins = empty($statistics->trainer->overall[$id]->{'wins_' . $group}) ? 0
                : $statistics->trainer->overall[$id]->{'wins_' . $group};
                $trainers->{$id}->{$group}->runs = empty($statistics->trainer->overall[$id]->{'runs_' . $group}) ? 0
                : $statistics->trainer->overall[$id]->{'runs_' . $group};
                $trainers->{$id}->{$group}->profit = empty($statistics->trainer->overall[$id]->{'profit_' . $group}) ? 0
                : $statistics->trainer->overall[$id]->{'profit_' . $group};
            }
        }
        $statistics->trainer = $trainers;

        $jockeys = new \stdClass();
        foreach ($statsIDs['jockeys'] as $id => $jockey) {
            $jockeys->{$id} = new \Api\Row\RaceCards\Stats();
            $jockeys->{$id}->jockey_uid = $jockey->jockey_uid;
            $jockeys->{$id}->jockey_name = $jockey->jockey_name;
            $jockeys->{$id}->overall = (empty($statistics->jockey->overall[$id])) ? $emptyStatsObj
            : $statistics->jockey->overall[$id];
            $jockeys->{$id}->last_14_days = (empty($statistics->jockey->last_14_days[$id])) ? $emptyStatsObj
            : $statistics->jockey->last_14_days[$id];

            foreach ($statsGroups as $group) {
                $jockeys->{$id}->{$group} = new \Api\Row\RaceCards\Stats();
                $jockeys->{$id}->{$group}->wins = empty($statistics->jockey->overall[$id]->{'wins_' . $group}) ? 0
                : $statistics->jockey->overall[$id]->{'wins_' . $group};
                $jockeys->{$id}->{$group}->runs = empty($statistics->jockey->overall[$id]->{'runs_' . $group}) ? 0
                : $statistics->jockey->overall[$id]->{'runs_' . $group};
                $jockeys->{$id}->{$group}->profit = empty($statistics->jockey->overall[$id]->{'profit_' . $group}) ? 0
                : $statistics->jockey->overall[$id]->{'profit_' . $group};
            }
        }
        $statistics->jockey = $jockeys;

        return $statistics;
    }

    /**
     * @return null|\Phalcon\Mvc\ModelInterface
     * @throws Model\Resultset\ResultsetException
     */
    public function getRaceCard()
    {
        $info = $this->getModelRaceInstance()->getRaceCard($this->request->getRaceId());
        if (empty($info)) {
            return null;
        }

        if ($info->race_group_code == Constants::getConstantValue(Constants::RACE_GROUP_CODE_HANDICAP)) {
            $handicap = [];

            if ($info->race_status_code == Constants::getConstantValue(Constants::RACE_STATUS_OVERNIGHT)) {
                $handicap = $this->getLongHandicapByRace();
            }

            $or = $this->getModelRaceInstance()->getHighestOfficialRating($this->request->getRaceId());
            if ($or !== null) {
                foreach ($or as $runner) {
                    if (isset($handicap[$runner->horse_uid])) {
                        $runner->official_rating += $runner->weight_carried_lbs
                         - $handicap[$runner->horse_uid]->lh_weight_carried_lbs;
                    }
                }

                usort(
                    $or,
                    function ($a, $b) {
                        if ($a->official_rating == $b->official_rating) {
                            return $a->start_number < $b->start_number
                            ? -1
                            : ($a->start_number == $b->start_number ? 0 : +1);
                        }

                        return ($a->official_rating > $b->official_rating) ? -1 : +1;
                    }
                );

                $info->highest_official_rating = current($or);
                unset($info->highest_official_rating->weight_carried_lbs);
            }
        }

        //join prizes
        $info->prizes = $this->getModelRaceInstancePrize()->getForRaceInstanceId($this->request->getRaceId(), $info->race_datetime);

        // Join other declarations
        $info->other_declarations = $this->getModelRaceInstance()->getOtherDeclaration($this->request->getRaceId());

        $info->forfeits = $this->getModelRaceInstance()->getForfeits($this->request->getRaceId());

        if (!(trim($info->country_code) === Constants::COUNTRY_IRE
            && in_array($info->race_type_code, self::RACE_TYPE_WFA_AVOID))
            && !is_null($raceWFA = $this->getRaceWFAInstance())
        ) {
            $info->weight_for_age = $raceWFA->getRaceWFA();
        } else {
            $info->weight_for_age = null;
        }

        $raceAttributes = $this->getModelRaceInstance()->getRaceAttributes([$this->request->getRaceId()]);

        // We need this array to check and populate the following fields depending on the race_attrib_uid
        $raceAttributesIdArray = [];
        foreach ($raceAttributes as $attr) {
            $raceAttributesIdArray = array_merge($raceAttributesIdArray, array_column($attr['attrib_uids'], 'race_attrib_uid'));
        }

        $RaceTypesArray = [
            "lucky7_race"               => [Constants::LUCKY_7_RACE],
            "scoop6_race"               => [Constants::SCOOP6_RACE],
            "jackpot_race"              => Constants::JACKPOT_RACES,
            "william_hill_offer_race"   => [Constants::BETOFFER_WH_RAJ_ID],
            "ladbrokes_offer_race"      => [Constants::BETOFFER_LB_RAJ_ID],
            "plus10_race"               => [Constants::PLUS10_RACE_ATTRIBUTE_ID],
            "selling_race"              => [Constants::RACE_ATTRIB_SELL],
            "claiming_race"             => [Constants::RACE_ATTRIB_CLAIM],
        ];

        $info->bet_to_view = false;
        // logic relating to bet2view - https://racingpost.atlassian.net/browse/AD-1541
        if ($info->perform_race_uid_ruk
            && ($info->country_code == Constants::COUNTRY_IRE || $info->course_uid == Constants::BET_TO_VIEW_COURSE_UID)
        ) {
            $info->bet_to_view = true;
        }
        // will set boolean value to the above fields in the response depending on race_attrib_uid conditions
        foreach ($RaceTypesArray as $raceType => $RaceAttrUid) {
            $info->$raceType = !empty(array_intersect($RaceAttrUid, $raceAttributesIdArray));
        }

        $classConstant = $info->country_code == 'GB' ? Constants::RACE_CLASS : Constants::RACE_CLASS_SUB;
        $classConstant = trim($classConstant, "'");
        $info->race_class = null;

        if (isset($raceAttributes[$classConstant])
            && !empty($raceAttributes[$classConstant])
        ) {
            $raceClassObject = current($raceAttributes[$classConstant]['attrib_uids']);
            $info->race_class = $raceClassObject['race_attrib_desc'];
        }

        $info->aw_surface_type = null;

        // Depending on the race_type_code we grab the race_attrib_desc or display null.
        if (in_array($info['race_type_code'], Constants::RACE_TYPE_FLAT_AW_ARRAY)) {
            if (isset($raceAttributes['Surface'])
                && !empty($raceAttributes['Surface'])
            ) {
                $surfaceObject = current($raceAttributes['Surface']['attrib_uids']);
                $info->aw_surface_type =  $surfaceObject['race_attrib_desc'];
            }
        }

        $info->prev_w_allowance = $info['weight_allowance_lbs'] == 0 ? null : $info['weight_allowance_lbs'];
        $info->prev_year = date('Y', strtotime($info['prev_year_datetime']));

        //join claiming_prices
        if ($info->claiming_race === true) {
            $info->claiming_prices = $this->getModelRaceInstance()->getClaimingPrices($this->request->getRaceId());
        } else {
            $info->claiming_prices = null;
        }

        // we need the course profile bo to access the methods for adding the image paths to the response
        $courseProfileBo = new \Bo\Profile\Course($this->request);
        $courseId = $info->course_uid;
        $courseMaps = $courseProfileBo->getModelCourse()->getCourseMap($courseId, $info->race_type_code);

        $info->small_map_image_path = null;
        $info->large_map_image_path = null;

        // if hours_difference is null we set to zero because in the mapper we use a method that cannot evaluate null
        $info->hours_difference = $info->hours_difference ?? 0;

        if (!empty($courseMaps)) {
            $courseMaps = $courseProfileBo->addMapImagePath($courseMaps);
            // the  above method will result in an array and we should take the first element of that array
            // and disregard the rest of the data we get
            $info->small_map_image_path = $courseMaps[0]->small_map_image_path;
            $info->large_map_image_path = $courseMaps[0]->large_map_image_path;
        }
        return $info;
    }

    /**
     * @param $raceTypeCode
     *
     * @return string
     */
    protected function getCDRaceTypeCode($raceTypeCode)
    {
        return in_array($raceTypeCode, self::JUMPS_GROUP_CODE)
        ? Constants::getConstantValue(Constants::SEASON_TYPE_CODE_JUMPS)
        : $raceTypeCode;
    }

    /**
     * @param $trackCode
     *
     * @return null
     */
    protected function getCDTrackCode($trackCode)
    {
        return ($trackCode !== self::TRACK_CODE_G) ? null : $trackCode;
    }

    /**
     * @param $baseRace
     * @param $race
     *
     * @return bool
     */
    protected function getCourseWinner($baseRace, $race)
    {
        if ($baseRace->course_uid === $race->course_uid
            && $this->getCDRaceTypeCode($baseRace->race_type_code) === $this->getCDRaceTypeCode($race->race_type_code)
            && $this->getCDTrackCode($baseRace->track_code) === $this->getCDTrackCode($race->track_code)
        ) {
            return true;
        }
        return false;
    }

    /**
     * @param $baseRace
     * @param $race
     *
     * @return bool
     */
    protected function getCourseDistanceWinner($baseRace, $race)
    {
        // srj corrections
        $baseSRJ = $baseRace->straight_round_jubilee_code;
        $raceSRJ = $race->straight_round_jubilee_code;

        if (in_array($baseSRJ, self::SRJ_CODES_REPLACEMENT)) {
            $baseSRJ = '*';
        }

        $raceSRJ = !empty($this->courseDistanceWinnerRules[$raceSRJ])
        ? $this->courseDistanceWinnerRules[$raceSRJ]
        : $raceSRJ;

        if ($baseSRJ === $raceSRJ
            && ((in_array($baseRace->race_type_code, self::RACE_TYPE_CHASE_CODES)
            && in_array($race->race_type_code, self::RACE_TYPE_CHASE_CODES))
            || $baseRace->race_type_code === $race->race_type_code)
        ) {
            return $this->getDistanceWinner($baseRace, $race);
        }
        return false;
    }

    /**
     * @param $baseRace
     * @param $race
     *
     * @return bool
     */
    protected function getDistanceWinner($baseRace, $race)
    {
        $adjDistance = strpos(Constants::RACE_TYPE_FLAT, $baseRace->race_type_code) !== false
        ? ($baseRace->distance_yard < 1761) ? 55 : 110
        : 219;

        if (($baseRace->distance_yard >= ($race->distance_yard - $adjDistance))
            && ($baseRace->distance_yard <= ($race->distance_yard + $adjDistance))
        ) {
            return true;
        }
        return false;
    }

    /**
     * @return \Phalcon\Mvc\Model\Row\General
     */
    public function getTopspeedSelection()
    {
        return $this->getModelTipsterSelection()->getTopspeedSelection($this->request->getRaceId());
    }

    /**
     * @return \Api\Row\Horse[]
     */
    public function retrieveVerdict($raceId = null)
    {
        if (is_null($raceId)) {
            $raceId = $this->request->getRaceId();
        }
        return $this->getModelRaceInstance()->fetchVerdict($raceId);
    }

    /**
     * @return \Api\Row\Horse[]
     */
    public function retrievePostPointerVerdict()
    {
        return $this->getModelRaceInstance()->fetchPostPointerVerdict($this->request->getRaceId());
    }

    /**
     * @return \Phalcon\Mvc\Model\Row\General
     */
    public function getSpotlightVerdictSelection($raceId = null)
    {
        if (is_null($raceId)) {
            $raceId = $this->request->getRaceId();
        }
        return $this->getModelTipsterSelection()->getSpotlightVerdictSelection($raceId);
    }

    public function getTipsterVerdicts()
    {
        $model = $this->getModelRaceInstance();
        return $model->getTipsterVerdicts($this->request->getRaceId());
    }

    /**
     * @return \StdClass
     */
    public function getComments()
    {
        return $this->getModelRaceInstance()->getComments($this->request->getRaceId());
    }

    /**
     * @return object|null
     */
    public function getPostData()
    {
        $raceInstance = $this->getModelRaceInstance()->getRaceInstance(
            $this->request->getRaceId()
        );

        if (empty($raceInstance)) {
            return null;
        }

        $runners = $this->getModelPostdataResultsNew()->getPostdata($this->request->getRaceId());
        if (!empty($runners)) {
            $firstRunner = current($runners);

            $handicap = [];

            if ($firstRunner->race_status_code == Constants::getConstantValue(Constants::RACE_STATUS_OVERNIGHT)) {
                $handicap = $this->getLongHandicapByRace();
            }

            foreach ($runners as $runner) {
                $runner->official_rating_today = $runner->official_rating + $runner->extra_weight_lbs;

                if (isset($handicap[$runner->horse_uid])) {
                    $runner->lh_weight_carried_lbs = $handicap[$runner->horse_uid]->lh_weight_carried_lbs;
                    $runner->out_of_handicap = $runner->weight_carried_lbs - $runner->lh_weight_carried_lbs;
                    $runner->official_rating_today += $runner->out_of_handicap;
                }
            }
            reset($runners);
        }

        $postdataSelection = $this->getModelTipsterSelection()->getPostdataSelection($this->request->getRaceId());

        if (empty($runners) && empty($postdataSelection)) {
            $result = null;
        } else {
            $result = (Object) [
                'race_details' => $raceInstance,
                'runners' => $runners,
                'postdata_selection' => $postdataSelection,
            ];
        }

        return $result;
    }

    /**
     * @return \Api\Row\RaceInstance
     */
    public function getRaceInstanceInfo()
    {
        return $this->getModelRaceInstance()->getRaceInstance($this->request->getRaceId());
    }

    /**
     * @param \Api\Row\RaceInstance $raceInfo
     * @param bool                  $withNonRunner
     *
     * @return \Api\Row\RaceCards\Selections[]
     * @throws \Api\Exception\ValidationError
     */
    public function getSelectionRows($raceInfo, $withNonRunner = false)
    {
        if (!isset($raceInfo->country_code)) {
            throw new \Api\Exception\ValidationError(5);
        }

        return $this->getModelRaceInstance()->getSelections($this->request->getRaceId(), $raceInfo->country_code, $withNonRunner);
    }

    /**
     * @param bool $withNonRunner
     *
     * @return object
     * @throws \Api\Exception\ValidationError
     */
    public function getSelections($withNonRunner = false)
    {
        $race = $this->getRaceInstanceInfo();

        if (!isset($race->country_code)) {
            throw new \Api\Exception\ValidationError(5);
        }

        $rows = $this->getSelectionRows($race, $withNonRunner);

        $horses = [];
        $selections = [];
        $publishTime = $this->getModelRaceInstance()->getPublishTime($this->request->getRaceId());

        if (!empty($rows)) {
            // only if the current time has surpassed the race_datetime do we want to populate selections and selections_selection
            if (isset($publishTime) && time() >= strtotime($publishTime->race_content_publish_time)) {
                foreach ($rows as $row) {
                    if (!empty($row->horse_name) && isset($row->newspaper_uid)) {
                        $horses[$row->horse_name][] = $row->newspaper_uid;
                    }
                }

                foreach ($horses as $horse) {
                    if (isset($rows[$horse[0]])
                        && isset($rows[$horse[0]]->selection_cnt)
                    ) {
                        $rows[$horse[0]]->selection_cnt = sizeof($horse);
                    }
                }

                usort(
                    $rows,
                    function ($a, $b) {
                        if ($a->selection_cnt == $b->selection_cnt) {
                            if ($a->horse_uid == $b->horse_uid) {
                                return 0;
                            }

                            return ($a->horse_uid > $b->horse_uid) ? -1 : 1;
                        }

                        return ($a->selection_cnt > $b->selection_cnt) ? -1 : 1;
                    }
                );

                $selections = $rows;
            }
        }

        return (Object) [
            'selections' => $selections,
            'selections_count' => count($selections),
            'race_details' => $race,
            'selections_selection' => !empty($selections) ? reset($selections) : null,
        ];
    }

    /**
     * @param $request
     *
     * @return array
     */
    public function getTopSelections($request)
    {
        $date = $request->getDate();
        $model = $this->getModelRaceInstance();
        return $model->getTopSelections($date);
    }

    /**
     * @return DataProviderPastWinners|null
     */
    protected function getDataProviderPastWinners()
    {
        if (is_null($this->dataProviderPastWinners)) {
            $this->dataProviderPastWinners = new DataProviderPastWinners();
        }

        return $this->dataProviderPastWinners;
    }

    /**
     * @return array|null
     * @throws \Api\Exception\ValidationError
     */
    public function getPastWinners()
    {
        $lastYearRaces = (new \Bo\LastYearRaces([$this->request->getRaceId()]))->getPastRacesIDs(self::PAST_RACES_LIMIT);
        if (empty($lastYearRaces)) {
            return null;
        }

        return $this->getDataProviderPastWinners()->getPastWinners(array_keys($lastYearRaces));
    }

    public function getOfficialRating()
    {
        $model = $this->getModelRaceInstance();
        $raceDetails = $model->getRaceInstance($this->request->getRaceId());
        if (empty($raceDetails)) {
            throw new \Api\Exception\NotFound(7101);
        }
        $runners = $model->getOfficialRating($this->request->getRaceId());
        $horseIds = $this->getHorseIdsByResult($runners);

        if (empty($runners)) {
            return [];
        }

        $raceTypeCode = $raceDetails->race_type_code;
        $raceDate = $raceDetails->race_datetime;
        $raceType = $this->getModelSelectors()->getRaceTypeKey($raceTypeCode);
        $raceTypeCodes = $this->getModelSelectors()->getRaceTypeCode($raceType);

        $lifetimeHigh = $model->getLifetime(
            $horseIds,
            $raceTypeCode,
            false
        );
        $lifetimeLow = $model->getLifetime(
            $horseIds,
            $raceTypeCode,
            true
        );
        $annualHigh = $model->getAnnual(
            $horseIds,
            $raceTypeCode,
            false
        );
        $annualLow = $model->getAnnual(
            $horseIds,
            $raceTypeCode,
            true
        );

        $handicap = [];
        if ($raceDetails->race_status_code == Constants::getConstantValue(Constants::RACE_STATUS_OVERNIGHT)) {
            $handicap = $this->getLongHandicapByRace();
        }

        foreach ($runners as &$runner) {
            $runner->last_races = $model->getOfficialRatingLastRaces(
                $runner->horse_uid,
                $raceDate,
                $raceTypeCodes,
                $runner->adjustment,
                6
            );
            if (empty($runner->last_races)) {
                $runner->last_races = null;
            }

            $runner->lifetime_high = isset($lifetimeHigh[$runner->horse_uid])
            ? $lifetimeHigh[$runner->horse_uid] : null;
            $runner->lifetime_low = (isset($lifetimeLow[$runner->horse_uid]))
            ? $lifetimeLow[$runner->horse_uid] : null;
            $runner->annual_high = (isset($annualHigh[$runner->horse_uid]))
            ? $annualHigh[$runner->horse_uid] : null;
            $runner->annual_low = (isset($annualLow[$runner->horse_uid]))
            ? $annualLow[$runner->horse_uid] : null;

            $runner->official_rating_today = $runner->official_rating + $runner->extra_weight;

            if (isset($handicap[$runner->horse_uid])) {
                $runner->lh_weight_carried_lbs = $handicap[$runner->horse_uid]->lh_weight_carried_lbs;
                $runner->out_of_handicap = $runner->weight_carried_lbs - $runner->lh_weight_carried_lbs;
                $runner->official_rating_today += $runner->out_of_handicap;
            }

            $runner->future_rating_difference =
            strpos(Constants::RACE_TYPE_HURDLE_TURF, $raceDetails->race_group_code) !== false
            ? $runner->current_official_rating - $runner->official_rating_today
            : null;
        }

        unset($runner);

        $resultObj = new \stdClass();
        $resultObj->race_details = $raceDetails;
        $resultObj->runners = $runners;

        return $resultObj;
    }

    private function getHorseIdsByResult($runners)
    {
        $rtn = [];
        foreach ($runners as $runner) {
            $rtn[] = $runner->horse_uid;
        }
        return $rtn;
    }

    /**
     * @param $raceDate
     * @param bool     $isFullList
     * @param array    $meetings
     * @param bool     $showBetToView
     * @return array
     * @throws \Exception
     */
    public function getList($raceDate, $isFullList = false, $meetings = [], $showBetToView = false)
    {
        $model = $this->getModelRaceInstance();
        $meetings = empty($meetings) ? $model->getMeetingByDate($raceDate, $isFullList) : $meetings;

        $races = [];
        //We need to place default values for fields that are used to calculate rp_order_meeting field
        //We place some big value for rp_meeting_order because for our logic it needs initial value
        foreach ($meetings as $key => $meeting) {
            $meeting->racesItv                 = 0;
            $meeting->containsNotFinishedRaces = 0;
            $meeting->totalPrizeMoney          = 0;
            $meeting->eveningMeeting           = 0;
            $meeting->raceGroups               = [];
            $meeting->raceClasses              = [];

            // In some cases we have dates from next day (when the race is in different time zone).
            // It is safe to show the requested date here because we need to show only courses from this day.
            // In FE this date is used to know where to use the meeting. In case specific meeting is with different than
            // requested date, this will break the logic for FE.
            $meeting->race_date = $raceDate;

            $meeting->rp_position = in_array($meeting->country_code, [Constants::COUNTRY_GB, Constants::COUNTRY_IRE]) ? 1 : 2;
            $meeting->rp_meeting_order = 100;
            if (isset($meeting['races']) && is_array($meeting['races'])) {
                $races = array_merge($races, $meeting['races']);
            }
        }

        $isFastResults = [];

        if (empty($races)) {
            $races = $model->getRacesListByDate($raceDate, $isFullList);
            $isFastResults = $model->checkFastResults($raceDate);
        }

        $groupedRacesTypeByCourseId = [];
        $raceRequestDay = (new \DateTime($raceDate))->format('D');

        foreach ($races as $race) {
            if ($showBetToView) {
                $race->bet_to_view = false;
                // logic relating to bet2view - https://racingpost.atlassian.net/browse/AD-1541
                if ($race->perform_race_uid_ruk
                    && ($race->country_code == Constants::COUNTRY_IRE || $race->course_uid == Constants::BET_TO_VIEW_COURSE_UID)
                ) {
                    $race->bet_to_view = true;
                }
            }

            $groupedRacesTypeByCourseId[$race->course_uid][] = $race->race_type_code;
            if (isset($isFastResults[$race->race_instance_uid])) {
                $race->is_fast_result = 1;
            }

            $raceDay = (new \DateTime($race->race_datetime))->format('D');
            $race->short_day_desc = $raceDay != $raceRequestDay ? $raceDay : null;

            $meeting = isset($meetings[$race->course_uid]) ? $meetings[$race->course_uid] : null;
            if ($meeting !== null) {
                if (!isset($meeting->course_race_type_code)) {
                    $meeting->course_race_type_code = $race->race_type_code;
                }
                if (!isset($meeting->max_prize)) {
                    $meeting->max_prize = 0.0;
                }

                if (isset($race->rp_tv_text) && $race->rp_tv_text) {
                    if (in_array(trim($race->rp_tv_text), Constants::ITV_CODES)) {
                        $meeting->racesItv = -1;
                    }
                }

                if (isset($race->race_group_uid) && $race->race_group_uid) {
                    $meeting->raceGroups[] = $race->race_group_uid;
                }

                if (isset($race->race_class) && $race->race_class) {
                    $meeting->raceClasses[] = $race->race_class;
                }

                if (isset($race->race_status_code) && $race->race_status_code != Constants::RACE_STATUS_RESULTS_STR) {
                    $meeting->containsNotFinishedRaces = -1;
                }

                if (isset($race->race_status_code) && $race->race_status_code == Constants::RACE_STATUS_ABANDONED_STR) {
                    $meeting->containsNotFinishedRaces = 1;
                }

                if ($race->prize > $meeting->max_prize) {
                    $meeting->max_prize = $race->prize;
                    $meeting->course_race_type_code = $race->race_type_code;
                }

                if (!empty($race->pool_prize_sterling)) {
                    $meeting->totalPrizeMoney -= $race->pool_prize_sterling;
                }

                // if hours_difference is null we set to zero because in the mapper we use a method that cannot evaluate null
                if (empty($race->hours_difference)) {
                    $race->hours_difference = 0;
                }

                // If $meeting->eveningMeeting = 0 then this must be that meeting's first race
                if ($meeting->eveningMeeting == 0) {
                    $meeting->eveningMeeting = $this->getEveningMeetingFlag($race->race_datetime);
                }

                $meeting->course_straight_round_jubilee_code = $this->getCourseStraightRoundJubileeCode(
                    $meeting,
                    $race
                );

                $meeting->complete_card = $this->isMeetingCompleteCard($meeting, $race, $raceDate, false);
                $meeting->early_complete_card = $this->isMeetingCompleteCard($meeting, $race, $raceDate, true);

                // Тhere is associative array with keys race_instance_uid in daily meetings and racecard endpoint
                // but not for rest of endpoints.
                // There aren`t any initial races and we need to populate them as indexed array
                if (empty($meeting->races) || !array_key_exists($race->race_instance_uid, $meeting->races)) {
                    $meeting->races[] = $race;
                } else {
                    $meeting->races[$race->race_instance_uid] = $race;
                }
            }
        }

        $cardsOrder = 1;
        $selectors = $this->getModelSelectors();
        foreach ($meetings as $id => $meeting) {
            sort($meeting->raceGroups);
            sort($meeting->raceClasses);
            $meeting->meeting_type = null;
            try {
                $meeting->meeting_type = $selectors->getMeetingTypeByRacesTypes($groupedRacesTypeByCourseId[$id]);
                //The types of the exceptions below denote that our method can not spot
                //  meeting type, so, we remain it as a null.
            } catch (\InvalidArgumentException $e) {
            } catch (\Api\Exception\ValidationError $e) {
            }
            $meeting->cards_order = $cardsOrder;
            $cardsOrder++;
        }

        $meetings = $this->makeOrder($meetings);

        unset($races);

        (new Course)->calculateRpMeetingOrder($meetings);

        return $meetings;
    }

    /**
     * @param array $meetings
     *
     * @return array
     */
    private function makeOrder(array $meetings)
    {
        /**
         * @param $array
         * @param $start
         * @param $end
         */
        $shift = function (&$array, $start, $end) {
            foreach ($array as $element) {
                if ($element->cards_order >= $start && $element->cards_order < $end) {
                    $element->cards_order++;
                }
            }
        };

        $digitalList = [];
        foreach ($meetings as $meeting) {
            if (!is_null($meeting->digital_order)) {
                $digitalList[] = $meeting;
            }
        }

        usort(
            $digitalList,
            function ($a, $b) {
                return $a->digital_order - $b->digital_order;
            }
        );

        foreach ($digitalList as $value) {
            $shift($meetings, $value->digital_order, $value->cards_order);
            $value->cards_order = $value->digital_order;
        }

        return $meetings;
    }

    /**
     * @param \Api\Row\Course       $meeting
     * @param \Api\Row\RaceInstance $race
     *
     * @return null|string
     */
    private function getCourseStraightRoundJubileeCode($meeting, $race)
    {
        $courseStraightRoundJubileeCode = empty($meeting->course_straight_round_jubilee_code)
        ? null
        : $meeting->course_straight_round_jubilee_code;

        // For daily meetings endpoint there is straight_round_jubilee_code_race because of a grouping issues in SQL
        // You can`t have same fields in different blocks in group structures
        $raceJubileeCode = $race->straight_round_jubilee_code ?? $race->straight_round_jubilee_code_race ?? null;
        if ($courseStraightRoundJubileeCode !== self::SRJ_GRAND_NATIONAL_CODE
            && $race->course_uid === 32
            && $raceJubileeCode === self::SRJ_GRAND_NATIONAL_CODE
        ) {
            $courseStraightRoundJubileeCode = self::SRJ_GRAND_NATIONAL_CODE;
        }

        return $courseStraightRoundJubileeCode;
    }

    /**
     * @param \Api\Row\Course       $meeting
     * @param \Api\Row\RaceInstance $race
     * @param string                $raceDate
     * @param boolean               $isEarly
     *
     * @return bool
     */
    private function isMeetingCompleteCard($meeting, $race, $raceDate, $isEarly)
    {
        $today = $this->getDateTime();
        $tomorrow = $this->getDateTime(RaceCards::DATE_TIME_TOMORROW);

        $isReadinessTime = $today > $this->getDateTime(RaceCards::DATE_TIME_TODAY_READINESS) || $isEarly;
        $isTodayEqualToRaceDate = $today->format('Y-m-d') == $raceDate || $isEarly;
        $isTomorrowEqualToRaceDate = $tomorrow->format('Y-m-d') == $raceDate || $isEarly;

        $isBoxingDatesToRace =
        $this->getDateTime(RaceCards::DATE_TIME_FOR_BOXING_INTERVAL)->format('Y-m-d') === $raceDate
        && $today > $this->getDateTime(RaceCards::DATE_TIME_BOXING_DATE_START)
        && $today < $this->getDateTime(RaceCards::DATE_TIME_BOXING_DATE_END);

        $field = ($isEarly) ? 'early_complete_card' : 'complete_card';
        $meetingCompleteCard = isset($meeting->{$field}) ? $meeting->{$field} : true;

        return $meetingCompleteCard
        && isset($race->race_status_code)
            && (
            (($race->race_status_code == Constants::getConstantValue(Constants::RACE_STATUS_OVERNIGHT)
                || $race->race_status_code == Constants::getConstantValue(Constants::RACE_STATUS_RESULTS))
                && $isTodayEqualToRaceDate)
            || ($race->race_status_code == Constants::getConstantValue(Constants::RACE_STATUS_OVERNIGHT)
                && $isTomorrowEqualToRaceDate
                && $isReadinessTime)
            || ($race->race_status_code === Constants::getConstantValue(Constants::RACE_STATUS_OVERNIGHT)
                && $isBoxingDatesToRace)
        );
    }

    /**
     * @param string $time
     *
     * @return \DateTime
     */
    protected function getDateTime($time = 'now')
    {
        return new \DateTime($time);
    }

    /**
     * @param $request
     *
     * @return array
     */
    public function getUpcomingRaces($request)
    {
        $model = $this->getModelRaceInstance();
        return $model->getUpcomingRaces($request);
    }

    /**
     *  Returns Big Races in a date order list
     *
     * @return mixed
     * @throws \Api\Exception\NotFound
     */
    public function getBigRaces()
    {
        $model = $this->getModelRaceInstance();
        return $model->getBigRaces();
    }

    public function getRunnersIndex($raceDate)
    {
        $model = $this->getModelRaceInstance();
        $runners = $model->getRunnersIndexByDate($raceDate);
        $nonRunners = $model->getNonRunnersIndexByDate($raceDate);

        $rtn = [
            'runners' => $runners,
            'non_runners' => $nonRunners,
        ];
        return (Object) $rtn;
    }

    /**
     * @param $raceDate
     * @return array|object
     * @throws Model\Resultset\ResultsetException
     */
    public function getTopspeed($raceDate)
    {
        $selectors = $this->getModelSelectors();
        $topspeedHorses = $this->getModelPreHorseRace()->getTopspeedHorses($this->request->getRaceId(), $selectors);

        if (!empty($topspeedHorses)) {
            $horseRaceInfo = $topspeedHorses[0];

            $horseUids = $this->getFieldFromArrayOfRows($topspeedHorses, 'horse_uid');
            $raceTypeCodes = $this->getModelSelectors()->getRaceTypeCode($horseRaceInfo->getRaceTypeName());

            $topspeedLastYear = $this->getModelHorseRace()->getTopspeedLastYear($horseUids, $raceTypeCodes);

            $topspeedGoing = $this->getModelHorseRace()->getTopspeedGoing(
                $horseUids,
                $horseRaceInfo->rp_going_type_desc,
                $raceTypeCodes
            );

            $adjustmentDistance = $horseRaceInfo->getAdjustmentDistance();

            $topspeedDistance = $this->getModelHorseRace()->getTopspeedDistance(
                $horseUids,
                $raceTypeCodes,
                $horseRaceInfo->distance_yard - $adjustmentDistance,
                $horseRaceInfo->distance_yard + $adjustmentDistance
            );

            $topspeedCourse = $this->getModelHorseRace()->getTopspeedCourse(
                $horseUids,
                $raceTypeCodes,
                $horseRaceInfo->course_uid
            );

            $topspeedHorsesArray = [];

            foreach ($topspeedHorses as $topspeedHorse) {
                if (strpos(Constants::RACE_TYPE_FLAT, $topspeedHorse->race_type_code) !== false) {
                    // The adjustment column in the table pre_rfu_horse_stats is calculated using the
                    // wrong weight for age (wfa) allowance for flat races, so we modify the value here.
                    $topspeedHorse->adjustment += ($topspeedHorse->wfa_allow - $topspeedHorse->topspeed_wfa_allow);
                    if ($topspeedHorse->adjustment > 15) {
                        $topspeedHorse->adjustment = 15;
                    }
                } else {
                    if ($topspeedHorse->adjustment > 21) {
                        $topspeedHorse->adjustment = 21;
                    }
                }

                $adjustment = (int) $topspeedHorse->adjustment;

                $topspeedHorse->best_topspeed = (Object) [
                    'last_year' => isset($topspeedLastYear[$topspeedHorse->horse_uid])
                    ? $this->addAdditionData(
                        $topspeedLastYear[$topspeedHorse->horse_uid],
                        ['adjustment' => $adjustment]
                    ) : null,
                    'going' => isset($topspeedGoing[$topspeedHorse->horse_uid])
                    ? $this->addAdditionData(
                        $topspeedGoing[$topspeedHorse->horse_uid],
                        ['adjustment' => $adjustment]
                    ) : null,
                    'distance' => isset($topspeedDistance[$topspeedHorse->horse_uid])
                    ? $this->addAdditionData(
                        $topspeedDistance[$topspeedHorse->horse_uid],
                        ['adjustment' => $adjustment]
                    ) : null,
                    'course' => isset($topspeedCourse[$topspeedHorse->horse_uid])
                    ? $this->addAdditionData(
                        $topspeedCourse[$topspeedHorse->horse_uid],
                        ['adjustment' => $adjustment]
                    ) : null,
                ];

                $last6ratings = $this->getModelHorseRace()->getLast6HorseRacesTopspeeds(
                    $topspeedHorse->horse_uid,
                    $raceTypeCodes,
                    $raceDate
                );

                $topspeedHorse->last6ratings = empty($last6ratings)
                ? null
                : $this->addAdditionData(
                    $last6ratings,
                    ['adjustment' => $adjustment]
                );

                $topspeedHorsesArray[$topspeedHorse->horse_uid] = $topspeedHorse;
            }

            $topspeedHorses = $topspeedHorsesArray;
            $this->addRatings($topspeedHorses);

            unset($topspeedHorsesArray);

            $neededFields = [
                'course_uid',
                'course_name',
                'race_datetime',
                'race_status_code',
                'race_group_code',
                'race_type_code',
                'country_code',
                'rp_going_type_desc',
                'distance_yard',
            ];

            $topspeedHorses = (object) [
                'race_details' => $this->getCommonFieldsAsObject($topspeedHorses, $neededFields),
                'runners' => $topspeedHorses,
            ];
        }

        return $topspeedHorses;
    }

    /**
     * @param string|null $searchBy
     * @param string|null $searchTerm
     *
     * @return array
     */
    public function getStableToursDatabase($searchBy = null, $searchTerm = null)
    {
        $searchTerm = $searchTerm ? strtoupper(trim($searchTerm)) : $searchTerm;

        if ($searchBy == 'horse') {
            $stableToursDatabase = $this->getModelHorseNotes()->getStableToursDatabaseByHorseName($searchTerm);
        } elseif ($searchBy == 'trainer') {
            $stableToursDatabase = $this->getModelHorseNotes()->getStableToursDatabaseByTrainerName($searchTerm);
        } else {
            $dateBegin = new \DateTime();
            $dateEnd = clone $dateBegin;
            $dateEnd->add(\DateInterval::createFromDateString('6 days'));

            $stableToursDatabase = $this->getModelHorseNotes()->getStableToursDatabase(
                $dateBegin->format('Y-m-d 00:00:00'),
                $dateEnd->format('Y-m-d 23:59:59')
            );
        }
        $this->limitStableToursNotes($stableToursDatabase, self::STABLE_TOURS_NOTES_LIMIT);

        return $stableToursDatabase;
    }

    /**
     * @param $raceUid
     *
     * @return array|object
     */
    public function getRPR($raceUid)
    {
        $selectors = $this->getModelSelectors();
        $model = $this->getModelRaceInstance();
        $ratingData = $model->getRprRatingData($raceUid, $selectors);

        if (!empty($ratingData)) {
            $horseIds = array_keys($ratingData);
            $row = current($ratingData);
            $raceType = $this->getModelSelectors()->getRaceTypeKey($row->race_type_code);
            $raceTypeCodes = $this->getModelSelectors()->getRaceTypeCode($raceType);

            $goingTypeDesc = $row->rp_going_type_desc;
            $distance = $row->distance_yard;
            $course = $row->course_name;

            $raceDate = date('Y-m-d', strtotime($row->race_datetime));

            reset($ratingData);

            $this->addRatings($ratingData);

            $last12Month = $model->getRprLast12Month($horseIds, $raceTypeCodes);
            $going = $model->getRprGoing($horseIds, $raceTypeCodes, $goingTypeDesc);

            $adjustmentDistance = $row->getAdjustmentDistance();
            $distance = $model->getRprDistance(
                $horseIds,
                $raceTypeCodes,
                $distance - $adjustmentDistance,
                $distance + $adjustmentDistance
            );
            $course = $model->getRprCourse($horseIds, $raceTypeCodes, $course);

            foreach ($ratingData as &$horse) {
                $adjustment = !empty($horse->adjustment) ? $horse->adjustment : 0;

                $horse->last_12_months = isset($last12Month[$horse->horse_uid])
                ? $this->addAdditionData($last12Month[$horse->horse_uid], ['adjustment' => $adjustment])
                : null;
                $horse->going = isset($going[$horse->horse_uid])
                ? $this->addAdditionData($going[$horse->horse_uid], ['adjustment' => $adjustment])
                : null;
                $horse->distance = isset($distance[$horse->horse_uid])
                ? $this->addAdditionData($distance[$horse->horse_uid], ['adjustment' => $adjustment])
                : null;
                $horse->course = isset($course[$horse->horse_uid])
                ? $this->addAdditionData($course[$horse->horse_uid], ['adjustment' => $adjustment])
                : null;

                $horse->last_races = $model->getRprLastRaces(
                    $horse->horse_uid,
                    $raceDate,
                    $raceTypeCodes
                );
                $horse->last_races = $this->addAdditionData($horse->last_races, ['adjustment' => $adjustment]);
            }

            $neededFields = [
                'course_uid',
                'course_name',
                'race_datetime',
                'race_status_code',
                'race_type_code',
                'country_code',
                'rp_going_type_desc',
                'distance_yard',
                'race_group_code',
            ];

            $ratingData = (object) [
                'race_details' => $this->getCommonFieldsAsObject($ratingData, $neededFields),
                'runners' => $ratingData,
            ];
        }
        return $ratingData;
    }

    /**
     * @param $arrayData
     * @param $neededFields
     *
     * @return object
     * @throws \Exception
     */
    private function getCommonFieldsAsObject($arrayData, $neededFields)
    {
        if (!is_array($arrayData)) {
            throw new \Exception('Incorrect incoming parameter');
        }

        $data = current($arrayData);
        $rtn = [];

        foreach ($neededFields as $fieldName) {
            if (!property_exists($data, $fieldName)) {
                throw new \Exception('Undefined field ' . $fieldName);
            }
            $rtn[$fieldName] = $data->$fieldName;
        }

        return (object) $rtn;
    }

    /**
     * @param $mainArr
     * @param $additionArray array
     */
    private function addAdditionData($mainArr, array $additionArray)
    {

        $addAdditional = function (&$object) use ($additionArray) {
            foreach ($additionArray as $k => $v) {
                $object->{$k} = $v;
            }
        };

        if (is_array($mainArr)) {
            foreach ($mainArr as $obj) {
                $addAdditional($obj);
            }
        } elseif (is_object($mainArr)) {
            $addAdditional($mainArr);
        }

        return $mainArr;
    }

    /**
     * Return forms for all runners in current race
     *
     * @param int $limit - Limit for horse returned horse races
     * @param bool $hardCodePtpGbFlag - Whether to include P2P races to the response
     *
     * @return array
     * @throws \Api\Exception\NotFound
     * @throws \Api\Exception\ValidationError
     */
    public function getForm($limit, $hardCodePtpGbFlag)
    {
        $model = $this->getModelRaceInstance();
        $model->dropHorsesUidsTmpTables();
        $model->createHorsesIdTables($this->request->getRaceId());

        $runnersIds = $model->getRunnersIds();

        if (empty($runnersIds)) {
            throw new \Api\Exception\NotFound(7101);
        }

        if ($limit > Constants::PARAMETER_LIMIT_MAX_UPPER) {
            throw new \Api\Exception\ValidationError(30, array('limit', (Constants::PARAMETER_LIMIT_MAX_UPPER + 1)));
        }

        $result = $model->getForm($runnersIds, $this->request->getRaceId(), false, '', $hardCodePtpGbFlag, $limit);
        $this->addVideoDetails($result);

        $model->dropHorsesUidsTmpTables();

        return $result;
    }

    /**
     * @param array $raceIDs
     *
     * @return VideoProviders
     */
    protected function getVideoProviders($raceIDs)
    {
        return new \Bo\VideoProviders($raceIDs);
    }

    /**
     * @param array $result
     */
    public function addVideoDetails(&$result)
    {
        if (empty($result)) {
            return;
        }

        $raceIDs = [];
        foreach ($result as $horse) {
            if (!empty($horse->races)) {
                $raceIDs = array_merge(array_keys($horse->races), $raceIDs);
            }
        }

        if (empty($raceIDs)) {
            return;
        }

        $videoDetails = $this->getVideoProviders($raceIDs)->getDetails();
        foreach ($result as $horse) {
            if (!empty($horse->races)) {
                foreach ($horse->races as $race) {
                    $race->video_detail = (isset($videoDetails[$race->race_instance_uid]))
                    ? $videoDetails[$race->race_instance_uid] : null;
                }
            }
        }
    }

    public function getLongHandicapByRaces($raceIds)
    {
        $model = $this->getModelHorse();
        return $model->getLongHandicapPerRaces($raceIds);
    }
    /**
     * @param null $raceId
     * @param null $handicaps
     * @return array
     */
    public function getLongHandicapByRace($raceId = null, $handicaps = null)
    {
        if ($raceId === null) {
            $raceId = $this->request->getRaceId();
        }

        if (is_null($handicaps)) {
            $model = $this->getModelHorse();
            $handicaps = $model->getLongHandicap($raceId);
        }

        $output = [];

        foreach ($handicaps as $handicap) {
            if ($handicap->three_yo_min_weight_lbs === null && $handicap->minimum_weight_lbs === null) {
                continue;
            }

            $totalWeight = $handicap->weight_carried_lbs + $handicap->weights_raised_lbs
             + $handicap->extra_weight_lbs;

            if ($handicap->three_yo_min_weight_lbs === null || $handicap->three_yo_min_weight_lbs < 1) {
                if ($handicap->minimum_weight_lbs === null) {
                    $handicap->minimum_weight_lbs = 250;
                }

                $handicap->three_yo_min_weight_lbs = $handicap->minimum_weight_lbs;
            }

            if ($handicap->horse_age == 3 && $totalWeight >= $handicap->three_yo_min_weight_lbs) {
                continue;
            }

            if ($handicap->horse_age != 3 && $totalWeight >= $handicap->minimum_weight_lbs) {
                continue;
            }

            $row = [];
            $row['horse_name'] = $handicap->style_name;
            $row['lh_weight_carried_lbs'] = $totalWeight;
            $output[$handicap->horse_uid] = (object) $row;
        }

        return $output;
    }

    /**
     * @return mixed
     */
    public function getQuotes()
    {
        return $this->getModelRaceInstance()->getQuotes($this->request->getRaceId());
    }

    /**
     * @param \Api\Input\Request\Horses\RaceCards\NextRace $request
     *
     * @return Model\Row\General
     */
    public function getNextRace(\Api\Input\Request\Horses\RaceCards\NextRace $request)
    {
        return $this->getModelRaceInstance()->getNextRace((bool) $request->getIsExcludePTP());
    }

    /**
     * @return array
     */
    public function getNapsTable()
    {
        return $this->getModelRaceInstance()->getNapsTable();
    }

    /**
     * @param \Api\Input\Request\Horses\RaceCards\TopNaps $request
     *
     * @return Model\Row\General[]
     */
    public function getTopNaps(\Api\Input\Request\Horses\RaceCards\TopNaps $request)
    {
        return $this->getModelRaceInstance()->getTopNaps();
    }

    /**
     * Calculate Topspeed and RPR ratings.
     *
     * @param  array $runners
     * @param  array $raceIds
     * @param  bool  $adjustFinalRace
     * @throws \Exception
     */
    public function addRatings(array &$runners, array $raceIds = [], $adjustFinalRace = false)
    {
        if (empty($raceIds)) {
            $raceIds[] = $this->request->getRaceId();
        }

        $races = $this
            ->getModelRaceInstance()
            ->getRaceAdditionalData($raceIds);

        $rprDataProvider = new Rpr(current($races), $runners);

        $horseRpr = $this->getHorseRpr($rprDataProvider, $runners);

        $horsesTopspeed = $this
            ->getModelRaceInstance()
            ->getHorsesTopspeed(array_keys($runners));

        foreach ($raceIds as $raceId) {
            if (!isset($races[$raceId]) || $this->isFinalRace($races[$raceId])) {
                if ($adjustFinalRace) {
                    foreach ($runners as $runner) {
                        unset($horsesTopspeed[$runner->horse_uid]);
                        $runner->rp_topspeed = $runner->num_topspeed_best_rating ?? null;
                    }
                }
                continue;
            }
            $race = $races[$raceId];

            if (strpos(Constants::RACE_TYPE_FLAT, $race->race_type_code) !== false) {
                if ($race->top_age > Constants::MAX_TOP_AGE_PER_RACE_TYPE['flat']) {
                    $race->top_age = Constants::MAX_TOP_AGE_PER_RACE_TYPE['flat'];
                }
            } else {
                if (strpos(Constants::RACE_TYPE_HURDLE, $race->race_type_code) !== false) {
                    if ($race->top_age > Constants::MAX_TOP_AGE_PER_RACE_TYPE['hurdle']) {
                        $race->top_age = Constants::MAX_TOP_AGE_PER_RACE_TYPE['hurdle'];
                    }
                } else {
                    if ($race->top_age > Constants::MAX_TOP_AGE_PER_RACE_TYPE['default']) {
                        $race->top_age = Constants::MAX_TOP_AGE_PER_RACE_TYPE['default'];
                    }
                }
            }

            if (isset($horseRpr[$raceId])) {
                $rprDataProvider->addRatingForRace($horseRpr[$raceId], $runners, $race);
            }

            $selectors = $this->getModelSelectors();

            if (count($raceIds) == 1) {
                $horses = $this
                    ->getModelRaceInstance()
                    ->getHorsesAttributes($race);

                if (count($horses) == 0) {
                    return;
                }
            } else {
                $horses = $runners;
            }
        }

        // loop over all race's runners
        foreach ($horses ?? [] as $horse) {
            $race = $races[$horse->race_instance_uid];
            $horseId = $horse->horse_uid;
            if (!isset($runners[$horseId])) {
                continue;
            }

            $topspeed = $horsesTopspeed[$horseId]['race_types'][$race->race_type_code]['topspeed'][0]->rp_topspeed ?? 0;

            // applying weight adjustments to ratings
            if ($topspeed > 0 && $horse->weight_carried_lbs > 0 && $runners[$horseId]->weight_carried_lbs > 0) {
                $flatRaceType = in_array(
                    $race->race_type_code,
                    $selectors->getRaceTypeCode(Constants::RACE_TYPE_FLAT_ALIAS)
                );

                $topspeedAdjustedWeight = $horse->weight_carried_lbs;

                if ($flatRaceType) {
                    // Commented-out as it was leading to discrepancies with the figures produced by the newspaper.
                    // Leave the Jumps adjustment (the 'else' segment) in place for now.
                    /*if ($horse->weight_carried_lbs < Constants::MIN_WEIGHT_CARRIED_LBS_PER_RACE_TYPE['flat']) {
                        $topspeedAdjustedWeight = Constants::MIN_WEIGHT_CARRIED_LBS_PER_RACE_TYPE['flat'];
                    }*/
                } else {
                    if ($horse->weight_carried_lbs < Constants::MIN_WEIGHT_CARRIED_LBS_PER_RACE_TYPE['default']) {
                        $topspeedAdjustedWeight = Constants::MIN_WEIGHT_CARRIED_LBS_PER_RACE_TYPE['default'];
                    }
                }

                $weightDiff = $race->weight_adjustment - $topspeedAdjustedWeight;

                if ($flatRaceType) {
                    if ($weightDiff > Constants::MAX_WEIGHT_DIFF_PER_RACE_TYPE['flat']) {
                        $weightDiff = Constants::MAX_WEIGHT_DIFF_PER_RACE_TYPE['flat'];
                    }
                } else {
                    if ($weightDiff > Constants::MAX_WEIGHT_DIFF_PER_RACE_TYPE['default']) {
                        $weightDiff = Constants::MAX_WEIGHT_DIFF_PER_RACE_TYPE['default'];
                    }
                }
                $topspeed += $weightDiff;
            }

            if (!isset($horse->wfa_control_flag)) {
                $horse->wfa_control_flag = 0;
                if (in_array($race->race_type_code, Constants::RACE_TYPE_FLAT_ARRAY)) {
                    if ($race->min_age != $race->max_age) {
                        if ($race->min_age >= 5) {
                            $horse->wfa_control_flag = 1;
                        } else {
                            $horse->wfa_control_flag = 2;
                        }
                    }
                } else {
                    if ($race->max_age != $race->min_age && $race->top_age < $race->min_age) {
                        $horse->wfa_control_flag = 2;
                    }
                }
            }

            // WFA logic lives here
            if ($horse->wfa_control_flag == 2) {
                $topspeed = $this->calcTopspeed($topspeed, $race, $horse);
            }

            $runners[$horse->horse_uid]->rp_topspeed = $topspeed;
            $runners[$horse->horse_uid]->rp_postmark = $this->adjustRpr($runners[$horse->horse_uid], $race, $horse);
        }
    }

    /**
     * @param $topspeed
     * @param $race
     * @param $horse
     *
     * @return int
     */
    private function calcTopspeed($topspeed, $race, $horse)
    {
        $selectors = DI::getDefault()->getShared('selectors');
        $wfa = 0;
        $horseAge = $horse->age ?? $horse->horse_age ?? null;

        if ($race->top_age > 0 && $horseAge != $race->top_age) {
            if (!isset($horse->wfa_topspeed_flat) && !isset($horse->wfa_jump)) {
                $wfa = $horse->wfa_adjustment;
            } else {
                $wfa = in_array($race->race_type_code, $selectors->getRaceTypeCode(Constants::RACE_TYPE_FLAT_ALIAS))
                    ? $horse->wfa_topspeed_flat
                    : $horse->wfa_jump;
            }
        }

        if (!isset($horse->adjusted_age)) {
            $horse->adjusted_age = $horseAge > 2 && $horseAge < 20 ? $horseAge : 0;

            if (!in_array($race->race_type_code, Constants::RACE_TYPE_FLAT_ARRAY)) {
                if ($horse->adjusted_age > 6) {
                    $horse->adjusted_age = 6;
                } elseif ($horse->adjusted_age > 5) {
                    $horse->adjusted_age = 5;
                }
            }
        }

        if (!isset($horse->force_deduct_wfa)) {
            $horse->force_deduct_wfa = 0;

            if (!in_array($race->race_type_code, Constants::RACE_TYPE_FLAT_ARRAY)
                && $race->max_age != $race->min_age
                && $race->min_age != $race->top_age
                && $race->race_group_code != Constants::RACE_GROUP_CODE_HANDICAP_STR
            ) {
                $horse->force_deduct_wfa = 1;
            }
        }

        if ($horse->adjusted_age < $race->top_age && $horse->force_deduct_wfa == 0) {
            $topspeed = $topspeed - $wfa;
        }

        return empty($topspeed) || $topspeed < 0 ? 0 : $topspeed;
    }

    /**
     * @param StartRating $request
     *
     * @return \Api\Row\RaceInstance|null
     */
    public function getStartRating(StartRating $request)
    {
        $data = $this->getModelRaceInstance()->getRaceCard($request->getRaceId());

        if (empty($data)) {
            return null;
        }

        $dp = $this->getDataProviderStarRating();
        $data->horses = $dp->getData($request);

        return $data;
    }

    /**
     * @param SalesData $request
     *
     * @return array
     */
    public function getSalesData(SalesData $request)
    {
        $salesData = $this->getModelRunners()->getSalesData($request->getRaceId());

        if (empty($salesData)) {
            return null;
        }

        $modelHorse = new \Models\Bo\HorseProfile\Horse();
        $sales = $modelHorse->getSales(array_keys($salesData));

        foreach ($salesData as $horse) {
            $horse->sales_info = isset($sales[$horse->horse_uid]) ? $sales[$horse->horse_uid]['sales'] : null;
        }

        return $salesData;
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
}
