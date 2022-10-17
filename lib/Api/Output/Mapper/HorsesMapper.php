<?php

namespace Api\Output\Mapper;

use \RP\Util\Math\GetSum;
use \RP\Util\Methods\DateISO8601;

/**
 * Class HorsesMapper
 * @package Api\Output\Mapper
 */
abstract class HorsesMapper extends \Api\Output\Mapper
{
    use \Api\Methods\YardsToFurlongs;

    /** Method capitalises the country code part of the horse name for a horse where country is 'ARO'
     *
     * @param string $name
     * @param string $country
     *
     * @return string
     *
     */
    public function fixAroHorseName($name, $country)
    {
        $name = trim($name);

        if (!empty($name) && !empty($country) && strtoupper($country) == 'ARO') {
            $name = preg_replace_callback(
                '/(\s\([a-z]{2,3}\))$/',
                function (array $m) {
                    return strtoupper($m[1]);
                },
                $name
            );
        }
        return $name;
    }


    /**
     * @param mixed     $val
     *
     * @return mixed
     */
    protected function getActualRaceClassName($val)
    {
        return 'C' . $val;
    }

    /**
     * @param mixed     $val
     *
     * @return mixed
     */
    protected function zero2mdash($val)
    {
        $val *= 1;
        return empty($val) || $val<0 ? '&mdash;' : $val;
    }

    /**
     * The value in '<distanceGoing>' tag
     * @param   float     $distance_yard
     * @param   string|null    $going_type_code
     * @return  string
     */
    protected function distanceGoingInFurlongs(float $distance_yard, ?string $going_type_code) : string
    {
        return $this->yardsToFurlongs($distance_yard) . $going_type_code;
    }

    /**
     * Returns the currency amount given,
     * turned int a "K thousands" format.
     * @param   float    $num
     * @param   string   $preppend_str
     * @param   string   $append_str
     * @return  string
     */
    protected function thousandsCurrencyFormat(float $num = 0, string $preppend_str = '&pound;', string $append_str = '') : string
    {
        //In legacy when a prize is rouned it didn`t get float part of them that is why we need to cast it to int
        $num = (int) $num;

        if ($num > 1000) {
            $x = round($num);
            $x_number_format = number_format($x);
            $x_array = explode(',', $x_number_format);
            $x_parts = array('K', 'M', 'B', 'T');
            $x_count_parts = count($x_array) - 1;

            $secondaryPart = $x_array[1];

            $count = strlen((string)$secondaryPart);

            $secondaryPart = $secondaryPart/(pow(10, ($count))); //we need a number between 0 and 10

            $x_display = round($x_array[0] + $secondaryPart, 1);
            $x_display .= $x_parts[$x_count_parts - 1];

            $rtrn = $x_display;
        } else {
            $rtrn = $num;
        }

        if (!empty($preppend_str)) {
            $rtrn = $preppend_str . $rtrn;
        }

        if (!empty($append_str)) {
            $rtrn = $rtrn . $append_str;
        }

        return $rtrn;
    }
}
