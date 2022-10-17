<?php

namespace ApiStatus\Server;

use ApiStatus\Exception;

/**
 * Class Variables
 * @package ApiStatus\Server
 */
class Variables extends \ApiStatus\Status
{
    /**
     * @var string
     */
    private $pathToConfig = '';

    const DEV = 0;
    const STG = 1;
    const PR = 2;
    const LIVE = 3;

    const ENV_COUNT = 4;

    const ERROR_INCONSISTENT_ENV = 'Config does not contain data for all environments';
    const ERROR_INCONSISTENT_VARS = 'The vars are not same for different environments';
    const ERROR_ABSENT_FILE = 'The config file does not exist';
    const ERROR_EMPTY_FILE = 'The config file is empty or JSON is not valid';
    const ERROR_EMPTY_ENV = 'The environment is not set or it does not exist in the config';

    const ERROR_DELIMITER = '. ';

    /**
     * @return string
     */
    public function getPathToConfig()
    {
        return $this->pathToConfig;
    }

    /**
     * @param $pathToConfig
     *
     * @return $this
     */
    public function setPathToConfig($pathToConfig)
    {
        $this->pathToConfig = $pathToConfig;
        return $this;
    }

    /**
     * @return array
     */
    protected function getDefinedServerVarList()
    {
        $varList = array_keys(filter_input_array(INPUT_SERVER));
        return $varList;
    }

    /**
     * @inheritdoc
     */
    protected function obtainStatuses()
    {
        return function () {
            try {
                $configsFromFile = $this->getConfigsFromFile();
                $predefinedData = array_values($configsFromFile);
                $this->checkIntegrityData($predefinedData);
                $currentConfig = $this->getCurrentConfig($configsFromFile);
                $definedConfig = $this->getDefinedServerVarList();
                $missed = array_values(array_diff($currentConfig, $definedConfig));
            } catch (Exception $e) {
                $errorMessage = $e->getMessage();
            }

            $this->statuses = (Object)[
                'missing_variables' => empty($missed) ? null : $missed,
                'info' => empty($errorMessage) ? null : $errorMessage,
                'healthy' => empty($missed) && empty($errorMessage) ? true : false
            ];
        };
    }

    /**
     * @throws \ApiStatus\Exception
     * @return array
     */
    private function getConfigsFromFile()
    {
        $filePath = $this->getPathToConfig();

        if (file_exists($filePath)) {
            $string = file_get_contents($filePath);
            $array = json_decode($string, true);
            if (empty($array)) {
                throw new Exception(self::ERROR_EMPTY_FILE);
            }
        } else {
            throw new Exception(self::ERROR_ABSENT_FILE);
        }
        return $array;
    }

    /**
     * @throws \ApiStatus\Exception
     * @param array $predefinedData
     */
    private function checkIntegrityData($predefinedData)
    {
        if (!$this->isVarsForAllEnvExist($predefinedData)) {
            throw new Exception(self::ERROR_INCONSISTENT_ENV);
        }

        $serverVars = $this->getNamesOfServerVars($predefinedData);

        if ($this->isDiscrepancyBetweenEnvExists($serverVars)) {
            throw new Exception(self::ERROR_INCONSISTENT_VARS);
        }
    }

    /**
     * @param $predefinedData
     *
     * @return array
     */
    private function getNamesOfServerVars($predefinedData)
    {
        $serverVars = [];
        foreach ($predefinedData as $envConfig) {
            $varNames = array_keys($envConfig);
            $serverVars[] = $varNames;
        }
        return $serverVars;
    }

    /**
     * @param $serverVars
     *
     * @return bool
     */
    private function isDiscrepancyBetweenEnvExists($serverVars)
    {
        foreach ($serverVars as &$serverVar) {
            sort($serverVar);
        }

        return !($serverVars[self::DEV] == $serverVars[self::STG]
            && $serverVars[self::STG] == $serverVars[self::PR]
            && $serverVars[self::PR] == $serverVars[self::LIVE]);
    }

    /**
     * @param array $predefinedData
     *
     * @return bool
     */
    private function isVarsForAllEnvExist(array $predefinedData)
    {
        return count($predefinedData) === self::ENV_COUNT;
    }

    /**
     * @param array $configsFromFile
     *
     * @return array
     */
    private function getCurrentConfig(array $configsFromFile)
    {
        $currentConfig = current($configsFromFile);
        return array_keys($currentConfig);
    }
}
