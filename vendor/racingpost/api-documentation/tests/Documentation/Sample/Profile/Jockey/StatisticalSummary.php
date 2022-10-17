<?php

namespace Tests\Documentation\Sample\Profile\Jockey;

use RP\Documentation\Parameter;
use RP\Documentation\Method;
use RP\Documentation\Response;
use RP\Documentation\ResponseType;
use RP\Documentation\Group;

class StatisticalSummary extends \Tests\Documentation\Sample\BaseLeaf
{
    public function setup()
    {
        $this->setName("Represents of Statistical Summary Resource");
        $this->setDescription("Summary statistics of the Jockey");
    }

    protected function setupUriParams()
    {
        $this->addUriParam('jockeyId', Parameter::createFromArray([
            'description' => 'Numeric `id` of the Jockey',
            'type' => 'integer',
            'required' => true,
            'example' => 92227,
        ]));
        $this->addUriParam('countryCode', Parameter::createFromArray([
            'description' => 'Alphabet short code of country',
            'type' => 'string',
            'required' => false,
            'example' => 'IRE',
        ]));
        $this->addUriParam('raceType', Parameter::createFromArray([
            'description' => 'Allowed types of the race types',
            'type' => 'string',
            'enum' => ['flat', 'jumps'],
            'required' => false,
            'example' => 'flat',
        ]));
        $this->addUriParam('surface', Parameter::createFromArray([
            'description' => 'Allowed types of the surfaces',
            'type' => 'string',
            'enum' => ['turf', 'aw'],
            'required' => false,
            'example' => 'aw',
        ]));
        $this->addUriParam('championship', Parameter::createFromArray([
            'description' => 'If parameter is specified - statistics will be calculated regarding championship type code',
            'type' => 'string',
            'required' => false,
            'example' => 'championship',
        ]));

        $this->addGroup(['jockeyId']);
        $this->addGroup(['jockeyId', 'countryCode', 'raceType']);
        $this->addGroup(['jockeyId', 'countryCode', 'raceType', 'surface']);
        $this->addGroup(['jockeyId', 'countryCode', 'raceType', 'surface', 'championship']);
    }

    protected function setupMethods()
    {
        $get = new Method();
        $get->setDescription('Returns Statistical Summary Resource');
        
        $get->addQueryParam('beginSeasonYear', Parameter::createFromArray([
            'description' => 'Numeric `year` of the beginning of the season',
            'type' => 'integer',
            'required' => false,
            'example' => 2011,
        ]));
        $get->addQueryParam('endSeasonYear', Parameter::createFromArray([
            'description' => 'Numeric `year` of the end of the season.',
            'type' => 'integer',
            'required' => false,
            'example' => 2012,
        ]));
        
        $get->addResponse(200, Response::build('Profile/Jockey/statistical-summary-example.json', 'Profile/Jockey/statistical-summary-schema.json'));

        $this->addMethod('get', $get);
        parent::setupMethods();
    }
}
