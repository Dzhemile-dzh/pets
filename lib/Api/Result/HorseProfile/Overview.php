<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\HorseProfile;

class Overview extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'profile' => '\Api\Output\Mapper\HorseProfile\Profile',
            'profile.tips' => '\Api\Output\Mapper\HorseProfile\Tips',
            'profile.comments' => '\Api\Output\Mapper\HorseProfile\Comments',
            'profile.trainer_last_14_days' => '\Api\Output\Mapper\HorseProfile\WinsRuns',
            'profile.previous_trainers' => '\Api\Output\Mapper\HorseProfile\PreviousTrainer',
            'profile.previous_owners' => '\Api\Output\Mapper\HorseProfile\PreviousOwner',
            'profile.stud_fee' => '\Api\Output\Mapper\HorseProfile\StudFee',
            'profile.to_follow' => '\Api\Output\Mapper\HorseProfile\ToFollow',
            'entries' => '\Api\Output\Mapper\HorseProfile\EntryForOverview',
            'entries.jockey_last_14_days' => '\Api\Output\Mapper\HorseProfile\WinsRuns',
            'quotes' => '\Api\Output\Mapper\HorseProfile\Quotes',
            'stable_tour_quotes' => '\Api\Output\Mapper\HorseProfile\StableTourQuotes',
        ];
    }
}
