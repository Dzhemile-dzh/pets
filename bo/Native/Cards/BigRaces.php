<?php

declare(strict_types=1);

namespace Bo\Native\Cards;

use Api\DataProvider\Bo\Native\Cards\BigRaces\Collection as DataProvider;
use Api\Input\Request\Horses\Native\Cards\BigRaces as Request;
use Bo\Standart;

/**
 * @package Bo\Native\Cards
 * @property Request $request;
 */
class BigRaces extends Standart
{
    const PREDICTOR_ALLOWED_HOURS = 18;

    /**
     * @return object|null
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getData(): ?array
    {
        $list = (new DataProvider())->getData($this->request);

        if (is_array($list)) {
            foreach ($list as $race) {
                $race->time = date('g:i', strtotime($race->race_date));
                $race->date = date('Y-m-d', strtotime($race->race_date));
                $race->ampm = date('a', strtotime($race->race_date));
                $race->meeting = (object)[
                    'course_id' => $race->course_id,
                    'course_name' => $race->course_name,
                    'course_country' => $race->course_country,
                ];
            }
        }

        return $list;
    }
}
