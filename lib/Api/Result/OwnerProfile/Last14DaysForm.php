<?php

namespace Api\Result\OwnerProfile;

/**
 * Class Last14DaysForm
 *
 * @package Api\Result\OwnerProfile
 */
class Last14DaysForm extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'last_14_days_form' => '\Api\Output\Mapper\OwnerProfile\WinsRuns',
        ];
    }
}
