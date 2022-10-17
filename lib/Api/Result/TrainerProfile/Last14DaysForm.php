<?php

namespace Api\Result\TrainerProfile;

/**
 * Class Last14DaysForm
 *
 * @package Api\Result\TrainerProfile
 */
class Last14DaysForm extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'last_14_days_form' => '\Api\Output\Mapper\TrainerProfile\WinsRuns',
        ];
    }
}
