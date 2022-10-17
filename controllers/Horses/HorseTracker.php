<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 7/6/2016
 * Time: 12:19 PM
 */

namespace Controllers\Horses;

use Api\Input\Request\Horses\HorseTracker as Request;
use Api\SharedConstants;

class HorseTracker extends \Controllers\Basic
{
    /**
     * @param \Api\Input\Request\Horses\HorseTracker\Index $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetIndex(Request\Index $request)
    {
        $horseTracker = new \Bo\HorseTracker($request);

        $result = new \Api\Result\HorseTracker\HorseTracker();
        $result->setData(
            (Object)[
                'horses' => $horseTracker->getHorsesByUser()
            ]
        );

        $this->setResult($result);
        $this->storeRedisKey($request->getUserId());
    }

    /**
     * @param Request\Entries $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetEntries(Request\Entries $request)
    {
        $bo = new \Bo\HorseTracker($request);

        $result = (new \Api\Result\HorseTracker\Entries())
            ->setData(
                (Object)[
                    'entries' => $bo->getEntries(),
                ]
            );
        $this->setResult($result);
        $this->storeRedisKey($request->getUserId());
    }

    private function storeRedisKey($regId)
    {
        $contentAttributes = $this->getDI()->getShared('contentAttributes');
        $key = $contentAttributes->tags()->getUniqueKey();
        if ($key && $this->getDI()->has('redis')) {
            /** @var \Redis $redis */
            $redis = $this->getDI()->getShared('redis');
            $redis->hSet(
                sprintf(SharedConstants::UGC_CLEAR_CACHE_TEMPLATE, $regId, 'horse-tracker'),
                $key,
                time()
            );
        } else {
            $this->getDI()->getShared('logger')->warning('Service \'redis\' wasn\'t found in the dependency injection container');
        }
    }
}
