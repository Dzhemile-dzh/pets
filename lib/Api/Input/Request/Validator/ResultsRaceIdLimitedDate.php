<?php

namespace Api\Input\Request\Validator;

use Api\Exception\ValidationError;
use Phalcon\Input\Request\Validator;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;

/**
 * Class ResultsRaceIdLimitedDate
 *
 * @package Api\Input\Request\ResultsRaceIdLimitedDate
 */
class ResultsRaceIdLimitedDate extends Validator
{

    /**
     * @param int $raceId
     *
     * @return string|null
     */
    private function getRaceDate($raceId)
    {
        $dataProvider = $this->getDataProvider();

        if (is_null($dataProvider)) {
            return null;
        }

        $raceInfo = $dataProvider->getRaceInfo($raceId);

        return (!is_null($raceInfo) && isset($raceInfo->race_datetime) ? $raceInfo->race_datetime : null);
    }

    /**
     * @return \Api\DataProvider\Validator
     */
    public function getDataProvider()
    {
        return new \Api\DataProvider\Validator\ResultsRaceIdLimitedDate();
    }

    /**
     * @throws ValidationError
     */
    public function validate()
    {
        if (!is_null($this->request->getRaceId())) {
            $raceDate = $this->getRaceDate($this->request->getRaceId());

            if (is_null($raceDate)) {
                throw new ValidationError(1015);
            }

            $res = new StandardValidator\Date(
                new \DateTime('today -7 Days'),
                new \DateTime('today')
            );

            if (!$res->validate((new \DateTime($raceDate))->format('Y-m-d'))) {
                throw new ValidationError(1015);
            }
        }
    }
}
