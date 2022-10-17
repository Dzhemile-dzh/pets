<?php
namespace Api\Input\Request\Validator;

use Api\Exception\ValidationError;
use Phalcon\Input\Request\Validator;

class BloodstockStatisticsParamsCombinations extends Validator
{
    /**
     * @var \Models\Selectors
     */
    protected $selectors;
    protected $statisticKey;

    public function __construct(\Models\Selectors $selectors, $key)
    {
        $this->selectors = $selectors;
        $this->statisticKey = $key;
    }

    /**
     * Checks country code, race type code, surface combination
     *
     * @throws ValidationError
     */
    public function validate()
    {
        if ($this->request->getGivenParametersCount() > 1) {
            if ($this->request->isParameterSet('jumpsCode')
                && $this->request->getRaceType() != 'jumps') {
                throw new ValidationError(1006);
            }

            try {
                if ($this->request->getJumpsCode() && $this->request->getSurface()) {
                    throw new ValidationError(22);
                }
                $isSeasonalStatisticsAvailable = $this->selectors->isSeasonalStatisticsAvailable(
                    $this->statisticKey,
                    null,
                    $this->request->getRaceType(),
                    $this->request->getRaceType() === 'jumps'
                        ? $this->request->getJumpsCode()
                        : $this->request->getSurface()
                );

                if (!$isSeasonalStatisticsAvailable) {
                    throw new ValidationError(22);
                }
            } catch (\Exception $e) {
                throw new ValidationError(22);
            }
        }
    }
}
