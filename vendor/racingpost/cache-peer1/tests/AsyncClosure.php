<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 2017-06-19
 * Time: 18:29
 */

namespace Tests;

class AsyncClosure extends \Thread
{

    private $closure;
    private $args = [];

    public function __construct(\Closure $closure, $args = null)
    {
        $this->closure = $closure;
        if ($args !== null) {
            $this->args = (!is_array($args)) ? [$args] : $args;
        }
    }

    public function run()
    {
        call_user_func_array($this->closure, $this->args);
    }
}
