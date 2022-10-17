<?php

namespace Api\Row\Methods;

use \Api\Constants\Horses as Constants;

/**
 * Trait IsWorldwideStakeRace
 *
 * @package Api\Row\Methods
 */
trait IsWorldwideStakeRace
{
    /**
     * @return bool
     */
    public function isWorldwideStakeRace()
    {
        if (isset($this->is_worldwide_stake)) {
            return boolval($this->is_worldwide_stake);
        } else {
            return (
                in_array(
                    $this->race_group_desc,
                    [
                        'Group 1',
                        'Group 2',
                        'Group 3',
                        'Listed',
                        'Grade 1',
                        'Grade 2',
                        'Grade 3',
                        'Grade 1 Handicap',
                        'Grade 2 Handicap',
                        'Grade 3 Handicap',
                    ]
                )
                && strpos(Constants::RACE_TYPE_FLAT, $this->race_type_code) !== false
            );
        }
    }
}
