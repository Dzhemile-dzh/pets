<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 3/16/2016
 * Time: 9:20 AM
 */

namespace Tests\Stubs\Bo\Bloodstock\Stallion;

use Tests\Stubs\Models\Bo\Bloodstock\Stallion as Bo;

class ProgenyEntries extends \Bo\Bloodstock\Stallion\ProgenyEntries
{
    /**
     * @return \Tests\Stubs\DataProvider\Bo\Bloodstock\Stallion\ProgenyEntries
     */
    protected function getProgenyEntriesDataProvider()
    {
        return new \Tests\Stubs\DataProvider\Bo\Bloodstock\Stallion\ProgenyEntries();
    }
}
