<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result;

use Api\Output;

class Predictor extends \Api\Result\Json
{

    /**
     * Prepares data for predictor
     *
     * @return mixed
     */
    protected function getPreparedData()
    {
        $data = clone $this->data;

        if (isset($data->race)) {
            $data->race = new Output\Mapper\Predictor\Race($data->race);
        }

        if (isset($data->runners)) {
            foreach ($data->runners as $key => $runner) {
                $data->runners[$key] = new Output\Mapper\Predictor\Runner($runner);
            }
        }

        return $data;
    }
}
