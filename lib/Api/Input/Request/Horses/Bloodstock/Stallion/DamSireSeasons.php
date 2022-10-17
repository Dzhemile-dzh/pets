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
 * Class DamSireSeasons
 *
 * @method int getStallionId()
 *
 * @package Api\Input\Request\Horses\Bloodstock\Stallion
 */
class DamSireSeasons extends \Api\Input\Request\HorsesRequest
{
    private $season;

    private $seasonDates;

    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'stallionId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('stallionId', new Cast\DecimalInteger());
    }
}
