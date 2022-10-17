<?php

namespace Api\Result\Tipping;

use Api\Result\Json as Result;

/**
 * Class Success
 *
 * @package Api\Result\Tipping
 */
class Success extends Result
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'tippings' => '\Api\Output\Mapper\Tipping\Success\Main',
            'tippings.winning_tip' => '\Api\Output\Mapper\Tipping\Success\WinningTip',
            'tippings.upcoming_tip' => '\Api\Output\Mapper\Tipping\Success\UpcomingTip',
        ];
    }
}
