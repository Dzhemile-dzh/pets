<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 10/26/2016
 * Time: 3:03 PM
 */

namespace Bo\Heartbeat;

use Phalcon\Config;

class DbMonitorAccess extends \ApiStatus\FactoryStatuses
{
    /**
     * @var \Api\Input\Request\Horses\Heartbeat\DbMonitorAccess
     */
    private $request;

    public function __construct(Config $config, $request)
    {
        $this->setRequest($request);
        parent::__construct($config);
    }

    /**
     * @return \Api\Input\Request\Horses\Heartbeat\DbMonitorAccess
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param \Api\Input\Request\Horses\Heartbeat\DbMonitorAccess $request
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
            $monitor = (new \ApiStatus\Sql\AccessMonitor($this->getConfig()))->setRedis($di->getShared('redis'));
        } else {
            $monitor = new \Tests\ApiStatus\StatusMock($this->getConfig());
            $monitor->setObtainedStatuses(
                ["connection_count" => null, "connection_threshold" => null, "healthy" => false]
            );
        }
        $this->setAccessMonitor($monitor);
    }
}
