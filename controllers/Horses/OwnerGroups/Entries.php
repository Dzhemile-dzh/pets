<?php

namespace Controllers\Horses\OwnerGroups;

use Api\Constants\Horses as Constants;
use Controllers\Basic;
use Bo\OwnerGroups\Entries as Bo;
use Api\Result\OwnerGroups as Result;
use Api\Input\Request\HorsesRequest as Request;

/**
 * Class HorseList
 *
 * @package Controllers\Horses\OwnerGroups
 */
class Entries extends Basic
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
            $result = new Result\EntriesNoOwnerFilter();
        } else {
            $result = new Result\Entries();
        }
        $result->setData(['entries' => $bo->getData()]);

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

        $result = new Result\Entries();
        $result->setData(['entries' => $bo->getData()]);

        $this->setResult($result);
    }
}
