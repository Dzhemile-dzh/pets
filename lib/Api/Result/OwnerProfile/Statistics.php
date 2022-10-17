<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\OwnerProfile;

class Statistics extends \Api\Result\Json
{

    /**
     * Prepares data for OwnerProfile
     *
     * @return mixed
     */
    protected function getPreparedData()
    {
        $data = clone $this->data;

        if (isset($data->statistics)) {
            $statistics = [];
            foreach ($data->statistics as $groupName => $groupData) {
                if (!isset($statistics[$groupName])) {
                    $statistics[$groupName] = [];
                }

                foreach ($groupData as $key => $value) {
                    $statistics[$groupName][] = new \Api\Output\Mapper\OwnerProfile\Statistics($value);
                }
            }
            $data->statistics = $statistics;
        }

        if (isset($data->season_info)) {
            $data->season_info = new \Api\Output\Mapper\SeasonInfo\SeasonInfoWithTypeCode($data->season_info);
        }

        return $data;
    }
}
