<?php

namespace controllers\Horses\RaceCards;

use Api\Input\Request\Horses\RaceCards\GodolphinReplay as Request;
use Bo\RaceCards\GodolphinReplay as Bo;
use Controllers\Basic as ControllersBasic;
use GuzzleHttp\Client as GuzzleHttp;

/**
 * Class GodolphinReplay
 * @package controllers\Horses\RaceCards
 */
class GodolphinReplay extends ControllersBasic
{
    /**
     * @param Request $request
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function actionCheckForReplay(Request $request)
    {
        $guzzleClient = new GuzzleHttp();
        $bo = new Bo($guzzleClient);
        
        $result = new \Api\Result\RaceCards\GodolphinReplay();
        
        $result->setData([
            'hasVideo' => $bo->checkRaceReplay($request->getRaceId())
        ]);
        
        $this->setResult($result);
    }
}
