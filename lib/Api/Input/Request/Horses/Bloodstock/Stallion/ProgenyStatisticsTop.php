<?php

namespace Api\Input\Request\Horses\Bloodstock\Stallion;

use \Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Cast;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;

/**
 * Class ProgenyStatisticsTop
 *
 * @package Api\Input\Request\Horses\Bloodstock\Stallion
 */
class ProgenyStatisticsTop extends HorsesRequest
{
    const STATISTICS_LIMIT = 10;

    /**
     * @var array
     */
    private static $availableCategories = [
        'Worldwide G1',
        'Euro Stakes',
        'First Crop',
        'All-weather',
        'Jumps',
        'Hurdle',
        'Hurdles',
        'Chase',
        'NHF',
        'Flat',
        '2yo',
        '5-6f',
        '7-9f',
        '10-11f',
        '12-13f',
        '14f+',
        'Heavy',
        'Soft',
        'Gd-sft',
        'Good',
        'Gd-fm',
        'Turf',
        'Firm',
    ];

    /**
     * @return array
     */
    public static function getAvailableCategories()
    {
        return self::$availableCategories;
    }

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

        $this->addNamedParameter(
            'category',
            new StandardValidator\ExistsInArray(
                self::getAvailableCategories()
            ),
            true
        );

        $this->addCast('category', new Cast\Callback(function ($val) {
            if ($val === 'Hurdles') {
                $val = 'Hurdle';
            }

            return $val;
        }));

        $this->addOrderedParameter(
            'period',
            new StandardValidator\Integer(null, idate('Y'))
        );

        $this->addCast('period', new Cast\DecimalInteger());
    }

    /**
     * @return string
     */
    public function getEndDate()
    {
        return date('Y-m-d') . ' 23:59:59';
    }

    /**
     * @return string
     */
    public function getStartDate()
    {
        $currentYear = date('Y');
        $requestedYear = $this->getPeriod();

        if ($requestedYear >= $currentYear) {
            return $currentYear . '-01-01 00:00:00';
        } elseif ($requestedYear == '2000') {
            return '2000-01-01 00:00:00';
        } else {
            return '1988-01-01 00:00:00';
        }
    }

    /**
     * @return int
     */
    public function getStatisticsLimit()
    {
        return self::STATISTICS_LIMIT;
    }
}
