<?php

namespace Api\Row\Methods;

use \Api\Constants\Horses as Constants;

/**
 * Trait GetRaceTypeCodeFmt
 *
 * @package Api\Row\Methods
 */
trait GetRaceTypeCodeFmt
{
    /**
     * @return string
     */
    public function getRaceTypeCodeFmt()
    {
        return str_replace(
            [
                Constants::getConstantValue(Constants::RACE_TYPE_HURDLE_TURF),
                Constants::getConstantValue(Constants::RACE_TYPE_CHASE_TURF),
                Constants::getConstantValue(Constants::RACE_TYPE_CHASE_AW),
                Constants::getConstantValue(Constants::RACE_TYPE_HUNTER_CHASE),
                Constants::getConstantValue(Constants::RACE_TYPE_HURDLE_AW),
                Constants::getConstantValue(Constants::RACE_TYPE_NH_FLAT),
                Constants::getConstantValue(Constants::RACE_TYPE_NH_FLAT_AW),
                Constants::getConstantValue(Constants::RACE_TYPE_P2P)
            ],
            [
                "H",
                "Ch",
                "Ch",
                "HntCh",
                "H",
                "NHF",
                "NHF",
                "PTP"
            ],
            $this->race_type_code
        );
    }
}
