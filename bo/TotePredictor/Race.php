<?php

namespace Bo\TotePredictor;

use Bo\TotePredictor;
use Phalcon\Mvc\Model\Row\General;
use Api\DataProvider\Bo\TotePredictor\Race as DataProvider;

/**
 * Class Race
 *
 * @package Bo\TotePredictor
 */
class Race extends TotePredictor
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
        $data = $this->addRunners($this->getRaces(), []);

        return !empty($data) ? current($data) : null;
    }
}
