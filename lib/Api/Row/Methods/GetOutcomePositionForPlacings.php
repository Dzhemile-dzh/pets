<?php

namespace Api\Row\Methods;

use \Api\Constants\Horses as Constants;

/**
 * Trait GetOutcomePositionForPlacings
 *
 * @package Api\Row\Methods
 */
trait GetOutcomePositionForPlacings
{
    /**
     * @return string
     */
    public function getOutcomePositionForPlacings()
    {

        $result = $this->race_outcome_position;

        if ($this->race_outcome_position > 0 && $this->race_outcome_position <= 9) {
            $result = $this->race_outcome_position;
        } elseif ($this->race_outcome_position > 9) {
            $result = 0;
        } elseif (!$this->race_outcome_position) {
            $result = $this->race_outcome_form_char;
        }

        if ($this->disqualification_desc) {
            $result = $this->disqualification_desc == Constants::RACE_OUTCOME_DISQ
                ? Constants::RACE_OUTCOME_DISQ_CHAR
                : $this->disqualification_desc;
        }

        return $result;
    }
}
