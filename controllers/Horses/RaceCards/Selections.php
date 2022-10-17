<?php

namespace controllers\Horses\RaceCards;

use Api\Input\Request\Horses\RaceCards\Selections as Request;
use Bo\RaceCards;
use Controllers\Basic as ControllersBasic;

/**
 * Class Selections
 * @package controllers\Horses\RaceCards
 */
class Selections extends ControllersBasic
{
    /**
     * @param Request $request
     * @throws \Api\Exception\InternalServerError
     * @throws \Api\Exception\ValidationError
     * @throws \Exception
     */
    public function actionGetIndex(Request $request)
    {
        $raceCards = new RaceCards($request);
        
        $result = new \Api\Result\RaceCards\Selections();
        
        $result->setData($raceCards->getSelections(true));
        
        $this->setResult($result);
    }
}
