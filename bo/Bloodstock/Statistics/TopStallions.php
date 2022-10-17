<?php

namespace Bo\Bloodstock\Statistics;

use Bo\Standart;
use Models\Bo\Bloodstock\StallionStatistics\Horses;

/**
 * Class TopStallions
 *
 * @package Bo\Bloodstock\Statistics
 */
class TopStallions extends Standart
{
    /**
     * @return Horses
     *
     * @codeCoverageIgnore
     */
    protected function getModelTopStatistics()
    {
        return new Horses();
    }

    /**
     * return array
     */
    public function getTopStallions()
    {
        $model = $this->getModelTopStatistics();
        $model->dropStallionsTmpTables();
        $status = $model->createStallionsTmpTable($this->request);

        if ($status === false) {
            return null;
        }

        $progenyPerformersLimit = $this->request->getProgenyPerformersLimit();
        $progenyPerformers = $model->getStallionProgenyPerformers($progenyPerformersLimit);
        $model->dropStallionsTmpTables();

        $stallions = $model->getTopStallions($this->request);

        foreach ($stallions as $id => $stallion) {
            $stallions[$id]->progeny_performers = (array_key_exists($stallion->horse_uid, $progenyPerformers))
                ? array_slice(
                    array_values($progenyPerformers[$stallion->horse_uid]),
                    0,
                    $progenyPerformersLimit
                )
                : null;
        }

        return $stallions;
    }
}
