<?php

namespace Bo\Profile\Jockey;

use Api\DataProvider\Bo\Profile\Jockey\SeasonsAvailable as DataProvider;
use Bo\Profile;

/**
 * Class SeasonsAvailable
 * @package Bo\Profile\Jockey
 */
class SeasonsAvailable extends Profile\Jockey
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
