<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 9/14/2015
 * Time: 3:05 PM
 */

namespace Api\Output\Mapper\BetFinder;

class Version extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
             '(addHexPrefix)max_version' => 'version',
        ];
    }
}
