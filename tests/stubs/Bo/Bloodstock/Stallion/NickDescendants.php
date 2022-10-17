<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 5/10/2016
 * Time: 12:38 PM
 */

namespace Tests\Stubs\Bo\Bloodstock\Stallion;

use Tests\Stubs\Models\Bo\Bloodstock\Stallion as Bo;

class NickDescendants extends \Bo\Bloodstock\Stallion\NickDescendants
{
    /**
     * @return \Tests\Stubs\DataProvider\Bo\Bloodstock\Stallion\NickDescendants
     */
    protected function getNickDescendantsDataProvider()
    {
        return new \Tests\Stubs\DataProvider\Bo\Bloodstock\Stallion\NickDescendants();
    }
}
