<?php

namespace Bo\Profile\Owner;

use Api\DataProvider\Bo\Profile\Owner\SeasonsAvailable as DataProvider;
use Bo\Profile;

/**
 * Class SeasonsAvailable
 * @package Bo\Profile\Owner
 */
class SeasonsAvailable extends Profile\Owner
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
