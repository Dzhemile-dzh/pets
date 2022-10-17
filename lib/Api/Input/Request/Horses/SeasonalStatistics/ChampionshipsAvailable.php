<?php
namespace Api\Input\Request\Horses\SeasonalStatistics;

use \Api\Input\Request\Parameter\Validator;

class ChampionshipsAvailable extends \Api\Input\Request\HorsesRequest
{
    /**
     * Setup parameters
     */
    protected function setupParameters()
    {
        $this->addOrderedParameter(
            'championship',
            new Validator\Championship(),
            true
        );
    }
}
