<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\RaceMeetings;

class Favourites extends \Api\Result\Json
{

    /**
     * Prepares data for results
     *
     * @return mixed
     */
    protected function getPreparedData()
    {
        $data = clone $this->data;

        foreach ($data->favourites as $handicap_type => $handicap_data) {
            foreach ($handicap_data as $group_key => $group_data) {
                $data->favourites[$handicap_type][$group_key] = new \Api\Output\Mapper\RaceMeetings\Favourites(
                    (Object)$group_data
                );
            }
        }

        return $data;
    }
}
