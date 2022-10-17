<?php

namespace Tests\ApiStatus\Sql;

use ApiStatus\Sql\Sybase;
use ApiStatus\Sql\Sybase\Nodes;
use Tests\ApiStatus\Sql\Utils\FakePdoTrait;

/**
 * Class SybaseTest
 * @package Tests\ApiStatus\Sql
 */
class SybaseTest extends \PHPUnit\Framework\TestCase
{
    use \Tests\ApiStatus\Config;
    use FakePdoTrait;

    const ENV_SUFFIX = '_API_STATUS';

    protected function tearDown()
    {
        $this->cleanUpServerVars();
    }

    /**
     * @param $config
     * @param array $pdoConfig
     * @param $expectedStatusesOfNodes
     *
     * @dataProvider providerTestObtainStatusesSuccess
     */
    public function testObtainStatusesSuccess($config, array $pdoConfig, $expectedStatusesOfNodes)
    {
        $this->initFakePdo($pdoConfig);
        $sybase = new Nodes($config);

        $actualStatuses = $sybase->getStatuses();

        $this->assertInstanceOf(\stdClass::class, $actualStatuses);
        $this->assertEquals($expectedStatusesOfNodes, (array)$actualStatuses);
    }

    /**
     * @inheritdoc
     */
    public function providerTestObtainStatusesSuccess()
    {
        $config = $this->getConfig([
            "AUTH_NODES_SERVERNAME_API_STATUS" => "RPC113_1",
            "AUTH_NODES_PASSWORD_API_STATUS" => "****",
            "AUTH_NODES_USERNAME_API_STATUS" => "user_1",
        ]);

        return [
            [
                $config,
                [
                    Sybase::ROUTINE_COMMAND => [
                        [], //First resultset is empty
                        [
                            [
                                'datetime' => '2016/06/10 12:28:26',
                                'sample_s' => '5',
                                'elapse_s' => '5.000',
                                'dbs' => 'rpc113_1',
                                'up' => '1 month 5 days',
                                'users' => '115',
                                'commits' => '6',
                                'tps' => '1.200',
                                'SEL' => '28',
                                'INS' => '13',
                                'UPD' => '7',
                                'DEL' => '0',
                                'LIO' => '328',
                                'dbn' => 'mon_db',
                                'ckpts' => '1',
                                'xacts' => '1',
                            ]
                        ]
                    ]
                ],
                [
                    'nodes' => [
                        (Object)[
                            'node_name' => 'RPC113_1',
                            'routine_result' => (Object)[
                                'datetime' => '2016/06/10 12:28:26',
                                'sample_s' => '5',
                                'elapse_s' => '5.000',
                                'dbs' => 'rpc113_1',
                                'up' => '1 month 5 days',
                                'users' => '115',
                                'commits' => '6',
                                'tps' => '1.200',
                                'SEL' => '28',
                                'INS' => '13',
                                'UPD' => '7',
                                'DEL' => '0',
                                'LIO' => '328',
                                'dbn' => 'mon_db',
                                'ckpts' => '1',
                                'xacts' => '1',
                            ],
                            'healthy' => true,
                            'info' => 'Successful connect to Sybase',

                        ],
                    ],
                    'healthy' => true,
                ]
            ]
        ];
    }

    /**
     * @param $config
     *
     * @dataProvider providerTestObtainStatusesFailure
     */
    public function testObtainStatusesFailure($config)
    {
        $sybase = new Nodes($config);
        $this->assertEquals(
            (Object)[
                'nodes' => null,
                'healthy' => null,
            ],
            $sybase->getStatuses()
        );
    }

    /**
     * @inheritdoc
     */
    public function providerTestObtainStatusesFailure()
    {
        $config = new \Phalcon\Config([]);

        return [
            [
                $config
            ]
        ];
    }
}
