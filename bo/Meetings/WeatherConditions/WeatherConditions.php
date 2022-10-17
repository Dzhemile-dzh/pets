<?php

declare(strict_types=1);

namespace Bo\Meetings\WeatherConditions;

use Api\Exception;
use Api\DataProvider\Bo\Meetings\WeatherConditions\WeatherConditions as Dataprovider;
use Api\Input\Request\Horses\WeatherConditions as Request;
use Bo\Standart;
use InvalidArgumentException;

/**
 * Class WeatherConditions
 *
 * @property Request $request;
 *
 * @package Bo\Meetings\WeatherConditions
 *
 * @throws \Exception
 */
class WeatherConditions extends Standart
{
    /**
     * @return Dataprovider
     *
     * @throws \Exception
     */
    protected function getDataProvider(): object
    {
        return new Dataprovider();
    }

    /**
     * @return array
     *
     * @throws Exception\ValidationError
     */
    public function getMeetingsWeatherConditions(): array {
        $courseQueryId = $this->request->getCourseId() ?? null;
        $data = $this->getDataProvider()->getWeatherConditionsData($this->request->getMeetingDate(), $courseQueryId);

        if (empty($data)) {
            return [];
        }

        foreach ($data as $courseId => $meeting) {
            $meeting->meeting_type = null;
            try {
                $meeting->meeting_type = $this->getModelSelectors()->getMeetingTypeByRacesTypes(array_keys($meeting->race_type_codes));
            } catch (InvalidArgumentException $e) {
            } catch (Exception\ValidationError $e) {
            }
        }

        return $data;
    }
}
