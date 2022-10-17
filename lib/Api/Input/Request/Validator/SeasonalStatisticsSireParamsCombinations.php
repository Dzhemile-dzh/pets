<?php
namespace Api\Input\Request\Validator;

use Api\Exception\ValidationError;
use Phalcon\Input\Request\Validator;

class SeasonalStatisticsSireParamsCombinations extends Validator
{
    /**
     * @var \Models\Selectors
     */
    protected $selectors;

    public function __construct(\Models\Selectors $selectors)
    {
        $this->selectors = $selectors;
    }

    /**
     * Checks country code, race type code, surface and championship combination
     *
     * @throws ValidationError
     */
    public function validate()
    {
        if ($this->request->getGivenParametersCount() > 0) {
            //It means that request has parameters

            try {
                $isSeasonalStatisticsAvailable = $this->selectors->isSeasonalStatisticsAvailable(
                    'sire',
                    $this->request->getCountryCode(),
                    $this->request->getRaceType(),
                    $this->request->getSurface(),
                    $this->request->getChampionship()
                );

                if (!$isSeasonalStatisticsAvailable) {
                    throw new ValidationError(23);
                }
            } catch (\Exception $e) {
                throw new ValidationError(23);
            }
        }
    }
}
