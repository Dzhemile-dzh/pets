<?php

namespace Tests\ApiStatus;

use Phalcon\Config\Adapter\EnvironmentVariablesNew;

/**
 * Trait Config
 * @package Tests\ApiStatus
 */
trait Config
{
    /**
     * @param $params
     * @return EnvironmentVariablesNew
     */
    protected function getConfig($params)
    {
        global $_SERVER;
        foreach ($params as $key => $value) {
            $_SERVER[$key] = $value;
        }
        return new EnvironmentVariablesNew('_', static::ENV_SUFFIX);
    }

    /**
     * @inheritdoc
     */
    protected function cleanUpServerVars()
    {
        global $_SERVER;
        foreach ($_SERVER as $key => $value) {
            if (strpos($key, static::ENV_SUFFIX)) {
                unset($_SERVER[$key]);
            }
        }
    }
}
