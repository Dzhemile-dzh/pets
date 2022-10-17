<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 23-Oct-14
 * Time: 16:38
 */
//TODO: remove deprecated after all projects will migrate to the new vars

namespace Phalcon\Config\Adapter;

/**
 * @deprecated
 * Class EnvironmentVariables
 *
 * @package Phalcon\Config\Adapter
 */
class EnvironmentVariables extends \Phalcon\Config
{

    const MIN_VARIABLE_DEPTH = 3;

    public function __construct($levelSeparator = '_000_', $configPrefix = 'API_CONFIG')
    {
        $config = [];

        foreach ($_SERVER as $envVarName => $varVal) {
            $itemLocation = explode($levelSeparator, $envVarName);
            if (count($itemLocation) < self::MIN_VARIABLE_DEPTH || $itemLocation[0] != $configPrefix) {
                continue;
            }
            array_shift($itemLocation);
            $varName = array_pop($itemLocation);
            $currentItem = &$config;
            foreach ($itemLocation as $keyName) {
                if (!isset($currentItem[$keyName])) {
                    $currentItem[$keyName] = [];
                }
                $currentItem = &$currentItem[$keyName];
            }

            $currentItem[$varName] = $varVal;
        }

        if (empty($config)) {
            throw new \Phalcon\Config\Exception("Configuration cannot be loaded from environment variables");
        }

        parent::__construct($config);
    }
}
