<?php

namespace Bo\Profile\RecordByRaceType;

use \Api\DataProvider\Bo\Profile\Owner as DataProvider;
use \Api\Input\Request\Horses\Profile as ProfileRequest;

/**
 * Class Owner
 *
 * @package Bo\Profile\RecordByRaceType
 */
class Owner extends \Bo\Profile\RecordByRaceType
{
    /**
     * @param ProfileRequest $request
     *
     * @return static
     */
    public static function initByModel(ProfileRequest $request)
    {
        $bo = new static($request);

        $request->set(self::MODEL_DEFAULT_INFO, (new \Bo\Profile\Owner($request))->getDataProviderDefaultInfo());
        $request->set(self::MODEL_SEASON, $bo->getModelSeason());

        return $bo;
    }

    /**
     * @return DataProvider\OwnerProfile
     */
    public function getDataProvider()
    {
        static $model;
        if (!$model) {
            $model = new DataProvider\OwnerProfile();
        }
        return $model;
    }
}
