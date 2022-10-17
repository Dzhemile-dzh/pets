<?php

namespace Api\Row\Methods;

use \Api\Constants\Horses as Constants;

/**
 * Trait GetSurface
 *
 * @package Api\Row\Methods
 */
trait GetSurface
{
    /**
     * @return string
     * @throws \Exception
     */
    public function getSurface()
    {
        if (strpos(Constants::RACE_TYPE_FLAT_TURF
                . Constants::RACE_TYPE_HURDLE_TURF
                . Constants::RACE_TYPE_CHASE_TURF
                . Constants::RACE_TYPE_NH_FLAT
                . Constants::RACE_TYPE_HUNTER_CHASE, $this->race_type_code) !== false) {
            $result = 'turf';
        } elseif (strpos(Constants::RACE_TYPE_CHASE_AW
                . Constants::RACE_TYPE_FLAT_AW
                . Constants::RACE_TYPE_HURDLE_AW
                . Constants::RACE_TYPE_NH_FLAT_AW, $this->race_type_code) !== false) {
            $result = 'aw';
        } else {
            throw new \Exception(
                "Unknown race_type_code: '{$this->race_type_code}'."
            );
        }

        return $result;
    }
}
