<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 10/28/2016
 * Time: 2:42 PM
 */

namespace Tests\Input\Mock;

class BuilderErrorMessage extends \Phalcon\Input\BuilderErrorMessage
{
    private $router;

    public function __construct(\Tests\CommonTestCase $phpUnit, $requestMethods)
    {
        $request = $phpUnit->getMockForAbstractClass(
            'Phalcon\Input\Request',
            [],
            '',
            false,
            true,
            true,
            ['getNamedParameters', 'getOrderedParameters']
        );
        $request->expects($phpUnit->any())->method('getNamedParameters')->willReturn($requestMethods['named']);
        $request->expects($phpUnit->any())->method('getOrderedParameters')->willReturn($requestMethods['ordered']);
        parent::__construct($request);
    }

    public function setRouter($router)
    {
        $this->router = $router;

        return $this;
    }

    protected function getRouter()
    {
        return $this->router;
    }
}
