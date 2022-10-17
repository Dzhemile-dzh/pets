<?php

namespace Api\Row\Methods;

use \Api\Constants\Horses as Constants;

/**
 * Trait IsFlatRace
 *
 * @package Api\Row\Methods
 */
trait IsFlatRace
{
    /**
     * @return bool
     */
    public function isFlatRace()
    {
        return (strpos(Constants::RACE_TYPE_FLAT, $this->race_type_code) !== false);
    }
}
