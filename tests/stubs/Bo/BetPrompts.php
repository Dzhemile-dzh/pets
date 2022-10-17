<?php
namespace Tests\Stubs\Bo;

use Tests\Stubs\DataProvider\Bo\BestBetWeightings;
use Tests\Stubs\Bo\BetPrompts\Signposts;

class BetPrompts extends \Bo\BetPrompts
{
    /**
     * @return RaceCards
     */
    protected function getRaceCardsBo()
    {
        return new RaceCards($this->request);
    }

    /**
     * @return \Tests\Stubs\DataProvider\Bo\BestBetWeightings
     */
    protected function getBestBetWeightingsProvider()
    {
        return new BestBetWeightings();
    }

    /**
     * @return \Bo\BetPrompts\Signposts
     */
    protected function getBoSignpostsBetPromts()
    {
        $bo = new Signposts($this->getRequest());
        $bo->setBetPromts($this);
        return $bo;
    }
}
