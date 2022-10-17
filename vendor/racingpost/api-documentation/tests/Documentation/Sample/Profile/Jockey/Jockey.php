<?php

namespace Tests\Documentation\Sample\Profile\Jockey;

use \RP\Documentation\Parameter as Parameter;
use \RP\Documentation\Method as Method;
use \RP\Documentation\Response as Response;
use \RP\Documentation\ResponseType as ResponseType;
use RP\Documentation\Group;

class Jockey extends \Tests\Documentation\Sample\BaseLeaf
{
    public function setup()
    {
        $this->setName("Jockey");
        $this->setDescription("Represents Jockey Resource");
    }

    protected function setupUriParams()
    {
        $this->addUriParam('jockeyId', Parameter::createFromArray([
            'description' => 'Numeric `id` of the Jockey',
            'type' => 'integer',
            'required' => true,
            'example' => 4107,
        ]));
    }

    protected function setupMethods()
    {
        $get = new Method();

        $get->setDescription('Returns Jockey data');
        $get->addResponse(200, Response::build('Profile/Jockey/jockey-example.json', 'Profile/Jockey/jockey-schema.json'));
        
        $this->addMethod('get', $get);
        parent::setupMethods();
    }
}
