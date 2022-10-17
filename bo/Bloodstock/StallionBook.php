<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 3/29/2016
 * Time: 12:33 PM
 */

namespace Bo\Bloodstock;

use Models\Bo\Bloodstock\StallionBook as Bo;

/**
 * Class StallionBook
 * @package Bo\Bloodstock
 */
class StallionBook extends \Bo\Standart
{
    /**
     * @return Bo\RaceInstance
     *
     * @codeCoverageIgnore
     */
    protected function getModelRaceInstance()
    {
        return new Bo\RaceInstance();
    }

    /**
     * @return array
     */
    public function getSearchResult()
    {
        return $this->getModelRaceInstance()->getSearchResult(
            $this->request,
            $this->getModelSelectors()
        );
    }

    /**
     * @return object
     */
    public function getNames()
    {

        $data = $this->getModelRaceInstance()->getSearchResult(
            $this->request,
            $this->getModelSelectors()
        );

        $stallions = [];
        $sires = [];
        $studs = [];
        $sireLine = [];

        foreach ($data as $row) {
            if (!is_null($row['style_name'])) {
                array_push($stallions, $row['style_name']);
            }

            if (!is_null($row['sire_style_name'])) {
                array_push($sires, $row['sire_style_name']);
            }

            if (!is_null($row['stud_name'])) {
                array_push($studs, $row['stud_name']);
            }

            if (!is_null($row['sire_line_style_name'])) {
                array_push($sireLine, $row['sire_line_style_name']);
            }
        }

        return (Object) [
            'stallion_names'    => array_values(array_unique($stallions)),
            'sire_names'        => array_values(array_unique($sires)),
            'stud_farms'        => array_values(array_unique($studs)),
            'sire_line'         => array_values(array_unique($sireLine))
        ];
    }
}
