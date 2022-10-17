<?php

declare(strict_types=1);

namespace Controllers\Horses;

use Api\Input\Request\Horses;
use Api\Result\Meetings\Meetings as Result;
use Api\Result\Meetings\WeatherConditions\WeatherConditions as WeatherConditionsResult;
use Bo\Meetings\Meetings as MeetingsBo;
use Bo\Meetings\WeatherConditions\WeatherConditions as WeatherConditionsBo;
use Controllers\Basic;

/**
 * @package Controllers\Horses
 */
class Meetings extends Basic
{
    /**
     * @param Horses\Meetings $request
     *
     * @throws \Exception
     */
    public function actionGetData(Horses\Meetings $request): void
    {
        $bo = new MeetingsBo($request);

        $result = new Result;

        $result->setData($bo->getData(), true);
        $this->setResult($result);
    }


    /**
     * @param Horses\WeatherConditions $request
     *
     * @throws \Exception
     */
    public function actionGetWeatherConditions(Horses\WeatherConditions $request): void
    {
        $boWeatherConditions = new WeatherConditionsBo($request);

        $result = new WeatherConditionsResult();
        
        $result->setData(
            (Object) [
                'meetings' => $boWeatherConditions->getMeetingsWeatherConditions()
            ]);

        $this->setResult($result);
    }
}
