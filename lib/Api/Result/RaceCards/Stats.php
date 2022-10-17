<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\RaceCards;

class Stats extends \Api\Result\Json
{
    /**
     *
     * @return mixed
     */
    protected function getPreparedData()
    {
        $data = clone $this->data;

        $selectors = new \Models\Selectors();
        $statsGroups = array_merge(
            $selectors->getRaceCardStatsGroups(true),
            $selectors->getRaceCardStatsGroups(false)
        );

        if (isset($data->stats->horse) && !empty((array) $data->stats->horse)) {
            foreach ($data->stats->horse as $id => $horse) {
                $data->stats->horse->{$id} = new \Api\Output\Mapper\RaceCards\Stats\Horse($horse);
                $data->stats->horse->{$id}->going = new \Api\Output\Mapper\RaceCards\Stats\HorseStats($horse->going);
                $data->stats->horse->{$id}->distance = new \Api\Output\Mapper\RaceCards\Stats\HorseStats($horse->distance);
                $data->stats->horse->{$id}->course = new \Api\Output\Mapper\RaceCards\Stats\HorseStats($horse->course);
            }
        } else {
            $data->stats->horse = null;
        }

        if (isset($data->stats->trainer) && !empty((array) $data->stats->trainer)) {
            foreach ($data->stats->trainer as $id => $trainer) {
                $data->stats->trainer->{$id} = new \Api\Output\Mapper\RaceCards\Stats\Trainer($trainer);
                $data->stats->trainer->{$id}->overall = new \Api\Output\Mapper\RaceCards\Stats\Overall($trainer->overall);
                $data->stats->trainer->{$id}->last_14_days = new \Api\Output\Mapper\RaceCards\Stats\Overall($trainer->last_14_days);
                foreach ($statsGroups as $group) {
                    if (isset($trainer->{$group})) {
                        $data->stats->trainer->{$id}->{$group} = new \Api\Output\Mapper\RaceCards\Stats\Overall($trainer->{$group});
                    }
                }
            }
        } else {
            $data->stats->trainer = null;
        }

        if (isset($data->stats->jockey) && !empty((array) $data->stats->jockey)) {
            foreach ($data->stats->jockey as $id => $jockey) {
                $data->stats->jockey->{$id} = new \Api\Output\Mapper\RaceCards\Stats\Jockey($jockey);
                $data->stats->jockey->{$id}->overall = new \Api\Output\Mapper\RaceCards\Stats\Overall($jockey->overall);
                $data->stats->jockey->{$id}->last_14_days = new \Api\Output\Mapper\RaceCards\Stats\Overall($jockey->last_14_days);
                foreach ($statsGroups as $group) {
                    if (isset($jockey->{$group})) {
                        $data->stats->jockey->{$id}->{$group} = new \Api\Output\Mapper\RaceCards\Stats\Overall($jockey->{$group});
                    }
                }
            }
        } else {
            $data->stats->jockey = null;
        }

        return $data;
    }
}
