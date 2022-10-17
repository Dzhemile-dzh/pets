<?php

namespace Api\Input\Request\Horses\OwnerGroups;

use Api\Input\Request\HorsesRequest;
use Api\Input\Request\Validator;
use Phalcon\Input\Request\Parameter\Cast;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;

/**
 * Class Results
 *
 * @method int getOwnerGroupId()
 * @method int getOwnerId()
 * @method int getTrainerId()
 * @method string getTrainerCountryCode()
 *
 * @package Api\Input\Request\Horses\OwnerGroups
 */
class Results extends HorsesRequest
{
    /**
     * The max date range allowed
     */
    const MAX_DATE_RANGE = 'P1Y';

    /**
     * Default date range
     */
    const DEFAULT_DATE_RANGE = 'P90D';

    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'ownerGroupId',
            new StandardValidator\Integer(0, 2147483647)
        );
        $this->addCast('ownerGroupId', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'ownerId',
            new StandardValidator\IntegerId(),
            false
        );
        $this->addCast('ownerId', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'trainerId',
            new StandardValidator\IntegerId(),
            false
        );
        $this->addCast('trainerId', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'trainerCountryCode',
            new StandardValidator\StringLength(2, 3),
            false
        );

        $this->addNamedParameter(
            'countryCode',
            new StandardValidator\StringLength(2, 3),
            false
        );

        $this->addNamedParameter(
            'startDate',
            new StandardValidator\Date(null, (new \DateTime())->format('Y-m-d')),
            false,
            $this->getDefaultStartDate()
        );

        $this->addNamedParameter(
            'endDate',
            new StandardValidator\Date(null, (new \DateTime())->format('Y-m-d')),
            false,
            $this->getDefaultEndDate()
        );

        $this->addValidator(
            new Validator\DateFromTo(
                self::MAX_DATE_RANGE,
                'startDate',
                'endDate'
            )
        );
    }

    /**
     * @return string
     * @throws \Exception
     */
    protected function getDefaultStartDate()
    {
        // Check whether an endDate parameter has been passed AND verify that it's a valid date
        if (array_key_exists('endDate', $this->rawNamedParameters) &&
            \DateTime::createFromFormat('Y-m-d', $this->rawNamedParameters['endDate'])
        ) {
            $endDate = (new \DateTime($this->rawNamedParameters['endDate']));
        } else {
            $endDate = new \DateTime();
        }
        $endDate->sub(new \DateInterval(self::DEFAULT_DATE_RANGE));

        return $endDate->format('Y-m-d');
    }

    /**
     * @return string
     * @throws \Exception
     */
    protected function getDefaultEndDate()
    {
        $curDate = new \DateTime();

        // Check whether an endDate parameter has been passed AND verify that it's a valid date
        if (array_key_exists('startDate', $this->rawNamedParameters) &&
            \DateTime::createFromFormat('Y-m-d', $this->rawNamedParameters['startDate'])
        ) {
            $startDate = new \DateTime($this->rawNamedParameters['startDate']);
            $startDate->add(new \DateInterval(self::DEFAULT_DATE_RANGE));

            if ($startDate > $curDate) {
                $startDate = $curDate;
            }
        } else {
            $startDate = $curDate;
        }

        return $startDate->format('Y-m-d');
    }

    /**
     * @return bool
     */
    public function isOwnerIdProvided() : bool
    {
        return $this->isParameterProvided('ownerId');
    }

    /**
     * @return bool
     */
    public function isCountryCodeProvided() : bool
    {
        return $this->isParameterProvided('countryCode');
    }

    /**
     * @return bool
     */
    public function isTrainerIdProvided() : bool
    {
        return $this->isParameterProvided('trainerId');
    }

    /**
     * @return bool
     */
    public function isTrainerCountryCodeProvided() : bool
    {
        return $this->isParameterProvided('trainerCountryCode');
    }
}
