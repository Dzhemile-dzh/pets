<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 8/31/2016
 * Time: 12:34 PM
 */

namespace Api\Result\Signposts;

class Index extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'hot_trainers' => '\Api\Output\Mapper\Signposts\HotTrainers',
            'hot_trainers.entries' => '\Api\Output\Mapper\Signposts\Entries',
            'ahead_of_handicapper' => '\Api\Output\Mapper\Signposts\AheadOfHandicapper',
            'ahead_of_handicapper.entries' => '\Api\Output\Mapper\Signposts\AheadOfHandicapperEntries',
            'course_jockeys' => '\Api\Output\Mapper\Signposts\CoursesJockeys',
            'course_jockeys.jockeys' => '\Api\Output\Mapper\Signposts\Jockeys',
            'course_jockeys.jockeys.entries' => '\Api\Output\Mapper\Signposts\Entry',
            'course_trainers' => '\Api\Output\Mapper\Signposts\CoursesTrainers',
            'course_trainers.trainers' => '\Api\Output\Mapper\Signposts\Trainers',
            'course_trainers.trainers.entries' => '\Api\Output\Mapper\Signposts\Entry',
            'first_time_blinkers' => '\Api\Output\Mapper\Signposts\FirstTimeBlinkers',
            'horses_for_courses' => '\Api\Output\Mapper\Signposts\HorsesForCourses',
            'horses_for_courses.entries' => '\Api\Output\Mapper\Signposts\Entries',
            'hot_jockeys' => '\Api\Output\Mapper\Signposts\HotJockeys',
            'hot_jockeys.entries' => '\Api\Output\Mapper\Signposts\Entries',
            'seven_day_winners' => '\Api\Output\Mapper\Signposts\SevenDayWinners',
            'top_upcoming_rpr' => '\Api\Output\Mapper\Signposts\TopUpcomingRpr',
            'trainers_jockeys' => '\Api\Output\Mapper\Signposts\TrainersJockeys',
            'trainers_jockeys.entries' => '\Api\Output\Mapper\Signposts\Entries',
            'travellers_check' => '\Api\Output\Mapper\Signposts\TravellersCheck'
        ];
    }
}
