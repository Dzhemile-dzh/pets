<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 6/8/2016
 * Time: 4:22 PM
 */

namespace Bo\Heartbeat;

use Phalcon\Config;
use Api\Input\Request\Horses\Heartbeat\Index as Request;

class StatusesConcise extends \ApiStatus\FactoryStatuses
{
    const RELATIVE_PATH_TO_CONFIG = '/env/server_variable.json';
    /**
     * @var \Api\Input\Request\Horses\Heartbeat\Index
     */
    private $request;

    public function __construct(Config $config, $request)
    {
        $this->setRequest($request);
        parent::__construct($config);
    }

    /**
     * @return \Api\Input\Request\Horses\Heartbeat\Index
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param \Api\Input\Request\Horses\Heartbeat\Index $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    protected function buildStatuses()
    {
        $di = \Phalcon\DI::getDefault();
        $di->getShared('db')->close();

        if ($di->has('redis')) {
            $redis = (new \ApiStatus\Cache\Redis($this->getConfig()))->setRedis($di->getShared('redis'));
        } else {
            $redis = new \Tests\ApiStatus\StatusMock($this->getConfig());
            $redis->setObtainedStatuses(["statuses" => null, "healthy" => false]);
        }
        $this->setCache($redis);

        $this->setServerVars(
            (new \ApiStatus\Server\Variables($this->getConfig()))
                ->setPathToConfig(ROOT_DIR . self::RELATIVE_PATH_TO_CONFIG)
        );

        $this->setReplication(new \ApiStatus\Sql\Sybase\Replication($this->getConfig()));
    }
}
