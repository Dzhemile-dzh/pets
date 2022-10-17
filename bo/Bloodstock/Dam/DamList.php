<?php

namespace Bo\Bloodstock\Dam;

use Bo\Standart;
use \Api\DataProvider\Bo\Bloodstock\Dam\DamList as DataProvider;

/**
 * Class DamList
 * @package Bo\Bloodstock\Dam
 */
class DamList extends Standart
{
    public function getDataProvider()
    {
        return new DataProvider();
    }

    public function getDamList()
    {
        $selectors = $this->getModelSelectors();

        $result = $this->getDataProvider()->getDamList(
            $this->getRequest(),
            $selectors
        );

        return $result;
    }
}
