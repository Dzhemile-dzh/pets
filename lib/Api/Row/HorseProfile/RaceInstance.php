<?php

namespace Api\Row\HorseProfile;

class RaceInstance extends \Api\Row\RaceInstance
{
    public function getIndicator()
    {
        if (isset($this->running_conditions) && isset($this->num_overnight_races) && $this->num_overnight_races > 1) {
            $lower = strtolower($this->running_conditions);

            /*
             * This statement is correct: we really have to return 2 when it's "1st", it's not a mistake
             */

            if (strpos($lower, '1st') !== false) {
                return 2;
            } else {
                return 1;
            }
        }

        return null;
    }
}
