<?php

namespace Config;

use RP\Cache\LifeTime;
use Phalcon\Mvc\RouterInterface;

/**
 * Class Router
 *
 * @package Config
 */
class Router
{
    /**
     * @param RouterInterface $router
     */
    public function apply(RouterInterface $router): void
    {
        //------------- course profile -----------
        $router->addGet(
            "/horses/profile/course/{courseId}/:action/:params",
            [
                "controller" => 'Controllers\Horses\Profile\Course',
                "courseId" => 1,
                "action" => 2,
                "params" => 3,
            ]
        );
        $router->addGet(
            "/horses/profile/course/{courseId}/standard",
            [
                "controller" => 'Controllers\Horses\Profile\Course\Standard',
                "action" => 'actionGetStandard',
                "courseId" => 1,
                "request" => '\Api\Input\Request\Horses\Profile\Course\Standard',
            ]
        );
        $router->addGet(
            "/horses/profile/course/{courseId}/principle-race-results/:params",
            [
                "controller" => 'Controllers\Horses\Profile\Course',
                "action" => 'actionGetPrincipleRaceResults',
                "courseId" => 1,
                'params' => 2,
                "request" => '\Api\Input\Request\Horses\Profile\Course\PrincipleRaceResults',
            ]
        );
        $router->addGet(
            "/horses/profile/course/{courseId}/average-times",
            [
                "controller" => 'Controllers\Horses\Profile\Course\AverageTimes',
                "action" => 'actionGetAverageTimes',
                "courseId" => 1,
                "request" => '\Api\Input\Request\Horses\Profile\Course\AverageTimes',
            ]
        );
        $router->addGet(
            "/horses/profile/course/{courseId}",
            [
                "controller" => 'Controllers\Horses\Profile\Course',
                "action" => 'actionGetIndex',
                "courseId" => 1,
            ]
        );

        //------------- horse profile -----------

        $router->addGet(
            "/horses/profile/horse/{horseId}/all-entries",
            [
                "controller" => 'Controllers\Horses\Profile\Horse',
                "action" => 'actionGetAllEntries',
                "horseId" => 1,
                "request" => '\Api\Input\Request\Horses\Profile\Horse\AllEntries',
                'cache' => LifeTime::NO_EXPIRE
            ]
        );

        $router->addGet(
            "/horses/profile/horse/{horseId}/entries",
            [
                "controller" => 'Controllers\Horses\Profile\Horse',
                "action" => 'actionGetEntries',
                "horseId" => 1,
                "request" => '\Api\Input\Request\Horses\Profile\Horse\Entries',
                'cache' => LifeTime::NO_EXPIRE
            ]
        );

        $router->addGet(
            "/horses/profile/horse/{horseId}/form",
            [
                "controller" => 'Controllers\Horses\Profile\Horse',
                "action" => 'actionGetForm',
                "horseId" => 1,
                "request" => '\Api\Input\Request\Horses\Profile\Horse\Form',
                'cache' => LifeTime::NO_EXPIRE
            ]
        );

        $router->addGet(
            "/horses/profile/horse/{horseId}/going-form",
            [
                "controller" => 'Controllers\Horses\Profile\Horse',
                "action" => 'actionGetGoingForm',
                "horseId" => 1,
                "request" => '\Api\Input\Request\Horses\Profile\Horse\GoingForm',
                'cache' => LifeTime::NO_EXPIRE
            ]
        );

        $router->addGet(
            "/horses/profile/horse/{horseId}/medical",
            [
                "controller" => 'Controllers\Horses\Profile\Horse\Medical',
                "action" => 'actionGetMedical',
                "horseId" => 1,
                "request" => '\Api\Input\Request\Horses\Profile\Horse\Medical',
                'cache' => LifeTime::NO_EXPIRE
            ]
        );

        $router->addGet(
            "/horses/profile/horse/{horseId}/my-notes",
            [
                "controller" => 'Controllers\Horses\Profile\Horse',
                "action" => 'actionGetMyNotes',
                "horseId" => 1,
                "request" => '\Api\Input\Request\Horses\Profile\Horse\MyNotes',
            ]
        );

        $router->addGet(
            "/horses/profile/horse/{horseId}/my-ratings",
            [
                "controller" => 'Controllers\Horses\Profile\Horse',
                "action" => 'actionGetMyRatings',
                "horseId" => 1,
                "request" => '\Api\Input\Request\Horses\Profile\Horse\MyRatings',
            ]
        );

        $router->addGet(
            "/horses/profile/horse/{horseId}/overview",
            [
                "controller" => 'Controllers\Horses\Profile\Horse',
                "action" => 'actionGetOverview',
                "horseId" => 1,
                "request" => '\Api\Input\Request\Horses\Profile\Horse\Overview',
                'cache' => LifeTime::NO_EXPIRE
            ]
        );

        $router->addGet(
            "/horses/profile/horse/{horseId}/pedigree",
            [
                "controller" => 'Controllers\Horses\Profile\Horse',
                "action" => 'actionGetPedigree',
                "horseId" => 1,
                "request" => '\Api\Input\Request\Horses\Profile\Horse\Pedigree',
                'cache' => LifeTime::NO_EXPIRE
            ]
        );

        $router->addGet(
            "/horses/profile/horse/{horseId}/quotes",
            [
                "controller" => 'Controllers\Horses\Profile\Horse',
                "action" => 'actionGetQuotes',
                "horseId" => 1,
                "request" => '\Api\Input\Request\Horses\Profile\Horse\Quotes',
                'cache' => LifeTime::NO_EXPIRE
            ]
        );

        $router->addGet(
            "/horses/profile/horse/{horseId}/notes",
            [
                "controller" => 'Controllers\Horses\Profile\Horse',
                "action" => 'actionGetNotes',
                "horseId" => 1,
                "request" => '\Api\Input\Request\Horses\Profile\Horse\Notes',
                'cache' => LifeTime::NO_EXPIRE
            ]
        );

        $router->addGet(
            "/horses/profile/horse/{horseId}/record",
            [
                "controller" => 'Controllers\Horses\Profile\Horse',
                "action" => 'actionGetRecord',
                "horseId" => 1,
                "request" => '\Api\Input\Request\Horses\Profile\Horse\Record',
                'cache' => LifeTime::NO_EXPIRE
            ]
        );

        $router->addGet(
            "/horses/profile/horse/{horseId}/relatives",
            [
                "controller" => 'Controllers\Horses\Profile\Horse',
                "action" => 'actionGetRelatives',
                "horseId" => 1,
                "request" => '\Api\Input\Request\Horses\Profile\Horse\Relatives',
            ]
        );

        $router->addGet(
            "/horses/profile/horse/{horseId}/sales",
            [
                "controller" => 'Controllers\Horses\Profile\Horse',
                "action" => 'actionGetSales',
                "horseId" => 1,
                "request" => '\Api\Input\Request\Horses\Profile\Horse\Sales',
            ]
        );

        $router->addGet(
            "/horses/profile/horse/{horseId}/statistics/:params",
            [
                "controller" => 'Controllers\Horses\Profile\Horse',
                "action" => 'actionGetStatistics',
                "horseId" => 1,
                "params" => 2,
                "request" => '\Api\Input\Request\Horses\Profile\Horse\Statistics',
                'cache' => LifeTime::NO_EXPIRE
            ]
        );

        $router->addGet(
            "/horses/profile/horse/{horseId}/wins",
            [
                "controller" => 'Controllers\Horses\Profile\Horse',
                "action" => 'actionGetWins',
                "horseId" => 1,
                "request" => '\Api\Input\Request\Horses\Profile\Horse\Wins',
                'cache' => LifeTime::NO_EXPIRE
            ]
        );

        $router->addGet(
            "/horses/profile/horse/{horseId}",
            [
                "controller" => 'Controllers\Horses\Profile\Horse',
                "action" => 'actionGetIndex',
                "horseId" => 1,
                "request" => 'Api\Input\Request\Horses\Profile\Horse\Index',
                'cache' => LifeTime::NO_EXPIRE
            ]
        );

        //------------- jockey profile -----------
        $router->addGet(
            "/horses/profile/jockey/{jockeyId}/:action/:params",
            [
                "controller" => 'Controllers\Horses\Profile\Jockey',
                "jockeyId" => 1,
                "action" => 2,
                "params" => 3,
            ]
        );
        $router->addGet(
            "/horses/profile/jockey/{jockeyId}/horses/:params",
            [
                "controller" => 'Controllers\Horses\Profile\Jockey',
                "jockeyId" => 1,
                "request" => 'Api\Input\Request\Horses\Profile\Jockey\Horses',
                "action" => 'actionGetHorses',
                "params" => 2,
            ]
        );
        $router->addGet(
            "/horses/profile/jockey/{jockeyId}/statistical-summary/:params",
            [
                "controller" => 'Controllers\Horses\Profile\Jockey',
                "jockeyId" => 1,
                "request" => 'Api\Input\Request\Horses\Profile\Jockey\StatisticalSummary',
                "action" => 'actionGetStatisticalSummary',
                "params" => 2,
            ]
        );
        $router->addGet(
            "/horses/profile/jockey/{jockeyId}/record-by-race-type/:params",
            [
                "controller" => 'Controllers\Horses\Profile\Jockey',
                "jockeyId" => 1,
                "request" => 'Api\Input\Request\Horses\Profile\Jockey\RecordByRaceType',
                "action" => 'actionGetRecordByRaceType',
                "params" => 2,
            ]
        );
        $router->addGet(
            "/horses/profile/jockey/{jockeyId}/seasons-available",
            [
                "controller" => 'Controllers\Horses\Profile\Jockey\SeasonsAvailable',
                "jockeyId" => 1,
                "request" => 'Api\Input\Request\Horses\Profile\Jockey\SeasonsAvailable',
                "action" => 'actionGetSeasonsAvailable',
            ]
        );
        $router->addGet(
            "/horses/profile/jockey/{jockeyId}/standard",
            [
                "controller" => 'Controllers\Horses\Profile\Jockey\Standard',
                "action" => 'actionGetStandard',
                "jockeyId" => 1,
                "request" => '\Api\Input\Request\Horses\Profile\Jockey\Standard',
            ]
        );
        $router->addGet(
            "/horses/profile/jockey/{jockeyId}",
            [
                "controller" => 'Controllers\Horses\Profile\Jockey',
                "action" => 'actionGetIndex',
                "jockeyId" => 1,
            ]
        );

        //------------- owner profile -----------
        $router->addGet(
            "/horses/profile/owner/{ownerId}/:action/:params",
            [
                "controller" => 'Controllers\Horses\Profile\Owner',
                "ownerId" => 1,
                "action" => 2,
                "params" => 3,
            ]
        );

        $router->addGet(
            "/horses/profile/owner/{ownerId}/last-14-days-form",
            [
                "controller" => 'Controllers\Horses\Profile\Owner',
                "ownerId" => 1,
                "request" => 'Api\Input\Request\Horses\Profile\Owner\Last14DaysForm',
                "action" => 'actionGetLast14DaysForm',
            ]
        );

        $router->addGet(
            "/horses/profile/owner/{ownerId}/seasons-available",
            [
                "controller" => 'Controllers\Horses\Profile\Owner\SeasonsAvailable',
                "ownerId" => 1,
                "request" => 'Api\Input\Request\Horses\Profile\Owner\SeasonsAvailable',
                "action" => 'actionGetSeasonsAvailable',
            ]
        );
        $router->addGet(
            "/horses/profile/owner/{ownerId}/horses/:params",
            [
                "controller" => 'Controllers\Horses\Profile\Owner',
                "ownerId" => 1,
                "request" => 'Api\Input\Request\Horses\Profile\Owner\Horses',
                "action" => 'actionGetHorses',
                "params" => 2,
            ]
        );
        $router->addGet(
            "/horses/profile/owner/{ownerId}/statistical-summary/:params",
            [
                "controller" => 'Controllers\Horses\Profile\Owner',
                "ownerId" => 1,
                "request" => 'Api\Input\Request\Horses\Profile\Owner\StatisticalSummary',
                "action" => 'actionGetStatisticalSummary',
                "params" => 2,
            ]
        );
        $router->addGet(
            "/horses/profile/owner/{ownerId}/record-by-race-type/:params",
            [
                "controller" => 'Controllers\Horses\Profile\Owner',
                "ownerId" => 1,
                "request" => 'Api\Input\Request\Horses\Profile\Owner\RecordByRaceType',
                "action" => 'actionGetRecordByRaceType',
                "params" => 2,
            ]
        );
        $router->addGet(
            "/horses/profile/owner/{ownerId}/standard",
            [
                "controller" => 'Controllers\Horses\Profile\Owner\Standard',
                "action" => 'actionGetStandard',
                "ownerId" => 1,
                "request" => '\Api\Input\Request\Horses\Profile\Owner\Standard',
            ]
        );
        $router->addGet(
            "/horses/profile/owner/{ownerId}",
            [
                "controller" => 'Controllers\Horses\Profile\Owner',
                "action" => 'actionGetIndex',
                "ownerId" => 1,
            ]
        );

        //------------- trainer profile -----------
        $router->addGet(
            "/horses/profile/trainer/{trainerId}/:action/:params",
            [
                "controller" => 'Controllers\Horses\Profile\Trainer',
                "trainerId" => 1,
                "action" => 2,
                "params" => 3,
            ]
        );

        $router->addGet(
            "/horses/profile/trainer/{trainerId}/last-14-days-form",
            [
                "controller" => 'Controllers\Horses\Profile\Trainer',
                "trainerId" => 1,
                "request" => 'Api\Input\Request\Horses\Profile\Trainer\Last14DaysForm',
                "action" => 'actionGetLast14DaysForm',
            ]
        );

        $router->addGet(
            "/horses/profile/trainer/{trainerId}/horses/:params",
            [
                "controller" => 'Controllers\Horses\Profile\Trainer',
                "trainerId" => 1,
                "request" => 'Api\Input\Request\Horses\Profile\Trainer\Horses',
                "action" => 'actionGetHorses',
                "params" => 2,
            ]
        );
        $router->addGet(
            "/horses/profile/trainer/{trainerId}/record-by-race-type/:params",
            [
                "controller" => 'Controllers\Horses\Profile\Trainer',
                "trainerId" => 1,
                "request" => 'Api\Input\Request\Horses\Profile\Trainer\RecordByRaceType',
                "action" => 'actionGetRecordByRaceType',
                "params" => 2,
            ]
        );
        $router->addGet(
            "/horses/profile/trainer/{trainerId}/statistical-summary/:params",
            [
                "controller" => 'Controllers\Horses\Profile\Trainer',
                "trainerId" => 1,
                "request" => 'Api\Input\Request\Horses\Profile\Trainer\StatisticalSummary',
                "action" => 'actionGetStatisticalSummary',
                "params" => 2,
            ]
        );
        $router->addGet(
            "/horses/profile/trainer/{trainerId}/seasons-available",
            [
                "controller" => 'Controllers\Horses\Profile\Trainer\SeasonsAvailable',
                "jockeyId" => 1,
                "request" => 'Api\Input\Request\Horses\Profile\Trainer\SeasonsAvailable',
                "action" => 'actionGetSeasonsAvailable',
            ]
        );
        $router->addGet(
            "/horses/profile/trainer/{trainerId}/standard",
            [
                "controller" => 'Controllers\Horses\Profile\Trainer\Standard',
                "trainerId" => 1,
                "action" => 'actionGetStandard',
                "request" => '\Api\Input\Request\Horses\Profile\Trainer\Standard',
            ]
        );
        $router->addGet(
            "/horses/profile/trainer/{trainerId}",
            [
                "controller" => 'Controllers\Horses\Profile\Trainer',
                "trainerId" => 1,
                "action" => 'actionGetIndex',
            ]
        );

        //------------- bet finder -----------
        $router->addGet(
            "/horses/bet-finder/:action/:params",
            [
                "controller" => 'Controllers\Horses\BetFinder',
                "action" => 1,
                "params" => 2,
            ]
        );
        $router->addGet(
            "/horses/bet-finder",
            [
                "controller" => 'Controllers\Horses\BetFinder',
                "action" => 'actionGetIndex',
            ]
        );

        //------------- draw analyser -----------
        $router->addGet(
            "/horses/draw-analyser/:params",
            [
                "controller" => 'Controllers\Horses\DrawAnalyser',
                "action" => 'actionGetIndex',
                "params" => 1,
            ]
        );

        //------------- predictor -----------
        $router->addGet(
            '/horses/predictor/{raceId}',
            [
                'controller' => 'Controllers\Horses\Predictor\Race',
                'action' => 'actionGetIndex',
                'raceId' => 1,
                'request' => 'Api\Input\Request\Horses\Predictor\Index'
            ]
        );
        $router->addGet(
            '/horses/predictor/next-race',
            [
                'controller' => 'Controllers\Horses\Predictor\NextRace',
                'action' => 'actionGetNextRace',
                'request' => '\Api\Input\Request\Horses\Predictor\NextRace'
            ]
        );

        //------------- race cards -----------
        $router->addGet(
            "/horses/racecards/:action/:params",
            [
                "controller" => 'Controllers\Horses\RaceCards',
                "action" => 1,
                "params" => 2,
            ]
        );

        $router->addGet(
            "/horses/racecards/form/:params",
            [
                "controller" => 'Controllers\Horses\RaceCards',
                "action" => 'actionGetForm',
                'params' => 1,
                "request" => 'Api\Input\Request\Horses\RaceCards\Form'
            ]
        );

        $router->addGet(
            "/horses/racecards/standard-form/:params",
            [
                "controller" => 'Controllers\Horses\RaceCards',
                "action" => 'actionGetStandardForm',
                'params' => 1,
                "request" => 'Api\Input\Request\Horses\RaceCards\StandardForm',
            ]
        );

        $router->addGet(
            "/horses/racecards/{raceId}",
            [
                "controller" => 'Controllers\Horses\RaceCards',
                "action" => 'actionGetIndex',
                'raceId' => 1,
                "request" => 'Api\Input\Request\Horses\RaceCards\Index'
            ]
        );

        $router->addGet(
            "/horses/racecards/{raceId}/head-to-head",
            [
                "controller" => 'Controllers\Horses\RaceCards',
                "action" => 'actionGetHeadToHead',
                'raceId' => 1,
                "request" => 'Api\Input\Request\Horses\RaceCards\HeadToHead'
            ]
        );

        $router->addGet(
            "/horses/racecards/{raceId}/post-picks",
            [
                "controller" => 'Controllers\Horses\RaceCards\PostPicks',
                "action" => 'actionGetData',
                'raceId' => 1,
                "request" => 'Api\Input\Request\Horses\RaceCards\PostPicks'
            ]
        );

        $router->addGet(
            "/horses/racecards/runners/{raceId}",
            [
                "controller" => 'Controllers\Horses\RaceCards\Runners',
                "action" => 'actionGetIndex',
                'raceId' => 1,
                "request" => 'Api\Input\Request\Horses\RaceCards\Runners',
            ]
        );

        $router->addGet(
            "/horses/racecards/runners/{raceId}/sales-data",
            [
                "controller" => 'Controllers\Horses\RaceCards',
                "action" => 'actionGetSalesData',
                "raceId" => 1,
                "request" => 'Api\Input\Request\Horses\RaceCards\SalesData',
            ]
        );

        $router->addGet(
            "/horses/racecards/standard-runners/{raceId}",
            [
                "controller" => 'Controllers\Horses\RaceCards',
                "action" => 'actionGetStandardRunners',
                'raceId' => 1,
                "request" => 'Api\Input\Request\Horses\RaceCards\StandardRunners',
            ]
        );

        $router->addGet(
            "/horses/racecards/date/{raceDate}/all-meetings",
            [
                "controller" => 'Controllers\Horses\RaceCards\Date\AllMeetings',
                "action" => 'actionGetData',
                'raceDate' => 1,
                "request" => 'Api\Input\Request\Horses\RaceCards\Date\AllMeetings'
            ]
        );

        $router->addGet(
            '/horses/racecards/date/{raceDate}/all-races',
            [
                'controller' => 'Controllers\Horses\RaceCards\AllRaces',
                'action' => 'actionGetAllRaces',
                'request' => '\Api\Input\Request\Horses\RaceCards\AllRaces',
                'raceDate' => 1,
            ]
        );

        $router->addGet(
            "/horses/racecards/verdict/:params",
            [
                "controller" => 'Controllers\Horses\RaceCards',
                "action" => 'actionGetVerdict',
                "params" => 1,
                "cache" => LifeTime::NO_EXPIRE,
            ]
        );

        $router->addGet(
            "/horses/racecards/godolphin_check_for_replay/{raceId}",
            [
                "controller" => 'Controllers\Horses\RaceCards\GodolphinReplay',
                "action" => 'actionCheckForReplay',
                "request" => '\Api\Input\Request\Horses\RaceCards\GodolphinReplay',
                "raceId" => 1
            ]
        );

        $router->addGet(
            "/horses/racecards/selections/:params",
            [
                "controller" => 'Controllers\Horses\RaceCards\Selections',
                "request" => '\Api\Input\Request\Horses\RaceCards\Selections',
                "action" => 'actionGetIndex',
                "params" => 1,
                "cache" => LifeTime::NO_EXPIRE,
            ]
        );

        $router->addGet(
            "/horses/racecards/quotes/:params",
            [
                "controller" => 'Controllers\Horses\RaceCards',
                "action" => 'actionGetQuotes',
                "params" => 1,
                "cache" => LifeTime::NO_EXPIRE,
            ]
        );

        $router->addGet(
            "/horses/racecards/todays-trainers",
            [
                "controller" => 'Controllers\Horses\RaceCards',
                "action" => 'actionGetTodaysTrainers',
            ]
        );

        $router->addGet(
            "/horses/racecards/todays-jockeys",
            [
                "controller" => 'Controllers\Horses\RaceCards',
                "action" => 'actionGetTodaysJockeys',
            ]
        );

        $router->addGet(
            "/horses/racecards/upcoming/:params",
            [
                "controller" => 'Controllers\Horses\RaceCards',
                "action" => 'actionGetUpcoming',
                "params" => 1,
                "request" => '\Api\Input\Request\Horses\RaceCards\Upcoming',
            ]
        );

        $router->addGet(
            "/horses/racecards/upcoming/all",
            [
                "controller" => 'Controllers\Horses\RaceCards',
                "action" => 'actionGetUpcoming',
                "request" => '\Api\Input\Request\Horses\RaceCards\UpcomingAll',
            ]
        );

        $router->addGet(
            "/horses/racecards/press-challenge",
            [
                "controller" => 'Controllers\Horses\RaceCards',
                "action" => 'actionGetPressChallenge',
                "request" => '\Api\Input\Request\Horses\RaceCards\PressChallenge',
            ]
        );

        $router->addGet(
            "/horses/racecards/big-races",
            [
                "controller" => 'Controllers\Horses\RaceCards',
                "action" => 'actionGetBigRaces',
            ]
        );

        $router->addGet(
            "/horses/racecards/next-race",
            [
                "controller" => 'Controllers\Horses\RaceCards',
                "action" => 'actionGetNextRace',
            ]
        );

        $router->addGet(
            "/horses/racecards/naps-table",
            [
                "controller" => 'Controllers\Horses\RaceCards',
                "action" => 'actionGetNapsTable',
            ]
        );

        $router->addGet(
            "/horses/racecards/top-naps",
            [
                "controller" => 'Controllers\Horses\RaceCards',
                "action" => 'actionGetTopNaps',
            ]
        );

        $router->addGet(
            "/horses/racecards/trainerspot/race-trace/:params",
            [
                "controller" => 'Controllers\Horses\RaceCards\Trainerspot',
                "action" => 'actionGetRaceTrace',
                "params" => 1,
                "request" => 'Api\Input\Request\Horses\RaceCards\Trainerspot\RaceTrace'
            ]
        );

        $router->addGet(
            "/horses/racecards/trainerspot/in-form/:params",
            [
                "controller" => 'Controllers\Horses\RaceCards\Trainerspot',
                "action" => 'actionGetInForm',
                "params" => 1,
                "request" => 'Api\Input\Request\Horses\RaceCards\Trainerspot\InForm'
            ]
        );

        $router->addGet(
            "/horses/racecards/trainerspot/out-of-form/:params",
            [
                "controller" => 'Controllers\Horses\RaceCards\Trainerspot',
                "action" => 'actionGetOutOfForm',
                "params" => 1,
                "request" => 'Api\Input\Request\Horses\RaceCards\Trainerspot\OutOfForm'
            ]
        );

        $router->addGet(
            "/horses/racecards/trainerspot/course-specialists/:params",
            [
                "controller" => 'Controllers\Horses\RaceCards\Trainerspot',
                "action" => 'actionGetCourseSpecialists',
                "params" => 1,
                "request" => 'Api\Input\Request\Horses\RaceCards\Trainerspot\CourseSpecialists'
            ]
        );

        $router->addGet(
            "/horses/racecards/trainerspot/jockey-bookings/:params",
            [
                "controller" => 'Controllers\Horses\RaceCards\Trainerspot',
                "action" => 'actionGetJockeyBookings',
                "params" => 1,
                "request" => 'Api\Input\Request\Horses\RaceCards\Trainerspot\JockeyBookings'
            ]
        );

        $router->addGet(
            "/horses/racecards/stable-tours-database",
            [
                "controller" => 'Controllers\Horses\RaceCards',
                "action" => 'actionGetStableToursDatabase',
            ]
        );

        $router->addGet(
            "/horses/racecards/{raceId}/betting-forecast",
            [
                "controller" => 'Controllers\Horses\RaceCards',
                "raceId" => 1,
                "action" => 'actionGetBettingForecast',
            ]
        );

        $router->addGet(
            "/horses/racecards/{raceId}/star-rating",
            [
                "controller" => 'Controllers\Horses\RaceCards',
                "raceId" => 1,
                "action" => 'actionGetStartRating',
            ]
        );

        $router->addGet(
            "/horses/racecards/key-stats/{raceId}",
            [
                "controller" => 'Controllers\Horses\RaceCards\KeyStats',
                "action" => 'actionGetKeyStats',
                'request' => '\Api\Input\Request\Horses\RaceCards\KeyStats',
                "raceId" => 1,
                "cache" => LifeTime::NO_EXPIRE,
            ]
        );

        $router->addGet(
            "/horses/racecards/post-pointer-comments/{raceId}",
            [
                "controller" => 'Controllers\Horses\RaceCards\PostPointerComments',
                "action" => 'actionGetPostPointerComments',
                'request' => '\Api\Input\Request\Horses\RaceCards\PostPointerComments',
                "raceId" => 1,
            ]
        );

        $router->addGet(
            "/horses/racecards/post-pointer-verdict/{raceId}",
            [
                "controller" => 'Controllers\Horses\RaceCards\PostPointerVerdict',
                "action" => 'actionGetPostPointerVerdict',
                'request' => '\Api\Input\Request\Horses\RaceCards\PostPointerVerdict',
                "raceId" => 1,
            ]
        );

        $router->addGet(
            "/horses/racecards/{raceId}/wind-surgeries",
            [
                "controller" => 'Controllers\Horses\RaceCards\WindSurgeries',
                "action" => 'actionGetData',
                "raceId" => 1,
                "request" => 'Api\Input\Request\Horses\RaceCards\WindSurgeries',
            ]
        );

        $router->addGet(
            "/horses/racecards/topspeed/{raceId}/{raceDate}",
            [
                "controller" => 'Controllers\Horses\RaceCards',
                "action" => 'actionGetTopspeed',
                "raceId" => 1,
                "raceDate" => 2,
                "request" => 'Api\Input\Request\Horses\RaceCards\Topspeed',
            ]
        );

        $router->addGet(
            "/horses/racecards/rpr/{raceId}",
            [
                "controller" => 'Controllers\Horses\RaceCards',
                "action" => 'actionGetRpr',
                "raceId" => 1,
                "request" => 'Api\Input\Request\Horses\RaceCards\Rpr',
            ]
        );

        $router->addGet(
            "/horses/racecards/ten-year-trends/{raceId}",
            [
                "controller" => 'Controllers\Horses\RaceCards\TenYearTrends',
                "action" => 'actionGetTenYearTrends',
                "raceId" => 1,
                "request" => 'Api\Input\Request\Horses\RaceCards\TenYearTrends',
            ]
        );

        $router->addGet(
            "/horses/racecards/global-comments/:params",
            [
                "controller" => 'Controllers\Horses\RaceCards\GlobalComments',
                "action" => 'actionGetData',
                "params" => 1,
                "request" => 'Api\Input\Request\Horses\RaceCards\GlobalComments',
            ]
        );

        //------------- race meetings -----------
        $router->addGet(
            "/horses/race-meetings/:action/:params",
            [
                "controller" => 'Controllers\Horses\RaceMeetings',
                "action" => 1,
                "params" => 2,
            ]
        );

        $router->addGet(
            "/horses/race-meetings/{meetingDate}",
            [
                "controller" => 'Controllers\Horses\DailyRaceMeetings',
                "action" => 'actionGetMeetings',
                'request' => '\Api\Input\Request\Horses\RaceMeetings\DailyRaceMeetings',
                "meetingDate" => 1,
            ]
        );

        $router->addGet(
            "/horses/race-meetings/jockey-changes/{raceDate}",
            [
                "controller" => 'Controllers\Horses\RaceMeetings',
                "action" => 'actionGetJockeyChanges',
                "request" => "\Api\Input\Request\Horses\RaceMeetings\JockeyChanges",
                "raceDate" => 1
            ]
        );

        $router->addGet(
            "/horses/race-meetings/silks-gen",
            [
                "controller" => 'Controllers\Horses\RaceMeetings',
                "action" => 'actionGetSilksGen',
                "request" => "\Api\Input\Request\Horses\RaceMeetings\SilksGen"
            ]
        );

        $router->addGet(
            "/horses/race-meetings/going-changes/{raceDate}",
            [
                "controller" => 'Controllers\Horses\RaceMeetings',
                "action" => 'actionGetGoingChanges',
                "request" => "\Api\Input\Request\Horses\RaceMeetings\GoingChanges",
                "raceDate" => 1
            ]
        );

        //------------- results -----------
        $router->addGet(
            "/horses/results/:action/:params",
            [
                "controller" => 'Controllers\Horses\Results',
                "action" => 1,
                "params" => 2,
            ]
        );
        $router->addGet(
            "/horses/results/date/{raceDate}",
            [
                "controller" => 'Controllers\Horses\Results',
                "action" => 'actionGetDate',
                'request' => '\Api\Input\Request\Horses\Results\DateRequest',
                "raceDate" => 1,
                'cache' => LifeTime::NO_EXPIRE
            ]
        );
        $router->addGet(
            "/horses/results/date/{raceDate}/limited",
            [
                "controller" => 'Controllers\Horses\Results',
                "action" => 'actionGetDate',
                'request' => '\Api\Input\Request\Horses\Results\DateLimitedRequest',
                "raceDate" => 1,
                'cache' => LifeTime::NO_EXPIRE
            ]
        );
        $router->addGet(
            "/horses/results/date/{raceDate}/all-races",
            [
                "controller" => 'Controllers\Horses\Results',
                "action" => 'actionGetAllRaces',
                'request' => '\Api\Input\Request\Horses\Results\DateRequestAllRaces',
                "raceDate" => 1,
                'cache' => LifeTime::NO_EXPIRE
            ]
        );
        $router->addGet(
            "/horses/results/{raceId}",
            [
                "controller" => 'Controllers\Horses\Results',
                "action" => 'actionGetIndex',
                'request' => '\Api\Input\Request\Horses\Results\Index',
                "raceId" => 1,
                'cache' => LifeTime::NO_EXPIRE
            ]
        );

        $router->addGet(
            "/horses/results/{raceId}/limited",
            [
                "controller" => 'Controllers\Horses\Results',
                "action" => 'actionGetIndex',
                'request' => '\Api\Input\Request\Horses\Results\IndexLimited',
                "raceId" => 1,
                'cache' => LifeTime::NO_EXPIRE
            ]
        );

        $router->addGet(
            "/horses/results/{raceId}/sales-data",
            [
                "controller" => 'Controllers\Horses\Results',
                "action" => 'actionGetResultsSalesData',
                "raceId" => 1,
                "request" => 'Api\Input\Request\Horses\Results\SalesData',
            ]
        );

        $router->addGet(
            "/horses/results/race-info/{raceId}",
            [
                "controller" => 'Controllers\Horses\Results',
                "action" => 'actionGetRaceInfo',
                'request' => 'Api\Input\Request\Horses\Results\RaceInfo',
                "raceId" => 1,
                'cache' => LifeTime::NO_EXPIRE
            ]
        );

        $router->addGet(
            "/horses/results/{raceId}/past-winners",
            [
                "controller" => 'Controllers\Horses\Results',
                "action" => 'actionGetPastWinners',
                'request' => '\Api\Input\Request\Horses\Results\PastWinners',
                "raceId" => 1,
                'cache' => LifeTime::NO_EXPIRE
            ]
        );
        $router->addGet(
            "/horses/results",
            [
                "controller" => 'Controllers\Horses\Results',
                "action" => 'actionGetIndex',
                'request' => '\Api\Input\Request\Horses\Results\Index',
            ]
        );

        $router->addGet(
            "/horses/results/search",
            [
                "controller" => 'Controllers\Horses\Results',
                "action" => 'actionGetSearch',
                'request' => '\Api\Input\Request\Horses\Results\Search',
            ]
        );

        $router->addGet(
            "/horses/results/courses",
            [
                "controller" => 'Controllers\Horses\Results',
                "action" => 'actionGetCourses',
                'request' => '\Api\Input\Request\Horses\Results\Courses',
                'cache' => LifeTime::NO_EXPIRE
            ]
        );

        $router->addGet(
            "/horses/results/fast/:params",
            [
                "controller" => 'Controllers\Horses\Results',
                "action" => 'actionGetFast',
                'request' => 'Api\Input\Request\Horses\Results\Fast',
                "params" => 1,
                'cache' => LifeTime::NO_EXPIRE
            ]
        );

        $router->addGet(
            "/horses/results/fast-by-race/:params",
            [
                "controller" => 'Controllers\Horses\Results',
                "action" => 'actionGetFastByRace',
                'request' => 'Api\Input\Request\Horses\Results\FastByRace',
                "params" => 1,
                'cache' => LifeTime::NO_EXPIRE
            ]
        );

        //------------- ads -------------
        $router->addGet(
            "/horses/ads/success-boxes/:params",
            [
                "controller" => 'Controllers\Horses\Ads\SuccessBoxes',
                "action" => 'actionGetIndex',
                "params" => 1,
                "request" => 'Api\Input\Request\Horses\Ads\SuccessBoxes\Index',
            ]
        );

        //------------- bloodstock stallion -------------

        $router->addGet(
            "/horses/bloodstock/stallion/{stallionId}/:action/:params",
            [
                "controller" => 'Controllers\Horses\Bloodstock\Stallion',
                "stallionId" => 1,
                "action" => 2,
                "params" => 3,
            ]
        );

        $router->addGet(
            "/horses/bloodstock/stallion/{stallionId}",
            [
                "controller" => 'Controllers\Horses\Bloodstock\Stallion',
                "action" => 'actionGetIndex',
                "request" => 'Api\Input\Request\Horses\Bloodstock\Stallion\Index',
            ]
        );

        $router->addGet(
            "/horses/bloodstock/stallion/{stallionId}/progeny-statistics",
            [
                "controller" => 'Controllers\Horses\Bloodstock\Stallion',
                "action" => 'actionGetProgenyStatistics',
                "stallionId" => 1,
                "request" => 'Api\Input\Request\Horses\Bloodstock\Stallion\ProgenyStatistics',
            ]
        );

        $router->addGet(
            "/horses/bloodstock/stallion/{stallionId}/progeny-statistics/going-form",
            [
                "controller" => 'Controllers\Horses\Bloodstock\Stallion',
                "action" => 'actionGetProgenyStatisticsGoingForm',
                "request" => 'Api\Input\Request\Horses\Bloodstock\Stallion\ProgenyStatisticsGoingForm',
            ]
        );

        $router->addGet(
            "/horses/bloodstock/stallion/{stallionId}/progeny-horses",
            [
                "controller" => 'Controllers\Horses\Bloodstock\Stallion',
                "action" => 'actionGetProgenyHorses',
                "stallionId" => 1,
                "request" => 'Api\Input\Request\Horses\Bloodstock\Stallion\ProgenyHorses',
            ]
        );

        $router->addGet(
            "/horses/bloodstock/stallion/{stallionId}/dam-sire-seasons-available",
            [
                "controller" => 'Controllers\Horses\Bloodstock\Stallion',
                "action" => 'actionGetDamSireSeasons',
                "stallionId" => 1,
                "request" => 'Api\Input\Request\Horses\Bloodstock\Stallion\DamSireSeasons',
            ]
        );

        $router->addGet(
            "/horses/bloodstock/stallion/{stallionId}/progeny-horses/{raceType}/{seasonYearBegin}/{seasonYearEnd}/{number}",
            [
                "controller" => 'Controllers\Horses\Bloodstock\Stallion',
                "action" => 'actionGetProgenyHorses',
                "stallionId" => 1,
                "request" => 'Api\Input\Request\Horses\Bloodstock\Stallion\ProgenyHorses',
            ]
        );

        $router->addGet(
            "/horses/bloodstock/stallion/{stallionId}/dam-sire-progeny-horses",
            [
                "controller" => 'Controllers\Horses\Bloodstock\Stallion\DamSireProgenyHorses',
                "action" => 'actionGetData',
                "stallionId" => 1,
                "request" => 'Api\Input\Request\Horses\Bloodstock\Stallion\DamSireProgenyHorses',
            ]
        );

        $router->addGet(
            "/horses/bloodstock/stallion/{stallionId}/dam-sire-progeny-horses/{raceType}/{seasonYearBegin}/{seasonYearEnd}/{number}",
            [
                "controller" => 'Controllers\Horses\Bloodstock\Stallion\DamSireProgenyHorses',
                "action" => 'actionGetData',
                "stallionId" => 1,
                "request" => 'Api\Input\Request\Horses\Bloodstock\Stallion\DamSireProgenyHorses',
            ]
        );

        $router->addGet(
            "/horses/bloodstock/stallion/{stallionId}/nick",
            [
                "controller" => 'Controllers\Horses\Bloodstock\Stallion',
                "action" => 'actionGetNick',
                "stallionId" => 1,
                "request" => 'Api\Input\Request\Horses\Bloodstock\Stallion\Nick',
            ]
        );

        $router->addGet(
            "/horses/bloodstock/stallion/{stallionId}/seasons-available",
            [
                "controller" => 'Controllers\Horses\Bloodstock\Stallion',
                "action" => 'actionGetSeasonsAvailable',
                "stallionId" => 1,
                "request" => 'Api\Input\Request\Horses\Bloodstock\Stallion\SeasonsAvailable',
            ]
        );

        $router->addGet(
            "/horses/bloodstock/stallion/{stallionId}/progeny-results",
            [
                "controller" => 'Controllers\Horses\Bloodstock\Stallion',
                "action" => 'actionGetProgenyResults',
                "stallionId" => 1,
                "request" => 'Api\Input\Request\Horses\Bloodstock\Stallion\ProgenyResults',
            ]
        );

        $router->addGet(
            "/horses/bloodstock/stallion/{stallionId}/progeny-results/:params",
            [
                "controller" => 'Controllers\Horses\Bloodstock\Stallion',
                "action" => 'actionGetProgenyResults',
                "stallionId" => 1,
                "params" => 2,
                "request" => 'Api\Input\Request\Horses\Bloodstock\Stallion\ProgenyResults',
            ]
        );

        //------------- bloodstock stallion-statistics -------------
        $router->addGet(
            "/horses/bloodstock/stallion-statistics/:action/:params",
            [
                "controller" => 'Controllers\Horses\Bloodstock\Statistics',
                "action" => 1,
                "params" => 2,
            ]
        );

        //------------- bloodstock stallion-book -------------
        $router->addGet(
            "/horses/bloodstock/stallion-book/:params",
            [
                "controller" => 'Controllers\Horses\Bloodstock\StallionBook',
                "action" => 'actionGetIndex',
                "params" => 1,
            ]
        );

        $router->addGet(
            "/horses/bloodstock/stallion-book/names/:params",
            [
                "controller" => 'Controllers\Horses\Bloodstock\StallionBook',
                "action" => 'actionGetNames',
                "params" => 1,
            ]
        );

        //------------- bloodstock sales -------------
        $router->addGet(
            "/horses/bloodstock/sales/(upcoming-sales|sales-results|company-names|upcoming-names)/:params",
            [
                "controller" => 'Controllers\Horses\Bloodstock\Sales',
                "action" => 1,
                "params" => 2,
            ]
        );

        $router->addGet(
            "/horses/bloodstock/sales/catalogue/full/:params",
            [
                "controller" => 'Controllers\Horses\Bloodstock\Sales',
                "action" => 'actionGetCatalogue',
                "params" => 1,
            ]
        );

        $router->addGet(
            "/horses/bloodstock/sales/catalogue/{venueId}/{startDate}/{endDate}/vendors",
            [
                "controller" => 'Controllers\Horses\Bloodstock\Sales',
                "action" => 'actionGetCatalogueVendors',
                "venueId" => 1,
                "startDate" => 2,
                "endDate" => 3,
            ]
        );

        $router->addGet(
            "/horses/bloodstock/sales/catalogue/{venueId}/{startDate}/{endDate}/sires",
            [
                "controller" => 'Controllers\Horses\Bloodstock\Sales',
                "action" => 'actionGetCatalogueSires',
                "venueId" => 1,
                "startDate" => 2,
                "endDate" => 3,
            ]
        );

        $router->addGet(
            "/horses/bloodstock/sales/catalogue/{venueId}/{startDate}/{endDate}/previously-sold",
            [
                "controller" => 'Controllers\Horses\Bloodstock\Sales',
                "venueId" => 1,
                "startDate" => 2,
                "endDate" => 3,
                "action" => "actionGetCataloguePreviouslySold",
            ]
        );

        $router->addGet(
            "/horses/bloodstock/sales/statistics/:action/:params",
            [
                "controller" => 'Controllers\Horses\Bloodstock\SalesStatistics',
                "action" => 1,
                "params" => 2,
            ]
        );

        //------------- bloodstock dam -------------
        $router->addGet(
            "/horses/bloodstock/dam/{damId}/:action/:params",
            [
                "controller" => 'Controllers\Horses\Bloodstock\Dam',
                "damId" => 1,
                "action" => 2,
                "params" => 3,
            ]
        );

        $router->addGet(
            "/horses/bloodstock/dam/{damId}/progeny-results/sales-default",
            [
                "controller" => 'Controllers\Horses\Bloodstock\Dam',
                "damId" => 1,
                "action" => 'actionGetProgenyResultsSalesDefault',
            ]
        );

        $router->addGet(
            "/horses/bloodstock/dam/dam-list",
            [
                "controller" => 'Controllers\Horses\Bloodstock\Dam',
                "action" => 'actionGetDamList',
                "request" => '\Api\Input\Request\Horses\Bloodstock\Dam\DamList',
            ]
        );

        //------------- lookup tables -------------
        $router->addGet(
            "/horses/lookup-table/:action/:params",
            [
                "controller" => 'Controllers\Horses\LookupTable',
                "action" => 1,
                "params" => 2,
            ]
        );

        $router->addGet(
            '/horses/lookup-table/race-group',
            [
                'controller' => 'Controllers\Horses\LookupTable\RaceGroup',
                'action' => 'actionGetData',
                'request' => 'Api\Input\Request\Horses\LookupTable\RaceGroup',
            ]
        );

        $router->addGet(
            '/horses/lookup-table/sales-venues',
            [
                'controller' => 'Controllers\Horses\LookupTable\SalesVenues',
                'action' => 'actionGetData',
                'request' => 'Api\Input\Request\Horses\LookupTable\SalesVenues',
            ]
        );

        $router->addGet(
            '/horses/lookup-table/course-list',
            [
                'controller' => 'Controllers\Horses\LookupTable\CourseList',
                'action' => 'actionGetData',
                'request' => 'Api\Input\Request\Horses\LookupTable\CourseList',
            ]
        );

        $router->addGet(
            '/horses/lookup-table/horse-head-gear',
            [
                'controller' => 'Controllers\Horses\LookupTable\HorseHeadGear',
                'action' => 'actionGetData',
                'request' => 'Api\Input\Request\Horses\LookupTable\HorseHeadGear',
            ]
        );

        //------------- seasonal statistic -------------
        $router->addGet(
            "/horses/seasonal-statistics/:action/:params",
            [
                "controller" => 'Controllers\Horses\SeasonalStatistics',
                "action" => 1,
                "params" => 2,
            ]
        );

        $router->addGet(
            "/horses/seasonal-statistics/sire/:params",
            [
                "controller" => 'Controllers\Horses\SeasonalStatistics\Sire',
                'action' => 'actionGetData',
                'params' => 1,
                'request' => 'Api\Input\Request\Horses\SeasonalStatistics\Sire',
            ]
        );

        $router->addGet(
            "/horses/seasonal-statistics/first-crop/:params",
            [
                "controller" => 'Controllers\Horses\SeasonalStatistics\FirstCrop',
                'action' => 'actionGetData',
                'params' => 1,
                'request' => 'Api\Input\Request\Horses\SeasonalStatistics\FirstCrop',
            ]
        );

        $router->addGet(
            "/horses/seasonal-statistics/horse/:params",
            [
                "controller" => 'Controllers\Horses\SeasonalStatistics\Horse',
                'action' => 'actionGetData',
                'params' => 1,
                'request' => 'Api\Input\Request\Horses\SeasonalStatistics\Horse',
            ]
        );

        $router->addGet(
            "/horses/seasonal-statistics/jockey/:params",
            [
                "controller" => 'Controllers\Horses\SeasonalStatistics\Jockey',
                'action' => 'actionGetData',
                'params' => 1,
                'request' => 'Api\Input\Request\Horses\SeasonalStatistics\Jockey',
            ]
        );

        $router->addGet(
            "/horses/seasonal-statistics/trainer/:params",
            [
                "controller" => 'Controllers\Horses\SeasonalStatistics\Trainer',
                'action' => 'actionGetData',
                'params' => 1,
                'request' => 'Api\Input\Request\Horses\SeasonalStatistics\Trainer',
            ]
        );

        $router->addGet(
            "/horses/seasonal-statistics/owner/:params",
            [
                "controller" => 'Controllers\Horses\SeasonalStatistics\Owner',
                'action' => 'actionGetData',
                'params' => 1,
                'request' => 'Api\Input\Request\Horses\SeasonalStatistics\Owner',
            ]
        );

        $router->addGet(
            "/horses/seasonal-statistics/broodmare-sire/:params",
            [
                "controller" => 'Controllers\Horses\SeasonalStatistics\BroodmareSire',
                'action' => 'actionGetData',
                'params' => 1,
                'request' => 'Api\Input\Request\Horses\SeasonalStatistics\BroodmareSire',
            ]
        );

        $router->addGet(
            "/horses/seasonal-statistics/championships-available/:params",
            [
                "controller" => 'Controllers\Horses\SeasonalStatistics\ChampionshipsAvailable',
                'action' => 'actionGetData',
                'params' => 1,
                'request' => 'Api\Input\Request\Horses\SeasonalStatistics\ChampionshipsAvailable',
            ]
        );

        $router->addGet(
            "/horses/seasonal-statistics/seasons-available/:params",
            [
                "controller" => 'Controllers\Horses\SeasonalStatistics\SeasonsAvailable',
                'action' => 'actionGetData',
                'params' => 1,
                'request' => 'Api\Input\Request\Horses\SeasonalStatistics\SeasonsAvailable',
            ]
        );

        //------------- signposts -------------

        $router->addGet(
            "/horses/signposts",
            [
                "controller" => 'Controllers\Horses\Signposts',
                "action" => 'actionGetIndex',
            ]
        );

        $router->addGet(
            "/horses/signposts/:action/:params",
            [
                "controller" => 'Controllers\Horses\Signposts',
                "action" => 1,
                "params" => 2,
            ]
        );

        $router->addGet(
            "/horses/signposts/daily",
            [
                "controller" => 'Controllers\Horses\Signposts',
                "action" => 'actionGetIndex',
                "daily" => "daily",
            ]
        );

        //------------- heartbeat -------------
        $router->addGet(
            "/horses/heartbeat",
            [
                "controller" => 'Controllers\Horses\Heartbeat',
                "action" => 'actionGetIndex',
                "cache" => LifeTime::ZERO,
            ]
        );
        $router->addGet(
            "/horses/heartbeat/:action",
            [
                "controller" => 'Controllers\Horses\Heartbeat',
                "action" => 1,
                "cache" => LifeTime::ZERO,
            ]
        );

        //------------- horse tracker -------------
        $router->addGet(
            "/horses/horse-tracker/{userId}/:action/:params",
            [
                "controller" => 'Controllers\Horses\HorseTracker',
                "userId" => 1,
                "action" => 2,
                "params" => 3,
                "cache" => LifeTime::SHORT,
            ]
        );

        $router->addGet(
            "/horses/horse-tracker/{userId}",
            [
                "controller" => 'Controllers\Horses\HorseTracker',
                "action" => 'actionGetIndex',
                "userId" => 1,
                "cache" => LifeTime::SHORT,
            ]
        );

        //------------ Going to Suit ------------------

        $router->addGet(
            "/horses/going-to-suit/:action/:params",
            [
                "controller" => 'Controllers\Horses\GoingToSuit',
                "action" => 1,
                "params" => 2,
            ]
        );

        $router->addGet(
            "/horses/going-to-suit/:int",
            [
                "controller" => 'Controllers\Horses\GoingToSuit',
                "action" => 'actionGetIndex',
                "raceId" => 1,
            ]
        );

        $router->addGet(
            "/horses/bet-prompts/{raceId}/:params",
            [
                'controller' => 'Controllers\Horses\BetPrompts',
                'action' => 'actionGetIndex',
                'raceId' => 1,
                'params' => 2,
            ]
        );

        //------------- Stakes data -------------

        $router->addGet(
            "/horses/stakes-data/horse/{horseId}/:params",
            [
                'controller' => 'Controllers\Horses\StakesData',
                'action' => 'actionGetHorse',
                'horseId' => 1,
                'params' => 2,
            ]
        );

        $router->addGet(
            "/horses/stakes-data/jockey/{jockeyId}/:params",
            [
                'controller' => 'Controllers\Horses\StakesData',
                'action' => 'actionGetJockey',
                'jockeyId' => 1,
                'params' => 2,
            ]
        );

        $router->addGet(
            "/horses/stakes-data/trainer/{trainerId}/:params",
            [
                'controller' => 'Controllers\Horses\StakesData',
                'action' => 'actionGetTrainer',
                'trainerId' => 1,
                'params' => 2,
            ]
        );

        //------------- Tote predictor -------------

        $router->addGet(
            '/horses/tote-predictor/{raceId}',
            [
                'controller' => 'Controllers\Horses\TotePredictor\Race',
                'action' => 'actionGetRace',
                'raceId' => 1,
                'params' => 2,
                'request' => '\Api\Input\Request\Horses\TotePredictor\Race',
            ]
        );

        $router->addGet(
            '/horses/tote-predictor/meeting/{date}/{courseId}',
            [
                'controller' => 'Controllers\Horses\TotePredictor\Meeting',
                'action' => 'actionGetMeeting',
                'date' => 1,
                'courseId' => 2,
                'request' => '\Api\Input\Request\Horses\TotePredictor\Meeting',
            ]
        );

        $router->addGet(
            '/horses/tote-predictor/meeting/{date}/scoop-6',
            [
                'controller' => 'Controllers\Horses\TotePredictor\Meeting\Scoop6',
                'action' => 'actionGetData',
                'date' => 1,
                'request' => 'Api\Input\Request\Horses\TotePredictor\Meeting\Scoop6',
            ]
        );

        $router->addGet(
            '/horses/tote-predictor/meeting/{date}/jackpot',
            [
                'controller' => 'Controllers\Horses\TotePredictor\Meeting\Jackpot',
                'action' => 'actionGetData',
                'date' => 1,
                'request' => '\Api\Input\Request\Horses\TotePredictor\Meeting\Jackpot',
            ]
        );

        //------------- Owner groups --------------------

        $router->addGet(
            '/horses/owner-groups/{ownerGroupId}/horse-list',
            [
                'controller' => 'Controllers\Horses\OwnerGroups\HorseList',
                'action' => 'actionGetData',
                'ownerGroupId' => 1,
                'request' => 'Api\Input\Request\Horses\OwnerGroups\HorseList',
            ]
        );

        $router->addGet(
            '/horses/owner-groups/{ownerGroupId}/entries/:params',
            [
                'controller' => 'Controllers\Horses\OwnerGroups\Entries',
                'action' => 'actionGetData',
                'ownerGroupId' => 1,
                'request' => 'Api\Input\Request\Horses\OwnerGroups\Entries',
                'params' => 2,
            ]
        );

        $router->addGet(
            '/horses/owner-groups/{ownerGroupId}/results',
            [
                'controller' => 'Controllers\Horses\OwnerGroups\Results',
                'action' => 'actionGetData',
                'ownerGroupId' => 1,
                'request' => 'Api\Input\Request\Horses\OwnerGroups\Results',
            ]
        );

        $router->addGet(
            '/horses/owner-groups/results/first-season-sire/{firstSeasonSireGroupName}',
            [
                'controller' => 'Controllers\Horses\OwnerGroups\Results',
                'action' => 'actionSeasonSire',
                'request' => 'Api\Input\Request\Horses\OwnerGroups\Results\FirstSeasonSire',
            ]
        );

        $router->addGet(
            '/horses/owner-groups/results/second-season-sire/{secondSeasonSireGroupName}',
            [
                'controller' => 'Controllers\Horses\OwnerGroups\Results',
                'action' => 'actionSeasonSire',
                'request' => 'Api\Input\Request\Horses\OwnerGroups\Results\SecondSeasonSire',
            ]
        );

        $router->addGet(
            '/horses/owner-groups/owner-list',
            [
                'controller' => 'Controllers\Horses\OwnerGroups\OwnerList',
                'action' => 'actionGetData',
                'request' => 'Api\Input\Request\Horses\OwnerGroups\OwnerList',
            ]
        );

        $router->addGet(
            '/horses/owner-groups/splash',
            [
                'controller' => 'Controllers\Horses\OwnerGroups\Splash',
                'action' => 'actionGetData',
                'request' => 'Api\Input\Request\Horses\OwnerGroups\Splash',
            ]
        );

        $router->addGet(
            '/horses/owner-groups/trainer-list',
            [
                'controller' => 'Controllers\Horses\OwnerGroups\TrainerList',
                'action' => 'actionGetData',
                'request' => 'Api\Input\Request\Horses\OwnerGroups\TrainerList',
            ]
        );

        $router->addGet(
            '/horses/owner-groups/country-list',
            [
                'controller' => 'Controllers\Horses\OwnerGroups\CountryList',
                'action' => 'actionGetData',
                'request' => 'Api\Input\Request\Horses\OwnerGroups\CountryList',
            ]
        );

        $router->addGet(
            '/horses/owner-groups/entries/first-season-sire/{firstSeasonSireGroupName}',
            [
                'controller' => 'Controllers\Horses\OwnerGroups\Entries',
                'action' => 'actionSeasonSire',
                'request' => 'Api\Input\Request\Horses\OwnerGroups\Entries\FirstSeasonSire',
            ]
        );
        $router->addGet(
            '/horses/owner-groups/entries/second-season-sire/{secondSeasonSireGroupName}',
            [
                'controller' => 'Controllers\Horses\OwnerGroups\Entries',
                'action' => 'actionSeasonSire',
                'request' => 'Api\Input\Request\Horses\OwnerGroups\Entries\SecondSeasonSire',
            ]
        );
        $router->addGet(
            '/horses/owner-groups/daily-stats/coolmore/:params',
            [
                'controller' => 'Controllers\Horses\OwnerGroups\DailyStats',
                'action' => 'actionGetData',
                'request' => 'Api\Input\Request\Horses\OwnerGroups\DailyStats',
                'params' => 1,
            ]
        );
        $router->addGet(
            '/horses/tipping/singles/{raceDate}',
            [
                'controller' => 'Controllers\Horses\Tipping',
                'action' => 'actionTippingSingles',
                'request' => 'Api\Input\Request\Horses\Tipping\Singles',
            ]
        );

        $router->addGet(
            '/horses/tipping/multiples/{raceDate}',
            [
                'controller' => 'Controllers\Horses\Tipping',
                'action' => 'actionTippingMultiples',
                'request' => 'Api\Input\Request\Horses\Tipping\Multiples',
            ]
        );

        $router->addGet(
            '/horses/tipping/success/{raceDate}',
            [
                'controller' => 'Controllers\Horses\Tipping',
                'action' => 'actionTippingSuccess',
                'request' => 'Api\Input\Request\Horses\Tipping\Success',
            ]
        );

        //------------- AD Prompts --------------------
        $router->addGet(
            '/horses/ad-prompts/next-race',
            [
                'controller' => 'Controllers\Horses\AdPrompts\NextRace',
                'action' => 'actionGetData',
                'request' => 'Api\Input\Request\Horses\AdPrompts\NextRace',
            ]
        );

        //------------- Head to head --------------
        $router->addGet(
            '/horses/head-to-head/{firstHorseUid}/{secondHorseUid}',
            [
                'controller' => 'Controllers\Horses\HeadToHead',
                'action' => 'actionGetIndex',
                'request' => 'Api\Input\Request\Horses\HeadToHead\Index',
            ]
        );
        //------------- Native --------------------


        $router->addGet(
            '/horses/native/cards/date-menu',
            [
                'controller' => 'Controllers\Horses\Native\Cards\DateMenu',
                'action' => 'actionGetData',
                'request' => 'Api\Input\Request\Horses\Native\Cards\DateMenu',
                'xmlErrors' => 'xml',
            ]
        );

        $router->addGet(
            '/horses/native/cards/{raceId}/bet-to-view',
            [
                'controller' => 'Controllers\Horses\Native\Cards\BetToView',
                'action' => 'actionGetData',
                'raceId' => 1,
                'request' => 'Api\Input\Request\Horses\Native\Cards\BetToView',
                'xmlErrors' => 'xml',
            ]
        );

        $router->addGet(
            '/horses/native/cards/{raceId}/predictor',
            [
                'controller' => 'Controllers\Horses\Native\Cards\Predictor\Race',
                'action' => 'actionGetRace',
                'raceId' => 1,
                'request' => 'Api\Input\Request\Horses\Native\Cards\Predictor\Race',
                'xmlErrors' => 'xml',
            ]
        );

        $router->addGet(
            '/horses/native/cards/{raceId}/tips',
            [
                'controller' => 'Controllers\Horses\Native\Cards\Tips',
                'action' => 'actionGetData',
                'raceId' => 1,
                'request' => 'Api\Input\Request\Horses\Native\Cards\Tips',
                'xmlErrors' => 'xml',
            ]
        );

        $router->addGet(
            '/horses/native/cards/{raceDate}/list',
            [
                'controller' => 'Controllers\Horses\Native\Cards\CardsList',
                'action' => 'actionGetData',
                'raceDate' => 1,
                'request' => 'Api\Input\Request\Horses\Native\Cards\CardsList',
                'xmlErrors' => 'xml',
            ]
        );

        $router->addGet(
            '/horses/native/meetings/{meetingDate}/list',
            [
                'controller' => 'Controllers\Horses\Native\Meetings\MeetingList',
                'action' => 'actionGetListByDate',
                'raceId' => 1,
                'request' => 'Api\Input\Request\Horses\Native\Meetings\MeetingList',
                'xmlErrors' => 'xml',
            ]
        );

        $router->addGet(
            '/horses/native/cards/{date}/next-race',
            [
                'controller' => 'Controllers\Horses\Native\Cards\NextRace',
                'action' => 'actionGetData',
                'request' => 'Api\Input\Request\Horses\Native\Cards\NextRace',
                'xmlErrors' => 'xml',
            ]
        );

        $router->addGet(
            '/horses/native/cards/{raceDate}/big-races',
            [
                'controller' => 'Controllers\Horses\Native\Cards\BigRaces',
                'action' => 'actionGetData',
                'request' => 'Api\Input\Request\Horses\Native\Cards\BigRaces',
                'xmlErrors' => 'xml',
            ]
        );

        $router->addGet(
            '/horses/native/cards/{raceId}/full-card',
            [
                'controller' => 'Controllers\Horses\Native\Cards\FullCard',
                'action' => 'actionGetData',
                'request' => 'Api\Input\Request\Horses\Native\Cards\FullCard',
                'xmlErrors' => 'xml',
            ]
        );

        $router->addGet(
            '/horses/native/cards/{raceId}/form',
            [
                'controller' => 'Controllers\Horses\Native\Cards\Form',
                'action' => 'actionGetData',
                'request' => 'Api\Input\Request\Horses\Native\Cards\Form',
                'xmlErrors' => 'xml',
            ]
        );
        $router->addGet(
            '/horses/native/results/date-menu',
            [
                'controller' => 'Controllers\Horses\Native\Results\DateMenu',
                'action' => 'actionGetData',
                'request' => 'Api\Input\Request\Horses\Native\Results\DateMenu',
                'xmlErrors' => 'xml',
            ]
        );

        $router->addGet(
            '/horses/native/results/{raceId}/full-result',
            [
                'controller' => 'Controllers\Horses\Native\Results\FullResult',
                'action' => 'actionGetData',
                'raceId' => 1,
                'xmlErrors' => 'xml',
                'request' => 'Api\Input\Request\Horses\Native\Results\FullResult',
                'cache' => LifeTime::EXTRALONG,
            ]
        );

        $router->addGet(
            '/horses/native/results/{resultsDate}/list',
            [
                'controller' => 'Controllers\Horses\Native\Results\ResultsList',
                'action' => 'actionGetData',
                'resultsDate' => 1,
                'xmlErrors' => 'xml',
                'request' => 'Api\Input\Request\Horses\Native\Results\ResultsList'
            ]
        );

        $router->addGet(
            '/horses/native/profiles/horses/{horseId}',
            [
                'controller' => 'Controllers\Horses\Native\Profiles\Horses\Horse',
                'action' => 'actionGetData',
                'horseId' => 1,
                'request' => 'Api\Input\Request\Horses\Native\Profiles\Horses\Horse',
                'xmlErrors' => 'xml',
                'cache' => LifeTime::EXTRALONG,
            ]
        );

        $router->addGet(
            '/horses/native/profiles/horses/search',
            [
                'controller' => 'Controllers\Horses\Native\Profiles\Horses\Search',
                'action' => 'actionGetData',
                'request' => 'Api\Input\Request\Horses\Native\Profiles\Horses\Search',
                'xmlErrors' => 'xml',
            ]
        );

        $router->addGet(
            '/horses/native/competitor/{horseId}/{raceId}',
            [
                'controller' => 'Controllers\Horses\Native\Competitor\CompetitorDetails',
                'action' => 'actionGetData',
                'horseId' => 1,
                'raceId' => 2,
                'request' => 'Api\Input\Request\Horses\Native\Competitor\CompetitorDetails',
                'xmlErrors' => 'xml',
            ]
        );

        $router->addGet(
            '/horses/native/video-list',
            [
                'controller' => 'Controllers\Horses\Native\VideoList',
                'action' => 'actionGetData',
                'request' => 'Api\Input\Request\Horses\Native\VideoList',
                'xmlErrors' => 'xml',
            ]
        );

        // ------- Janus Endpoints----------- //
        $router->addGet(
            "/horses/meetings",
            [
                "controller" => 'Controllers\Horses\Meetings',
                "action" => 'actionGetData',
                "request" => '\Api\Input\Request\Horses\Meetings',
            ]
        );

        $router->addGet(
            "/horses/meetings/{meetingDate}/weather-conditions/:params",
            [
                "controller" => 'Controllers\Horses\Meetings',
                "action" => 'actionGetWeatherConditions',
                'request' => '\Api\Input\Request\Horses\WeatherConditions',
                "meetingDate" => 1,
                "params" => 2,
            ]
        );

        $router->addGet(
            "/horses/races/one-two-three",
            [
                "controller" => 'Controllers\Horses\Races',
                "action" => 'actionGetData',
                "request" => '\Api\Input\Request\Horses\Races\Request',
                'cache' => LifeTime::NO_EXPIRE
            ]
        );

        $router->addGet(
            "/horses/races/{raceId}/one-two-three",
            [
                "controller" => 'Controllers\Horses\Races',
                "action" => 'actionGetDataForRaceId',
                "raceId" => 1,
                "request" => '\Api\Input\Request\Horses\Races\RequestById',
                'cache' => LifeTime::NO_EXPIRE
            ]
        );

        $router->addGet(
            "/horses/races/favourites",
            [
                "controller" => 'Controllers\Horses\Races',
                "action" => 'actionGetFavourites',
                "request" => '\Api\Input\Request\Horses\Races\Request',
            ]
        );

        $router->addGet(
            "/horses/races/runners-index/{date}",
            [
                "controller" => 'Controllers\Horses\Races',
                "action" => 'actionGetRunnersIndex',
                "request" => '\Api\Input\Request\Horses\Races\Request',
            ]
        );

        $router->addGet(
            "/horses/racecards-results/{raceId}",
            [
                "controller" => 'Controllers\Horses\RacecardsResults',
                "action" => 'actionGetData',
                'raceId' => 1,
                "request" => '\Api\Input\Request\Horses\RacecardsResults',
            ]
        );
        $router->addGet(
            "/horses/form/{raceId}",
            [
                "controller" => 'Controllers\Horses\Form',
                "action" => 'actionGetData',
                'raceId' => 1,
                "request" => '\Api\Input\Request\Horses\Form',
            ]
        );
        $router->addGet(
            "/horses/naps-table/recent-form",
            [
                "controller" => 'Controllers\Horses\NapsTableForm',
                "action" => 'actionGetNapsTableForm',
                "request" => '\Api\Input\Request\Horses\NapsTableForm\RecentForm',
            ]
        );
    }
}
