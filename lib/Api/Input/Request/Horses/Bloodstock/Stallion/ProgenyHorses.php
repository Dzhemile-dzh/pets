<?php

namespace Api\Input\Request\Horses\Bloodstock\Stallion;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;
use Api\Input\Request\Parameter\Validator;
use Api\Input\Request\Parameter\Calculate\RaceType\Bloodstock\Stallion\ProgenyHorses as RaceTypeCalculation;
use Api\Input\Request\Parameter\Calculate\SeasonYearBegin as SeasonYearBeginCalculation;
use Api\Input\Request\Parameter\Calculate\SeasonYearEnd as SeasonYearEndCalculation;
use Api\Input\Request\Horses\Bloodstock\StallionProgeny;
use Bo\Bloodstock\Stallion\ProgenyHorses as Bo;

/**
 * Class ProgenyHorses
 *
 * @method int getStallionId()
 * @method getRaceType
 * @method getSeasonYearBegin
 * @method getSeasonYearEnd
 * @method getNumber
 * @method getAge
 *
 * @package Api\Input\Request\Horses\Bloodstock\Stallion
 */
class ProgenyHorses extends StallionProgeny
{
    private $season;

    private $seasonDates;

    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            static::ENTITY_ID,
            new StandardValidator\IntegerId()
        );
        $this->addCast(static::ENTITY_ID, new Cast\DecimalInteger());

        $this->addNamedParameter(
            'raceType',
            new Validator\RaceType(
                $this->getSelectors()
            ),
            false,
            new RaceTypeCalculation()
        );

        $this->addNamedParameter(
            'seasonYearBegin',
            new Validator\SeasonYear(),
            false,
            new SeasonYearBeginCalculation()
        );
        $this->addCast('seasonYearBegin', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'seasonYearEnd',
            new Validator\SeasonYear(),
            false,
            new SeasonYearEndCalculation()
        );
        $this->addCast('seasonYearEnd', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'number',
            new Validator\Number(),
            false,
            50
        );
        $this->addCast('number', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'age',
            new Validator\HorseAge(['2', '3', '4+']),
            false
        );
        $this->addCast('age', new Cast\HorseAge());
    }

    /**
     * @return mixed|object
     */
    public function getSeason()
    {
        if (empty($this->season) && $this->get(Bo::MODEL_DEFAULT_INFO) && $this->get(Bo::BO)) {
            $firstAndLastSeasons = $this->get(Bo::BO)->getFirstAndLastSeasons();
            if (!empty($firstAndLastSeasons)) {
                list($appropriateFirstSeasons, $appropriateLastSeasons) = $firstAndLastSeasons;
                list($beginDate, $endDate) = $this->get(Bo::MODEL_DEFAULT_INFO)->getStartEndSeasonDate(
                    array_merge($appropriateFirstSeasons, $appropriateLastSeasons)
                );
                $begin = $beginDate->format(static::DATE_FORMAT);
                $end = $endDate->format(static::DATE_FORMAT);

                $this->season = (Object)[
                    'seasonDateBegin' => $begin,
                    'seasonDateEnd' => $end,
                    'raceType' => $this->get(Bo::MODEL_DEFAULT_INFO)->getDefaultProgenyRaceType(
                        $this->getId(),
                        $begin,
                        $end
                    )
                ];
            } else {
                $this->season = $this->get(Bo::MODEL_DEFAULT_INFO)->getCurrentSeason();
            }
        }
        return $this->season;
    }

    /**
     * @return mixed|object
     * @throws \Api\Exception\ValidationError
     * @throws \Exception
     */
    protected function getSeasonDates()
    {
        if (!$this->seasonDates) {
            if ($this->isParameterProvided('seasonYearBegin') && $this->isParameterProvided('seasonYearEnd')) {
                $db = $this->getSelectors()->getDb();
                $seasonTypeCode = $this->getSeasonTypeCode();

                $this->seasonDates = (Object)[
                    'seasonDateBegin' => $db->getSeasonDateBegin($this->getSeasonYearBegin(), $seasonTypeCode),
                    'seasonDateEnd' => $db->getSeasonDateEnd($this->getSeasonYearEnd(), $seasonTypeCode)
                ];
            } elseif ($this->getSeason()) {
                $this->seasonDates = $this->getSeason();
            }
        }
        return $this->seasonDates;
    }
}
