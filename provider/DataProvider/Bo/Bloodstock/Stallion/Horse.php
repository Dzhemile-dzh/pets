<?php

namespace Api\DataProvider\Bo\Bloodstock\Stallion;

use Api\Exception\NotFound;
use Phalcon\Mvc\DataProvider;

class Horse extends DataProvider
{
    /**
     * Check if horse exists, if not throws an exception `Horse instance not found`
     *
     * @param int $horseUid
     * @throws NotFound
     */
    public function isHorseExisting(int $horseUid)
    {
        $result = $this->query(
            "SELECT 1 FROM horse h WHERE h.horse_uid = :horseUid",
            ['horseUid' => $horseUid]
        );

        if ($result->count() === 0) {
            throw new NotFound(3101);
        }
    }
}
