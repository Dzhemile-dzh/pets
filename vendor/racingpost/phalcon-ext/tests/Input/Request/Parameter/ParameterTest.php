<?php

/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 2/15/2016
 * Time: 12:04 PM
 */

namespace Tests\Input\Request\Parameter;

use Phalcon\Input\Request\Parameter;

class ParameterTest extends \Tests\CommonTestCase
{
    /**
     * @param array $parameters
     *
     * @dataProvider providerParameters
     */
    public function testSetGetMagicSuccess($parameters)
    {
        $parameterObject = new Parameter();

        foreach ($parameters as $name => $parameter) {
            //testing \Phalcon\Input\Request\Parameter::__get
            //We do not expect any exceptions
            $parameterObject->{$name} = $parameter;
        }

        foreach ($parameters as $name => $parameter) {
            //testing \Phalcon\Input\Request\Parameter::__set
            $this->assertEquals($parameter, $parameterObject->{$name});
        }
    }

    /**
     * @param array $parameters
     *
     * @dataProvider providerParameters
     * @expectedException \BadMethodCallException
     */
    public function testSetMagicFailure($parameters)
    {
        $parameterObject = new Parameter();

        foreach ($parameters as $name => $parameter) {
            $name .= 'RaiseFailure';
            $parameterObject->{$name} = $parameter;
        }
    }

    /**
     * @param array $parameters
     *
     * @dataProvider providerParameters
     * @expectedException \BadMethodCallException
     */
    public function testGetMagicFailure($parameters)
    {
        $parameterObject = new Parameter();

        foreach ($parameters as $name => $parameter) {
            $parameterObject->{$name} = $parameter;
        }

        foreach ($parameters as $name => $parameter) {
            $name .= 'RaiseFailure';
            $parameterObject->{$name};
        }
    }

    public function providerParameters()
    {
        return [
            [['parameterName' => 'namedParam1', 'type' => 'named', 'validator' => new \Phalcon\Input\Request\Parameter\Validator\Date(new \Exception()), 'isRequired' => true, 'defaultValue' => '', 'value' => '2011-11-05']],
            [['parameterName' => 'orderedParam1', 'type' => 'ordered', 'validator' => new \Phalcon\Input\Request\Parameter\Validator\Integer(new \Exception()), 'isRequired' => true, 'defaultValue' => null, 'value' => 2]],
            [['parameterName' => 'orderedParam2', 'type' => 'ordered', 'validator' => null, 'isRequired' => false, 'defaultValue' => 5, 'value' => null]],
        ];
    }

    public function testCast()
    {
        $parameterObject = new Parameter();
        $parameterObject->parameterName = 'param1';
        $parameterObject->type = 'ordered';
        $parameterObject->key = 1;
        $parameterObject->cast = (new \Tests\Input\Request\Parameter\Mock\Cast())->setCast('casted string');
        $parameterObject->value = 'tested string';

        $this->assertSame('casted string', $parameterObject->getValue(false));

        $parameterObject->cast = (new \Tests\Input\Request\Parameter\Mock\Cast())->setCast(null);
        $parameterObject->value = 'tested string';

        $this->assertSame('tested string', $parameterObject->getValue(false));

        $parameterObject->cast = (new \Tests\Input\Request\Parameter\Mock\Cast())->setCast(false);
        $parameterObject->value = false;

        $this->assertSame(false, $parameterObject->getValue(false));
    }
}
