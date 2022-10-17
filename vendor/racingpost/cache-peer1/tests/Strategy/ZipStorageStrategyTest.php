<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 02.12.2015
 * Time: 14:36
 */

namespace Tests\Strategy;

use Phalcon\Cache\Strategy\ZipStorageStrategy;

/**
 * @package Tests\Strategy
 */
class ZipStorageStrategyTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @test
     */
    public function testPacking()
    {
        $pack = new ZipStorageStrategy();
        $str = "testString";
        $tmp = $pack->pack($str);
        $tmp = $pack->unpack($tmp);
        $this->assertEquals($str, $tmp, '');
    }
}
