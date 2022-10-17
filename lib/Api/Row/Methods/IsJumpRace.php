<?php

namespace Api\Row\Methods;

use \Api\Constants\Horses as Constants;

/**
 * Trait IsJumpRace
 *
 * @package Api\Row\Methods
 */
trait IsJumpRace
{
    /**
     * @return bool
     */
    public function isJumpRace()
    {
        return (
            strpos(Constants::RACE_TYPE_JUMPS, $this->race_type_code) !== false
            || strpos(Constants::RACE_TYPE_P2P, $this->race_type_code) !== false
        );
    }
}
