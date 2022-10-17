<?php

namespace Bo\Profile\RecordByRaceType;

use \Api\DataProvider\Bo\Profile\Jockey as DataProvider;
use \Api\Input\Request\Horses\Profile as ProfileRequest;

/**
 * Class Jockey
 *
 * @package Bo\Profile\RecordByRaceType
 */
class Jockey extends \Bo\Profile\RecordByRaceType
{
    /**
     * @param ProfileRequest $request
     *
     * @return static
     */
    public static function initByModel(ProfileRequest $request)
    {
        $bo = new static($request);

        $request->set(self::MODEL_DEFAULT_INFO, (new \Bo\Profile\Jockey($request))->getDataProviderDefaultInfo());
        $request->set(self::MODEL_SEASON, $bo->getModelSeason());

        return $bo;
    }

    /**
     * @return DataProvider\JockeyProfile
     */
    public function getDataProvider()
    {
        static $dataProvider;
        if (!$dataProvider) {
            $dataProvider = new DataProvider\JockeyProfile();
        }
        return $dataProvider;
    }
}
