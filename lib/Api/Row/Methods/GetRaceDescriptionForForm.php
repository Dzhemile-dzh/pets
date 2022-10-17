<?php

namespace Api\Row\Methods;

use \Api\Constants\Horses as Constants;

/**
 * Trait GetRaceDescriptionForForm
 *
 * @package Api\Row\Methods
 */
trait GetRaceDescriptionForForm
{
    /**
     * @return string
     */
    public function getRaceDescriptionForForm()
    {

        $description = str_replace('Cl', 'C', $this->actual_race_class ?: '');

        if (in_array($this->rp_ages_allowed_desc, ['2yo', '3yo', '4yo'])) {
            $description .= substr($this->rp_ages_allowed_desc, 0, 2);
        }


        if ($this->race_type_code == Constants::getConstantValue(Constants::RACE_TYPE_P2P)) {
            $map = [
                " ladies" => "Lds",
                " mens" => "Mns",
                " mixed" => "Mxd",
                " novice" => "Nv",
                " veteran" => "Vet"
            ];
            foreach ($map as $k => $v) {
                if (strpos($this->race_instance_title, $k) !== false) {
                    $description .= $v;
                }
            }
        }

        if ($this->race_type_code != Constants::getConstantValue(Constants::RACE_TYPE_P2P)) {
            $map = [
                " novice" => "Nv",
                " maiden" => "Md",
            ];
            foreach ($map as $k => $v) {
                if (stripos($this->race_instance_title, $k) !== false) {
                    // Exclude races for 'Novice Amateurs' when defining 'Novice' races
                    if ($k == ' novice' && stripos($this->race_instance_title, 'amateurs') !== false) {
                        continue;
                    } else {
                        $description .= $v;
                    }
                }
            }
        } else {
            $map = [
                " maiden" => "Md",
                "restricted" => "Res",
                "intermediate" => "Int",
                "club members" => "Clb",
                " hunt " => "Hnt",
                "open" => "Open",
                "confined" => "Cnf",
                "winners of one" => "W1",
                "winners of one" => "W2",
            ];
            foreach ($map as $k => $v) {
                if (stripos($this->race_instance_title, $k) !== false) {
                    $description .= $v;
                }
            }
        }

        if ($this->race_type_code != Constants::getConstantValue(Constants::RACE_TYPE_P2P)) {
            $map = [
                " selling " => "Sl",
                " claiming " => "Cl",
                " auction stakes" => "Ac",
                " banded " => "Bd",
            ];
            foreach ($map as $k => $v) {
                if (stripos($this->race_instance_title, $k) !== false) {
                    $description .= $v;
                }
            }

            if ($this->race_group_code == Constants::getConstantValue(Constants::RACE_GROUP_CODE_HANDICAP)) {
                $description .= 'Hc';
            }
        }

        if (!in_array($this->getRaceTypeCodeFmt(), [
            Constants::getConstantValue(Constants::RACE_TYPE_P2P),
            Constants::getConstantValue(Constants::RACE_TYPE_FLAT_TURF),
            Constants::getConstantValue(Constants::RACE_TYPE_FLAT_AW)
        ])) {
            $description .= $this->getRaceTypeCodeFmt();
        }

        $map = [
            'Group 1' => 'G1',
            'Group 2' => 'G2',
            'Group 3' => 'G3',
            'Listed' => 'L',
            'Grade 1' => 'G1',
            'Grade 2' => 'G2',
            'Grade 3' => 'G3',
        ];
        foreach ($map as $k => $v) {
            if (strpos($this->race_group_desc, $k) !== false) {
                $description .= $v;
            }
        }

        if (in_array($this->race_type_code, Constants::RACE_TYPE_FLAT_ARRAY)) {
            if (stripos($this->race_instance_title, 'fillies') !== false &&
                stripos($this->race_instance_title, 'colts & fillies') == false) {
                $description .= 'F';
            }
        }

        if (in_array($this->race_type_code, Constants::RACE_TYPE_JUMPS_ARRAY)) {
            if (stripos($this->race_instance_title, 'mares') !== false) {
                $description .= 'M';
            }
        }

        if (in_array($this->race_type_code, Constants::RACE_TYPE_NHF_ARRAY)
            ||
            in_array($this->race_type_code, [Constants::RACE_TYPE_HURDLE_TURF_STR])) {
            if (stripos($this->race_instance_title, 'fillies') !== false) {
                $description .= 'M';
            }
        }
        return $description;
    }
}
