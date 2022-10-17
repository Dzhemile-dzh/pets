<?php
/**
 * Created by PhpStorm.
 * User: oleg_symonchuk
 * Date: 29/12/14
 * Time: 12:41 PM
 */

namespace Api\Input\Request\Horses\Bloodstock\Stallion;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class ProgenyBroodmareSiresStatisticsTop extends \Api\Input\Request\HorsesRequest
{
    const STATISTICS_LIMIT = 10;

    /**
     * Setup Parameters
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'stallionId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('stallionId', new Cast\DecimalInteger());

        $this->addOrderedParameter(
            'period',
            new StandardValidator\IntegerId()
        );
        $this->addCast('period', new Cast\DecimalInteger());
    }

    public function getEndDate()
    {
        return date('Y-m-d') . ' 23:59:59';
    }

    public function getStartDate()
    {
        $currentYear = date('Y');
        $requestedYear = $this->getPeriod();

        if ($requestedYear >= $currentYear) {
            return date('Y') . '-01-01 00:00:00';
        } elseif ($requestedYear == '2000') {
            return '2000-01-01 00:00:00';
        } else {
            return '1988-01-01 00:00:00';
        }
    }

    public function getStatisticsLimit()
    {
        return self::STATISTICS_LIMIT;
    }
}
