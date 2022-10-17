<?php
namespace Api\Input\Request\Validator;

use Api\Exception\ValidationError;
use Phalcon\Input\Request\Validator;

class SeasonalStatisticsParamsCombinations extends Validator
{
    /**
     * @var \Models\Selectors
     */
    protected $selectors;
    protected $seasonalStatisticKey;
    private $countryCodes;

    public function __construct(\Models\Selectors $selectors, $seasonalStatisticKey)
    {
        $this->selectors = $selectors;
        $this->seasonalStatisticKey = $seasonalStatisticKey;
    }

    /**
     * Checks country code, race type code, surface and championship combination
     *
     * @throws ValidationError
     */
    public function validate()
    {
        if ($this->isParametersWereProvided()) {
            $this->setCountryCodes();

            $isChampionship = $this->request->isParameterExists('championship');

            try {
                $this->isSeasonalStatisticsAvailable($isChampionship);
            } catch (\Exception $e) {
                throw new ValidationError($isChampionship ? 11 : 7);
            }
        }
    }

    private function setCountryCodes()
    {
        if ($this->request->isParameterExists('countryCode')) {
            $this->countryCodes[] = $this->request->getCountryCode();
        } else {
            $this->countryCodes = $this->request->getCountryCodes();
        }
    }

    private function isSeasonalStatisticsAvailable($isChampionship)
    {

        $key = $this->seasonalStatisticKey;
        $raceType = $this->request->getRaceType();
        $surface = $this->request->getSurface();
        $champ = $isChampionship ? $this->request->getChampionship() : null;

        foreach ($this->countryCodes as $country) {
            $valid = $this->selectors->isSeasonalStatisticsAvailable($key, $country, $raceType, $surface, $champ);
            if (!$valid) {
                throw new ValidationError(3);
            }
        }
    }

    private function isParametersWereProvided()
    {
        $params = ['raceType', 'surface', 'championship', 'countryCode', 'countryCodes'];

        foreach ($params as $param) {
            if ($this->request->isParameterProvided($param)) {
                return true;
            }
        }
        return false;
    }
}
