<?php
/**
 * Created by PhpStorm.
 * User: georgi.purnarov
 * Date: 13.9.2018 г.
 * Time: 13:47
 */

namespace Controllers\Horses\Native\Profiles\Horses;

use Controllers\Basic;
use Bo\Native\Profiles\Horses\Search as Bo;
use Api\Result\Native\Profiles\Horses\Search as Result;
use Api\Result\Native\Profiles\Horses\SearchNotFound as NotFound;
use Api\Input\Request\Horses\Native\Profiles\Horses\Search as Request;

/**
 * @package Controllers\Horses\Native\Profiles\Horses
 */
class Search extends Basic
{
    /**
     * @param Request $request
     *
     * @throws \Exception
     */
    public function actionGetData(Request $request): void
    {
        $bo = new Bo($request);

        $searchResult = $bo->getData();

        if(isset($searchResult->fail)) {
            $result = new NotFound();
        }
        else {
            $result = new Result();
        }

        $result->setData(['rp_search' => $searchResult]);
        $this->setResult($result);
    }


}