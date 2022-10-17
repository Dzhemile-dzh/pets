<?php

namespace Tests\Config;

//TODO: rename after deprecated will be removed
/**
 * @package Tests\Config
 */
class EnvironmentVariablesNewTest extends \Tests\CommonTestCase
{

    const CONFIG_LEVEL_SEPARATOR = '_';
    const CONFIG_SUFFIX = '_API';

    private $serverBak = [];

    protected function setUp()
    {
        $this->serverBak = $_SERVER;
        $_SERVER = [];
    }

    protected function tearDown()
    {
        $_SERVER = $this->serverBak;
    }

    /**
     * @test
     *
     * @dataProvider providerEnvironmentVariables
     *
     * @param array $server
     * @param \Phalcon\Config $config
     */
    public function testEnvironmentVariables(array $server, \Phalcon\Config $config)
    {
        $_SERVER = $server;
        $conf = new \Phalcon\Config\Adapter\EnvironmentVariablesNew(self::CONFIG_LEVEL_SEPARATOR, self::CONFIG_SUFFIX);
        $this->assertEquals((array)$config, (array)$conf);
    }

    /**
     * @return array
     */
    public function providerEnvironmentVariables()
    {
        return [
            [
                [
                    'ANY_LEVEL1_VAR1_API' => 'val1',
                    'PREFIX_LEVEL1_LEVEL2_VAR2_API' => 'val2',
                    'IS_LEVEL11_VAR1_API' => 'val3',
                    'IGNORED_LEVEL11_VAR2_API' => 'val4',
                    'DB_DB_VAR1_API' => 'val5',
                    'DB_DB_USEPREPAREDSTATEMENTS_API' => 'val6',
                    'DB_DB_ENVMODE_API' => 'val7',
                    'ANY_LEVEL1_API' => 'not be there',
                    'OTHER_LEVEL1_VAR1_API_OTHER' => 'not be there'
                ],
                new \Phalcon\Config([
                    'level1' => [
                        'var1' => 'val1',
                        'level2' => [
                            'var2' => 'val2'
                        ]
                    ],
                    'level11' => [
                        'var1' => 'val3',
                        'var2' => 'val4'
                    ],
                    'database' => [
                        'var1' => 'val5',
                        'usePreparedStatements' => 'val6',
                        'envMode' => 'val7'
                    ]
                ])
            ]
        ];
    }

    /**
     * @test
     *
     * @dataProvider providerEmptyConfig
     * @expectedException \Phalcon\Config\Exception
     *
     * @param array $server
     */
    public function testEmptyConfig(array $server)
    {
        new \Phalcon\Config\Adapter\EnvironmentVariablesNew($server, self::CONFIG_LEVEL_SEPARATOR, self::CONFIG_SUFFIX);
    }

    /**
     * @return array
     */
    public function providerEmptyConfig()
    {
        return [
            [
                [
                    'SERV_VAR' => 'var val',
                    'SOME_OTHER_VAR' => 'some other val',
                    'ANY_LEVEL1_API' => 'not be there',
                    'OTHER_LEVEL1_VAR1_API_OTHER' => 'not be there'
                ]
            ]
        ];
    }
}
