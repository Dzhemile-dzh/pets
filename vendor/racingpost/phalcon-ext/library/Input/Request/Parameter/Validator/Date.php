<?php

namespace Phalcon\Input\Request\Parameter\Validator;

class Date extends Time
{
    const VALIDATOR_TITLE = 'date [YYYY-MM-DD]';
    const FORMAT = 'Y-m-d';

    private $min;
    private $max;
    private $checkFormat;
    private $argumentsValid;


    public function __construct($min = null, $max = null, $checkFormat = true)
    {
        $this->argumentsValid = true;
        try {
            if ($min) {
                $this->min = $this->retrieveDate($min);
            }
            if ($max) {
                $this->max = $this->retrieveDate($max);
            }
            $this->checkFormat = $checkFormat;
        } catch (\Exception $e) {
            $this->argumentsValid = false;
        }
    }

    public function getValidatorTitle()
    {
        $range = '';
        if ($this->min || $this->max) {
            $range .= ', with range [' .
                (!$this->min ? null : 'from ' . $this->min->format(self::FORMAT)) .
                (!$this->max ? null : 'to ' . $this->max->format(self::FORMAT))
                . ']';
        }

        return self::VALIDATOR_TITLE . $range;
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public function validate($value)
    {
        $valid = false;
        if ($this->argumentsValid) {
            $valid = parent::validate($value);
            if ($valid) {
                $date = new \DateTime($value);
                if (!is_null($this->min) && !is_null($this->max)) {
                    $valid = ($date >= $this->min && $date <= $this->max);
                } elseif (!is_null($this->min)) {
                    $valid = $date >= $this->min;
                } elseif (!is_null($this->max)) {
                    $valid = $date <= $this->max;
                }
                if ($valid && $this->checkFormat) {
                    $valid = $date->format('Y-m-d') === $value;
                }
            }
        }
        return $valid;
    }

    /**
     * @param $date
     *
     * @return \DateTime
     * @throws \InvalidArgumentException
     */
    private function retrieveDate($date)
    {
        if (is_string($date)) {
            return new \DateTime($date);
        } elseif ($date instanceof \DateTime) {
            return $date;
        } else {
            throw new \InvalidArgumentException("Wrong time for date boundaries");
        }
    }
}
