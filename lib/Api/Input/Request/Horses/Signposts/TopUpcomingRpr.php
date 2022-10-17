<?php

namespace Api\Input\Request\Horses\Signposts;

use Api\Input\Request\HorsesRequest;
use Api\Input\Request\Method\GetRaceTypeCodes;
use Api\Input\Request\Parameter\Validator\RaceType;
use Phalcon\Input\Request\Parameter\Validator\Integer;
use Phalcon\Input\Request\Parameter\Validator\ExistsInArray;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class TopUpcomingRpr extends HorsesRequest
{
    use GetRaceTypeCodes;

    const DEFAULT_LOWER_NUMBER_HORSES = 5;
    const DEFAULT_UPPER_NUMBER_HORSES = 30;

    public static function init(HorsesRequest $request)
    {
        $ordered = $request->getIncomingOrderedParameters();
        if (count($ordered) === 1 && $ordered[0] === 'daily') {
            array_unshift($ordered, self::DEFAULT_LOWER_NUMBER_HORSES);
        }
        return new self($ordered, $request->getIncomingNamedParameters());
    }

    /**
     * @param array $parameters
     * @return int
     */
    private function setTopHorses(array &$parameters)
    {
        if (count($parameters) == 0) {
            $parameters[] = self::DEFAULT_LOWER_NUMBER_HORSES;
        }

        return $parameters[0];
    }

    protected function setupParameters()
    {
        $this->addOrderedParameter(
            'topHorses',
            new Integer(
                self::DEFAULT_LOWER_NUMBER_HORSES,
                self::DEFAULT_UPPER_NUMBER_HORSES
            ),
            false,
            $this->setTopHorses($this->rawOrderedParameters)
        );
        $this->addCast('topHorses', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'raceType',
            new RaceType($this->getSelectors()),
            false
        );

        $this->addOrderedParameter(
            'daily',
            new ExistsInArray(['daily']),
            false
        );

        $this->addNamedParameter(
            'courseId',
            new StandardValidator\SmallInteger(),
            false
        );
        $this->addCast('courseId', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'raceId',
            new StandardValidator\IntegerId(),
            false
        );
        $this->addCast('raceId', new Cast\DecimalInteger());
    }
}
