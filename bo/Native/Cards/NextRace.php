<?php

declare(strict_types=1);

namespace Bo\Native\Cards;

use Api\DataProvider\Bo\Native\Cards\NextRace\Data as DataProvider;
use Bo\Standart;
use Phalcon\Mvc\Model\Row;
use Api\Input\Request\Horses\Native\Cards\NextRace as Request;

/**
 * Class NextRace
 * @package Bo\Native\Cards
 *
 * @method Request getRequest()
 */
class NextRace extends Standart
{
    /**
     * @return Row
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getData(): array
    {
        $data = (new DataProvider())->getData($this->getRequest()->getDate());

        $rtn = [
            'nextRaceId' => (object)[
                'race_instance_uid' => $data->race_instance_uid ?? null,
            ],
            'nextRaceDate' => (object)[
                'race_datetime' => $data->race_datetime ?? null,
            ]
        ];

        return $rtn;
    }
}
