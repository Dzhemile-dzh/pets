<?php

namespace Bo\Tipping;

use Bo\Standart;
use Api\DataProvider\Bo\Tipping as DataProvider;

/**
 * Class Tippings
 *
 * @package Bo\Tipping
 */
class Singles extends Standart
{
    /**
     * @var \Api\Input\Request\Horses\Tipping\Singles
     */
    protected $request;

    /**
     * @return DataProvider
     */
    protected function getDataProvider()
    {
        return new DataProvider();
    }

    /**
     * @return array|null
     */
    public function getRaceDate()
    {
        return $this->getDataProvider()->getTippings($this->request->getRaceDate());
    }
}
