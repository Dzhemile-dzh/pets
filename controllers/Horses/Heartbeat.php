<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 6/8/2016
 * Time: 4:35 PM
 */

namespace Controllers\Horses;

use Api\Input\Request\Horses\Heartbeat\Index as RequestIndex;
use Api\Input\Request\Horses\Heartbeat\DbMonitorAccess as RequestDbMonitorAccess;
use Api\Input\Request\Horses\Heartbeat\Full as RequestFull;
use Api\Input\Request\Horses\Heartbeat\Light as RequestLight;
use Phalcon\DI;

class Heartbeat extends \Controllers\Basic
{
    public function actionGetIndex(RequestIndex $request)
    {
        $bo = new \Bo\Heartbeat\StatusesConcise(DI::getDefault()->getShared('config'), $request);
        DI::getDefault()->setShared('heartbeat', $bo);

        $result = new \Api\Result\Heartbeat\Concise();
        $result->setData(
            (Object)[
                'redis' => $bo->getStatus('cache'),
                'replication_state' => $bo->getStatus('replication'),
                'server_variables' => $bo->getStatus('server_vars'),
                'healthy' => $bo->isHealthy(),
            ]
        );

        $this->setResult($result);
    }

    public function actionGetFull(RequestFull $request)
    {
        $bo = new \Bo\Heartbeat\StatusesFull(DI::getDefault()->getShared('config'), $request);
        DI::getDefault()->setShared('heartbeat', $bo);

        $result = new \Api\Result\Heartbeat\Full();
        $result->setData(
            (Object)[
                'redis' => $bo->getStatus('cache'),
                'sybase' => $bo->getStatus('sql'),
                'replication_state' => $bo->getStatus('replication'),
                'server_variables' => $bo->getStatus('server_vars'),
                'healthy' => $bo->isHealthy(),
            ]
        );

        $this->setResult($result);
    }

    public function actionGetDbMonitorAccess(RequestDbMonitorAccess $request)
    {
        $bo = new \Bo\Heartbeat\DbMonitorAccess(DI::getDefault()->getShared('config'), $request);
        DI::getDefault()->setShared('heartbeat', $bo);

        $result = new \Api\Result\Heartbeat\DbMonitorAccess();
        $result->setData(
            (Object)[
                'access_monitor' => $bo->getStatus('access_monitor'),
            ]
        );

        $this->setResult($result);
    }

    public function actionGetLight(RequestLight $request)
    {
        $bo = new \Bo\Heartbeat\StatusesLight(DI::getDefault()->getShared('config'), $request);
        DI::getDefault()->setShared('heartbeat', $bo);

        $result = new \Api\Result\Heartbeat\Light();
        $result->setData(
            (Object)[
                'redis'            => $bo->getStatus('cache'),
                'sybase'           => $bo->getStatus('sql'),
                'server_variables' => $bo->getStatus('server_vars'),
                'healthy'          => $bo->isHealthy(),
            ]
        );

        $this->setResult($result);
    }
}
