<?php

namespace Tests\Documentation\Sample\Profile\Jockey;

use \RP\Documentation\Parameter as Parameter;
use \RP\Documentation\Method as Method;
use \RP\Documentation\Response as Response;
use \RP\Documentation\ResponseType as ResponseType;
use RP\Documentation\Group;

class BigRaceWins extends \Tests\Documentation\Sample\BaseLeaf
{
    public function setup()
    {
        $this->setName("Big Race Wins");
        $this->setDescription("Represents Big Race Wins Resource");
    }

    protected function setupUriParams()
    {
        $this->addUriParam('jockeyId', Parameter::createFromArray([
            'description' => 'Numeric id of the Jockey to get Big Race Wins',
            'type' => 'integer',
            'required' => true,
            'example' => 85793,
        ]));
    }

    protected function setupMethods()
    {
        $get = new Method();

        $get->setDescription('Returns Big Race Wins data for a given jockey');
        $get->addResponse(200, Response::build('Profile/Jockey/big-race-wins-example.json', 'Profile/Jockey/big-race-wins-schema.json'));
        
        $this->addMethod('get', $get);
        parent::setupMethods();
    }
}
