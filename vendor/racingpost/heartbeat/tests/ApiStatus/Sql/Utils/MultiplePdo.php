<?php

namespace Tests\ApiStatus\Sql\Utils;

use Pseudo\Pdo;

/**
 * @package Mvc\Model\Resultset
 */
class MultiplePdo extends Pdo
{
    public function prepare($statement, $driver_options = null)
    {
        $rtn = parent::prepare($statement, $driver_options);
        return new MultiplePdoStatement($rtn);
    }

    public function query($statement)
    {
        return new MultiplePdoStatement(parent::query($statement));
    }
}
