<?php

namespace Api\Result\OwnerGroups;

use Api\Result\Json as Result;

/**
 * Class HorseList
 *
 * @package Api\Result\OwnerGroups
 */
class EntriesNoOwnerFilter extends Result
{
    /**
     * @return array
     */
    protected function getMappers(): array
    {
        return [
            'entries' => 'Api\Output\Mapper\OwnerGroups\Entries\Races',
            'entries.runners' => 'Api\Output\Mapper\OwnerGroups\Entries\Runners',
            'entries.runners.sales_info' => 'Api\Output\Mapper\HorseProfile\Sales'
        ];
    }
}
