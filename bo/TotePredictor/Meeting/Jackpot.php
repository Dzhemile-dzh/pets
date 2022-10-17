<?php

namespace Bo\TotePredictor\Meeting;

use Bo\TotePredictor;
use Phalcon\Mvc\Model\Row\General;
use Api\DataProvider\Bo\TotePredictor\Meeting\Jackpot as DataProvider;

/**
 * Class Jackpot
 * @package Bo\TotePredictor\Meeting
 */
class Jackpot extends TotePredictor
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
     * Get Tote Predictor race instance
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
