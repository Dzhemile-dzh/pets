<?php

/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 3/2/2017
 * Time: 1:49 PM
 */

namespace Tests\Stubs\Bo\BetPrompts;

use Bo\BetPrompts\Signposts as Core;
use Tests\Stubs\Bo\Signposts as BoSignposts;
use Api\Input\Request\Horses\Signposts as Request;

class Signposts extends Core
{
    /**
     * @codeCoverageIgnore
     * @param $request
     *
     * @return \Tests\Stubs\Bo\Signposts
     */
    protected function getBoSignposts(Request $request)
    {
        return BoSignposts::init($request);
    }
}
