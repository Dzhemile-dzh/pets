<?php

namespace Api\Input\Request\Validator;

use Phalcon\Input\Request\Validator;
use Api\Exception\ValidationError;

class DateFromTo extends Validator
{
    /**
     * @var null|string
     */
    protected $maxRange;

    /**
     * @var string
     */
    protected $paramNameFrom;

    /**
     * @var string
     */
    protected $paramNameTo;

    /**
     * DateFromTo constructor.
     *
     * @param string $maxRange interval for \DateInterval in format http://php.net/manual/en/dateinterval.construct.php
     * @param string $paramNameFrom
     * @param string $paramNameTo
     *
     */
    public function __construct($maxRange = null, $paramNameFrom = 'dateFrom', $paramNameTo = 'dateTo')
    {
        $this->maxRange = $maxRange;
        $this->paramNameFrom = $paramNameFrom;
        $this->paramNameTo = $paramNameTo;
    }

    /**
     * @throws ValidationError
     */
    public function validate()
    {
        $dateFrom = new \DateTime($this->request->{'get' . ucfirst($this->paramNameFrom)}());
        $dateTo = new \DateTime($this->request->{'get' . ucfirst($this->paramNameTo)}());
        if ($dateFrom > $dateTo) {
            throw new ValidationError(27, [$this->paramNameFrom, $this->paramNameTo]);
        }

        if ($this->maxRange !== null) {
            $range = new \DateInterval($this->maxRange);

            $dateTo->sub($range);
            if ($dateTo > $dateFrom) {
                throw new ValidationError(
                    28,
                    [
                        $this->paramNameFrom,
                        $this->paramNameTo,
                        $range->format('%y years %m month %d days %h hours %i minutes %s seconds')
                    ]
                );
            }
        }
    }
}
