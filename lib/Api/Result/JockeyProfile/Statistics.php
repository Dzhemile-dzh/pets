<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\JockeyProfile;

class Statistics extends \Api\Result\Json
{
    /**
     * @return mixed
     */
    protected function getPreparedData()
    {
        $data = clone $this->data;

        if (isset($data->statistics)) {
            foreach ($data->statistics as $category => $value) {
                if (!is_object($value)) {
                    foreach ($value as $key => $field_val) {
                        if (isset($field_val->group_id)) {
                            $data->statistics[$category][$key] = new \Api\Output\Mapper\JockeyProfile\StatisticsWithGroupId($field_val);
                        } else {
                            $data->statistics[$category][$key] = new \Api\Output\Mapper\JockeyProfile\StatisticsWithoutGroupId($field_val);
                        }
                    }
                }
            }
        }

        if (isset($data->season_info)) {
            $data->season_info = new \Api\Output\Mapper\SeasonInfo\SeasonInfoWithTypeCode($data->season_info);
        }

        return $data;
    }
}
