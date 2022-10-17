<?php

namespace Phalcon\Input\Request\Parameter\Validator;

class Callback extends \Phalcon\Input\Request\Parameter\Validator
{
    private $callback = null;
    private $callbackParameters = [];

    public function getValidatorTitle()
    {
        return '';
    }

    /**
     * Callback constructor.
     *
     * @param callable   $callback
     * @param array      $callbackParameters
     */
    public function __construct(callable $callback, array $callbackParameters = [])
    {
        $this->callback = $callback;
        $this->callbackParameters = $callbackParameters;
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public function validate($value)
    {
        return !(!call_user_func_array($this->callback, array_merge([$value], $this->callbackParameters)));
    }
}
