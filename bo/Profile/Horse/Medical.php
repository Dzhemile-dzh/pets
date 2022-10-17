<?php

namespace Bo\Profile\Horse;

use \Api\DataProvider\Bo\HorseProfile\Medical as DataProvider;

/**
 * Class Medical
 * @package Bo\Profile\Horse
 */
class Medical extends \Bo\Standart
{
    /**
     * @codeCoverageIgnore
     * @return DataProvider
     */
    public function getDataProvider()
    {
        return new DataProvider();
    }

    /**
     * @return \Phalcon\Mvc\Model\Row[]
     */
    public function getResult()
    {
        return $this->getDataProvider()->getMedicalInfo($this->getRequest()->getHorseId());
    }
}
