<?php

namespace Tests\Stubs\Bo\TotePredictor\Meeting;

use Api\Input\Request\HorsesRequest;

use Tests\Stubs\Bo\BetPrompts;
use Tests\Stubs\Bo\BetPrompts\Signposts;
use Tests\Stubs\DataProvider\Bo\TotePredictor\Scoop6 as DataProvider;

/**
 * Class Scoop6
 *
 * @package Tests\Stubs\Bo\TotePredictor
 */
class Scoop6 extends \Bo\TotePredictor\Meeting\Scoop6
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
