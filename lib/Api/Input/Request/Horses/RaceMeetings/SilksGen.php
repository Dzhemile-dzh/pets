<?php
namespace Api\Input\Request\Horses\RaceMeetings;

use Api\Input\Request\HorsesRequest;
use Api\Input\Request\Validator\DateFromTo;
use Phalcon\Input\Request\Parameter\Validator\Date;
use Phalcon\Input\Request\Parameter\Validator\ExistsInArray;

class SilksGen extends HorsesRequest
{
    protected function setupParameters()
    {
        $this->addOrderedParameter(
            'dateFrom',
            new Date(),
            false,
            (new \DateTime())->sub(new \DateInterval('P1D'))->format('Y-m-d')
        );

        $this->addOrderedParameter(
            'dateTo',
            new Date(),
            false,
            (new \DateTime())->add(new \DateInterval('P2D'))->format('Y-m-d')
        );

        $this->addNamedParameter(
            'type',
            new ExistsInArray(['gif', 'png', 'eps', 'GIF', 'PNG', 'EPS']),
            false,
            'gif'
        );

        $this->addValidator(new DateFromTo('P30D'));
    }
}
