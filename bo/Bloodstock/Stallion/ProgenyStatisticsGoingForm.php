<?php

namespace Bo\Bloodstock\Stallion;

use Bo\Bloodstock\Stallion;
use Phalcon\Mvc\Model\Row\General;

/**
 * Class ProgenyStatisticsGoingForm
 * @package Bo\Bloodstock\Stallion
 */
class ProgenyStatisticsGoingForm extends Stallion
{
    /**
     * @param array $data
     *
     * @return int
     */
    protected function countTotalRuns($data)
    {
        return array_reduce(
            $data,
            function ($carry, $item) {
                return $carry + $item->runs;
            },
            0
        );
    }

    /**
     * @param $data
     * @param $totalRuns
     */
    protected function countImpactValues($data, $totalRuns)
    {
        if ($totalRuns > 0) {
            foreach ($data as &$category) {
                $runPercentage = $category->runs * 100 / $totalRuns;
                $category->impact_value = round($category->win_percentage / $runPercentage, 2);
            }
            unset($category);
        }
    }

    /**
     * @return General
     */
    public function getGoingForm()
    {
        $data = $this->getProgenyStatisticsGoingFormDataProvider()->getGoingForm($this->request);

        $this->countImpactValues($data, $this->countTotalRuns($data));

        return General::createFromArray(array_merge(
            [
                'heavy_soft' => null,
                'good_to_soft' => null,
                'good' => null,
                'good_to_firm' => null,
                'firm' => null,
            ],
            $data
        ));
    }

    /**
     * @param array $horseIds
     *
     * @return General[]
     */
    public function getGoingFormByHorses(array $horseIds)
    {
        $sireData = $this->getProgenyStatisticsGoingFormDataProvider()->getGoingFormBySire($horseIds, 'detailed');

        foreach ($sireData as &$sireRow) {
            $this->countImpactValues($sireRow->going_groups, $this->countTotalRuns($sireRow->going_groups));
        }

        return $sireData;
    }
}
