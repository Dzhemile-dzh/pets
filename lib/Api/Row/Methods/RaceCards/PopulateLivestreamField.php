<?php

namespace Api\Row\Methods\RaceCards;

use \Api\Constants\Horses as Constants;

/**
 * Trait PopulateLivestreamField
 * @package Api\Row\Methods\RaceCards
 */
trait PopulateLivestreamField
{
    /**
     * The business requires that the field "livesteam_uid" is to be populated with the value of "int_1"
     * from table "race_instance_genlkup" when "lookup_id" is eqaul to 11.
     *
     * @param $lookupUid
     * @param $int1
     * @return null
     */
    public function populateLivestreamField($lookupUid, $int1)
    {

        $livestreamUid = null;

        // The business requires that the field "livesteam_uid" is to be populated with the value of "int_1"
        // from table "race_instance_genlkup" when "lookup_id" is eqaul to 11.
        if ($lookupUid == CONSTANTS::LIVESTREAM_LOOKUP_ID) {
            $livestreamUid = $int1;
        }

        return $livestreamUid;
    }
}
