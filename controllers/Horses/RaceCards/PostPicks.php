<?php

declare(strict_types=1);

namespace Controllers\Horses\RaceCards;

use Controllers\Basic;
use Api\Exception\NotFound;
use Bo\RaceCards\PostPicks as Bo;
use Api\Result\RaceCards\PostPicks as Result;
use Api\Input\Request\Horses\RaceCards\PostPicks as Request;

/**
 * @package Controllers\Horses\RaceCards
 */
class PostPicks extends Basic
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
        $result->setEmptyResultException(new NotFound(7101));
        $result->setData(['post_picks' => (object)$bo->getData()]);

        $this->setResult($result);
    }
}
