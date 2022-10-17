<?php
namespace Controllers\Horses;

use Api\Exception\NotFound;
use Api\Result\HeadToHead\HeadToHead as IndexResponse;
use \Api\Input\Request\Horses\HeadToHead as Request;
use \Bo\HeadToHead as BO;

/**
 * Class HeadToHead
 *
 * @package Controllers\Horses
 */
class HeadToHead extends \Controllers\Basic
{
    /**
     * @param Request\Index $request
     *
     * @throws \Exception
     */
    public function actionGetIndex(Request\Index $request)
    {
        $requestedHorses = [$request->getFirstHorseUid(), $request->getSecondHorseUid()];
        $bo = new BO($requestedHorses);
        $result = (new IndexResponse())
            ->setEmptyResultException(new NotFound(16000))
            ->setData([
                'head_to_head' => $bo->getHeadToHead(),
                'form_statistics' => $bo->getStatistics(),
                'entries' => $bo->getEntries(),
            ]);

        $this->setResult($result);
    }
}
