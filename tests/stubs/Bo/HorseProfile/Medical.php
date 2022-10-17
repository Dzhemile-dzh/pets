<?php

namespace Tests\Stubs\Bo\HorseProfile;

use \Tests\Stubs\DataProvider\Bo\HorseProfile\Medical as StubsProviderMedical;

class Medical extends \Bo\Profile\Horse\Medical
{
    public function getDataProvider()
    {
        return new StubsProviderMedical();
    }
}
