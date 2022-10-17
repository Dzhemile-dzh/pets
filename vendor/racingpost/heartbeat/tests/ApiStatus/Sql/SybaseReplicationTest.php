<?php

namespace Tests\ApiStatus\Sql;

use ApiStatus\Sql\Sybase\Replication;
use Tests\ApiStatus\Sql\Utils\FakePdoTrait;

/**
 * Class SybaseReplicationTest
 * @package Tests\ApiStatus\Sql
 */
class SybaseReplicationTest extends \PHPUnit\Framework\TestCase
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
        $sybase = new Replication($config);

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
            "AUTH_NODES_SERVERNAME_API_STATUS" => "RPC113_1;RPC113_2",
            "AUTH_NODES_PASSWORD_API_STATUS" => "****;****",
            "AUTH_NODES_USERNAME_API_STATUS" => "user_1;user_2",
            "CTRL_DB_PERSISTENT_API_STATUS" => 0,
            "CTRL_DB_USEPREPAREDSTATEMENTS_API_STATUS" => 1,
            "AUTH_DB_NAME_API_STATUS" => "horses_113",
        ]);

        return [
            [
                $config,
                [
                    Replication::ROUTINE_COMMAND => [
                        [],//first resultset is empty
                        [
                            [
                                'timecheck' => '2016/09/13,13:08:16',
                                'dbs' => 'RPCDB4_1',
                                'dbn' => 'master',
                                'last_replicated_on_' => 'non-replicate DB',
                                '__min' => 'X',
                            ]
                        ]
                    ]
                ],
                [
                    'replication' => (Object)[
                        'node_name' => 'RPC113_1',
                        'routine_result' => (Object)[
                            'timecheck' => '2016/09/13,13:08:16',
                            'dbs' => 'RPCDB4_1',
                            'dbn' => 'master',
                            'last_replicated_on_' => 'non-replicate DB',
                            '__min' => 'X',
                        ],
                        'healthy' => true,
                        'info' => 'Successful connect to Sybase',
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
        $sybase = new Replication($config);
        $this->assertEquals(
            (Object)[
                'replication' => null,
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
