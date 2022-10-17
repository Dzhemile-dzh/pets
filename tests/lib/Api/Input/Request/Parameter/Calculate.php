<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 1/20/2017
 * Time: 9:54 AM
 */

namespace Tests\Api\Input\Request\Parameter;

use Phalcon\Input\Request\Parameter\Calculate\ByDefault;

abstract class Calculate extends \PHPUnit\Framework\TestCase
{
    protected function setUpCalculation($methods, ByDefault $calculation)
    {
        $request = $this
            ->getMockBuilder('\Api\Input\Request\HorsesRequest')
            ->disableOriginalConstructor()
            ->setMethods(array_keys($methods))
            ->getMockForAbstractClass();

        foreach ($methods as $name => $value) {
            if ($name === 'get' && $value) {
                $fakeModel = $this
                    ->getMockBuilder('stdClass')
                    ->setMethods(array_keys($value))
                    ->getMock();
                foreach ($value as $fakeMethod => $fakeValue) {
                    $fakeModel
                        ->expects($this->any())
                        ->method($fakeMethod)
                        ->willReturn($fakeValue);
                }
                $request->expects($this->any())->method($name)->willReturn($fakeModel);
            } else {
                $request->expects($this->any())->method($name)->willReturn($value);
            }
        }

        $calculation->setRequest($request);
    }
}
