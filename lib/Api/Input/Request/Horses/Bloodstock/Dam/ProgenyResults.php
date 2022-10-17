<?php
namespace Api\Input\Request\Horses\Bloodstock\Dam;

use Api\Exception\ValidationError;
use Api\Input\Request\Method\GetRaceTypeCodes;
use Api\Input\Request\Validator\StartEndYear;
use Api\Input\Request\Parameter\Validator\SeasonYear;
use Phalcon\Input\Request\Parameter\Validator\ExistsInArray;
use Phalcon\Input\Request\Parameter\Cast;

class ProgenyResults extends ProgenyResultsDefault
{
    use GetRaceTypeCodes;

    protected function setupParameters()
    {
        parent::setupParameters();

        $this->addNamedParameter(
            'startYear',
            new SeasonYear(),
            false
        );
        $this->addCast('startYear', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'endYear',
            new SeasonYear(),
            false
        );
        $this->addCast('endYear', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'raceType',
            new ExistsInArray($this->getSelectors()->getRaceTypeKeys()),
            false
        );

        $this->addValidator(new StartEndYear(new ValidationError(12)));
    }
}
