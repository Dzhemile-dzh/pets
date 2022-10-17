<?php
//ToDo: rename after deprecated class will be discontinued

namespace Phalcon\Config\Adapter;

class EnvironmentVariablesNew extends \Phalcon\Config
{

    private static $searchtMap = [
        '/^db$/',
        '/^usepreparedstatements$/',
        '/^envmode$/'
    ];

    private static $replacementMap = [
        'database',
        'usePreparedStatements',
        'envMode'
    ];

    const SKIP_PREFIX = 'REDIRECT_';
    const MIN_VARIABLE_DEPTH = 3;

    /**
     * @param string $levelSeparator
     * @param string $configSuffix
     *
     * @throws \Phalcon\Config\Exception
     */
    public function __construct($levelSeparator = '_', $configSuffix = 'API_HORSES')
    {
        $config = [];

        foreach ($_SERVER as $envVarName => $varVal) {
            if (substr($envVarName, -strlen($configSuffix)) !== $configSuffix ||
                strpos($envVarName, self::SKIP_PREFIX) === 0
            ) {
                continue;
            }
            $envVarName = substr_replace($envVarName, '', -strlen($configSuffix));
            $itemLocation = explode($levelSeparator, $envVarName);
            if (count($itemLocation) < self::MIN_VARIABLE_DEPTH) {
                continue;
            }
            array_shift($itemLocation);
            $varName = strtolower(array_pop($itemLocation));
            //override infra hardcoded name and restore camelcase
            $varName = preg_replace(self::$searchtMap, self::$replacementMap, $varName);
            $currentItem = &$config;
            foreach ($itemLocation as $keyName) {
                $keyName = strtolower($keyName);
                //override infra hardcoded name and restore camelcase
                $keyName = preg_replace(self::$searchtMap, self::$replacementMap, $keyName);
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
