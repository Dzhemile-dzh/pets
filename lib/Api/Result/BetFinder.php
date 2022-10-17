<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result;

class BetFinder extends \Api\Result\Json
{

    /**
     * Prepares data for Bet Finder
     *
     * @return mixed
     */
    protected function getPreparedData()
    {
        $data = clone $this->data;

        if (isset($data->bets)) {
            foreach ($data->bets as $key => $race) {
                $data->bets[$key] = new \Api\Output\Mapper\BetFinder\Bet($race);
            }
        }

        if (isset($data->version)) {
            $version =  new \Api\Output\Mapper\BetFinder\Version($data->version);
            $data->version = $version->version;
        }

        return $data;
    }
}
