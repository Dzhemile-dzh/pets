<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 25.09.2014
 * Time: 13:25
 */

namespace Bo;

use Phalcon\Mvc\Model;

class DrawAnalyser extends Standart
{

    protected $raceId;
    private $race;
    private $runners;

    /**
     * Set internal value for race Id and validate it's type
     *
     * @param int $raceId
     *
     * @throws \Api\Exception\InternalServerError
     */
    public function __construct($raceId)
    {
        if (!is_numeric($raceId) || $raceId <= 0) {
            throw new \Exception('Wrong raceId parameter');
        }

        $this->raceId = (int)$raceId;
    }

    /**
     * @codeCoverageIgnore
     *
     * Return model (for models stubbing in tests)
     *
     * @return DaOvernightData
     */
    protected function getModelDaOvernightData()
    {
        return new \Models\DaOvernightData();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\DrawAnalyser\RaceInstance
     */
    protected function getModelRaceInstance()
    {
        return new \Models\Bo\DrawAnalyser\RaceInstance();
    }

    /**
     * Retrieve and calculate all necessary race details
     *
     * @return Model\Row
     * @throws \Api\Exception\NotFound
     */
    public function getRace()
    {
        if (!empty($this->race)) {
            return $this->race;
        }

        $raceInstance = $this->getModelRaceInstance();
        $data = $raceInstance->getRace($this->raceId);

        if (!empty($data)) {
            $runners = $this->getRunners();

            if (!empty($runners)) {
                $runner = current($runners);
                $data->min_rounded_length = $runner->y_norm_length;
                $data->max_rounded_length = $runner->y_norm_length;
                $data->min_rounded_lbs = $runner->y_norm_pound;
                $data->max_rounded_lbs = $runner->y_norm_pound;
                $data->min_rounded_going = $runner->y_norm_going;
                $data->max_rounded_going = $runner->y_norm_going;

                foreach ($runners as $runner) {
                    $data->min_rounded_length = ($data->min_rounded_length
                        < $runner->y_norm_length) ?
                        $data->min_rounded_length : $runner->y_norm_length;
                    $data->max_rounded_length = ($data->max_rounded_length
                        > $runner->y_norm_length) ?
                        $data->max_rounded_length : $runner->y_norm_length;

                    $data->min_rounded_lbs = ($data->min_rounded_lbs
                        < $runner->y_norm_pound) ?
                        $data->min_rounded_lbs : $runner->y_norm_pound;
                    $data->max_rounded_lbs = ($data->max_rounded_lbs
                        > $runner->y_norm_pound) ?
                        $data->max_rounded_lbs : $runner->y_norm_pound;

                    $data->min_rounded_going = ($data->min_rounded_going
                        < $runner->y_norm_going) ?
                        $data->min_rounded_going : $runner->y_norm_going;
                    $data->max_rounded_going = ($data->max_rounded_going
                        > $runner->y_norm_going) ?
                        $data->max_rounded_going : $runner->y_norm_going;
                }
            }
        }
        $this->race = $data;

        return $this->race;
    }

    /**
     * Rectieves runners details
     *
     * @return array
     * @throws \Api\Exception\NotFound
     */
    public function getRunners()
    {
        if (is_null($this->runners)) {
            $this->runners = $this->getModelDaOvernightData()->getRaceData($this->raceId);
        }

        return $this->runners;
    }
}
