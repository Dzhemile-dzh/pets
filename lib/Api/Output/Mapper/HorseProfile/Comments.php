<?php

namespace Api\Output\Mapper\HorseProfile;

use Api\Constants\Horses as Constants;

class Comments extends \Api\Output\Mapper\HorsesMapper
{
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            '(getIndividualText)race_status_code,individual_spotlight' => 'individual_spotlight',
            '(getIndividualText)race_status_code,individual_comment' => 'individual_comment',
            'rp_owner_choice' => 'rp_owner_choice'
        ];
    }

    private function getIndividualText($race_status_code, $text)
    {
        $result = null;

        if ($race_status_code != Constants::RACE_STATUS_RESULTS) {
            $result = $text;
        }

        return $result;
    }
}
