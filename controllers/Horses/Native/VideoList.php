<?php

declare(strict_types=1);

namespace Controllers\Horses\Native;

use Controllers\Basic;
use Bo\Native\VideoList as Bo;
use Api\Result\Native\VideoList as Result;
use Api\Input\Request\Horses\Native\VideoList as Request;

/**
 * @package Controllers\Horses\Native
 */
class VideoList extends Basic
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

        $data = $bo->getVideo();
        $result->setData($data);
        $this->setResult($result);
    }
}
