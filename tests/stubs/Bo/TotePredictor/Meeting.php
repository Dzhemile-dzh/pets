<?php

namespace Tests\Stubs\Bo\TotePredictor;

use \Api\Input\Request\HorsesRequest;
use Tests\Stubs\Bo\BetPrompts;
use Tests\Stubs\Bo\BetPrompts\Signposts;
use Tests\Stubs\DataProvider\Bo\TotePredictor\Meeting as DataProvider;

/**
 * Class Meeting
 *
 * @package Tests\Stubs\Bo\TotePredictor
 */
class Meeting extends \Bo\TotePredictor\Meeting
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
