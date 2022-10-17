<?php

namespace Tests\Stubs\Bo\TotePredictor;

use \Api\Input\Request\HorsesRequest;
use Tests\Stubs\Bo\BetPrompts;
use Tests\Stubs\Bo\BetPrompts\Signposts;
use Tests\Stubs\DataProvider\Bo\TotePredictor\Race as DataProvider;

/**
 * Class Race
 *
 * @package Tests\Stubs\Bo\TotePredictor
 */
class Race extends \Bo\TotePredictor\Race
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
