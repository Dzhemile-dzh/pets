<?php

namespace Controllers\Horses\OwnerGroups;

use Api\Constants\Horses as Constants;
use Controllers\Basic;
use Bo\OwnerGroups\Results as Bo;
use Api\Result\OwnerGroups as Result;
use Api\Input\Request\HorsesRequest as Request;

/**
 * Class Results
 *
 * @package Controllers\Horses\OwnerGroups
 */
class Results extends Basic
{
    /**
     * @param Request $request
     *
     * @throws \Exception
     */
    public function actionGetData(Request $request): void
    {
        $bo = new Bo($request);

        if ($request->getOwnerGroupId() == Constants::SKIP_OWNER_GROUP_ID_CHECK) {
            $result = new Result\ResultsNoOwnerFilter();
        } else {
            $result = new Result\Results();
        }

        $result->setData(['results' => $bo->getData()]);

        $this->setResult($result);
    }
    /**
     * @param Request $request
     *
     * @throws \Exception
     */
    public function actionSeasonSire(Request $request): void
    {

        $bo = new Bo($request);

        $result = new Result\Results();
        $result->setData(['results' => $bo->getData()]);

        $this->setResult($result);
    }
}
