<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 12/22/2016
 * Time: 5:28 PM
 */

namespace Tests;

use Api\Input\Request\Horses\Profile;

class ProfileTest extends \PHPUnit\Framework\TestCase
{
    public function testGetId()
    {
        $expected = 999;
        
        $mockParam = $this->getMockBuilder('stdClass')
            ->setMethods(['getValue'])
            ->getMock();
        $mockParam->method('getValue')->willReturn($expected);

        $request = $this->getMockBuilder('Api\Input\Request\Horses\Profile')
            ->setConstructorArgs([[], [Profile::ENTITY_ID => $expected]])
            ->setMethods(['getParameters'])
            ->getMockForAbstractClass();

        $request
            ->expects($this->any())
            ->method('getParameters')
            ->willReturn([Profile::ENTITY_ID => $mockParam]);


        $this->assertSame($request->getId(), $expected);
    }
}
