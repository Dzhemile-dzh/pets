<?php

namespace Bo\Profile\RecordByRaceType;

use \Api\DataProvider\Bo\Profile\Trainer as DataProvider;
use \Api\Input\Request\Horses\Profile as ProfileRequest;

/**
 * Class Trainer
 *
 * @package Bo\Profile\RecordByRaceType
 */
class Trainer extends \Bo\Profile\RecordByRaceType
{
    /**
     * @param ProfileRequest $request
     *
     * @return static
     */
    public static function initByModel(ProfileRequest $request)
    {
        $bo = new static($request);

        $request->set(self::MODEL_DEFAULT_INFO, (new \Bo\Profile\Trainer($request))->getDataProviderDefaultInfo());
        $request->set(self::MODEL_SEASON, $bo->getModelSeason());

        return $bo;
    }

    /**
     * @return DataProvider\TrainerProfile
     */
    public function getDataProvider()
    {
        static $dataProvider;
        if (!$dataProvider) {
            $dataProvider = new DataProvider\TrainerProfile();
        }
        return $dataProvider;
    }
}
