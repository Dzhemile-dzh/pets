<?php

namespace Tests\Documentation\Sample\Profile\Jockey;

use \RP\Documentation\Parameter as Parameter;
use \RP\Documentation\Method as Method;
use \RP\Documentation\Response as Response;
use \RP\Documentation\ResponseType as ResponseType;
use RP\Documentation\Group;

class BookedRides extends \Tests\Documentation\Sample\BaseLeaf
{
    public function setup()
    {
        $this->setName("Booked rides");
        $this->setDescription("Represents Booked rides Resource");
    }

    protected function setupUriParams()
    {
        $this->addUriParam('jockeyId', Parameter::createFromArray([
            'description' => 'Numeric id of the Jockey to get Booked rides',
            'type' => 'integer',
            'required' => true,
            'example' => 85793,
        ]));
    }

    protected function setupMethods()
    {
        $get = new Method();

        $get->setDescription('Returns Booked rides data for a given jockey');
        $get->addResponse(200, Response::build('Profile/Jockey/booked-rides-example.json', 'Profile/Jockey/booked-rides-schema.json'));
        
        $this->addMethod('get', $get);
        parent::setupMethods();
    }
}
