<?php


namespace Tests\ApiStatus\Sql\Utils;

use Phalcon\Db\Adapter\Sybase;

/**
 * @package Tests\ApiStatus\Sql\Utils
 */
trait FakePdoTrait
{
    /**
     * @param array $config
     */
    private function initFakePdo(array $config): void
    {
        $pdo = new MultiplePdo();
        foreach ($config as $sql => $rows) {
            $pdo->mock($sql, $rows);
        }
        Sybase::setCustomPdoObject($pdo);
    }
}
