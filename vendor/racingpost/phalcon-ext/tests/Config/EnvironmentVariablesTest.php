<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 30-Oct-14
 * Time: 12:11
 */

namespace Tests\Config;


class EnvironmentVariablesTest extends \Tests\CommonTestCase
{

    const CONFIG_LEVEL_SEPARATOR = '_000_';
    const CONFIG_PREFIX = 'API_CONFIG';

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
     * @param $server
     * @param $config
     */
    public function testEnvironmentVariables($server, $config)
    {
        $_SERVER = $server;
        $conf = new \Phalcon\Config\Adapter\EnvironmentVariables(self::CONFIG_LEVEL_SEPARATOR, self::CONFIG_PREFIX);
        $this->assertEquals((array)$config, (array)$conf);
    }

    public function providerEnvironmentVariables()
    {
        return [
            [
                [
                    'API_CONFIG_000_level1_000_var1' => 'val1',
                    'API_CONFIG_000_level1_000_level2_000_var2' => 'val2',
                    'API_CONFIG_000_level1_1_000_var1' => 'val3',
                    'API_CONFIG_000_level1_1_000_var2' => 'val4',
                    'API_CONFIG_000_level1' => 'not be there',
                    'OTHER_PREFIX_000_level1_000_var1' => 'not be there',
                ],
                new \Phalcon\Config([
                    'level1' => [
                        'var1' => 'val1',
                        'level2' => [
                            'var2' => 'val2',
                        ],
                    ],
                    'level1_1' => [
                        'var1' => 'val3',
                        'var2' => 'val4',
                    ],
                ]),
            ],
        ];
    }

    /**
     * @test
     *
     * @dataProvider providerEmptyConfig
     * @expectedException \Phalcon\Config\Exception
     *
     * @param $server
     */
    public function testEmptyConfig($server)
    {
        $_SERVER = $server;
        new \Phalcon\Config\Adapter\EnvironmentVariables(self::CONFIG_LEVEL_SEPARATOR, self::CONFIG_PREFIX);
    }


    public function providerEmptyConfig()
    {
        return [
            [
                [
                    'SERV_VAR' => 'var val',
                    'SOME_OTHER_VAR' => 'some other val',
                    'API_CONFIG_000_level1' => 'not be there',
                    'OTHER_PREFIX_000_level1_000_var1' => 'not be there',
                ],
            ],
        ];
    }


}