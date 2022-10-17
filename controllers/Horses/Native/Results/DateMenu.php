<?php

declare(strict_types=1);

namespace Controllers\Horses\Native\Results;

use Controllers\Basic;
use Bo\Native\Results\DateMenu as Bo;
use Api\Result\Native\Cards\Results\DateMenu as Result;
use Api\Input\Request\Horses\Native\Results\DateMenu as Request;

/**
 * @package Controllers\Horses\Native\Results
 */
class DateMenu extends Basic
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

        $result->setData( $bo->getData() );

        $this->setResult( $result );
    }
}
