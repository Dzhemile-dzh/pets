<?php

namespace Tests\Stubs\Bo;

class BetFinder extends \Bo\BetFinder
{
    /**
     * @return \Tests\Stubs\Models\Bo\BetFinder\BetfinderData
     */
    protected function getModelBetfinderData()
    {
        return new \Tests\Stubs\Models\Bo\BetFinder\BetfinderData();
    }
}
