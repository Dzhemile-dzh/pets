<?php

namespace Bo\TotePredictor\Meeting;

use Bo\TotePredictor;
use Api\DataProvider\Bo\TotePredictor\Meeting\Scoop6 as DataProvider;

/**
 * Class Scoop6
 *
 * @package Bo\TotePredictor
 */
class Scoop6 extends TotePredictor
{
    /**
     * @return DataProvider
     * @codeCoverageIgnore
     */
    public function getDataProvider()
    {
        return new DataProvider();
    }

    /**
     * @return array|null
     */
    public function getData()
    {
        return $this->addRunners($this->getRaces(), [$this, 'getFilteredRunners']);
    }
}
