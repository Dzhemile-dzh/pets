<?php
namespace Api\Result\BetPrompts;

use Api\Result\Json as Result;

class BetPrompts extends Result
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'bet_prompts' => '\Api\Output\Mapper\BetPrompts\BetPrompts',
            'bet_prompts.most_tipped' => '\Api\Output\Mapper\BetPrompts\BetPromptsMostTipped',
            'bet_prompts.most_napped' => '\Api\Output\Mapper\BetPrompts\BetPromptsMostNapped',
            'bet_prompts.post_data_selection' => '\Api\Output\Mapper\BetPrompts\BetPromptsPostDataSelection',
            'bet_prompts.rpr_selection' => '\Api\Output\Mapper\BetPrompts\BetPromptsRpSelection',
            'bet_prompts.hot_trainers' => '\Api\Output\Mapper\BetPrompts\HotTrainers',
            'bet_prompts.hot_trainers.entries' => '\Api\Output\Mapper\BetPrompts\Entries',
            'bet_prompts.ahead_of_handicapper' => '\Api\Output\Mapper\BetPrompts\AheadOfHandicapper',
            'bet_prompts.ahead_of_handicapper.entries' => '\Api\Output\Mapper\Signposts\AheadOfHandicapperEntries',
            'bet_prompts.course_jockeys' => '\Api\Output\Mapper\Signposts\CoursesJockeys',
            'bet_prompts.course_jockeys.jockeys' => '\Api\Output\Mapper\BetPrompts\Jockeys',
            'bet_prompts.course_jockeys.jockeys.entries' => '\Api\Output\Mapper\BetPrompts\Entry',
            'bet_prompts.course_trainers' => '\Api\Output\Mapper\Signposts\CoursesTrainers',
            'bet_prompts.course_trainers.trainers' => '\Api\Output\Mapper\BetPrompts\Trainers',
            'bet_prompts.course_trainers.trainers.entries' => '\Api\Output\Mapper\BetPrompts\Entry',
            'bet_prompts.horses_for_courses' => '\Api\Output\Mapper\BetPrompts\HorsesForCourses',
            'bet_prompts.horses_for_courses.entries' => '\Api\Output\Mapper\BetPrompts\Entries',
            'bet_prompts.hot_jockeys' => '\Api\Output\Mapper\BetPrompts\HotJockeys',
            'bet_prompts.hot_jockeys.entries' => '\Api\Output\Mapper\BetPrompts\Entries',
            'bet_prompts.seven_day_winners' => '\Api\Output\Mapper\BetPrompts\SevenDayWinners',
            'bet_prompts.trainers_jockeys' => '\Api\Output\Mapper\BetPrompts\TrainersJockeys',
            'bet_prompts.trainers_jockeys.entries' => '\Api\Output\Mapper\BetPrompts\Entries',
            'bet_prompts.travellers_check' => '\Api\Output\Mapper\BetPrompts\TravellersCheck'
        ];
    }
}
