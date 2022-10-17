<?php

namespace Tests\Documentation\Sample\Profile\Jockey;

use RP\Documentation\Parameter;
use RP\Documentation\Method;
use RP\Documentation\Response;
use RP\Documentation\ResponseType;
use RP\Documentation\Group;

class RecordByRaceType extends \Tests\Documentation\Sample\BaseLeaf
{
    public function setup()
    {
        $this->setName("Record by Race Type");
        $this->setDescription("Represents Record by Race Type Resource");
    }

    protected function setupUriParams()
    {
        $this->addUriParam('jockeyId', Parameter::createFromArray([
            'description' => 'Numeric `id` of the Jockey',
            'type' => 'integer',
            'required' => true,
            'example' => 87600,
        ]));
        $this->addUriParam('countryCode', Parameter::createFromArray([
            'description' => 'String `code` of the Country',
            'type' => 'string',
            'required' => false,
            'example' => 'GB',
        ]));
        $this->addUriParam('raceType', Parameter::createFromArray([
            'description' => 'String `code` of the Race Type',
            'type' => 'string',
            'enum' => ['flat', 'jumps'],
            'required' => false,
            'example' => 'flat',
        ]));
        $this->addUriParam('beginSeasonYear', Parameter::createFromArray([
            'description' => 'Numeric `year` of the beginning of the season',
            'type' => 'integer',
            'required' => false,
            'example' => 2011,
        ]));
        $this->addUriParam('endSeasonYear', Parameter::createFromArray([
            'description' => 'Numeric `year` of the end of the season.',
            'type' => 'integer',
            'required' => false,
            'example' => 2012,
        ]));

        $this->addGroup(['jockeyId']);
        $this->addGroup(['jockeyId', 'countryCode', 'raceType', 'beginSeasonYear', 'endSeasonYear']);
    }

    protected function setupMethods()
    {
        $get = new Method();

        $get->setDescription('Returns Record by Race Type data for a given jockey');
        $get->addResponse(200, Response::build('Profile/Jockey/record-by-race-type-example.json', 'Profile/Jockey/record-by-race-type-schema.json'));
        
        $this->addMethod('get', $get);
        parent::setupMethods();
    }
}
