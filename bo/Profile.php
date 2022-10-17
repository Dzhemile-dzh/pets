<?php

namespace Bo;

use Models\Bo\Selectors\Profile\Distance;

/**
 * Class Profile
 *
 * @package Bo
 */
abstract class Profile extends Standart
{
    use \Api\Bo\Traits\AddVideoDetails;

    const MODEL_DEFAULT_INFO = 'defaultInfo';
    const MODEL_SEASON = 'season';

    /**
     * @return mixed
     */
    abstract protected function getDataProviderDefaultInfo();

    /**
     * @param \Api\Input\Request\Horses\Profile $request
     * @return static
     */
    public static function initByModel(\Api\Input\Request\Horses\Profile $request)
    {
        $bo = new static($request);

        $request->set(self::MODEL_DEFAULT_INFO, $bo->getDataProviderDefaultInfo());
        $request->set(self::MODEL_SEASON, $bo->getModelSeason());

        return $bo;
    }

    /**
     * @param \Phalcon\Mvc\Model\Row\General[] $result
     *
     * @return array
     */
    public static function getSeasonInfoWithDateRange($result)
    {
        $seasonStartDates = [];
        $seasonEndDates = [];
        if (is_array($result)) {
            foreach ($result as $row) {
                $seasonStartDates[] = new \DateTime($row->season_start_date);
                $seasonEndDates[] = new \DateTime($row->season_end_date);
            }
        }

        $seasonStartDate = null;
        $seasonEndDate = null;
        if (!empty($seasonStartDates) && !empty($seasonEndDates)) {
            $seasonStartDate = min($seasonStartDates);
            $seasonEndDate = max($seasonEndDates);
        }

        $start = $seasonStartDate === null ? null : $seasonStartDate->format('Y-m-d H:i:s');
        $end = $seasonEndDate === null ? null : $seasonEndDate->format('Y-m-d H:i:s');

        return [$start, $end];
    }

    /**
     * @return \Models\Selectors|null
     */
    protected function getModelSelectorsForMan()
    {
        static $selectors = null;

        if (!$selectors) {
            $selectors = new \Models\Selectors();
            $selectors->setDistance(new Distance());
            $selectors->setDb(new \Models\Bo\Selectors\Database());
        }

        return $selectors;
    }
}
