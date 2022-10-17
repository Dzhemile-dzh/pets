<?php

namespace Api\DataProvider\Bo;

use Phalcon\DI;

class BestBetWeightings extends \Phalcon\Mvc\DataProvider
{
    public function getBestBetWeightings()
    {
        $metatagsDb = DI::getDefault()
            ->getShared('selectors')
            ->getDb()
            ->getMetatagsDb();

        $sql = "
            SELECT
                best_bet_uid
                , best_bet_weighting
            FROM $metatagsDb..best_bet_weighting
        ";

        $result = $this->query($sql);

        return $result->toArrayWithRows('best_bet_uid');
    }
}
