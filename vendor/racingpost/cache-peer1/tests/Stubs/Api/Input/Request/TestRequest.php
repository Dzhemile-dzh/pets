<?php

namespace Tests\Stubs\Api\Input\Request;

use \Phalcon\Input\Request;

class TestRequest extends Request
{
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'id',
            new \Phalcon\Input\Request\Parameter\Validator\IntegerId()
        );
    }

    protected function castParameters()
    {
    }
}
