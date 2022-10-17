<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 2/25/2016
 * Time: 12:37 PM
 */

namespace Api\Input\Request\Horses\Bloodstock\Stallion;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;
use Api\Input\Request\Parameter\Validator;
use Api\Input\Request\Parameter\Calculate\RaceType\Bloodstock\Stallion\ProgenyResults as RaceTypeCalculation;
use Api\Input\Request\Parameter\Calculate\CountryCode\Bloodstock\Stallion\ProgenyResults as CountryCodeCalculation;
use Api\Input\Request\Parameter\Calculate\SeasonYearBegin as SeasonYearBeginCalculation;
use Api\Input\Request\Parameter\Calculate\SeasonYearEnd as SeasonYearEndCalculation;
use Api\Input\Request\Horses\Bloodstock\StallionProgeny;
use Bo\Bloodstock\Stallion\ProgenyResults as Bo;

/**
 * Class ProgenyResults
 * @method getSeasonYearBegin
 * @method getSeasonYearEnd
 * @method getCountryCode
 * @method getRaceType
 * @method getSurface
 * @method getMonth
 *
 * @package Api\Input\Request\Horses\Bloodstock\Stallion
 */
class ProgenyResults extends StallionProgeny
{

    private $season;

    private $seasonDates;

    /**
     * Setup Parameters
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            self::ENTITY_ID,
            new StandardValidator\IntegerId()
        );
        $this->addCast(self::ENTITY_ID, new Cast\DecimalInteger());

        $this->addOrderedParameter(
            'seasonYearBegin',
            new Validator\SeasonYear(),
            false,
            new SeasonYearBeginCalculation()
        );
        $this->addCast('seasonYearBegin', new Cast\DecimalInteger());

        $this->addOrderedParameter(
            'seasonYearEnd',
            new Validator\SeasonYear(),
            false,
            new SeasonYearEndCalculation()
        );
        $this->addCast('seasonYearEnd', new Cast\DecimalInteger());

        $this->addOrderedParameter(
            'countryCode',
            new StandardValidator\ExistsInArray(['GB', 'IRE']),
            false,
            new CountryCodeCalculation()
        );

        $this->addOrderedParameter(
            'raceType',
            new StandardValidator\ExistsInArray(
                $this->getSelectors()->getRaceTypeKeys()
            ),
            false,
            new RaceTypeCalculation()
        );

        $this->addNamedParameter(
            'surface',
            new Validator\Surface(
                $this->getSelectors()
            ),
            false
        );

        $this->addNamedParameter(
            'month',
            new StandardValidator\Integer(1, 12),
            false
        );
        $this->addCast('month', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'graded',
            new StandardValidator\Boolean(),
            false,
            false
        );
        $this->addCast('graded', new Cast\Boolean());

        $this->addValidator(new \Api\Input\Request\Validator\StallionProgenyResultsRequired());
        $this->addValidator(new \Api\Input\Request\Validator\CountryRaceTypeSurface($this->getSelectors()));
        $this->addValidator(new \Api\Input\Request\Validator\OneSeasonBeginEndYears());
    }

    public function getSeason()
    {
        if (!$this->season && $this->get(Bo::MODEL_DEFAULT_INFO) && $this->get(Bo::BO)) {
            $lastSeasons = $this->get(Bo::BO)->getLastSeasons();
            if (!empty($lastSeasons)) {
                list($startDateObj, $endDateObj) = $this->get(Bo::MODEL_DEFAULT_INFO)->getStartEndSeasonDate($lastSeasons);
                $this->season = $this->get(Bo::MODEL_DEFAULT_INFO)->getResultsBySeasons(
                    $this->getId(),
                    $startDateObj->format(self::DATE_FORMAT),
                    $endDateObj->format(self::DATE_FORMAT)
                );
            }
            if (empty($this->season)) {
                $this->season = $this->get(Bo::MODEL_DEFAULT_INFO)->getCurrentSeason();
            }
        }
        return $this->season;
    }

    protected function getSeasonDates()
    {
        if ($this->isParameterProvided('seasonYearBegin') && $this->isParameterProvided('seasonYearEnd')) {
            $this->seasonDates = $this->getSelectors()->getDb()->getOneSeasonData(
                $this->getSeasonYearBegin(),
                $this->getSeasonYearEnd(),
                $this->getSeasonTypeCode()
            );
        } elseif (!$this->isRegisterEmpty()) {
            $this->seasonDates = $this->getSeason();
        }
        return $this->seasonDates;
    }
}
