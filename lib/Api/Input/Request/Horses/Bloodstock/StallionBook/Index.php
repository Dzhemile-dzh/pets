<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 3/29/2016
 * Time: 12:29 PM
 */

namespace Api\Input\Request\Horses\Bloodstock\StallionBook;

use Api\Input\Request\Parameter\Validator\CountryCodeFullScope;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class Index extends \Api\Input\Request\HorsesRequest
{
    protected function setupParameters()
    {
        $selectors = $this->getSelectors();

        // Type of list
        $this->addNamedParameter(
            'type',
            new StandardValidator\ExistsInArray(['active', 'inactive', 'weatherbys']),
            false,
            'active'
        );

        // Stallion criteria:
        $this->addNamedParameter(
            'stallion',
            new StandardValidator\StringLength(3, 30),
            false
        );
        $this->addNamedParameter(
            'sire',
            new StandardValidator\StringLength(3, 30),
            false
        );
        $this->addNamedParameter(
            'sireFlag',
            new StandardValidator\ExistsInArray(['include', 'exclude']),
            false,
            'include'
        );
        $this->addNamedParameter(
            'sireLine',
            new StandardValidator\StringLength(3, 30),
            false
        );
        $this->addNamedParameter(
            'sireLineFlag',
            new StandardValidator\ExistsInArray(['include', 'exclude']),
            false,
            'include'
        );
        $this->addNamedParameter(
            'sireType',
            new StandardValidator\ExistsInArray(
                ['all', 'firstCrop', 'secondCrop', 'thirdCrop']
            ),
            false
        );
        $this->addNamedParameter(
            'studCountryCode',
            new CountryCodeFullScope(),
            false
        );
        // Stud farm name
        $this->addNamedParameter(
            'studFarm',
            new StandardValidator\StringLength(3, 254),
            false
        );
        // Year to Stud
        $this->addNamedParameter(
            'yearToStud',
            new StandardValidator\Integer(1900, 2999),
            false
        );
        $this->addCast('yearToStud', new Cast\DecimalInteger());

        // Stud fee
        $this->addNamedParameter(
            'minPrice',
            new StandardValidator\Integer(0),
            false
        );
        $this->addCast('minPrice', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'maxPrice',
            new StandardValidator\Integer(0),
            false
        );
        $this->addCast('maxPrice', new Cast\DecimalInteger());

        // Win distance
        $this->addNamedParameter(
            'distance',
            null,
            false
        );

        // Progeny Success
        $this->addNamedParameter(
            'turfWinners',
            new StandardValidator\Boolean(),
            false
        );
        $this->addCast('turfWinners', new Cast\Boolean());

        $this->addNamedParameter(
            'hurdleWinners',
            new StandardValidator\Boolean(),
            false
        );
        $this->addCast('hurdleWinners', new Cast\Boolean());

        $this->addNamedParameter(
            'chaseWinners',
            new StandardValidator\Boolean(),
            false
        );
        $this->addCast('chaseWinners', new Cast\Boolean());

        $this->addNamedParameter(
            'allWeatherWinners',
            new StandardValidator\Boolean(),
            false
        );
        $this->addCast('allWeatherWinners', new Cast\Boolean());

        $this->addNamedParameter(
            'g1Winner',
            new StandardValidator\Boolean(),
            false
        );
        $this->addCast('g1Winner', new Cast\Boolean());

        $this->addNamedParameter(
            'g2Winner',
            new StandardValidator\Boolean(),
            false
        );
        $this->addCast('g2Winner', new Cast\Boolean());

        $this->addNamedParameter(
            'g3Winner',
            new StandardValidator\Boolean(),
            false
        );
        $this->addCast('g3Winner', new Cast\Boolean());

        $this->addNamedParameter(
            'gradeWinners',
            new StandardValidator\Boolean(),
            false
        );
        $this->addCast('gradeWinners', new Cast\Boolean());

        $this->addNamedParameter(
            'blackTypeWinners',
            new StandardValidator\Boolean(),
            false
        );
        $this->addCast('blackTypeWinners', new Cast\Boolean());

        $this->addValidator(new \Api\Input\Request\Validator\RaceDistances($selectors, 'legacy_alt'));
        $this->addValidator(new \Api\Input\Request\Validator\MinMaxPriceDependant());
    }
}
