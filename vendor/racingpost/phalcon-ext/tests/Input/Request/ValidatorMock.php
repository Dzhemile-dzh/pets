<?php

/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 2/17/2016
 * Time: 10:12 AM
 */

namespace Tests\Input\Request;

use Phalcon\Input\Request\Validator;

class ValidatorMock extends Validator
{
    private $parameters;

    public function setUp(array $parameters)
    {
        $this->parameters = $parameters;
    }

    public function validate()
    {
        foreach ($this->parameters['methods'] as $method) {
            $this->request->{$method}();
        }
        if (isset($this->parameters['exception'])) {
            throw $this->parameters['exception'];
        }
    }
}
