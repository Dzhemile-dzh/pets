<?php
/**
 * Created by PhpStorm.
 * User: georgi.purnarov
 * Date: 14.9.2018 г.
 * Time: 13:30
 */

declare(strict_types=1);

namespace Controllers\Horses\Native\Profiles\Horses;

use Controllers\Basic;
use Bo\Native\Profiles\Horses\Horse as Bo;
use Api\Result\Native\Profiles\Horses\Horse as Result;
use Api\Input\Request\Horses\Native\Profiles\Horses\Horse as Request;

/**
 * @package Controllers\Horses\Native\Profies\Horses
 */
class Horse extends Basic
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

        $result->setData($bo->getData());

        $this->setResult($result);
    }
}
