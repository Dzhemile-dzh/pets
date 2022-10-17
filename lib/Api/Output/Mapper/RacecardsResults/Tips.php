<?php

namespace Api\Output\Mapper\RacecardsResults;

use Api\Constants\Horses as Constants;
use Api\Output\Mapper\HorsesMapper;

/**
 * Class Tips
 * @package Api\Output\Mapper\RacecardsResults
 */
class Tips extends HorsesMapper
{

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            '(getTipsterName)newspaper_uid,newspaper_name,tipster_name' => 'tipsterName',
            '(getSelType)selection_type,newspaper_uid' => 'tipType',
        ];
    }

    /**
     * Method to map the selection type fields
     * @param $selType
     * @param $newspaperUid
     * @return string
     */
    private function getSelType($selType, $newspaperUid)
    {
        $selType = trim($selType);

        if ($selType == 'NAP') {
            $selType = '*';
        } elseif ($selType == 'NB') {
            if ($newspaperUid === 1) {
                $selType = '*';
            } else {
                $selType = '(nb)';
            }
        } else {
            $selType = '';
        }

        return $selType;
    }

    /**
     * Maps either the newspaper name or tipster name, depending on the newspaper id.
     * Currently this only applies to premium tips. Standard tips have an empty $tipsterName value
     * @param int $newspaperUid
     * @param string $newspaperName
     * @param string $tipsterName
     * @return string
     */
    private function getTipsterName(int $newspaperUid, string $newspaperName, string $tipsterName)
    {
        if (!empty($tipsterName) && in_array($newspaperUid, Constants::TIPSTER_NAME_NEWSPAPER_IDS_ARRAY)) {
            $name = $tipsterName;
        } else {
            $name = $newspaperName;
        }

        return $name;
    }
}
