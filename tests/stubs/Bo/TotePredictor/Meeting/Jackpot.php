<?php

namespace Tests\Stubs\Bo\TotePredictor\Meeting;

use \Api\Input\Request\HorsesRequest;
use Tests\Stubs\Bo\BetPrompts;
use Tests\Stubs\Bo\BetPrompts\Signposts;
use Tests\Stubs\DataProvider\Bo\TotePredictor\Jackpot as DataProvider;

/**
 * Class Jackpot
 * @package Tests\Stubs\Bo\TotePredictor
 */
class Jackpot extends \Bo\TotePredictor\Meeting\Jackpot
{
    /**
     * @return DataProvider
     */
    public function getDataProvider()
    {
        return new DataProvider();
    }

    /**
     * @param HorsesRequest $request
     *
     * @return BetPrompts
     */
    protected function getBetPrompts($request)
    {
        return new BetPrompts($request);
    }

    /**
     * @param HorsesRequest $request
     *
     * @return Signposts
     */
    protected function getSignposts($request)
    {
        return new Signposts($request);
    }
}
