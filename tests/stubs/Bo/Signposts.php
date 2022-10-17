<?php

namespace Tests\Stubs\Bo;

use Tests\Stubs\DataProvider\Bo\Signposts\UpcomingRaces;

class Signposts extends \Bo\Signposts
{
    protected function getDataProvider()
    {
        $dataProvider = new UpcomingRaces();
        $request = $this->getRequest();
        $dataProvider->setRequest($request);

        return $dataProvider;
    }
}
