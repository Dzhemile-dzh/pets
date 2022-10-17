<?php

namespace Api\Result\HorseProfile;

/**
 * Class AllEntries
 * @package Api\Result\HorseProfile
 */
class AllEntries extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'all_entries' => '\Api\Output\Mapper\HorseProfile\AllEntry',
            'all_entries.jockey_last_14_days' => '\Api\Output\Mapper\HorseProfile\WinsRuns',
        ];
    }
}
