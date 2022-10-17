<?php

namespace Bo\Profile\Trainer;

use Api\DataProvider\Bo\Profile\Trainer\SeasonsAvailable as DataProvider;
use Bo\Profile;

/**
 * Class SeasonsAvailable
 * @package Bo\Profile\Trainer
 */
class SeasonsAvailable extends Profile\Trainer
{
    /**
     * @return DataProvider
     * @codeCoverageIgnore
     */
    protected function getDataProviderSeasonsAvailable()
    {
        return new DataProvider();
    }

    /**
     * @return null|\Phalcon\Mvc\Model\Row\General[]
     */
    public function getSeasonsAvailable()
    {
        return $this->getDataProviderSeasonsAvailable()
            ->getSeasonsAvailableData($this->request);
    }
}
