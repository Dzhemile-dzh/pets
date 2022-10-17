<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 11/4/14
 * Time: 11:44 AM
 */

namespace Api\Row\Methods;

trait GetLifetimeName
{
    /**
     * @return string
     * @throws \Exception
     */
    public function getLifetimeName()
    {
        return self::getLifetimeNameForLineType($this->getLineType());
    }

    /**
     * @param string $lineType
     * @return mixed
     * @throws \Exception
     */
    public static function getLifetimeNameForLineType($lineType)
    {

        $lifetimes = [
            'F' => "Flat Turf",
            'X' => "All-weather",
            'S' => "Stakes",
            'N' => "NHF",
            'H' => "Hurdle",
            'C' => "Chase",
            'P' => "PTP",
            'A' => "Rules Races",
            'W' => "NHF",
            'B' => "NHF",
            'Y' => "Chase",
            'U' => "Hurdle",
            'Z' => "Chase",
        ];

        if (!isset($lifetimes[$lineType])) {
            throw new \Exception("Wrong line type: '{$lineType}'");
        }

        return $lifetimes[$lineType];
    }
}
