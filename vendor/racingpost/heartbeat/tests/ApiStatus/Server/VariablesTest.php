<?php

namespace Tests\ApiStatus\Server;

/**
 * Class VariablesTest
 * @package Tests\ApiStatus\Server
 */
class VariablesTest extends \PHPUnit\Framework\TestCase
{
    use \Tests\ApiStatus\Config;

    const SOURCE_FOLDER = '/source/';
    const ENV_SUFFIX = '_API_STATUS';

    /**
     * @inheritdoc
     */
    protected function tearDown()
    {
        $this->cleanUpServerVars();
    }
    /**
     * @param $config
     * @param $expected
     * @param $pathToConfig
     *
     * @dataProvider providerTestObtainStatusesFailure
     */
    public function testObtainStatusesFailure($config, $pathToConfig, $expected)
    {
        $serverVar = (new VariablesMock($this->getConfig($config)))
            ->setPathToConfig(__DIR__ . self::SOURCE_FOLDER . $pathToConfig);
        $this->assertEquals($expected, $serverVar->getStatuses());
    }

    /**
     * @inheritdoc
     */
    public function providerTestObtainStatusesFailure()
    {
        return [
            [
                [
                    'AUTH_DB_ADAPTER_API_STATUS' => true,
                    'AUTH_DB_SERVERNAME_API_STATUS' => true,
                    'AUTH_DB_USERNAME_API_STATUS' => true,
                ],
                'emptyEnv.json',
                (Object)[
                    'missing_variables' => [
                        'AUTH_DB_PASSWORD_API_STATUS',
                        'AUTH_DB_NAME_API_STATUS',
                        'CTRL_APPLICATION_ENVMODE_API_STATUS',
                    ],
                    'info' => null,
                    'healthy' => false
                ]
            ],
            [
                [
                    'AUTH_DB_ADAPTER_API_STATUS' => true,
                    'AUTH_DB_SERVERNAME_API_STATUS' => true,
                    'AUTH_DB_USERNAME_API_STATUS' => true,
                    'AUTH_DB_PASSWORD_API_STATUS' => true,
                    'AUTH_DB_NAME_API_STATUS' => true,
                    'CTRL_APPLICATION_ENVMODE_API_STATUS' => 'STG',
                ],
                'inconsistentEnv.json',
                (Object)[
                    'missing_variables' => null,
                    'info' => 'Config does not contain data for all environments',
                    'healthy' => false
                ]
            ],
            [
                [
                    'AUTH_DB_ADAPTER_API_STATUS' => true,
                    'AUTH_DB_SERVERNAME_API_STATUS' => true,
                    'AUTH_DB_USERNAME_API_STATUS' => true,
                    'CTRL_APPLICATION_ENVMODE_API_STATUS' => 'PR',
                ],
                'inconsistentVars.json',
                (Object)[
                    'missing_variables' => null,
                    'info' => 'The vars are not same for different environments',
                    'healthy' => false
                ]
            ],
            [
                [
                    'AUTH_DB_ADAPTER_API_STATUS' => true,
                    'AUTH_DB_SERVERNAME_API_STATUS' => true,
                    'AUTH_DB_USERNAME_API_STATUS' => true,
                    'AUTH_DB_PASSWORD_API_STATUS' => true,
                    'AUTH_DB_NAME_API_STATUS' => true,
                    'CTRL_APPLICATION_ENVMODE_API_STATUS' => 'DEV',
                ],
                'invalidFormat.json',
                (Object)[
                    'missing_variables' => null,
                    'info' => 'The config file is empty or JSON is not valid',
                    'healthy' => false
                ]
            ],
            [
                [
                    'AUTH_DB_ADAPTER_API_STATUS' => true,
                    'AUTH_DB_SERVERNAME_API_STATUS' => true,
                    'AUTH_DB_USERNAME_API_STATUS' => true,
                    'AUTH_DB_PASSWORD_API_STATUS' => true,
                    'AUTH_DB_NAME_API_STATUS' => true,
                    'CTRL_APPLICATION_ENVMODE_API_STATUS' => 'DEV',
                ],
                'WRONG_NAME_FILE.json',
                (Object)[
                    'missing_variables' => null,
                    'info' => 'The config file does not exist',
                    'healthy' => false
                ]
            ]
        ];
    }

    /**
     * @param $config
     * @param $pathToConfig
     * @param $expected
     *
     * @dataProvider providerTestObtainStatusesSuccess
     */
    public function testObtainStatusesSuccess($config, $pathToConfig, $expected)
    {
        $serverVar = (new VariablesMock($this->getConfig($config)))
            ->setPathToConfig(__DIR__ . self::SOURCE_FOLDER . $pathToConfig);
        $this->assertEquals($expected, $serverVar->getStatuses());
    }

    /**
     * @inheritdoc
     */
    public function providerTestObtainStatusesSuccess()
    {
        return [
            [
                [
                    'AUTH_DB_ADAPTER_API_STATUS' => true,
                    'AUTH_DB_SERVERNAME_API_STATUS' => true,
                    'AUTH_DB_USERNAME_API_STATUS' => true,
                    'AUTH_DB_PASSWORD_API_STATUS' => true,
                    'AUTH_DB_NAME_API_STATUS' => true,
                    'CTRL_APPLICATION_ENVMODE_API_STATUS' => 'LIVE',
                ],
                'valid.json',
                (Object)[
                    'missing_variables' => null,
                    'info' => null,
                    'healthy' => true
                ]
            ]
        ];
    }
}
