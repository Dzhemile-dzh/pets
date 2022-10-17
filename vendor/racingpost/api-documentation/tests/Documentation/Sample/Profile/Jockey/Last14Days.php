<?php

namespace Tests\Documentation\Sample\Profile\Jockey;

use \RP\Documentation\Parameter as Parameter;
use \RP\Documentation\Method as Method;
use \RP\Documentation\Response as Response;
use \RP\Documentation\ResponseType as ResponseType;
use RP\Documentation\Group;

class Last14Days extends \Tests\Documentation\Sample\BaseLeaf
{
    public function setup()
    {
        $this->setName("Last 14 Days");
        $this->setDescription("Represents Last 14 Days Resource");
    }

    protected function setupUriParams()
    {
        $this->addUriParam('jockeyId', Parameter::createFromArray([
            'description' => 'Numeric id of the Jockey to get Last 14 Days',
            'type' => 'integer',
            'required' => true,
            'example' => 90517,
        ]));
    }

    protected function setupMethods()
    {
        $get = new Method();

        $get->setDescription('Returns Last 14 Days data for a given jockey');
        $get->addResponse(200, Response::build('Profile/Jockey/last14-days-example.json', 'Profile/Jockey/last14-days-schema.json'));
        
        $this->addMethod('get', $get);
        parent::setupMethods();
    }
}
