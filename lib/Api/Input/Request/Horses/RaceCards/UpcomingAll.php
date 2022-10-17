<?php

namespace Api\Input\Request\Horses\RaceCards;

/**
 * Class UpcomingAll
 * @package Api\Input\Request\Horses\RaceCards
 */
class UpcomingAll extends \Api\Input\Request\HorsesRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
    }

    /**
     * @return mixed
     */
    public function getLimit()
    {
        return INF;
    }
}
