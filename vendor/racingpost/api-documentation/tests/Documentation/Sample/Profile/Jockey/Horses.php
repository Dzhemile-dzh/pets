<?php

namespace Tests\Documentation\Sample\Profile\Jockey;

use RP\Documentation\Parameter;
use RP\Documentation\Method;
use RP\Documentation\Response;
use RP\Documentation\ResponseType;
use RP\Documentation\Group;

class Horses extends \Tests\Documentation\Sample\BaseLeaf
{
    public function setup()
    {
        $this->setName("Represents Horses Resource");
        $this->setDescription("Jockey profile data related to horses");
    }

    protected function setupUriParams()
    {
        $this->addUriParam('jockeyId', Parameter::createFromArray([
            'description' => 'Numeric `id` of the Jockey',
            'type' => 'integer',
            'required' => true,
            'example' => 88563,
        ]));
        $this->addUriParam('year', Parameter::createFromArray([
            'description' => 'Numeric representation of an year',
            'type' => 'integer',
            'required' => false,
            'example' => 2013,
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
            'example' => 'turf',
        ]));
        $this->addUriParam('championship', Parameter::createFromArray([
            'description' => 'If parameter is specified - statistics will be calculated regarding championship type code',
            'type' => 'string',
            'required' => false,
            'example' => 'championship',
        ]));

        $this->addGroup(['jockeyId']);
        $this->addGroup(['jockeyId', 'year', 'countryCode', 'raceType']);
        $this->addGroup(['jockeyId', 'year', 'countryCode', 'raceType', 'surface']);
        $this->addGroup(['jockeyId', 'year', 'countryCode', 'raceType', 'surface', 'championship']);
    }

    protected function setupMethods()
    {
        $get = new Method();

        $get->setDescription('Represents Horses Resource');
        $get->addResponse(200, Response::build('Profile/Jockey/horses-example.json', 'Profile/Jockey/horses-schema.json'));

        $this->addMethod('get', $get);
        parent::setupMethods();
    }
}
