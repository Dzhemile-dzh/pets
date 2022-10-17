<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 11/27/2014
 * Time: 3:51 PM
 */

namespace Phalcon\Config;

class Environment
{
    /**
     * @see setMode()
     */
    const   MODE_PROD = "PROD";
    const   MODE_DEV = "DEV";

    /**
     * @var int
     */
    private $mode = self::MODE_PROD;

    /**
     * @var \Phalcon\Http\RequestInterface
     */
    private $request;

    /**
     * Environment constructor.
     *
     * @param \Phalcon\Http\RequestInterface $request
     */
    public function __construct(\Phalcon\Http\RequestInterface $request)
    {
        if (ini_get('display_errors') == '' || ini_get('display_errors') == '0' || ini_get('error_reporting') == '0') {
            $this->setMode(self::MODE_PROD);
        } else {
            $this->setMode(self::MODE_DEV);
        }
        $this->request = $request;
    }

    /**
     * @param string $mode
     * @return bool
     */
    private function isModeValid($mode)
    {
        return in_array($mode, [self::MODE_PROD, self::MODE_DEV]);
    }

    /**
     * @param $mode
     * @see Environment::MODE_PROD, ENV_MODE_DEV
     */
    private function setMode($mode)
    {
        if ($this->isModeValid($mode)) {
            $this->mode = $mode;
        } else {
            throw new \ErrorException('Wrong mode value');
        }
    }

    /**
     * @return int
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @return bool
     */
    public function isDevMode()
    {
        return $this->mode == self::MODE_DEV;
    }

    /***
     * @return bool
     */
    public function isProdMode()
    {
        return $this->mode == self::MODE_PROD;
    }

    /**
     * @return bool
     */
    public function isShowDetailedErrors()
    {
        return $this->isDevMode();
    }

    /**
     * @return bool
     */
    public function isShowErrorReporting()
    {
        return $this->isDevMode();
    }

    /**
     * @return bool
     */
    public function isProfileSqlQueries()
    {
        return $this->isDevMode() && $this->request->hasQuery('showQueries');
    }
}
