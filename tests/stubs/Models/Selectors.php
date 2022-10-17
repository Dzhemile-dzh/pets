<?php

namespace Tests\Stubs\Models;

class Selectors extends \Models\Selectors
{
    // We override this method for testing purposes.
    protected function getCurrentTime()
    {
        // 2020-01-15 @ 1:01am (UTC)
        return 1579050061;
    }
}
