<?php

declare(strict_types=1);

namespace Bo\Native\Cards;

use Api\DataProvider\Bo\Native\Cards\DateMenu\DatesWithRaces;
use Api\Input\Request\Horses\Native\Cards\DateMenu as Request;
use Bo\Standart;

/**
 * @package Bo\Native\Cards
 * @property Request $request;
 */
class DateMenu extends Standart
{
    const DAYS_INTERVAL = 7;

    /**
     * @return array
     * @throws \Exception
     */
    public function getData(): array
    {
        $date = $this->request->getRaceDate();

        $dateTimeStart = $date . ' 00:00:00';

        $endDate = new \DateTime($date);
        $endDate->add(new \DateInterval('P' . self::DAYS_INTERVAL . 'D'));
        $dateTimeEnd = $endDate->format('Y-m-d') . ' 23:59:59';

        $countRaces = (new DatesWithRaces())->getData($dateTimeStart, $dateTimeEnd);

        $datesAvailable = [];

        for ($i = 0; $i < self::DAYS_INTERVAL; $i++) {
            $currDate = new \DateTime($date);
            $currDate->add(new \DateInterval('P' . $i . 'D'));

            $datesAvailable[] = (object)[
                'available' => (array_key_exists($currDate->format('d.m.Y'), $countRaces)) ? 1 : 0,
                'date' => $currDate->format('Y-m-d')
            ];
        }

        return $datesAvailable;
    }
}
