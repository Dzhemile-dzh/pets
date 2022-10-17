<?php

declare(strict_types=1);

namespace Controllers\Horses\Ads;

use \Api\Input\Request\Horses\Ads\SuccessBoxes\Index;

/**
 * Class SuccessBoxes
 *
 * @package Controllers\Horses\Ads
 */
class SuccessBoxes extends \Controllers\Basic
{
    /**
     * @param Index $request
     *
     * @throws \Exception
     */
    public function actionGetIndex(Index $request): void
    {
        $successBoxesBo = new \Bo\Ads\SuccessBoxes($request);

        $result = (new \Api\Result\Ads\Index())->setData(
            (Object)[
                'success_boxes' => $successBoxesBo->getData(),
            ]
        );

        $this->setResult($result);
    }
}
