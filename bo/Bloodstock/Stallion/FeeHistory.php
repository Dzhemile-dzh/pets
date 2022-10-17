<?php

namespace Bo\Bloodstock\Stallion;

use Bo\Bloodstock\Stallion;

/**
 * Class FeeHistory
 * @package Bo\Bloodstock\Stallion
 */
class FeeHistory extends Stallion
{
    /**
     * @return \Api\Row\Bloodstock\Stallion\FeeHistory|null
     */
    public function getFeeHistory()
    {
        return $this->getFeeHistoryDataProvider()->getFeeHistory($this->request);
    }
}
