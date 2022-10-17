<?php

namespace Api\Result\Native\Cards\Predictor;

use \Api\Result\Xml;
use \Api\Output\Mapper\Native\Cards\Predictor as Mapper;

/**
 * Class Race
 *
 * @package Api\Result\Native\Cards\Predictor
 */
class Race extends Xml
{
    /**
     * @return Mapper\Race|mixed|\stdClass
     * @throws \Exception
     */
    protected function getPreparedData()
    {
        if (isset($this->data->race)) {
            $data = new Mapper\Race($this->data->race);
        } else {
            $data = new \stdClass();
        }

        $runners = [];
        if (isset($this->data->runners)) {
            foreach ($this->data->runners as $runner) {
                $runners[] = new Mapper\Runner($runner);
            }
        }
        $data->predictor = $runners;

        return $data;
    }
}
