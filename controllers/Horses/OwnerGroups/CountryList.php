<?php

namespace Controllers\Horses\OwnerGroups;

use Controllers\Basic;
use Bo\OwnerGroups\CountryList as Bo;
use Api\Result\OwnerGroups\CountryList as Result;
use Api\Input\Request\Horses\OwnerGroups\CountryList as Request;

/**
 * Class HorseList
 *
 * @package Controllers\Horses\OwnerGroups
 */
class CountryList extends Basic
{
    /**
     * @param Request $request
     *
     * @throws \Exception
     */
    public function actionGetData(Request $request): void
    {
        $bo = new Bo($request);

        $result = new Result();
        $result->setData(['country_list' => $bo->getData()]);

        $this->setResult($result);
    }
}
