<?php

declare(strict_types=1);

namespace Models\Bo\NapsTableForm;

use Models\RaceInstance;
use Phalcon\Mvc\Model\Resultset\General;
use Phalcon\Mvc\Model\Resultset\ResultsetException;

class RecentForm extends RaceInstance
{
    /**
     * @return array
     * @throws ResultsetException
     */
    public function getNapsTableForm(): array
    {
        $res = $this->getReadConnection()->query(
            "SELECT 
                  h.horse_uid
                , horse_style_name = h.style_name
                , snct.newspaper
                , snct.tipster
                , snct.level_stake
            FROM
                ss_nap_comp_today snct
            LEFT JOIN
             	horse h ON h.horse_uid = snct.nap_horse_uid 
            LEFT JOIN 
                pre_horse_race phr ON phr.horse_uid = h.horse_uid 
                AND phr.race_status_code LIKE '[OR]' 
            LEFT JOIN race_instance ri ON ri.race_instance_uid = phr.race_instance_uid 
                AND ri.race_datetime = snct.nap_time 
            WHERE ri.race_instance_uid = phr.race_instance_uid 
            ORDER BY snct.level_stake DESC , snct.wins DESC"
        );

        $collection = new General(
            null,
            new \Api\Row\NapsTableForm\RecentForm(),
            $res
        );

        return $collection->toArrayWithRows();
    }
}

