<?php

namespace Bo\Bloodstock\Stallion;

use Bo\Bloodstock\Stallion;

/**
 * Class ProgenyEntries
 * @package Bo\Bloodstock\Stallion
 */
class ProgenyEntries extends Stallion
{
    /**
     * @return \Api\Row\Bloodstock\Stallion\ProgenyEntries[]|null
     */
    public function getProgenyEntries()
    {
        return $this->getProgenyEntriesDataProvider()->getProgenyEntries(
            $this->request,
            $this->getModelSelectors()
        );
    }

    /**
     * @return \Api\DataProvider\Bo\Bloodstock\Stallion\RaceInstance
     */
    public function getDataProviderDefaultInfo()
    {
        return $this->getRaceInstanceDataProvider();
    }
}
