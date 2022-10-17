<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 11/4/14
 * Time: 11:44 AM
 */

namespace Api\Row\Methods;

use Api\Constants\Horses as Constants;

trait GetDistanceToWinner
{
    /**
     * @param $distance_value       string
     * @param $dtw_count_horse_race integer
     *
     * @return string
     */
    private function getDistance($distance_value, $dtw_count_horse_race)
    {

        $sumDistanceValueInteger = floor($distance_value);
        $sumDistanceValueFractional = $distance_value - $sumDistanceValueInteger;
        $sumDistanceValueFractionalString = '';

        if ($sumDistanceValueInteger >= 10) {
            if ($sumDistanceValueInteger < 20) {
                if ($sumDistanceValueFractional < 0.25) {
                    $sumDistanceValueFractional = 0;
                } elseif ($sumDistanceValueFractional < 0.75) {
                    $sumDistanceValueFractional = 0.5;
                } else {
                    $sumDistanceValueFractional = 0;
                    $sumDistanceValueInteger = $sumDistanceValueInteger + 1;
                }
            } else {
                if ($sumDistanceValueFractional < 0.50) {
                    $sumDistanceValueFractional = 0;
                } elseif ($sumDistanceValueFractional > 0.49) {
                    $sumDistanceValueFractional = 0;
                    $sumDistanceValueInteger = $sumDistanceValueInteger + 1;
                }
            }
        }

        if ($sumDistanceValueInteger < 1) {
            if ($sumDistanceValueFractional == 0.0) {
                $sumDistanceValueFractionalString = 'dht';
            } elseif ($sumDistanceValueFractional == 0.05) {
                $sumDistanceValueFractionalString = 'nse';
            } elseif ($sumDistanceValueFractional >= 0.06 and $sumDistanceValueFractional <= 0.10) {
                $sumDistanceValueFractionalString = 'shd';
            } elseif ($sumDistanceValueFractional >= 0.11 and $sumDistanceValueFractional <= 0.17) {
                $sumDistanceValueFractionalString = 'snk';
            } elseif ($sumDistanceValueFractional >= 0.18 and $sumDistanceValueFractional <= 0.22) {
                $sumDistanceValueFractionalString = 'hd';
            } elseif ($sumDistanceValueFractional >= 0.23 and $sumDistanceValueFractional <= 0.27) {
                $sumDistanceValueFractionalString = chr(188); // '¼'
            } elseif ($sumDistanceValueFractional >= 0.28 and $sumDistanceValueFractional <= 0.37) {
                $sumDistanceValueFractionalString = 'nk';
            } elseif ($sumDistanceValueFractional >= 0.38 and $sumDistanceValueFractional <= 0.67) {
                $sumDistanceValueFractionalString = chr(189); // '½'
            } elseif ($sumDistanceValueFractional >= 0.68 and $sumDistanceValueFractional <= 0.87) {
                $sumDistanceValueFractionalString = chr(190); //  '¾'
            } elseif ($sumDistanceValueFractional >= 0.88) {
                $sumDistanceValueInteger = 1;
            }
        } else {
            if ($sumDistanceValueFractional < 0.12) {
                $sumDistanceValueFractionalString = '';
            } elseif ($sumDistanceValueFractional >= 0.12 and $sumDistanceValueFractional < 0.38) {
                $sumDistanceValueFractionalString = chr(188); // '¼;
            } elseif ($sumDistanceValueFractional >= 0.38 and $sumDistanceValueFractional < 0.63) {
                $sumDistanceValueFractionalString = chr(189); // '½;
            } elseif ($sumDistanceValueFractional >= 0.63 and $sumDistanceValueFractional < 0.88) {
                $sumDistanceValueFractionalString = chr(190); // '¾'
            } else {
                $sumDistanceValueInteger = $sumDistanceValueInteger + 1;
            }
        }

        $plusFlag = $dtw_count_horse_race > 0 ? '+' : '';

        $result = ($sumDistanceValueInteger ?: '') . $sumDistanceValueFractionalString . $plusFlag;

        if ($result && !in_array(trim($result, ' +'), ['dht', 'nse', 'shd', 'snk', 'hd', 'nk', 'dist'])) {
            $result .= 'L';
        }

        return $result;
    }

    /**
     * @return string | null
     */
    public function getDistanceToWinner()
    {
        if ($this->orig_race_output_order > 1 && $this->dtw_total_distance_value > 0) {
            return $this->getDistance($this->dtw_sum_distance_value, $this->dtw_count_horse_race);
        } else {
            return null;
        }
    }

    /**
     * This method is a wrapper around "getDistanceToWinnerForm"
     * but excludes all non runners in their place returns null
     *
     * @param string $isNonRunner ("Y" or "N" or "NULL")
     * @return null|string
     */
    public function getDistanceRunnerHorseToWinnerForm($isNonRunner)
    {
        if ($isNonRunner !== 'Y') {
            return $this->getDistanceToWinnerForm();
        } else {
            return null;
        }
    }

    /**
     * @param bool @returnOnlyNumber - used if we only want to return a number without any mapping
     * @return string | float | null
     */
    public function getDistanceToWinnerForm($returnOnlyNumber = false)
    {
        if (!is_null($this->dtw_sum_distance_value) && $this->orig_race_output_order > 1 && $this->dtw_total_distance_value > 0
            && !in_array(trim($this->race_outcome_code), Constants::RACE_OUTCOME_CODES_NON_FINISHERS)) {
            if ($returnOnlyNumber == false) {
                $result = $this->getDistance($this->dtw_sum_distance_value, $this->dtw_count_horse_race);
            } else {
                $result = $this->dtw_sum_distance_value;
            }
            return $result;
        } else {
            return null;
        }
    }

    /**
     * @return string | null
     */
    public function getWinningDistance()
    {
        if (!is_null($this->dtw_sum_distance_value) && $this->orig_race_output_order == 1 && $this->dtw_total_distance_value > 0) {
            return $this->getDistance($this->dtw_sum_distance_value, $this->dtw_count_horse_race);
        } else {
            return null;
        }
    }
}
