<?php

namespace Bo\TotePredictor;

use Bo\TotePredictor;
use Phalcon\Mvc\Model\Row\General;
use Api\DataProvider\Bo\TotePredictor\Meeting as DataProvider;

/**
 * Class Meeting
 * @package Bo\TotePredictor\Meeting\Meeting
 */
class Meeting extends TotePredictor
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
     * Get Tote Predictor meeting races
     *
     * @return General|null
     */
    public function getData()
    {
        $result = null;
        $races = $this->addRunners($this->getRaces(), [$this, 'getFilteredRunners']);
        if (!empty($races)) {
            $result = General::createFromArray(
                ['races' => $races]
            );
        }

        return $result;
    }
}
