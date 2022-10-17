<?php

namespace Tests\Stubs\Cache\Strategy;

use Phalcon\DI;
use Phalcon\DiInterface;
use Phalcon\Exception;
use Phalcon\Input\Request;
use RP\Cache\Factory\Peer1CacheComponent;
use RP\Cache\Service\User;
use RP\Util\IUniqueIdentifier;

/**
 *
 */
class Peer1Strategy extends \Phalcon\Cache\Strategy\Peer1Strategy
{

    /**
     * @var \Phalcon\DiInterface
     */
    protected $di;
    private $identifier;

    /**
     * @param DiInterface $di
     */
    public function __construct(DiInterface $di)
    {
        $this->di = $di;

        $this->init();
    }


    public function init()
    {
        $reflection = new \ReflectionClass($this);
        $parent = $reflection;

        while (method_exists($parent, 'getParentClass') && is_object($parent->getParentClass())) {
            $parent = $parent->getParentClass();
        }

        $_involvedVars = $parent->getProperty("_involvedVars");
        $_involvedVars->setAccessible(true);
        $_involvedVars->setValue($this, $this->involvedVars());

        $_productKey = $parent->getProperty("_productKey");
        $_productKey->setAccessible(true);
        $_productKey->setValue($this, $this->productKey());

        $_requestParams = $parent->getProperty("_requestParams");
        $_requestParams->setAccessible(true);
        $_requestParams->setValue($this, $this->requestParams());

        $_requestMethod = $parent->getProperty("_requestMethod");
        $_requestMethod->setAccessible(true);
        $_requestMethod->setValue($this, $this->requestMethod());
    }

    /**
     * @return null
     */
    protected function getParams()
    {
        return null;
    }

    /**
     * @return array
     */
    protected function involvedVars()
    {
        return array (
            0 => 'seasonYearBegin',
            1 => 'seasonYearEnd',
            2 => 'raceType',
            3 => 'countryCode',
            4 => 'surface',
        );
    }

    private function productKey()
    {
        return 'ApiHorses';
    }

    protected function requestParams()
    {
        return array (
            '_url' => '/horses/seasonal-statistics/owner',
            'seasonYearBegin' => '2014',
            'seasonYearEnd' => '2015',
            'raceType' => 'flat',
            'countryCode' => 'GB',
            'surface' => 'aw',
            'XDEBUG_SESSION_START' => '1',
        );
    }

    private function requestMethod()
    {
        return 'GET';
    }
}
