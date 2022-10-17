<?php

namespace Tests\Stubs\Lib\Api\Input\Request\Validator;

/**
 * Class ResultsRaceIdLimitedDate
 *
 * @package Tests\Stubs\Lib\Api\Input\Request\ResultsRaceIdLimitedDate
 */
class ResultsRaceIdLimitedDate extends \Api\Input\Request\Validator\ResultsRaceIdLimitedDate
{
    /**
     * @return \Tests\Stubs\DataProvider\Validator\ResultsRaceIdLimitedDate
     */
    public function getDataProvider()
    {
        return new \Tests\Stubs\DataProvider\Validator\ResultsRaceIdLimitedDate();
    }
}
