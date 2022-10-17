<?php

namespace Api\Row\Methods;

use \Api\Constants\Horses as Constants;

/**
 * Trait GetHorseSex
 *
 * @package Api\Row\Methods
 */
trait GetHorseSex
{
    /**
     * @return string
     */
    public function getHorseSex()
    {
        $horseSex = $this->horse_sex_code;
        $raceDate = new \DateTime($this->race_datetime);

        if (isset($this->date_gelded)) {
            $dateGelded = new \DateTime($this->date_gelded);

            if ($dateGelded > $raceDate) {
                $horseSex = ($this->horse_age < 5) ? Constants::HORSE_SEX_CODE_COLT : Constants::HORSE_SEX_CODE_HORSE;
            } else {
                $horseSex = Constants::HORSE_SEX_CODE_GELDING;
            }
        } else {
            if (in_array($horseSex, [Constants::HORSE_SEX_CODE_COLT, Constants::HORSE_SEX_CODE_HORSE])) {
                $horseSex = ($this->horse_age < 5) ? Constants::HORSE_SEX_CODE_COLT : Constants::HORSE_SEX_CODE_HORSE;
            } elseif (in_array($horseSex, [Constants::HORSE_SEX_CODE_FILLY, Constants::HORSE_SEX_CODE_MARE])) {
                $horseSex = ($this->horse_age < 5) ? Constants::HORSE_SEX_CODE_FILLY : Constants::HORSE_SEX_CODE_MARE;
            }
        }

        return $horseSex;
    }
}
