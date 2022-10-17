<?php

namespace Tests\Stubs\Api\Input\Request;

use \Phalcon\Input\Request;

class TestSortedRequest extends Request
{
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'sorted',
            new \Phalcon\Input\Request\Parameter\Validator\IntegerId()
        );
        $this->addNamedParameter(
            'id',
            new \Phalcon\Input\Request\Parameter\Validator\IntegerId()
        );
    }

    protected function castParameters()
    {
    }
}
