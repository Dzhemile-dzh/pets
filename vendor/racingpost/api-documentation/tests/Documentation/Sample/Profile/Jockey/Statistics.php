<?php

namespace Tests\Documentation\Sample\Profile\Jockey;

use RP\Documentation\Parameter;
use RP\Documentation\Method;
use RP\Documentation\Response;
use RP\Documentation\ResponseType;
use RP\Documentation\Group;

class Statistics extends \Tests\Documentation\Sample\BaseLeaf
{
    public function setup()
    {
        $this->setName("Represents Statistical Resource");
        $this->setDescription("Jockey statistical data related to few criteria.");
    }

    protected function setupUriParams()
    {
        $this->addUriParam('jockeyId', Parameter::createFromArray([
            'description' => 'Numeric `id` of the Jockey',
            'type' => 'integer',
            'required' => true,
            'example' => 88563,
        ]));
        $this->addUriParam('beginSeasonYear', Parameter::createFromArray([
            'description' => 'Numeric representation of an year',
            'type' => 'integer',
            'required' => false,
            'example' => 2011,
        ]));
        $this->addUriParam('endSeasonYear', Parameter::createFromArray([
            'description' => 'Numeric representation of an year',
            'type' => 'integer',
            'required' => false,
            'example' => 2015,
        ]));
        $this->addUriParam('countryCode', Parameter::createFromArray([
            'description' => 'Alphabet short `code` of country',
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
        $this->addUriParam('statisticsType', Parameter::createFromArray([
            'description' => 'Allowed types of the statistics. Notice `age-of-horse` available only for flat races,`race-category` available for jumps',
            'type' => 'string',
            'enum' => ['course', 'distance', 'month', 'race-type', 'trainer', 'race-class', 'age-of-horse', 'race-category'],
            'required' => false,
            'example' => 'distance',
        ]));
        $this->addUriParam('surface', Parameter::createFromArray([
            'description' => 'Allowed types of the surfaces',
            'type' => 'string',
            'enum' => ['turf', 'aw'],
            'required' => false,
            'example' => 'aw',
        ]));
        $this->addUriParam('championship', Parameter::createFromArray([
            'description' => 'If parameter is specified - statistics will be calculated regarding championship start/end dates',
            'type' => 'string',
            'required' => false,
            'example' => 'championship',
        ]));

        $this->addGroup(['jockeyId']);
        $this->addGroup(['jockeyId', 'beginSeasonYear', 'endSeasonYear', 'raceType', 'countryCode', 'statisticsType']);
        $this->addGroup(['jockeyId', 'beginSeasonYear', 'endSeasonYear', 'raceType', 'countryCode', 'statisticsType', 'surface']);
        $this->addGroup(['jockeyId', 'beginSeasonYear', 'endSeasonYear', 'raceType', 'countryCode', 'statisticsType', 'surface', 'championship']);
    }

    protected function setupMethods()
    {
        $get = new Method();

        $get->setDescription('Represents Statistical Resource');
        $get->addResponse(200, Response::build('Profile/Jockey/statistics-example.json', 'Profile/Jockey/statistics-schema.json'));

        $this->addMethod('get', $get);
        parent::setupMethods();
    }
}
