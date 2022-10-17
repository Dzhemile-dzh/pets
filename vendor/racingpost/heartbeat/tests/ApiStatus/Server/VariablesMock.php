<?php

namespace Tests\ApiStatus\Server;

/**
 * Class VariablesMock
 * @package Tests\ApiStatus\Server
 */
class VariablesMock extends \ApiStatus\Server\Variables
{
    /**
     * @return array
     */
    protected function getDefinedServerVarList()
    {
        global $_SERVER;
        $varList = array_keys($_SERVER);
        return $varList;
    }
}
