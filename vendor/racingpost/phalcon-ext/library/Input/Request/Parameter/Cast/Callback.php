<?php

namespace Phalcon\Input\Request\Parameter\Cast;

use \Phalcon\Input\Request\Parameter\Cast;

class Callback extends Cast
{
    /**
     * @var callable
     */
    private $callback;

    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    /**
     * @return mixed
     */
    protected function cast()
    {
        //TODO: Refactor this to return ($this->callback)($this->getInitValue()); after PHP7 migration
        $callback = $this->callback;

        return $callback($this->getInitValue());
    }
}
